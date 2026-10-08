<?php
/**
 * Rendu : amfie/feature-grid
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
$a    = $attributes;
$cols = max( 1, min( 4, (int) ( $a['columns'] ?? 3 ) ) );
$cls  = 'amfie-feature-grid amfie-feature-grid--' . sanitize_html_class( amfie_attr( $a, 'variant', 'cards' ) );
?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => $cls ] ); ?>>
	<div class="amfie-container">
		<?php if ( '' !== amfie_attr( $a, 'title' ) ) : ?><h2><?php echo amfie_rich( $a, 'title' ); ?></h2><?php endif; ?>
		<?php if ( '' !== amfie_attr( $a, 'intro' ) ) : ?><p class="amfie-feature-grid__intro"><?php echo amfie_rich( $a, 'intro' ); ?></p><?php endif; ?>
		<div class="amfie-feature-grid__items" style="--amfie-cols:<?php echo (int) $cols; ?>"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	</div>
</section>
