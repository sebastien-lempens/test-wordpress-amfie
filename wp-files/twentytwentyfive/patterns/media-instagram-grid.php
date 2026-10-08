<?php
/**
 * Title: Instagram grid
 * Slug: twentytwentyfive/media-instagram-grid
 * Categories: media, gallery, featured
 * Viewport width: 1440
 * Description: A grid section with photos and a link to an Instagram profile.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-50 pb-50 mt-0 mb-0"} -->
<div class="wp-block-group alignfull pt-50 pb-50 mt-0 mb-0">
	<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"18rem"},"className":"gap-50"} -->
	<div class="wp-block-group alignwide gap-50">
		<!-- wp:group {"className":"is-style-section-3 min-h-[297px]","layout":{"type":"constrained"}} -->
		<div class="wp-block-group is-style-section-3 min-h-[297px]">
			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"center","justifyContent":"center"},"className":"gap-20 min-h-full"} -->
			<div class="wp-block-group gap-20 min-h-full">
				<!-- wp:heading {"className":"text-large"} -->
				<h2 class="wp-block-heading text-large"><?php esc_html_e( 'Instagram', 'twentytwentyfive' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"align":"center","className":"text-medium"} -->
				<p class="has-text-align-center text-medium"><a href="#"><?php echo esc_html_x( '@example', 'Example username for social media account.', 'twentytwentyfive' ); ?></a></p>
				<!-- /wp:paragraph -->
				</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->

		<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","className":"aspect-square object-cover"} -->
		<figure class="wp-block-image size-full aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/flower-meadow-square.webp" alt="<?php esc_attr_e( 'Photo of a field full of flowers, a blue sky and a tree.', 'twentytwentyfive' ); ?>"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","className":"aspect-square object-cover"} -->
		<figure class="wp-block-image size-full aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/vash-gon-square.webp" alt="<?php esc_attr_e( 'Profile portrait of a native person.', 'twentytwentyfive' ); ?>"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","className":"aspect-square object-cover"} -->
		<figure class="wp-block-image size-full aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/coral-square.webp" alt="<?php esc_attr_e( 'View of the deep ocean.', 'twentytwentyfive' ); ?>"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","className":"aspect-square object-cover"} -->
		<figure class="wp-block-image size-full aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/agenda-img-4.webp" alt="<?php esc_attr_e( 'Portrait of an African Woman dressed in traditional costume, wearing decorative jewelry.', 'twentytwentyfive' ); ?>"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","className":"aspect-square object-cover"} -->
		<figure class="wp-block-image size-full aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/parthenon-square.webp" alt="<?php esc_attr_e( 'The Acropolis of Athens.', 'twentytwentyfive' ); ?>"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","className":"aspect-square object-cover"} -->
		<figure class="wp-block-image size-full aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/dallas-creek-square.webp" alt="<?php esc_attr_e( 'Close up of two flowers on a dark background.', 'twentytwentyfive' ); ?>"/></figure>
		<!-- /wp:image -->

		<!-- wp:image {"scale":"cover","sizeSlug":"full","linkDestination":"none","className":"aspect-square object-cover"} -->
		<figure class="wp-block-image size-full aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/marshland-birds-square.webp" alt="<?php esc_attr_e( 'Birds on a lake.', 'twentytwentyfive' ); ?>"/></figure>
		<!-- /wp:image -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
