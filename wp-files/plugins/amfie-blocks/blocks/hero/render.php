<?php
/**
 * Rendu : amfie/hero
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
$a   = $attributes;
$img = amfie_attr( $a, 'imageUrl' );
$st  = $img ? '--amfie-hero-img:url(' . esc_url( $img ) . ')' : '';
?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-hero', 'style' => $st ] ); ?>>
	<div class="amfie-container">
		<h1 class="amfie-hero__title"><?php echo amfie_rich( $a, 'title' ); ?></h1>
		<?php if ( '' !== amfie_attr( $a, 'subtitle' ) ) : ?>
			<p class="amfie-hero__subtitle"><?php echo amfie_rich( $a, 'subtitle' ); ?></p>
		<?php endif; ?>
		<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</div>
</section>
