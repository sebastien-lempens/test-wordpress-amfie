<?php
/**
 * Rendu : amfie/news-list
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
$a    = $attributes;
$args = [ 'post_type' => 'post', 'posts_per_page' => max( 1, (int) ( $a['count'] ?? 3 ) ), 'post_status' => 'publish', 'ignore_sticky_posts' => true ];
if ( function_exists( 'pll_current_language' ) && pll_current_language() ) {
	$args['lang'] = pll_current_language();
}
$q = new WP_Query( $args );
?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => 'amfie-news' ] ); ?>>
	<div class="amfie-container">
		<h2><?php echo amfie_rich( $a, 'title' ); ?></h2>
		<div class="amfie-news__items">
			<?php while ( $q->have_posts() ) : $q->the_post(); $cats = get_the_category(); ?>
				<article class="amfie-news__item">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></time>
					<?php if ( $cats ) : ?><span class="amfie-news__cat"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
				</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php echo amfie_button( amfie_attr( $a, 'buttonLabel' ), amfie_attr( $a, 'buttonUrl' ), 'outline' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</div>
</section>
