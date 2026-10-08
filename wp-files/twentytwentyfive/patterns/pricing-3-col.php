<?php
/**
 * Title: Pricing, 3 columns
 * Slug: twentytwentyfive/pricing-3-col
 * Categories: call-to-action, banner, services
 * Description: A three-column boxed pricing table designed to showcase services, descriptions, and pricing options.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-60 pb-60 mt-0 mb-0"} -->
<div class="wp-block-group alignfull pt-60 pb-60 mt-0 mb-0">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:heading {"className":"text-x-large"} -->
		<h2 class="wp-block-heading text-x-large"><?php esc_html_e( 'Choose your membership', 'twentytwentyfive' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"is-style-text-annotation"} -->
		<p class="is-style-text-annotation"><?php esc_html_e( 'Pricing', 'twentytwentyfive' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|50"}}},"className":"mt-70 mb-0"} -->
	<div class="wp-block-columns alignwide mt-70 mb-0">
		<!-- wp:column {"borderColor":"accent-6","layout":{"type":"constrained","justifyContent":"center"},"className":"pt-40 pb-40 pl-40 pr-40 rounded-[10px] border-[1px]"} -->
		<div class="wp-block-column has-border-color has-accent-6-border-color pt-40 pb-40 pl-40 pr-40 rounded-[10px] border-[1px]">
			<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"0"}}},"className":"mt-0 mb-0"} -->
			<div class="wp-block-columns is-not-stacked-on-mobile mt-0 mb-0">
				<!-- wp:column {"width":"70%"} -->
				<div class="wp-block-column" style="flex-basis:70%">
					<!-- wp:heading {"level":3,"className":"mb-20 text-large"} -->
					<h3 class="wp-block-heading mb-20 text-large"><?php esc_html_e( 'Free', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"text-small"} -->
					<p class="text-small"><?php esc_html_e( 'Get access to our free articles and weekly newsletter.', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"className":"mt-0 mb-0 ml-0 mr-0"} -->
				<div class="wp-block-column mt-0 mb-0 ml-0 mr-0">
					<!-- wp:heading {"textAlign":"right","level":3,"className":"line-through"} -->
					<h3 class="wp-block-heading has-text-align-right line-through"><?php esc_html_e( '0€', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"className":"mt-30"} -->
			<div class="wp-block-buttons mt-30">
				<!-- wp:button {"width":100,"className":"tracking-[0.08px] leading-[1.2]"} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100 tracking-[0.08px] leading-[1.2]"><a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Join', 'Button text, refers to joining a community. Verb.', 'twentytwentyfive' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"borderColor":"accent-6","layout":{"type":"constrained","justifyContent":"center"},"className":"pt-40 pb-40 pl-40 pr-40 rounded-[10px] border-[1px]"} -->
		<div class="wp-block-column has-border-color has-accent-6-border-color pt-40 pb-40 pl-40 pr-40 rounded-[10px] border-[1px]">
			<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"0"}}},"className":"mt-0 mb-0"} -->
			<div class="wp-block-columns is-not-stacked-on-mobile mt-0 mb-0">
				<!-- wp:column {"width":"70%"} -->
				<div class="wp-block-column" style="flex-basis:70%">
					<!-- wp:heading {"level":3,"className":"mb-20 text-large"} -->
					<h3 class="wp-block-heading mb-20 text-large"><?php echo esc_html_x( 'Single', 'Name of membership package.', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"text-small"} -->
					<p class="text-small"><?php esc_html_e( 'Get access to our paid newsletter and a limited pass for one event.', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"className":"mt-0 mb-0 ml-0 mr-0"} -->
				<div class="wp-block-column mt-0 mb-0 ml-0 mr-0">
					<!-- wp:heading {"textAlign":"right","level":3} -->
					<h3 class="wp-block-heading has-text-align-right"><?php esc_html_e( '20€', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"right","className":"mt-0 text-small"} -->
					<p class="has-text-align-right mt-0 text-small"><?php esc_html_e( 'Month', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"className":"mt-30"} -->
			<div class="wp-block-buttons mt-30">
				<!-- wp:button {"width":100,"className":"tracking-[0.08px] leading-[1.2]"} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100 tracking-[0.08px] leading-[1.2]"><a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Join', 'Button text, refers to joining a community. Verb.', 'twentytwentyfive' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"borderColor":"accent-6","layout":{"type":"constrained","justifyContent":"center"},"className":"pt-40 pb-40 pl-40 pr-40 rounded-[10px] border-[1px]"} -->
		<div class="wp-block-column has-border-color has-accent-6-border-color pt-40 pb-40 pl-40 pr-40 rounded-[10px] border-[1px]">
			<!-- wp:columns {"isStackedOnMobile":false,"style":{"spacing":{"blockGap":{"top":"0"}}},"className":"mt-0 mb-0"} -->
			<div class="wp-block-columns is-not-stacked-on-mobile mt-0 mb-0">
				<!-- wp:column {"width":"70%"} -->
				<div class="wp-block-column" style="flex-basis:70%">
					<!-- wp:heading {"level":3,"className":"mb-20 text-large"} -->
					<h3 class="wp-block-heading mb-20 text-large"><?php echo esc_html_x( 'Expert', 'Name of membership package.', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"text-small"} -->
					<p class="text-small"><?php esc_html_e( 'Get access to our paid newsletter and an unlimited pass.', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"className":"mt-0 mb-0 ml-0 mr-0"} -->
				<div class="wp-block-column mt-0 mb-0 ml-0 mr-0">
					<!-- wp:heading {"textAlign":"right","level":3} -->
					<h3 class="wp-block-heading has-text-align-right"><?php esc_html_e( '40€', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"right","className":"mt-0 text-small"} -->
					<p class="has-text-align-right mt-0 text-small"><?php esc_html_e( 'Month', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"className":"mt-30"} -->
			<div class="wp-block-buttons mt-30">
				<!-- wp:button {"width":100,"className":"tracking-[0.08px] leading-[1.2]"} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100 tracking-[0.08px] leading-[1.2]"><a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Join', 'Button text, refers to joining a community. Verb.', 'twentytwentyfive' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
