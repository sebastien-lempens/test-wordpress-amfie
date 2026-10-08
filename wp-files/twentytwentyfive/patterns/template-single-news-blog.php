<?php
/**
 * Title: News blog single post with sidebar
 * Slug: twentytwentyfive/template-single-news-blog
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

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group">

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:spacer {"height":"var:preset|spacing|80"} -->
			<div style="height:var(--wp--preset--spacing--80)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			<!-- wp:post-title {"level":1,"align":"wide","className":"text-xx-large"} /-->
			<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
			<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			<!-- wp:group {"layout":{"type":"default"}} -->
			<div class="wp-block-group">
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"},"className":"pt-20 pb-20"} -->
				<div class="wp-block-group pt-20 pb-20">
					<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"className":"gap-[4px] text-small"} -->
					<div class="wp-block-group gap-[4px] text-small">
						<!-- wp:post-date /-->
						<!-- wp:paragraph -->
						<p><?php echo esc_html_x( '·', 'Separator between date and categories.', 'twentytwentyfive' ); ?></p>
						<!-- /wp:paragraph -->
						<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
					</div>
					<!-- /wp:group -->
					<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"className":"gap-20"} -->
					<div class="wp-block-group gap-20">
						<!-- wp:avatar {"size":30,"isLink":true,"className":"rounded-[100px]"} /-->
						<!-- wp:post-author-name {"isLink":true,"className":"text-small"} /-->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide"><!-- wp:post-featured-image {"align":"wide"} /--></div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}},"className":"pt-60 pb-60"} -->
		<div class="wp-block-columns alignwide pt-60 pb-60">
			<!-- wp:column {"width":"5%"} -->
			<div class="wp-block-column" style="flex-basis:5%"></div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"65%","className":"pb-60"} -->
			<div class="wp-block-column pb-60" style=";flex-basis:65%">
				<!-- wp:post-content {"layout":{"type":"default"}} /-->
				<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
				<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
				<!-- wp:post-terms {"term":"post_tag","separator":"  ","className":"is-style-post-terms-1 font-[400] not-italic"} /-->
			</div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"5%"} -->
			<div class="wp-block-column" style="flex-basis:5%"></div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"25%"} -->
			<div class="wp-block-column" style="flex-basis:25%"><!-- wp:template-part {"slug":"sidebar"} /--></div>
			<!-- /wp:column -->
			<!-- wp:column {"width":"5%"} -->
			<div class="wp-block-column" style="flex-basis:5%"></div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"},"className":"mt-60 mb-60"} -->
	<div class="wp-block-group alignwide mt-60 mb-60">
		<!-- wp:group {"ariaLabel":"<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>","tagName":"nav","align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"className":"pt-40 pb-40 border-t-accent-6 border-t"} -->
		<nav class="wp-block-group alignwide pt-40 pb-40 border-t-accent-6 border-t" aria-label="<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>">
			<!-- wp:post-navigation-link {"type":"previous","showTitle":true,"arrow":"arrow"} /-->
			<!-- wp:post-navigation-link {"showTitle":true,"arrow":"arrow"} /-->
		</nav>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"constrained","justifyContent":"center"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}},"className":"mt-0 mb-0"} -->
		<div class="wp-block-columns alignwide mt-0 mb-0">
			<!-- wp:column {"width":"5%"} -->
			<div class="wp-block-column" style="flex-basis:5%"></div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"65%","className":"pt-0 pb-0"} -->
			<div class="wp-block-column pt-0 pb-0" style=";flex-basis:65%">
				<!-- wp:group {"layout":{"type":"default"},"className":"pt-0 pb-0 pl-0 pr-0"} -->
				<div class="wp-block-group pt-0 pb-0 pl-0 pr-0">
					<!-- wp:pattern {"slug":"twentytwentyfive/comments"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"5%"} -->
			<div class="wp-block-column" style="flex-basis:5%"></div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"25%"} -->
			<div class="wp-block-column" style="flex-basis:25%"></div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"5%"} -->
			<div class="wp-block-column" style="flex-basis:5%"></div>
			<!-- /wp:column -->

		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer-newsletter"} /-->
