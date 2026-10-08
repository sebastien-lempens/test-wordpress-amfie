<?php
/**
 * Rendu : amfie/digital-process
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
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-digital' ] ); ?>>
	<div class="amfie-container">
		<h2><?php echo amfie_rich( $a, 'title' ); ?></h2>
		<?php if ( '' !== amfie_attr( $a, 'text' ) ) : ?><p><?php echo amfie_rich( $a, 'text' ); ?></p><?php endif; ?>
		<ol class="amfie-digital__steps">
			<?php foreach ( amfie_lines( amfie_attr( $a, 'steps' ) ) as $step ) : ?>
				<li><?php echo esc_html( $step ); ?></li>
			<?php endforeach; ?>
		</ol>
		<div class="amfie-actions">
			<?php echo amfie_button( amfie_attr( $a, 'primaryLabel' ), amfie_attr( $a, 'primaryUrl' ), 'solid' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php echo amfie_button( amfie_attr( $a, 'secondaryLabel' ), amfie_attr( $a, 'secondaryUrl' ), 'outline' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>
</section>
