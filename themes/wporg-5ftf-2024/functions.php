<?php

namespace WordPressDotOrg\Theme\FiveForTheFuture_2024;

use function WordPressDotOrg\FiveForTheFuture\PledgeMeta\get_pledge_meta;
use const WordPressDotOrg\FiveForTheFuture\Pledge\CPT_ID as PLEDGE_POST_TYPE;

require_once __DIR__ . '/inc/block-config.php';
require_once __DIR__ . '/inc/block-bindings.php';

// Block files.
require_once __DIR__ . '/src/pledge-contributors/index.php';
require_once __DIR__ . '/src/pledge-edit-button/index.php';
require_once __DIR__ . '/src/pledge-teams/index.php';

/**
 * Actions and filters.
 */
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
add_filter( 'the_content', __NAMESPACE__ . '\inject_pledge_content' );

/**
 * Enqueue scripts and styles.
 */
function enqueue_assets() {
	$asset_file = get_theme_file_path( 'build/style/index.asset.php' );
	if ( ! file_exists( $asset_file ) ) {
		return;
	}

	// The parent style is registered as `wporg-parent-2021-style`, and will be loaded unless
	// explicitly unregistered. We can load any child-theme overrides by declaring the parent
	// stylesheet as a dependency.

	$metadata = require $asset_file;
	wp_enqueue_style(
		'wporg-5ftf-2024',
		get_theme_file_uri( 'build/style/style-index.css' ),
		array( 'wporg-parent-2021-style', 'wporg-global-fonts' ),
		$metadata['version']
	);
}

/**
 * Replace the post content with the pledge description.
 *
 * @param string $content Content of the current post.
 *
 * @return string Updated content.
 */
function inject_pledge_content( $content ) {
	if ( PLEDGE_POST_TYPE !== get_post_type() ) {
		return $content;
	}

	remove_filter( 'the_content', __NAMESPACE__ . '\inject_pledge_content' );

	$data = get_pledge_meta( get_the_ID() );
	$content = apply_filters( 'the_content', $data['org-description'] );
	return $content;
}
