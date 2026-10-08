<?php
/**
 * Title: More posts
 * Slug: twentytwentyfive/more-posts
 * Description: Displays a list of posts with title and date.
 * Categories: query
 * Block Types: core/query
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"wide","layout":{"type":"constrained"},"className":"pt-60 pb-60"} -->
<div class="wp-block-group alignwide pt-60 pb-60">
	<!-- wp:heading {"align":"wide","className":"font-[700] not-italic uppercase tracking-[1.4px] text-small"} -->
	<h2 class="wp-block-heading alignwide font-[700] not-italic uppercase tracking-[1.4px] text-small"><?php esc_html_e( 'More posts', 'twentytwentyfive' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:query {"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[]},"align":"wide","layout":{"type":"default"}} -->
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
