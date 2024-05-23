<?php

/**
 * List of contributors and useful stats around it.
 */

namespace WordPressDotOrg\FiveForTheFuture\Reports;

use WordPressDotOrg\FiveForTheFuture;
use WordPressDotOrg\FiveForTheFuture\{ Contributor, Pledge, XProfile };
use WordPressdotorg\MU_Plugins\Utilities\Export_CSV;

use WP_Query;

defined( 'WPINC' ) || die();

add_action( 'admin_menu', __NAMESPACE__ . '\add_admin_pages' );
add_action( 'admin_enqueue_scripts',  __NAMESPACE__ . '\enqueue_assets' );
add_action( 'admin_init', __NAMESPACE__ . '\export_csv' );

/**
 * Register admin page.
 */
function add_admin_pages() {
	add_submenu_page(
		'edit.php?post_type=5ftf_pledge',
		'Company Report',
		'Company Report',
		'manage_options',
		'5ftf_company_report',
		__NAMESPACE__ . '\render_company_report_page'
	);
}

/**
 * Enqueue assets/
 */
function enqueue_assets() {
	wp_register_style(
		'5ftf-admin',
		plugins_url( 'assets/css/admin.css', __DIR__ ),
		array(),
		filemtime( FiveForTheFuture\PATH . '/assets/css/admin.css' )
	);

	if ( is_admin() ) {
		$current_page = get_current_screen();
		if ( '5ftf_pledge_page_5ftf_company_report' == $current_page->id ) {
			wp_enqueue_style( '5ftf-admin' );
		}
	}
}

/**
 * Render results and download button.
 */
function render_company_report_page() {

	$status = sanitize_title( $_GET['status'] );

	if ( ! in_array( $status, array( 'draft', '5ftf-deactivated', 'publish' ) ) ) {
		$status = 'all';
	}

	$pledges = get_posts( array(
		'post_type' => '5ftf_pledge',
		'post_status' => $status,
		'posts_per_page' => 250, // set to 250 to avoid unexpected memory overuse.
		'orderby' => 'post_title',
		'order' => 'ASC',
	) );

	// Add visible warning on page if we hit the upper limit of the query.
	if ( 250 == count( $pledges ) ) {
		echo '<p>WARNING: pledge limit reached, check the code query.</p>';
	}
	?>

	<p>
		<b>Total:</b><?php echo count( $pledges ); ?>
		<b>Status:</b>
		<a href="edit.php?post_type=5ftf_pledge&page=5ftf_company_report">All</a>
		<a href="edit.php?post_type=5ftf_pledge&page=5ftf_company_report&status=draft">Draft</a>
		<a href="edit.php?post_type=5ftf_pledge&page=5ftf_company_report&status=publish">Publish</a>
		<a href="edit.php?post_type=5ftf_pledge&page=5ftf_company_report&status=5ftf-deactivated">Deactivated</a>
	</p>

	<form action="#" method="post">
		<input type="hidden" name="wporg-5ftf-cr" value="1">
		<input type="hidden" name="status" value="<?php echo esc_attr( $status ); ?>">
		<input type="submit" value="Export">
		<?php wp_nonce_field( '5ftf_download_company_report' ); ?>
	</form>

	<table id="wporg-5ftf-company-report">
		<tr>
			<th>Company</th>
			<th>Status</th>
			<th>Total Hours</th>
			<th>Contributors</th>
			<th>Usernames</th>
			<th>Team(s)</th>
			<th>URL</th>
			<th>Pledge URL</th>
			<th>Email</th>
			<th>Pledge created</th>
			<th>Pledge updated</th>
		</tr>
	<?php
	$all_contributors = 0;

	$export_data = array();
	foreach ( $pledges as $pledge ) {
		$company_url    = get_post_meta( $pledge->ID, '5ftf_org-domain', true );
		$pledge_url     = get_post_meta( $pledge->ID, '5ftf_org-url', true );
		$email          = get_post_meta( $pledge->ID, '5ftf_org-pledge-email', true );
		$date_created   = substr( $pledge->post_date, 0, 10 );
		$date_modified  = substr( $pledge->post_modified, 0, 10 );

		$team           = XProfile\get_aggregate_contributor_data_for_pledge( $pledge->ID );
		$hours          = $team['hours'];
		$contributors   = $team['contributors'];

		$all_contributors += $contributors;
		$users          = Contributor\get_pledge_contributors( $pledge->ID, 'publish' );
		$wporg_profiles = wp_list_pluck( $users, 'post_title' );

		$usernames = implode( ', ', $wporg_profiles );
		$teams     = implode( ', ', str_replace( ' Team', '', $team['teams'] ) );

		echo '<tr>';
		echo ' <td><a href="' . esc_url( $pledge->guid ) . '">' . esc_html( $pledge->post_title ) . '</a></td>';
		echo ' <td>' . esc_html( $pledge->post_status ) . '</td>';
		echo ' <td class="center">' . esc_html( $hours ) . '</td>';
		echo ' <td class="center">' . esc_html( $contributors ) . '</td>';
		echo ' <td>' . esc_html( $usernames ) . '</td>';
		echo ' <td>' . esc_html( $teams ) . '</td>';
		echo ' <td>' . esc_html( $company_url ) . '</td>';
		echo ' <td>' . esc_html( $pledge_url ) . '</td>';
		echo ' <td>' . esc_html( $email ). '</td>';
		echo ' <td>' . esc_html( $date_created ) . '</td>';
		echo ' <td>' . esc_html( $date_modified ) . '</td>';
		echo '</tr>';
		$export_data[] = array( $pledge->post_title, $pledge->post_status, $hours, $contributors, $usernames, $teams, $company_url, $pledge_url, $email, $date_created, $date_modified );
	}
	echo '</table>';
	echo '<p>Total contributors: ' . esc_html( $all_contributors ) . '</p>';

	// Sets a transient to avoid double data lookup for export, might need to adjust timeout to longer.
	set_transient( 'wporg_5ftf_company_report_' . $status, $export_data, 60 );
}

/**
 * CSV export runner, grabs data lazily from a transient.
 */
function export_csv() {

	if (
		! isset( $_POST['wporg-5ftf-cr'] ) ||
		! current_user_can( 'manage_options' ) ||
		! wp_verify_nonce( $_POST['_wpnonce'], '5ftf_download_company_report' )
	) {
		return;
	}

	$status = $_POST['status'];

	$data = get_transient( 'wporg_5ftf_company_report_' . $status );

	$exporter = new Export_CSV( array(
		'filename' => 'company-report-' . $status,
		'headers'  => array( 'Company', 'Status', 'Hours', 'Contributors', 'Users', 'Teams', 'Company URL', 'Pledge URL', 'Email', 'Created', 'Last updated' ),
		'data'     => $data,
	) );

	$exporter->emit_file();
}
