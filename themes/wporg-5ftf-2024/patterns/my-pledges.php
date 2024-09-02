<?php
/**
 * Title: My Pledges
 * Slug: wporg-5ftf-2024/my-pledges
 * Inserter: no
 */

?>
<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:group {"style":{"border":{"radius":"50%"}},"backgroundColor":"light-grey-2","layout":{"type":"constrained"}} -->
	<div class="wp-block-group has-light-grey-2-background-color has-background" style="border-radius:50%">
		<!-- wp:post-featured-image {"aspectRatio":"4/3","width":"110px","scale":"contain","style":{"border":{"radius":"50%"}}} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical"}} -->
	<div class="wp-block-group">
		<!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"top":"0"}}}} /-->

		<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"wporg-5ftf/pledge-meta","args":{"key":"user-contribution-details"}}}}} -->
		<p>Pledged <strong>40 hours a week</strong> (edit) across 1 organization.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide">
	<!-- wp:wporg/my-pledge-list /-->

	<!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
	<div style="margin-top:var(--wp--preset--spacing--40);height:0" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
</div>
<!-- /wp:group -->
