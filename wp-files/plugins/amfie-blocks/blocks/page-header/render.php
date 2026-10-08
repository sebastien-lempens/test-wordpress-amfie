<?php
/**
 * Rendu : amfie/page-header
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
$a = $attributes;
?>
<header <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-page-header' ] ); ?>>
	<div class="amfie-container">
		<?php echo amfie_breadcrumb( $a ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<h1 class="amfie-page-header__title"><?php echo amfie_rich( $a, 'title' ); ?></h1>
		<?php if ( '' !== amfie_attr( $a, 'subtitle' ) ) : ?>
			<p class="amfie-page-header__subtitle"><?php echo amfie_rich( $a, 'subtitle' ); ?></p>
		<?php endif; ?>
	</div>
</header>
