<?php
/**
 * Rendu : amfie/text-section
 *
 * @var array    $attributes
 * @var string   $content
 * @var WP_Block $block
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php
$a   = $attributes;
$cls = 'amfie-text-section amfie-text-section--' . sanitize_html_class( amfie_attr( $a, 'variant', 'default' ) );
?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => $cls ] ); ?>>
	<div class="amfie-container">
		<?php if ( '' !== amfie_attr( $a, 'title' ) ) : ?><h2><?php echo amfie_rich( $a, 'title' ); ?></h2><?php endif; ?>
		<?php if ( '' !== amfie_attr( $a, 'subtitle' ) ) : ?><p class="amfie-subtitle"><?php echo amfie_rich( $a, 'subtitle' ); ?></p><?php endif; ?>
		<div class="amfie-text-section__content"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	</div>
</section>
