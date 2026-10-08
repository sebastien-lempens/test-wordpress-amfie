<?php
/**
 * Rendu : amfie/stats
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
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-stats' ] ); ?>>
	<div class="amfie-container">
		<h2><?php echo amfie_rich( $a, 'title' ); ?></h2>
		<div class="amfie-stats__items"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	</div>
</section>
