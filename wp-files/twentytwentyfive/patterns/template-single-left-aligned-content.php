<?php
/**
 * Title: Post with left-aligned content
 * Slug: twentytwentyfive/post-with-left-aligned-content
 * Template Types: posts, single
 * Viewport width: 1400
 * Inserter: no
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:template-part {"slug":"header-large-title"} /-->

	<!-- wp:group {"tagName":"main","align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
	<main class="wp-block-group alignwide">
		<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-50 pb-50"} -->
		<div class="wp-block-group pt-50 pb-50">
			<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
			<div class="wp-block-columns alignwide">
				<!-- wp:column {"width":"40%"} -->
				<div class="wp-block-column" style="flex-basis:40%">
					<!-- wp:group {"align":"wide","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"},"className":"gap-20"} -->
					<div class="wp-block-group alignwide gap-20">
						<!-- wp:post-title {"level":1,"align":"wide","className":"text-x-large"} /-->
						<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"className":"gap-[4px] text-small"} -->
						<div class="wp-block-group gap-[4px] text-small">
							<!-- wp:paragraph -->
							<p><?php echo esc_html_x( 'by', 'Prefix before the author name. The post author name is displayed in a separate block.', 'twentytwentyfive' ); ?></p>
							<!-- /wp:paragraph -->
							<!-- wp:post-author-name {"isLink":true,"className":"text-small"} /-->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column {"width":"60%"} -->
				<div class="wp-block-column" style="flex-basis:60%">
					<!-- wp:post-featured-image /-->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

			<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
			<div class="wp-block-columns alignwide">
				<!-- wp:column {"width":"100%"} -->
				<div class="wp-block-column" style="flex-basis:100%">
					<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap"},"className":"gap-[4px] text-small"} -->
					<div class="wp-block-group alignwide gap-[4px] text-small">
						<!-- wp:post-date /-->
						<!-- wp:paragraph -->
						<p><?php echo esc_html_x( '·', 'Separator between date and categories.', 'twentytwentyfive' ); ?></p>
						<!-- /wp:paragraph -->
						<!-- wp:post-terms {"term":"category"} /-->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-50 pb-50"} -->
		<div class="wp-block-group pt-50 pb-50">
			<!-- wp:post-content {"align":"wide","layout":{"type":"constrained","justifyContent":"left","contentSize":"800px"}} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"align":"wide","layout":{"type":"default"},"className":"mt-60 mb-60"} -->
		<div class="wp-block-group alignwide mt-60 mb-60">
			<!-- wp:group {"align":"wide","layout":{"type":"constrained"},"className":"border-t-accent-6 border-t"} -->
			<div class="wp-block-group alignwide border-t-accent-6 border-t">
				<!-- wp:group {"ariaLabel":"<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>","tagName":"nav","align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"className":"pt-40 pb-40"} -->
				<nav class="wp-block-group alignwide pt-40 pb-40" aria-label="<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>">
					<!-- wp:post-navigation-link {"type":"previous","showTitle":true,"arrow":"arrow"} /-->
					<!-- wp:post-navigation-link {"showTitle":true,"arrow":"arrow"} /-->
				</nav>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-50 pb-50"} -->
		<div class="wp-block-group pt-50 pb-50">
			<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
			<div class="wp-block-columns alignwide">
				<!-- wp:column {"width":"40%"} -->
				<div class="wp-block-column" style="flex-basis:40%">
					<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
					<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column {"width":"60%","className":"pt-0 pb-0"} -->
				<div class="wp-block-column pt-0 pb-0" style=";flex-basis:60%">
					<!-- wp:pattern {"slug":"twentytwentyfive/comments"} /-->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->
	</main>
	<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer-columns"} /-->
