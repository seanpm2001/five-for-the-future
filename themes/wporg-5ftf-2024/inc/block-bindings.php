<?php
/**
 * Set up custom block bindings.
 */

namespace WordPressdotorg\Theme\FiveForTheFuture_2024\Block_Bindings;

use function WordPressDotOrg\FiveForTheFuture\PledgeMeta\get_pledge_meta;
use function WordPressDotOrg\FiveForTheFuture\XProfile\get_aggregate_contributor_data_for_pledge;

add_action( 'init', __NAMESPACE__ . '\register_block_bindings' );

/**
 * Register block bindings.
 *
 * This registers some sources which can be used to dynamically inject content
 * into block text or attributes.
 */
function register_block_bindings() {
	register_block_bindings_source(
		'wporg-5ftf/pledge-meta',
		array(
			'label' => 'Pledge meta',
			'uses_context' => [ 'postId' ],
			'get_value_callback' => __NAMESPACE__ . '\get_meta_binding_value',
		)
	);
}

/**
 * Callback to provide the binding value.
 */
function get_meta_binding_value( $args, $block ) {
	if ( ! isset( $args['key'] ) ) {
		return '';
	}

	$data = get_pledge_meta( $block->context['postId'] );
	if ( empty( $data ) ) {
		return '';
	}

	switch ( $args['key'] ) {
		case 'org-url-link':
			return sprintf(
				'<a href="%s" rel="nofollow">%s</a>',
				esc_url( $data['org-url'] ),
				esc_html( $data['org-domain'] )
			);
		case 'org-contribution-details':
			$contribution_data = get_aggregate_contributor_data_for_pledge( $block->context['postId'] );
			return sprintf(
				__( '%1$s sponsors %2$s for a total of <strong>%3$s hours</strong> per week across <strong>%4$d teams</strong>.', 'wporg-5ftf' ),
				get_the_title( $block->context['postId'] ),
				sprintf(
					_n( '<strong>%d contributor</strong>', '<strong>%d contributors</strong>', $contribution_data['contributors'], 'wporg-5ftf' ),
					number_format_i18n( absint( $contribution_data['contributors'] ) )
				),
				number_format_i18n( absint( $contribution_data['hours'] ) ),
				count( $contribution_data['teams'] )
			);
		case 'org-contribution-short-details':
			$contribution_data = get_aggregate_contributor_data_for_pledge( $block->context['postId'] );
			return sprintf(
				__( 'Has pledged %s hours per week.', 'wporg-5ftf' ),
				number_format_i18n( absint( $contribution_data['hours'] ) ),
			);
	}
}
