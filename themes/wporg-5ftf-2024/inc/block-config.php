<?php
/**
 * Set up configuration for dynamic blocks.
 */

namespace WordPressDotOrg\Theme\FiveForTheFuture_2024\Block_Config;

add_filter( 'wporg_block_navigation_menus', __NAMESPACE__ . '\add_site_navigation_menus' );

/**
 * Provide a list of local navigation menus.
 */
function add_site_navigation_menus( $menus ) {
	global $wp_query;

	$menu = array();

	$menu[] = array(
		'label' => __( 'For individuals', 'wporg-5ftf' ),
		'url'   => '/for-individuals/',
	);
	$menu[] = array(
		'label' => __( 'For organizations', 'wporg-5ftf' ),
		'url'   => '/for-organizations/',
	);
	$menu[] = array(
		'label' => __( 'Handbook', 'wporg-5ftf' ),
		'url'   => '/handbook/',
	);
	$menu[] = array(
		'label' => __( 'Pledges', 'wporg-5ftf' ),
		'url'   => '/pledges/',
	);
	$menu[] = array(
		'label' => __( 'Contact', 'wporg-5ftf' ),
		'url'   => '/contact/',
	);
	$menu[] = array(
		'label'     => __( 'My pledges', 'wporg-5ftf' ),
		'url'       => '/my-pledges/',
		'className' => 'has-separator',
	);

	return array(
		'main' => $menu,
	);
}
