<?php
/**
 * Rendu : amfie/intro
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
$cls = 'amfie-intro' . ( ! empty( $a['reverse'] ) ? ' amfie-intro--reverse' : '' );
?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => $cls ] ); ?>>
	<div class="amfie-container amfie-intro__grid">
		<div class="amfie-intro__body">
			<h2><?php echo amfie_rich( $a, 'title' ); ?></h2>
			<div class="amfie-intro__text"><?php echo wpautop( amfie_rich( $a, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<?php echo amfie_button( amfie_attr( $a, 'buttonLabel' ), amfie_attr( $a, 'buttonUrl' ), 'solid' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
		<?php if ( $img ) : ?>
			<div class="amfie-intro__media"><img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy" /></div>
		<?php endif; ?>
	</div>
</section>
