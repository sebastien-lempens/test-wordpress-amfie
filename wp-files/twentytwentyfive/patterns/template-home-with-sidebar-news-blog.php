<?php
/**
 * Title: News blog with sidebar
 * Slug: twentytwentyfive/template-home-with-sidebar-news-blog
 * Template Types: front-page, index, home
 * Viewport width: 1400
 * Inserter: no
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:template-part {"slug":"header-large-title"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"},"className":"pt-50 pb-50 mt-0 mb-0"} -->
<main class="wp-block-group pt-50 pb-50 mt-0 mb-0">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"75%"} -->
		<div class="wp-block-column" style="flex-basis:75%">
			<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:post-featured-image {"isLink":true,"align":"wide","className":"aspect-[3/2]"} /-->
					<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"},"className":"pt-40 pb-40 gap-20"} -->
					<div class="wp-block-group pt-40 pb-40 gap-20">
						<!-- wp:post-title {"level":1,"isLink":true} /-->
						<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
						<!-- wp:post-date {"isLink":true} /-->
					</div>
					<!-- /wp:group -->
				<!-- /wp:post-template -->
			</div>
			<!-- /wp:query -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%"} -->
		<div class="wp-block-column" style="flex-basis:25%">
			<!-- wp:heading {"className":"font-[600] not-italic uppercase tracking-[1.6px] text-small"} -->
			<h2 class="wp-block-heading font-[600] not-italic uppercase tracking-[1.6px] text-small"><?php esc_html_e( 'The Latest', 'twentytwentyfive' ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
			<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			<!-- wp:query {"query":{"perPage":6,"pages":0,"offset":"1","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[]}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"},"className":"gap-20"} -->
					<div class="wp-block-group gap-20">
						<!-- wp:post-title {"level":3,"isLink":true,"className":"text-large"} /-->
						<!-- wp:post-date {"isLink":true,"className":"text-small"} /-->
					</div>
					<!-- /wp:group -->
					<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
					<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->
				<!-- /wp:post-template -->
				<!-- wp:query-no-results -->
					<!-- wp:paragraph {"placeholder":"<?php esc_attr_e( 'Add text or blocks that will display when a query returns no results.', 'twentytwentyfive' ); ?>","className":"text-medium"} -->
					<p class="text-medium"><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				<!-- /wp:query-no-results -->
			</div>
			<!-- /wp:query -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
	<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
	<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
	<!-- wp:query {"query":{"perPage":4,"pages":0,"offset":"7","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]},"align":"wide"} -->
	<div class="wp-block-query alignwide">
		<!-- wp:post-template -->
			<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}},"className":"pt-30 pb-30 mt-30 mb-30 border-b-accent-6 border-b"} -->
			<div class="wp-block-columns pt-30 pb-30 mt-30 mb-30 border-b-accent-6 border-b">
				<!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
				<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
					<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"},"className":"gap-30"} -->
					<div class="wp-block-group gap-30">
						<!-- wp:post-title {"className":"text-x-large"} /-->
						<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"},"className":"gap-20 text-small"} -->
						<div class="wp-block-group gap-20 text-small">
							<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
							<!-- wp:paragraph -->
							<p><?php echo esc_html_x( '·', 'Separator between date and categories.', 'twentytwentyfive' ); ?></p>
							<!-- /wp:paragraph -->
							<!-- wp:post-date {"isLink":true} /-->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column {"width":"20%"} -->
				<div class="wp-block-column" style="flex-basis:20%"></div>
				<!-- /wp:column -->
				<!-- wp:column {"width":"13.33%"} -->
				<div class="wp-block-column" style="flex-basis:13.33%">
					<!-- wp:post-featured-image {"isLink":true,"style":{"layout":{"selfStretch":"fixed","flexSize":"180px"}},"className":"aspect-square"} /-->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		<!-- /wp:post-template -->
		<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-30 pb-30"} -->
		<div class="wp-block-group pt-30 pb-30">
			<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"space-between"},"className":"text-medium"} -->
				<!-- wp:query-pagination-previous /-->
				<!-- wp:query-pagination-numbers /-->
				<!-- wp:query-pagination-next /-->
			<!-- /wp:query-pagination -->
		</div>
		<!-- /wp:group -->
		<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer-columns"} /-->
