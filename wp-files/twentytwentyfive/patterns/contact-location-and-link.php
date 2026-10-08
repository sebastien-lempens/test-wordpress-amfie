<?php
/**
 * Title: Contact location and link
 * Slug: twentytwentyfive/contact-location-and-link
 * Categories: contact, featured
 * Description: Contact section with a location address, a directions link, and an image of the location.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"full","className":"is-style-section-3 pt-50 pb-50 mt-0 mb-0","layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group alignfull is-style-section-3 pt-50 pb-50 mt-0 mb-0">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"verticalAlignment":"top","width":""} -->
		<div class="wp-block-column is-vertically-aligned-top">
			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"},"className":"gap-40 min-h-full"} -->
			<div class="wp-block-group gap-40 min-h-full"><!-- wp:paragraph {"className":"is-style-text-display text-xx-large"} -->
				<p class="is-style-text-display text-xx-large"><?php esc_html_e( 'Visit us at 123 Example St. Manhattan, NY 10300, United States', 'twentytwentyfive' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"className":"uppercase text-medium"} -->
				<p class="uppercase text-medium"><a href="#"><?php esc_html_e( 'Get directions', 'twentytwentyfive' ); ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"top","width":""} -->
		<div class="wp-block-column is-vertically-aligned-top">
			<!-- wp:image {"scale":"cover","linkDestination":"none","className":"wp-block-image size-large aspect-square"} -->
			<figure class="wp-block-image size-large aspect-square"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/location.webp" alt="<?php esc_attr_e( 'The business location', 'twentytwentyfive' ); ?>"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
