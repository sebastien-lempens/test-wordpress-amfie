<?php
/**
 * Rendu : amfie/link-list
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
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-link-list' ] ); ?>>
	<div class="amfie-container">
		<?php if ( '' !== amfie_attr( $a, 'title' ) ) : ?><h2><?php echo amfie_rich( $a, 'title' ); ?></h2><?php endif; ?>
		<div class="amfie-link-list__items"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	</div>
</section>
