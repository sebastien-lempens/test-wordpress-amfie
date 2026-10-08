<?php
/**
 * Title: 2 columns with avatar
 * Slug: twentytwentyfive/testimonials-2-col
 * Keywords: testimonial
 * Categories: testimonials
 * Description: Two columns with testimonials and avatars.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-60 pb-60 mt-0 mb-0"} -->
<div class="wp-block-group alignfull pt-60 pb-60 mt-0 mb-0">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"64px"} -->
				<div class="wp-block-column" style="flex-basis:64px">
					<!-- wp:image {"width":"64px","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded aspect-square object-cover"} -->
					<figure class="wp-block-image size-large is-resized is-style-rounded aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/nurse.webp" alt="<?php echo esc_attr_x( 'Picture of a person', 'Alt text for testimonial image.', 'twentytwentyfive' ); ?>" style=";width:64px"/></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:quote {"className":"is-style-plain font-[400] not-italic text-x-large","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
					<blockquote class="wp-block-quote is-style-plain font-[400] not-italic text-x-large">
						<!-- wp:paragraph {"className":"leading-[1.1]"} -->
						<p class="leading-[1.1]"><?php echo esc_html_x( '“Superb product and customer service!”', 'Sample testimonial.', 'twentytwentyfive' ); ?></p>
						<!-- /wp:paragraph -->
						<cite><?php echo wp_kses_post( _x( 'Jo Mulligan <br /><sub>Atlanta, GA</sub>', 'Sample testimonial citation.', 'twentytwentyfive' ) ); ?></cite>
					</blockquote>
					<!-- /wp:quote -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":""} -->
		<div class="wp-block-column">
			<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-columns">
				<!-- wp:column {"width":"64px"} -->
				<div class="wp-block-column" style="flex-basis:64px">
					<!-- wp:image {"width":"64px","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded aspect-square object-cover"} -->
					<figure class="wp-block-image size-large is-resized is-style-rounded aspect-square object-cover"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/nurse.webp" alt="<?php echo esc_attr_x( 'Picture of a person', 'Alt text for testimonial image.', 'twentytwentyfive' ); ?>" style=";width:64px"/></figure>
					<!-- /wp:image -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column -->
				<div class="wp-block-column">
					<!-- wp:quote {"className":"is-style-plain font-[400] not-italic text-x-large","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
					<blockquote class="wp-block-quote is-style-plain font-[400] not-italic text-x-large">
						<!-- wp:paragraph {"className":"leading-[1.1]"} -->
						<p class="leading-[1.1]"><?php echo esc_html_x( '“Amazing quality and care. I love all your products.”', 'Sample testimonial.', 'twentytwentyfive' ); ?></p>
						<!-- /wp:paragraph -->
						<cite><?php echo wp_kses_post( _x( 'Otto Reid <br><sub>Springfield, IL</sub>', 'Sample testimonial citation.', 'twentytwentyfive' ) ); ?></cite>
					</blockquote>
					<!-- /wp:quote -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
