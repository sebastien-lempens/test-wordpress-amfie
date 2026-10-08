<?php
/**
 * Title: Text blog single post
 * Slug: twentytwentyfive/template-single-text-blog
 * Template Types: posts, single
 * Viewport width: 1400
 * Inserter: no
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"},"className":"mt-60"} -->
<main class="wp-block-group mt-60">
	<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-60"} -->
	<div class="wp-block-group alignfull pt-60">
		<!-- wp:post-title {"level":1} /-->
		<!-- wp:post-terms {"term":"category","className":"font-[400] not-italic"} /-->
		<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
		<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->
		<!-- wp:post-content {"align":"full","layout":{"type":"constrained"}} /-->

		<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-60 pb-60"} -->
		<div class="wp-block-group pt-60 pb-60">
		<!-- wp:post-terms {"term":"post_tag","separator":"  ","className":"is-style-post-terms-1"} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pr-50 pl-50 mt-60 mb-60"} -->
		<div class="wp-block-group alignfull pr-50 pl-50 mt-60 mb-60">
			<!-- wp:group {"ariaLabel":"<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>","tagName":"nav","align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"className":"pt-40 pb-40 border-t-accent-6 border-t"} -->
			<nav class="wp-block-group alignwide pt-40 pb-40 border-t-accent-6 border-t" aria-label="<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>">
				<!-- wp:post-navigation-link {"type":"previous","showTitle":true,"arrow":"arrow"} /-->
				<!-- wp:post-navigation-link {"showTitle":true,"arrow":"arrow"} /-->
			</nav>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<!-- wp:pattern {"slug":"twentytwentyfive/comments"} /-->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer"} /-->
