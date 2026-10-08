<?php
/**
 * Rendu : amfie/stat
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
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-stat' ] ); ?>>
	<strong class="amfie-stat__value"><?php echo amfie_rich( $a, 'value' ); ?></strong>
	<span class="amfie-stat__label"><?php echo amfie_rich( $a, 'label' ); ?></span>
</div>
