<?php
/**
 * Rendu : amfie/quick-links
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
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-quick-links' ] ); ?>>
	<h2 class="amfie-quick-links__title"><?php echo amfie_rich( $a, 'title' ); ?></h2>
	<div class="amfie-quick-links__items"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
</div>
