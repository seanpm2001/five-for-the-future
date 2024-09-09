<?php
/**
 * Block Name: Edit pledge button
 * Description: Render the pledge edit button and form.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\FiveForTheFuture_2024\Pledge_Edit_Button_Block;

use WP_HTML_Tag_Processor;

defined( 'WPINC' ) || die();

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Register the block.
 */
function init() {
	register_block_type(
		dirname( dirname( __DIR__ ) ) . '/build/pledge-edit-button',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}

/**
 * Render the block content.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the block markup.
 */
function render( $attributes, $content, $block ) {
	ob_start();
	do_action( 'pledge_footer' );
	$content = ob_get_clean();

	$html = new WP_HTML_Tag_Processor( $content );
	$html->next_tag( 'button' );
	$html->add_class( 'wp-block-button__link' );

	$wrapper_attributes = get_block_wrapper_attributes( [ 'class' => 'wp-block-button is-style-outline is-small' ]);
	return sprintf(
		'<div %s>%s</div>',
		$wrapper_attributes,
		$html->get_updated_html()
	);
}
