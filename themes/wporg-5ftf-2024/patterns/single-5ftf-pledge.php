<?php
/**
 * Title: Pledge Detail
 * Slug: wporg-5ftf-2024/single-5ftf-pledge
 * Inserter: no
 */

?>
<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap"},"className":"org-pledge-header"} -->
<div class="wp-block-group alignwide org-pledge-header" style="margin-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:group {"style":{"border":{"radius":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}}},"backgroundColor":"light-grey-2","layout":{"type":"constrained"}} -->
	<div class="wp-block-group has-light-grey-2-background-color has-background" style="border-radius:2px;padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)">
		<!-- wp:post-featured-image {"aspectRatio":"16/9","width":"160px","scale":"contain"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical"}} -->
	<div class="wp-block-group">
		<!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"top":"0"}}}} /-->

		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"wporg-5ftf/pledge-meta","args":{"key":"org-url-link"}}}},"className":"external-link"} -->
			<p class="external-link">https://url.com</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|charcoal-5"}}}},"textColor":"charcoal-5","fontSize":"extra-small"} -->
			<p class="has-charcoal-5-color has-text-color has-link-color has-extra-small-font-size">•</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e( 'This organization contributes 5% of their resources to the WordPress project.', 'wporg-5ftf' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column {"width":"60%"} -->
	<div class="wp-block-column" style="flex-basis:60%">
		<!-- wp:post-content /-->

		<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"color":{"background":"#00000012"}}} -->
		<hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);background-color:#00000012;color:#00000012"/>
		<!-- /wp:separator -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button is-style-outline is-destructive is-small">
				<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/report/' ) ); ?>"><?php esc_html_e( 'Report a problem', 'wporg-5ftf' ); ?></a>
			</div>
			<!-- /wp:button -->

			<!-- wp:wporg/pledge-edit-button /-->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"40%"} -->
	<div class="wp-block-column" style="flex-basis:40%">
		<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"large","fontFamily":"inter"} -->
		<h2 class="wp-block-heading has-inter-font-family has-large-font-size" style="margin-top:0;font-style:normal;font-weight:600">Contributions</h2>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"wporg-5ftf/pledge-meta","args":{"key":"org-contribution-details"}}}}} -->
		<p></p>
		<!-- /wp:paragraph -->
		
		<!-- wp:wporg/pledge-teams /-->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--40)">
	<!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"large","fontFamily":"inter"} -->
	<h2 class="wp-block-heading has-inter-font-family has-large-font-size" style="margin-bottom:var(--wp--preset--spacing--40);font-style:normal;font-weight:600">Contributors</h2>
	<!-- /wp:heading -->

	<!-- wp:wporg/pledge-contributors /-->
</div>
<!-- /wp:group -->
