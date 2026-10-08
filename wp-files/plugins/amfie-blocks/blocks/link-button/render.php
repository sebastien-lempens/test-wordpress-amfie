<?php
/**
 * Rendu : amfie/link-button
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
<span <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-link-button' ] ); ?>>
	<?php echo amfie_button( amfie_attr( $a, 'label' ), amfie_link_href( $a ), amfie_attr( $a, 'style', 'solid' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
</span>
