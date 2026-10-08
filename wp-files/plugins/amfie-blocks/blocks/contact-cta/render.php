<?php
/**
 * Rendu : amfie/contact-cta
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
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-contact-cta' ] ); ?>>
	<div class="amfie-container">
		<h2><?php echo amfie_rich( $a, 'title' ); ?></h2>
		<?php echo amfie_button( amfie_attr( $a, 'buttonLabel' ), amfie_attr( $a, 'buttonUrl' ), 'solid' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</div>
</section>
