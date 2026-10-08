<?php
/**
 * Title: Offset post without featured image
 * Slug: twentytwentyfive/template-single-offset
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

<!-- wp:group {"tagName":"main","align":"wide","layout":{"type":"default"}} -->
<main class="wp-block-group alignwide">
	<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-80 pb-40 mt-0 mb-0"} -->
	<div class="wp-block-group pt-80 pb-40 mt-0 mb-0">
		<!-- wp:group {"align":"wide","layout":{"type":"default"},"className":"pb-50 border-b-accent-6 border-b"} -->
		<div class="wp-block-group alignwide pb-50 border-b-accent-6 border-b">
			<!-- wp:post-title {"level":1,"align":"wide","className":"text-xx-large"} /-->
			<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-30 pb-50 mt-0 mb-0"} -->
	<div class="wp-block-group pt-30 pb-50 mt-0 mb-0">
		<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"30%"} -->
				<div class="wp-block-column" style="flex-basis:30%">
					<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"className":"gap-[4px] text-small"} -->
					<div class="wp-block-group gap-[4px] text-small">
						<!-- wp:paragraph --><p><?php echo esc_html_x( 'Published on', 'Prefix before the post date block.', 'twentytwentyfive' ); ?></p><!-- /wp:paragraph -->
						<!-- wp:post-date {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}},"className":"text-contrast"} /-->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"width":"70%"} -->
				<div class="wp-block-column" style="flex-basis:70%">
					<!-- wp:post-content {"layout":{"type":"default"}} /-->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"},"className":"mt-0 mb-0"} -->
	<div class="wp-block-group alignwide mt-0 mb-0">
		<!-- wp:group {"ariaLabel":"<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>","tagName":"nav","align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"className":"pt-40 pb-40 border-t-accent-6 border-t"} -->
		<nav class="wp-block-group alignwide pt-40 pb-40 border-t-accent-6 border-t" aria-label="<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>">
			<!-- wp:post-navigation-link {"type":"previous","showTitle":true,"arrow":"arrow"} /-->
			<!-- wp:post-navigation-link {"showTitle":true,"arrow":"arrow"} /-->
		</nav>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-50 pb-50 mt-0 mb-0"} -->
	<div class="wp-block-group pt-50 pb-50 mt-0 mb-0">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column {"width":"30%"} -->
			<div class="wp-block-column" style="flex-basis:30%">
				<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
				<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"70%","className":"pt-0 pb-0"} -->
			<div class="wp-block-column pt-0 pb-0" style=";flex-basis:70%">
				<!-- wp:pattern {"slug":"twentytwentyfive/comments"} /-->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->
