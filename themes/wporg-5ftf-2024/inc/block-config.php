<?php
/**
 * Set up configuration for dynamic blocks.
 */

namespace WordPressDotOrg\Theme\FiveForTheFuture_2024\Block_Config;

/**
 * Actions and filters.
 */
add_filter( 'wporg_block_navigation_menus', __NAMESPACE__ . '\add_site_navigation_menus' );
add_filter( 'render_block_core/post-excerpt', __NAMESPACE__ . '\inject_excerpt_more_link', 10, 3 );

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

/**
 * Update the excerpt block content, replacing the placeholder string with
 * dynamic text including the pledge title for unique link text.
 *
 * @param string   $block_content The block content.
 * @param array    $block         The full block, including name and attributes.
 * @param WP_Block $instance      The block instance.
 *
 * @return string Updated block content.
 */
function inject_excerpt_more_link( $block_content, $block, $instance ) {
	$more_text = sprintf(
		__( 'Continue reading<span class="screen-reader-text"> %s</span>', 'wporg-5ftf' ),
		get_the_title( $instance->context['postId'] )
	);
	return str_replace( '[MORE]', $more_text,  $block_content );
}
