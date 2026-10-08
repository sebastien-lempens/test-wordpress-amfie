<?php
/**
 * Title: Header with large title
 * Slug: twentytwentyfive/header-large-title
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Site header with large site title and right-aligned navigation.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"layout":{"type":"constrained"},"className":"pt-0 pb-0 border-b-accent-6 border-b"} -->
<div class="wp-block-group pt-0 pb-0 border-b-accent-6 border-b">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"},"className":"pt-30 pb-30"} -->
	<div class="wp-block-group alignwide pt-30 pb-30">
		<!-- wp:site-title {"level":0,"className":"text-[100px] leading-[1.2]"} /-->
		<!-- wp:group {"layout":{"type":"constrained"},"className":"pr-0 pl-0"} -->
		<div class="wp-block-group pr-0 pl-0">
			<!-- wp:navigation {"overlayBackgroundColor":"base","overlayTextColor":"contrast","layout":{"type":"flex","justifyContent":"right","orientation":"vertical"},"className":"gap-0"} /-->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
