<?php
namespace WordPressDotOrg\FiveForTheFuture\View;

use function WordPressDotOrg\FiveForTheFuture\get_views_path;

/** @var array $contributors */
/** @var int   $pledge_id */
/** @var bool  $readonly */

add_action(
	is_admin() ? 'admin_footer' : 'wp_footer',
	function () use ( $readonly ) {
		?>
<script type="text/template" id="tmpl-5ftf-contributor-lists">
	<# if ( data.publish.length ) { #>
		<h3 class="contributor-list-heading"><?php esc_html_e( 'Confirmed', 'wporg-5ftf' ); ?></h3>
		<table class="contributor-list publish striped widefat">
			<thead>
				<th scope="col"><?php esc_html_e( 'Contributor', 'wporg-5ftf' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Date Confirmed', 'wporg-5ftf' ); ?></th>
				<?php if ( ! $readonly ) : ?>
				<th scope="col"><?php esc_html_e( 'Remove Contributor', 'wporg-5ftf' ); ?></th>
				<?php endif; ?>
			</thead>
			<tbody>{{{ data.publish }}}</tbody>
		</table>
	<# } #>
	<# if ( data.pending.length ) { #>
		<h3 class="contributor-list-heading"><?php esc_html_e( 'Unconfirmed', 'wporg-5ftf' ); ?></h3>
		<table class="contributor-list pending striped widefat">
			<thead>
				<tr>
					<th scope="col"><?php esc_html_e( 'Contributor', 'wporg-5ftf' ); ?></th>
					<th scope="col" class="resend-confirm"><?php esc_html_e( 'Resend Confirmation', 'wporg-5ftf' ); ?></th>
					<?php if ( ! $readonly ) : ?>
					<th scope="col"><?php esc_html_e( 'Remove Contributor', 'wporg-5ftf' ); ?></th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>{{{ data.pending }}}</tbody>
		</table>
	<# } #>
	<# if ( ! data.publish.length && ! data.pending.length ) { #>
		<p><?php esc_html_e( 'There are no contributors added to this pledge yet.', 'wporg-5ftf' ); ?></p>
	<# } #>
</script>

<script type="text/template" id="tmpl-5ftf-contributor">
	<tr>
		<th scope="row">
			{{{ data.avatar }}}
			<span class="contributor-list__name">
				{{ data.displayName }} ({{ data.name }})
			</span>
		</th>
		<# if ( 'pending' === data.status ) { #>
			<td class="resend-confirm">
				<div class="wp-block-button is-style-outline is-small">
					<button
						class="button wp-block-button__link"
						data-action="resend-contributor-confirmation"
						data-contributor-post="{{ data.contributorId }}"
					>
						{{ data.resendLabel }}
					</button>
				</div>
			</td>
		<# } else { #>
			<td>{{ data.publishDate }}</td>
		<# } #>
		<?php if ( ! $readonly ) : ?>
		<td>
			<div class="wp-block-button is-style-outline is-small is-destructive">
				<button
					class="button button-link button-link-delete wp-block-button__link"
					data-action="remove-contributor"
					data-contributor-post="{{ data.contributorId }}"
					data-confirm="{{ data.removeConfirm }}"
					aria-label="{{ data.removeLabel }}"
				>
					<span class="dashicons dashicons-no-alt" aria-hidden="true"></span>
					<?php esc_html_e( 'Remove', 'wporg-5ftf' ); ?>
				</button>
			</div>
		</td>
		<?php endif; ?>
	</tr>
</script>
		<?php
	}
);
?>

<div id="5ftf-contributors">
	<div class="pledge-contributors pledge-status__<?php echo esc_attr( get_post_status( $pledge_id ) ); ?> wp-block-table">
		<?php if ( ! empty( $contributors ) ) : ?>
			<?php
			printf(
				'<script>var fftfContributors = JSON.parse( decodeURIComponent( \'%s\' ) );</script>',
				rawurlencode( wp_json_encode( $contributors ) )
			);
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'There are no contributors added to this pledge yet.', 'wporg-5ftf' ); ?></p>
		<?php endif; ?>
	</div>

	<?php
	if ( ! $readonly ) :
		$data = array( 'pledge-contributors' => '' );
		require get_views_path() . 'inputs-pledge-contributors.php';
		?>

		<div id="add-contrib-message" role="alert" aria-atomic="true"></div>

		<div class="wp-block-button is-style-outline is-small">
			<button
				class="button button-secondary wp-block-button__link"
				data-action="add-contributor"
			>
				<?php esc_html_e( 'Add new contributors', 'wporg-5ftf' ); ?>
			</button>
		</div>
	<?php endif; ?>
</div>
