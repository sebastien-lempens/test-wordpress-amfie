<?php
/**
 * Title: Text blog query loop
 * Slug: twentytwentyfive/template-query-loop-text-blog
 * Inserter: no
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:query-no-results {"align":"wide","className":"text-medium"} -->
			<!-- wp:paragraph -->
			<p class="text-medium"><?php echo esc_html_x( 'Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'twentytwentyfive' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:group -->
	<!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
		<!-- wp:group {"align":"full","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center","justifyContent":"space-between"},"className":"pt-30 pb-30 border-b-accent-6 border-b"} -->
		<div class="wp-block-group alignfull pt-30 pb-30 border-b-accent-6 border-b">
			<!-- wp:post-title {"isLink":true,"className":"text-large"} /-->
			<!-- wp:post-date {"textAlign":"right","isLink":true,"className":"text-small"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->

	<!-- wp:spacer {"height":"var:preset|spacing|30"} -->
	<div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"mt-40 mb-40"} -->
	<div class="wp-block-group alignfull mt-40 mb-40">
		<!-- wp:query-pagination {"align":"full","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"},"className":"font-[400] not-italic"} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:query -->
