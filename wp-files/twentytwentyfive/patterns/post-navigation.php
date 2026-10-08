<?php
/**
 * Title: Post navigation
 * Slug: twentytwentyfive/post-navigation
 * Categories: text
 * Description: Next and previous post links.
 * Block Types: core/post-navigation-link
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"wide","layout":{"type":"default"},"className":"mt-60 mb-60"} -->
<div class="wp-block-group alignwide mt-60 mb-60">
	<!-- wp:group {"ariaLabel":"<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>","tagName":"nav","align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"className":"pt-40 pb-40 border-t-accent-6 border-t"} -->
	<nav class="wp-block-group alignwide pt-40 pb-40 border-t-accent-6 border-t" aria-label="<?php esc_attr_e( 'Post navigation', 'twentytwentyfive' ); ?>">
		<!-- wp:post-navigation-link {"type":"previous","showTitle":true,"arrow":"arrow"} /-->
		<!-- wp:post-navigation-link {"showTitle":true,"arrow":"arrow"} /-->
	</nav>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
