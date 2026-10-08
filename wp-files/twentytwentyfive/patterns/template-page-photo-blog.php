<?php
/**
 * Title: Photo blog page
 * Slug: twentytwentyfive/template-page-photo-blog
 * Template Types: page
 * Viewport width: 1400
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:template-part {"slug":"header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"},"className":"mt-60"} -->
<main class="wp-block-group mt-60">
	<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-60 pb-60"} -->
	<div class="wp-block-group alignfull pt-60 pb-60">
		<!-- wp:post-title {"textAlign":"center","level":1,"className":"mb-60 text-x-large"} /-->
		<!-- wp:post-featured-image {"className":"mb-60"} /-->
		<!-- wp:post-content {"align":"full","layout":{"type":"constrained"}} /-->
	</div>
	<!-- /wp:group -->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->
