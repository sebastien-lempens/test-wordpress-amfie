<?php
/**
 * Title: News blog with featured posts grid
 * Slug: twentytwentyfive/template-home-posts-grid-news-blog
 * Template Types: front-page, index, home
 * Inserter: no
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:template-part {"slug":"header-large-title"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"default"},"className":"mt-0 mb-0"} -->
<main class="wp-block-group mt-0 mb-0">

	<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-50 pb-50 mt-0 mb-0"} -->
	<div class="wp-block-group pt-50 pb-50 mt-0 mb-0">
		<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false},"align":"wide"} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template -->
				<!-- wp:post-featured-image {"isLink":true,"align":"wide","className":"aspect-[16/9]"} /-->
				<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"},"className":"pt-40"} -->
				<div class="wp-block-group pt-40">
					<!-- wp:post-title {"textAlign":"center","level":1,"isLink":true,"className":"text-xx-large"} /-->
					<!-- wp:post-terms {"term":"category","textAlign":"center","className":"uppercase tracking-[1.4px]"} /-->
					<!-- wp:post-date {"textAlign":"center","isLink":true} /-->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->
			<!-- wp:query-no-results -->
				<!-- wp:paragraph {"align":"center","placeholder":"<?php esc_attr_e( 'Add text or blocks that will display when a query returns no results.', 'twentytwentyfive' ); ?>"} -->
				<p class="has-text-align-center"><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
				<!-- /wp:paragraph -->
			<!-- /wp:query-no-results -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-50 pb-50 mt-0 mb-0"} -->
	<div class="wp-block-group pt-50 pb-50 mt-0 mb-0">
		<!-- wp:group {"align":"wide","layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"40rem"},"className":"gap-50"} -->
		<div class="wp-block-group alignwide gap-50">
			<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":"1","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[3/2]"} /-->
						<!-- wp:post-title {"isLink":true,"className":"text-x-large"} /-->
						<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
					</div>
					<!-- /wp:group -->
				<!-- /wp:post-template -->
				<!-- wp:query-no-results -->
				<!-- wp:paragraph -->
				<p><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- /wp:query-no-results -->
			</div>
			<!-- /wp:query -->
			<!-- wp:query {"query":{"perPage":1,"pages":0,"offset":"2","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]}} -->
			<div class="wp-block-query">
				<!-- wp:post-template -->
					<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
					<div class="wp-block-group">
						<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[3/2]"} /-->
						<!-- wp:post-title {"isLink":true,"className":"text-x-large"} /-->
						<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
					</div>
					<!-- /wp:group -->
				<!-- /wp:post-template -->
				<!-- wp:query-no-results -->
				<!-- wp:paragraph -->
				<p><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
				<!-- /wp:paragraph -->
				<!-- /wp:query-no-results -->
			</div>
			<!-- /wp:query -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-50 pb-50 mt-0 mb-0"} -->
	<div class="wp-block-group pt-50 pb-50 mt-0 mb-0">
		<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":"3","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]},"align":"wide"} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3},"className":"gap-50"} -->
				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group gap-50">
					<!-- wp:post-featured-image {"isLink":true,"className":"aspect-[4/3]"} /-->
					<!-- wp:post-title {"isLink":true,"className":"text-large"} /-->
					<!-- wp:post-terms {"term":"category","className":"uppercase tracking-[1.4px]"} /-->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->
			<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- /wp:query-no-results -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"constrained"},"className":"pt-60 pb-60 mt-0 mb-0"} -->
	<div class="wp-block-group alignwide pt-60 pb-60 mt-0 mb-0">
		<!-- wp:heading {"align":"wide"} -->
		<h2 class="wp-block-heading alignwide"><?php esc_html_e( 'Architecture', 'twentytwentyfive' ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:query {"query":{"perPage":6,"pages":0,"offset":"6","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[]},"align":"wide","layout":{"type":"default"}} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
				<!-- wp:group {"align":"full","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center","justifyContent":"space-between"},"className":"pt-30 pb-30 border-b-accent-6 border-b"} -->
				<div class="wp-block-group alignfull pt-30 pb-30 border-b-accent-6 border-b">
					<!-- wp:post-title {"level":3,"isLink":true,"className":"text-large"} /-->
					<!-- wp:post-date {"textAlign":"right","isLink":true} /-->
				</div>
				<!-- /wp:group -->
			<!-- /wp:post-template -->
			</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->

</main>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"twentytwentyfive/cta-newsletter"} /-->

<!-- wp:template-part {"slug":"footer-columns"} /-->
