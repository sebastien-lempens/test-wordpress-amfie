<?php
/**
 * Title: Review with large image on right
 * Slug: twentytwentyfive/testimonials-large
 * Keywords: testimonial
 * Categories: testimonials
 * Description: A testimonial with a large image on the right.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-60 pb-60 mt-0 mb-0"} -->
<div class="wp-block-group alignfull pt-60 pb-60 mt-0 mb-0">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","flexWrap":"wrap","verticalAlignment":"space-between"},"className":"gap-60 min-h-full"} -->
			<div class="wp-block-group gap-60 min-h-full">
				<!-- wp:heading {"className":"is-style-text-annotation","style":{"layout":{"selfStretch":"fit","flexSize":null}}} -->
				<h2 class="wp-block-heading is-style-text-annotation has-x-small-font-size"><?php echo esc_html_x( 'What people are saying', 'Testimonial heading.', 'twentytwentyfive' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:quote {"className":"is-style-plain font-[400] not-italic text-x-large","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
				<blockquote class="wp-block-quote is-style-plain font-[400] not-italic text-x-large">
					<!-- wp:group {"layout":{"type":"constrained","justifyContent":"left","contentSize":"400px"},"className":"pt-0 pb-0 pl-0 pr-0 mt-0 mb-0"} -->
					<div class="wp-block-group pt-0 pb-0 pl-0 pr-0 mt-0 mb-0">
						<!-- wp:paragraph {"className":"text-xx-large"} -->
						<p class="text-xx-large"><?php echo esc_html_x( '“Superb product and customer service!”', 'Sample testimonial.', 'twentytwentyfive' ); ?></p>
						<!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
					<cite><?php echo wp_kses_post( _x( 'Jo Mulligan <br /><sub>Atlanta, GA</sub>', 'Sample testimonial citation.', 'twentytwentyfive' ) ); ?></cite>
				</blockquote>
				<!-- /wp:quote -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"pt-0 pb-0 pl-0 pr-0"} -->
		<div class="wp-block-column pt-0 pb-0 pl-0 pr-0">
			<!-- wp:image {"scale":"cover","sizeSlug":"large","linkDestination":"none","className":"aspect-square object-cover"} -->
			<figure class="wp-block-image size-large aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/typewriter.webp" alt="<?php echo esc_attr_x( 'Picture of a person typing on a typewriter.', 'Alt text for testimonial image.', 'twentytwentyfive' ); ?>"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
