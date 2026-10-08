<?php
/**
 * Title: Vertical site header
 * Slug: twentytwentyfive/vertical-header
 * Categories: header
 * Block Types: core/template-part/vertical-header
 * Description: Vertical site header with site title and navigation.
 * Viewport width: 300
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"wide","layout":{"type":"default"},"className":"pt-40 pb-40"} -->
<div class="wp-block-group alignwide pt-40 pb-40">
	<!-- wp:group {"align":"wide","layout":{"type":"constrained","justifyContent":"center"},"className":"min-h-screen"} -->
	<div class="wp-block-group alignwide min-h-screen">
		<!-- wp:group {"align":"full","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:navigation {"overlayBackgroundColor":"base","overlayTextColor":"contrast","overlayMenu":"always","style":{"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","justifyContent":"right","orientation":"horizontal","flexWrap":"wrap"},"className":"mt-0 gap-20"} /-->
			<!-- wp:site-title {"level":0,"style":{"typography":{"writingMode":"vertical-rl"}},"className":"text-large"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
