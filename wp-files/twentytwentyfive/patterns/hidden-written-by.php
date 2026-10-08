<?php
/**
 * Title: Written by
 * Slug: twentytwentyfive/hidden-written-by
 * Inserter: no
 *
 * @package    WordPress
 * @subpackage Twenty_Twenty_Five
 * @since      Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"},"className":"mb-60 gap-[0.2em] text-small"} -->
<div class="wp-block-group mb-60 gap-[0.2em] text-small">
	<!-- wp:paragraph -->
	<p><?php esc_html_e( 'Written by ', 'twentytwentyfive' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-author-name {"isLink":true} /-->
	<!-- wp:paragraph -->
	<p><?php esc_html_e( 'in', 'twentytwentyfive' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- wp:post-terms {"term":"category","className":"font-[300]"} /-->
</div>
<!-- /wp:group -->
