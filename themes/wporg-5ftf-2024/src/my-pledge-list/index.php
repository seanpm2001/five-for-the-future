<?php
/**
 * Block Name: My pledges
 * Description: List out the pledges for this user.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\FiveForTheFuture_2024\My_Pledge_List;

defined( 'WPINC' ) || die();

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Register the block.
 */
function init() {
	register_block_type( dirname( __DIR__, 2 ) . '/build/my-pledge-list' );
}

/**
 * Helper function to render single pledges in My Pledge list.
 */
function render_single_pledge( $contributor_post, $has_profile_data ) {
	global $post;
	// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- Intentionally overriding so it's available in post blocks.
	$post = get_post( $contributor_post->post_parent );
	setup_postdata( $post );
	ob_start();
	?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"},"className":"my-pledges__pledge"} -->
<div class="wp-block-group my-pledges__pledge">
	<!-- wp:group {"style":{"border":{"style":"solid","width":"1px","color":"#d9d9d9","radius":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"backgroundColor":"light-grey-2","layout":{"type":"constrained"}} -->
	<div class="wp-block-group has-border-color has-light-grey-2-background-color has-background" style="border-color:#d9d9d9;border-style:solid;border-width:1px;border-radius:2px;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
		<!-- wp:post-featured-image {"aspectRatio":"1","width":"275px","scale":"contain"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
			<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"heading-4","fontFamily":"inter"} /-->

			<!-- wp:paragraph -->
			<p>
				<?php
				if ( 'publish' === $contributor_post->post_status ) {
					echo esc_html( sprintf(
						__( 'You confirmed this pledge on %s', 'wporg-5ftf' ),
						gmdate( get_option( 'date_format' ), strtotime( $contributor_post->post_date ) )
					) );
				} else {
					echo esc_html_e( 'This organization would like to pledge your time', 'wporg-5ftf' );
				}
				?>
			</p>
			<!-- /wp:paragraph -->

			<div class="my-pledges__pledge-actions">
				<form action="" method="post">
					<input type="hidden" name="contributor_post_id" value="<?php echo esc_attr( $contributor_post->ID ); ?>" />

					<?php if ( 'pending' === $contributor_post->post_status ) : ?>
						<?php wp_nonce_field( 'join_decline_organization_' . $contributor_post->ID ); ?>

						<div class="wp-block-button is-small">
							<input
								type="submit"
								class="button button-default wp-block-button__link wp-element-button"
								name="join_organization"
								value="Join Organization"
								<?php if ( ! $has_profile_data ) : ?>
									disabled="disabled"
								<?php endif; ?>
							/>
						</div>

						<div class="wp-block-button is-style-outline is-small">
							<input
								type="submit"
								class="button button-danger button-link wp-block-button__link wp-element-button"
								name="decline_invitation"
								value="Decline Invitation"
							/>
						</div>

					<?php elseif ( 'publish' === $contributor_post->post_status ) : ?>
						<?php wp_nonce_field( 'leave_organization_' . $contributor_post->ID ); ?>

						<div class="wp-block-button is-style-outline is-destructive is-small">
							<input
								type="submit"
								class="button button-danger wp-block-button__link wp-element-button"
								name="leave_organization"
								value="Leave Organization"
							/>
						</div>

					<?php endif; ?>

				</form>
			</div>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
	<?php
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Content escaped inline.
	echo do_blocks( ob_get_clean() );
	wp_reset_postdata();
}

/**
 * Helper function to render notices using the notice block styles.
 *
 * @param string $type Type of message to render, one of `tip`, `info`, `alert`, `warning`.
 * @param string $message The message to display.
 */
function render_notice( $type, $message ) {
	ob_start();
	?>
<!-- wp:wporg/notice {"type":"<?php echo esc_attr( $type ); ?>"} -->
<div class="wp-block-wporg-notice is-<?php echo esc_attr( $type ); ?>-notice">
	<div class="wp-block-wporg-notice__icon"></div>
	<div class="wp-block-wporg-notice__content"><p><?php echo wp_kses_data( $message ); ?></p></div>
</div>
<!-- /wp:wporg/notice -->
	<?php
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Content escaped inline.
	echo do_blocks( ob_get_clean() );
}