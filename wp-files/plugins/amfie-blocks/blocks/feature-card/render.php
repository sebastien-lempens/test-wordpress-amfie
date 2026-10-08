<?php
/**
 * Rendu : amfie/feature-card
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
<article <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-card' ] ); ?>>
	<?php if ( '' !== amfie_attr( $a, 'icon' ) ) : ?><span class="amfie-card__icon" aria-hidden="true"><?php echo esc_html( amfie_attr( $a, 'icon' ) ); ?></span><?php endif; ?>
	<h3 class="amfie-card__title"><?php echo amfie_rich( $a, 'title' ); ?></h3>
	<?php if ( '' !== amfie_attr( $a, 'text' ) ) : ?><p class="amfie-card__text"><?php echo amfie_rich( $a, 'text' ); ?></p><?php endif; ?>
	<?php echo amfie_button( amfie_attr( $a, 'linkLabel' ), amfie_attr( $a, 'url' ), 'ghost' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
</article>
