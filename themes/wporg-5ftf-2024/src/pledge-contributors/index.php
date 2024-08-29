<?php
/**
 * Block Name: Pledge contributors
 * Description: List out the contributors for this organization's pledge.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\FiveForTheFuture_2024\Pledge_Contributors;
const TRUNCATED_MAX = 15;

defined( 'WPINC' ) || die();

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Register the block.
 */
function init() {
	register_block_type( dirname( __DIR__, 2 ) . '/build/pledge-contributors' );
	register_block_style(
		'wporg/pledge-contributors',
		array(
			'name'  => 'truncated',
			'label' => _x( 'Truncated', 'block style name', 'wporg-5ftf' ),
		)
	);
}
