<?php
/**
 * Title: Contact, info and locations
 * Slug: twentytwentyfive/contact-info-locations
 * Keywords: contact, location
 * Categories: contact
 * Viewport width: 1400
 * Description: Contact section with social media links, email, and multiple location details.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained"},"className":"pt-50 pb-50 mt-0 mb-0"} -->
<div class="wp-block-group alignfull pt-50 pb-50 mt-0 mb-0">
	<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:heading {"textAlign":"left","align":"full","className":"text-xx-large"} -->
		<h2 class="wp-block-heading alignfull has-text-align-left text-xx-large"><?php esc_html_e( 'How to get in touch with us', 'twentytwentyfive' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:group {"align":"wide","layout":{"type":"grid","minimumColumnWidth":"23rem"},"className":"pt-60 pb-60 mt-50 gap-50 border-t-accent-4 border-t"} -->
		<div class="wp-block-group alignwide pt-60 pb-60 mt-50 gap-50 border-t-accent-4 border-t">
			<!-- wp:group {"style":{"layout":{"rowSpan":1,"columnSpan":2}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group">
				<!-- wp:heading {"level":3,"className":"font-[700] not-italic text-medium"} -->
				<h3 class="wp-block-heading font-[700] not-italic text-medium"><?php esc_html_e( 'Social media', 'twentytwentyfive' ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"ariaLabel":"<?php esc_attr_e( 'Social media', 'twentytwentyfive' ); ?>","className":"gap-20 text-medium"} -->
					<!-- wp:navigation-link {"label":"<?php echo esc_html_x( 'X', 'Refers to the social media platform formerly known as Twitter.', 'twentytwentyfive' ); ?>","url":"#"} /-->
					<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Instagram', 'twentytwentyfive' ); ?>","url":"#"} /-->
					<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Facebook', 'twentytwentyfive' ); ?>","url":"#"} /-->
					<!-- wp:navigation-link {"label":"<?php esc_html_e( 'TikTok', 'twentytwentyfive' ); ?>","url":"#"} /-->
				<!-- /wp:navigation -->
				<!-- wp:heading {"level":3,"className":"font-[700] not-italic text-medium"} -->
				<h3 class="wp-block-heading font-[700] not-italic text-medium"><?php esc_html_e( 'Email', 'twentytwentyfive' ); ?></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"className":"text-medium"} -->
				<p class="text-medium"><?php esc_html_e( 'example@example.com', 'twentytwentyfive' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:group {"layout":{"type":"grid","minimumColumnWidth":null,"columnCount":2}} -->
			<div class="wp-block-group">
				<!-- wp:group {"style":{"layout":{"columnSpan":1,"rowSpan":1}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3,"className":"font-[700] not-italic text-medium"} -->
					<h3 class="wp-block-heading font-[700] not-italic text-medium"><?php esc_html_e( 'New York', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"className":"text-medium"} -->
					<p class="text-medium"><?php esc_html_e( '123 Example St. Manhattan, NY 10300 United States', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"style":{"layout":{"columnSpan":1,"rowSpan":1}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3,"className":"font-[700] not-italic text-medium"} -->
					<h3 class="wp-block-heading font-[700] not-italic text-medium"><?php esc_html_e( 'San Diego', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"text-medium"} -->
					<p class="text-medium"><?php esc_html_e( '123 Example St. Manhattan, NY 10300 United States', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"style":{"layout":{"columnSpan":1,"rowSpan":1}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3,"className":"font-[700] not-italic text-medium"} -->
					<h3 class="wp-block-heading font-[700] not-italic text-medium"><?php esc_html_e( 'Salt Lake City', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"text-medium"} -->
					<p class="text-medium"><?php esc_html_e( '123 Example St. Manhattan, NY 10300 United States', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"style":{"layout":{"columnSpan":1,"rowSpan":1}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3,"className":"font-[700] not-italic text-medium"} -->
					<h3 class="wp-block-heading font-[700] not-italic text-medium"><?php esc_html_e( 'Portland', 'twentytwentyfive' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"className":"text-medium"} -->
					<p class="text-medium"><?php esc_html_e( '123 Example St. Manhattan, NY 10300 United States', 'twentytwentyfive' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
