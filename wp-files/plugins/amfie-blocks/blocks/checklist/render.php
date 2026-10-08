<?php
/**
 * Rendu : amfie/checklist
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
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-checklist' ] ); ?>>
	<div class="amfie-container">
		<h2><?php echo amfie_rich( $a, 'title' ); ?></h2>
		<ul class="amfie-checklist__items">
			<?php foreach ( amfie_lines( amfie_attr( $a, 'items' ) ) as $line ) : ?>
				<li><?php echo esc_html( $line ); ?></li>
			<?php endforeach; ?>
		</ul>
		<div class="amfie-actions">
			<?php echo amfie_button( amfie_attr( $a, 'primaryLabel' ), amfie_attr( $a, 'primaryUrl' ), 'solid' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php echo amfie_button( amfie_attr( $a, 'secondaryLabel' ), amfie_attr( $a, 'secondaryUrl' ), 'outline' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>
</section>
