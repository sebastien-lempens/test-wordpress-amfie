<?php
/**
 * Title: Right-aligned single post
 * Slug: twentytwentyfive/template-single-vertical-header-blog
 * Template Types: posts, single
 * Viewport width: 1400
 * Inserter: no
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"left":"0"}}},"className":"pr-0 pl-0 pt-0 pb-0"} -->
<div class="wp-block-columns is-not-stacked-on-mobile pr-0 pl-0 pt-0 pb-0">
	<!-- wp:column {"width":"8rem"} -->
	<div class="wp-block-column" style="flex-basis:8rem">
		<!-- wp:template-part {"slug":"vertical-header"} /-->
	</div>
	<!-- /wp:column -->
	<!-- wp:column {"width":"90%","layout":{"type":"default"},"className":"pt-50 pb-50 pl-50 pr-0"} -->
	<div class="wp-block-column pt-50 pb-50 pl-50 pr-0" style=";flex-basis:90%">
		<!-- wp:group {"tagName":"main","layout":{"type":"default"}} -->
		<main class="wp-block-group">
			<!-- wp:group {"layout":{"type":"default"},"className":"pr-50 pl-0"} -->
			<div class="wp-block-group pr-50 pl-0">
				<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
				<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
				<div class="wp-block-group">
					<!-- wp:post-title {"level":1,"style":{"layout":{"selfStretch":"fixed","flexSize":"70vw"}},"className":"text-xx-large"} /-->
					<!-- wp:post-date {"textAlign":"right","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}},"className":"text-small text-contrast"} /-->
					</div>
				<!-- /wp:group -->

				<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
				<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
			</div>
			<!-- /wp:group -->
			<!-- wp:post-featured-image {"className":"aspect-[16/9]"} /-->
			<!-- wp:group {"layout":{"type":"default"},"className":"pr-50"} -->
			<div class="wp-block-group pr-50">
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"className":"pt-20 pb-20"} -->
				<div class="wp-block-group pt-20 pb-20">
					<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"className":"gap-20"} -->
					<div class="wp-block-group gap-20">
						<!-- wp:avatar {"size":30,"isLink":true,"className":"rounded-[100px]"} /-->
						<!-- wp:post-author-name {"isLink":true,"className":"text-small"} /-->
					</div>
					<!-- /wp:group -->
					<!-- wp:post-terms {"term":"post_tag","separator":"  ","className":"is-style-post-terms-1 font-[400] not-italic"} /-->
				</div>
				<!-- /wp:group -->

				<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
				<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->

				<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70"}}}} -->
				<div class="wp-block-columns">
					<!-- wp:column {"width":"75%","className":"pb-60"} -->
					<div class="wp-block-column pb-60" style=";flex-basis:75%">
						<!-- wp:post-content {"layout":{"type":"default"}} /-->
					</div>
					<!-- /wp:column -->
					<!-- wp:column {"width":"25%"} -->
					<div class="wp-block-column" style="flex-basis:25%">
						<!-- wp:template-part {"slug":"sidebar"} /-->
					</div>
					<!-- /wp:column -->
				</div>
				<!-- /wp:columns -->

				<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
				<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
			</div>
			<!-- /wp:group -->
			<!-- wp:group {"ariaLabel":"<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>","tagName":"nav","align":"full","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"},"className":"pt-40 pb-40 gap-40 border-t-accent-6 border-t"} -->
			<nav class="wp-block-group alignfull pt-40 pb-40 gap-40 border-t-accent-6 border-t" aria-label="<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>">
				<!-- wp:post-navigation-link {"type":"previous","showTitle":true,"arrow":"arrow"} /-->
				<!-- wp:post-navigation-link {"showTitle":true,"arrow":"arrow"} /-->
			</nav>
			<!-- /wp:group -->
		</main>
		<!-- /wp:group -->
		<!-- wp:group {"tagName":"aside","align":"wide","layout":{"type":"constrained","justifyContent":"left"},"className":"pt-0 pb-0 pl-0 pr-0"} -->
		<aside class="wp-block-group alignwide pt-0 pb-0 pl-0 pr-0">
			<!-- wp:pattern {"slug":"twentytwentyfive/comments"} /-->
		</aside>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:template-part {"slug":"footer"} /-->
