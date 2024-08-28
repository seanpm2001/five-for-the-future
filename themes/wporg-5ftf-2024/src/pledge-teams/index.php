<?php
/**
 * Block Name: Pledge teams
 * Description: List out the teams supported by this organization's pledge.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\FiveForTheFuture_2024\Pledge_Teams;

defined( 'WPINC' ) || die();

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Register the block.
 */
function init() {
	register_block_type( dirname( __DIR__, 2 ) . '/build/pledge-teams' );
}
