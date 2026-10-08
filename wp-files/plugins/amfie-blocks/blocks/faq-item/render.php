<?php
/**
 * Rendu : amfie/faq-item
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
<details <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-faq-item' ] ); ?>>
	<summary><?php echo esc_html( wp_strip_all_tags( amfie_attr( $a, "question" ) ) ); ?></summary>
	<div class="amfie-faq-item__answer"><?php echo wpautop( amfie_rich( $a, 'answer' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
</details>
