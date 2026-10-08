<?php
/**
 * Rendu : amfie/contact-card
 *
 * @var array    $attributes
 * @var string   $content
 * @var WP_Block $block
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php $a = $attributes; $phone = amfie_attr( $a, 'phone' ); $email = amfie_attr( $a, 'email' ); ?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-contact-card' ] ); ?>>
	<div class="amfie-container">
		<h2><?php echo amfie_rich( $a, 'title' ); ?></h2>
		<?php if ( '' !== amfie_attr( $a, 'text' ) ) : ?><p><?php echo amfie_rich( $a, 'text' ); ?></p><?php endif; ?>
		<address>
			<?php echo nl2br( esc_html( amfie_attr( $a, 'address' ) ) ); ?>
			<?php if ( $phone ) : ?><br /><a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a><?php endif; ?>
			<?php if ( $email ) : ?><br /><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a><?php endif; ?>
			<?php if ( '' !== amfie_attr( $a, 'linkedin' ) ) : ?><br /><a href="<?php echo esc_url( amfie_attr( $a, 'linkedin' ) ); ?>" rel="noopener">LinkedIn</a><?php endif; ?>
		</address>
	</div>
</section>
