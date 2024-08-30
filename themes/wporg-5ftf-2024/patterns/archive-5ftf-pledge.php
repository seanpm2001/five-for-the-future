<?php
/**
 * Title: Pledge List
 * Slug: wporg-5ftf-2024/archive-5ftf-pledge
 * Categories: wporg
 */

$page_title = __( 'Pledges', 'wporg-5ftf' );
if ( is_search() ) {
	$page_title = __( 'Search results', 'wporg-5ftf' );
}
?>

<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide">
	<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:0"><?php echo esc_html( $page_title ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button">
			<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/for-organizations/' ) ); ?>"><?php esc_html_e( 'Pledge your company', 'wporg-5ftf' ); ?></a>
		</div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:query {"queryId":15,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"tagName":"main","align":"wide"} -->
<main class="wp-block-query alignwide">

	<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--40)">
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"}} -->
		<div class="wp-block-group">
			<!-- wp:search {"showLabel":false,"placeholder":"<?php esc_html_e( 'Search pledges', 'wporg-5ftf' ); ?>","width":100,"widthUnit":"%","buttonText":"<?php esc_html_e( 'Search', 'wporg-5ftf' ); ?>","buttonPosition":"button-inside","buttonUseIcon":true,"className":"is-style-secondary-search-control"} /-->

			<!-- wp:wporg/query-total /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap"},"className":"wporg-query-filters"} -->
		<div class="wp-block-group wporg-query-filters">
			<!-- wp:wporg/query-filter {"key":"sort","multiple":false} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|60"}}} -->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
		<div class="wp-block-group">
			<!-- wp:group {"style":{"border":{"style":"solid","width":"1px","color":"#d9d9d9","radius":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"backgroundColor":"light-grey-2","layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-border-color has-light-grey-2-background-color has-background" style="border-color:#d9d9d9;border-style:solid;border-width:1px;border-radius:2px;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
				<!-- wp:post-featured-image {"aspectRatio":"1","width":"275px","scale":"contain"} /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"layout":{"type":"constrained"}} -->
			<div class="wp-block-group">
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"heading-4","fontFamily":"inter"} /-->

					<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|charcoal-4"}}}},"textColor":"charcoal-4","metadata":{"bindings":{"content":{"source":"wporg-5ftf/pledge-meta","args":{"key":"org-contribution-short-details"}}}}} -->
					<p class="has-charcoal-4-color has-text-color has-link-color"></p>
					<!-- /wp:paragraph -->

					<!-- wp:post-excerpt {"moreText":"[MORE]","showMoreOnNewLine":false,"excerptLength":50} /-->
				</div>
				<!-- /wp:group -->

				<!-- wp:wporg/pledge-contributors {"className":"is-style-truncated"} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->

	<!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
	<div style="margin-top:var(--wp--preset--spacing--40);height:0" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:query-pagination -->
		<!-- wp:query-pagination-previous {"label":"<?php esc_html_e( 'Previous', 'wporg-5ftf' ); ?>"} /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next {"label":"<?php esc_html_e( 'Next', 'wporg-5ftf' ); ?>"} /-->
	<!-- /wp:query-pagination -->
</main>
<!-- /wp:query -->
