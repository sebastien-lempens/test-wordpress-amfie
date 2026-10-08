<?php
/**
 * Title: Poster-like section
 * Slug: twentytwentyfive/banner-poster
 * Categories: banner, media
 * Description: A section that can be used as a banner or a landing page to announce an event.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/poster-image-background.webp","alt":"Picture of a historical building in ruins.","dimRatio":30,"overlayColor":"contrast","isUserOverlayColor":true,"minHeight":100,"minHeightUnit":"vh","align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-1"}}}},"layout":{"type":"constrained"},"className":"pr-50 pl-50 pt-50 pb-50 mt-0 mb-0 text-accent-1"} -->
<div class="wp-block-cover alignfull has-link-color pr-50 pl-50 pt-50 pb-50 mt-0 mb-0 text-accent-1" style=";min-height:100vh"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-30 has-background-dim"></span><img class="wp-block-cover__image-background" alt="<?php esc_attr_e( 'Picture of a historical building in ruins.', 'twentytwentyfive' ); ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/poster-image-background.webp" data-object-fit="cover"/>
<div class="wp-block-cover__inner-container">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between","justifyContent":"stretch"},"className":"min-h-screen"} -->
	<div class="wp-block-group alignwide min-h-screen">
		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column {"width":"80%"} -->
			<div class="wp-block-column" style="flex-basis:80%">
				<!-- wp:heading {"textAlign":"left","align":"wide","className":"text-[12vw] font-[300] not-italic leading-[0.9]"} -->
				<h2 class="wp-block-heading alignwide has-text-align-left text-[12vw] font-[300] not-italic leading-[0.9]">
					<?php
					echo wp_kses_post(
						/* translators: This string contains the word "Stories" in four different languages with the first item in the locale's language. */
						_x( '“Stories, <span lang="es">historias</span>, <span lang="uk">iсторії</span>, <span lang="el">iστορίες</span>”', 'Placeholder heading in four languages.', 'twentytwentyfive' )
					);
					?>
				</h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"20%"} -->
			<div class="wp-block-column" style="flex-basis:20%">
				<!-- wp:paragraph {"align":"right"} -->
				<p class="has-text-align-right"><?php echo esc_html_x( 'Aug 08—10 2025', 'Example event date in pattern.', 'twentytwentyfive' ); ?><br><?php esc_html_e( 'Fuego Bar, Mexico City', 'twentytwentyfive' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->

		<!-- wp:columns {"verticalAlignment":"bottom","isStackedOnMobile":false,"align":"wide"} -->
		<div class="wp-block-columns alignwide are-vertically-aligned-bottom is-not-stacked-on-mobile">
			<!-- wp:column {"verticalAlignment":"bottom","width":"80%"} -->
			<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:80%">
				<!-- wp:heading {"textAlign":"left","align":"wide","className":"font-[300] not-italic leading-[0.9] text-xx-large"} -->
				<h2 class="wp-block-heading alignwide has-text-align-left font-[300] not-italic leading-[0.9] text-xx-large"><?php esc_html_e( 'Let’s hear them.', 'twentytwentyfive' ); ?></h2>
				<!-- /wp:heading -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"bottom","width":"20%"} -->
			<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:20%">
				<!-- wp:paragraph {"align":"right"} -->
				<p class="has-text-align-right"><?php esc_html_e( '#stories', 'twentytwentyfive' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
