<?php
/**
 * Title: Cover with big heading
 * Slug: twentytwentyfive/banner-cover-big-heading
 * Categories: banner, about, featured
 * Description: A full-width cover section with a large background image and an oversized heading.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"full","className":"is-style-section-3 pt-50 pb-50 mt-0 mb-0","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-3 pt-50 pb-50 mt-0 mb-0">
	<!-- wp:group {"align":"wide","style":{"spacing":{}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"wide"} -->
		<figure class="wp-block-image alignwide size-full">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/coming-soon-bg-image.webp" alt="<?php esc_attr_e( 'Photo of a field full of flowers, a blue sky and a tree.', 'twentytwentyfive' ); ?>"/>
		</figure>
		<!-- /wp:image -->
		<!-- wp:group {"align":"full","layout":{"type":"default"}} -->
		<!-- wp:paragraph -->
			<p>Lorem ipsum</p>
		<!-- /wp:paragraph -->
		<div class="wp-block-group alignfull">
			<!-- wp:heading {"align":"left","className":"text-[length:clamp(1rem,_380px,_24vw)] font-[700] not-italic tracking-[-0.02em] leading-[1]"} -->
			<h2 class="wp-block-heading has-text-align-left text-[length:clamp(1rem,_380px,_24vw)] font-[700] not-italic tracking-[-0.02em] leading-[1]"><?php esc_html_e( 'Stories', 'twentytwentyfive' ); ?></h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->
		 <!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et distinctio facere eum qui in, libero non. Iusto rerum minus laboriosam a vel saepe temporibus fugiat quos distinctio necessitatibus. Maiores, perspiciatis!</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
