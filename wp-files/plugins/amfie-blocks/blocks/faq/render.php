<?php
/**
 * Rendu : amfie/faq
 *
 * @var array    $attributes
 * @var string   $content
 * @var WP_Block $block
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php $a = $attributes; ?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-faq' ] ); ?>>
	<div class="amfie-container">
		<?php if ( '' !== amfie_attr( $a, 'title' ) ) : ?><h2><?php echo amfie_rich( $a, 'title' ); ?></h2><?php endif; ?>
		<?php if ( '' !== amfie_attr( $a, 'subtitle' ) ) : ?><p class="amfie-subtitle"><?php echo amfie_rich( $a, 'subtitle' ); ?></p><?php endif; ?>
		<div class="amfie-faq__items"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	</div>
</section>
