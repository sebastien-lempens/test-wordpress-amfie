<?php
/**
 * Simplifie l'éditeur pour les rédacteurs : uniquement les blocs AMFIE + le strict minimum de blocs du cœur
 * (contenu libre dans « Section de texte » et motifs synchronisés). Pas de compositions du thème,
 * pas d'annuaire de blocs, pas de médiathèque Openverse.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Blocs du cœur conservés (nécessaires au contenu libre et au fonctionnement de l'éditeur). */
function amfie_core_blocks_allowed(): array {
	return [
		'core/paragraph', 'core/heading', 'core/list', 'core/list-item', 'core/image', 'core/buttons', 'core/button',
		'core/columns', 'core/column', 'core/table', 'core/quote', 'core/separator',
		'core/block', // motifs synchronisés (contact, processus digital).
	];
}

add_filter(
	'allowed_block_types_all',
	static function ( $allowed, $context ) {
		// L'éditeur de site (modèles, pièces de modèle) garde tous les blocs.
		$post = $context->post ?? null;
		if ( ! $post || ! in_array( $post->post_type, [ 'page', 'post', 'wp_block' ], true ) ) {
			return $allowed;
		}
		$amfie = array_values( array_filter( array_keys( WP_Block_Type_Registry::get_instance()->get_all_registered() ), static fn( $n ) => str_starts_with( $n, 'amfie/' ) ) );
		return array_merge( amfie_core_blocks_allowed(), $amfie );
	},
	20,
	2
);

// Compositions du thème / du répertoire WordPress.org : supprimées (les motifs synchronisés AMFIE restent).
add_filter( 'should_load_remote_block_patterns', '__return_false' );
add_action(
	'init',
	static function (): void {
		remove_theme_support( 'core-block-patterns' );
		$reg = WP_Block_Patterns_Registry::get_instance();
		foreach ( $reg->get_all_registered() as $p ) {
			unregister_block_pattern( $p['name'] );
		}
	},
	100
);

// Annuaire de blocs (installation de blocs tiers) et Openverse.
add_action(
	'admin_init',
	static function (): void {
		remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
		remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
	}
);
add_filter(
	'block_editor_settings_all',
	static function ( array $settings ): array {
		$settings['enableOpenverseMediaCategory'] = false;
		$settings['__experimentalBlockPatterns']  = [];
		return $settings;
	}
);

/** Filtre de langue visible au-dessus des listes Pages / Articles (en plus du sélecteur de la barre d'admin Polylang). */
foreach ( [ 'page', 'post' ] as $amfie_pt ) {
	add_filter(
		'views_edit-' . $amfie_pt,
		static function ( array $views ) use ( $amfie_pt ): array {
			if ( ! function_exists( 'pll_languages_list' ) ) {
				return $views;
			}
			$base = add_query_arg( 'post_type', $amfie_pt, admin_url( 'edit.php' ) );
			$cur  = isset( $_GET['lang'] ) ? sanitize_key( wp_unslash( $_GET['lang'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
			$out  = [];
			foreach ( pll_languages_list( [ 'fields' => '' ] ) as $l ) {
				$n   = function_exists( 'pll_count_posts' ) ? pll_count_posts( $l->slug, [ 'post_type' => $amfie_pt ] ) : '';
				$cls = $cur === $l->slug ? ' class="current" aria-current="page"' : '';
				$out[ 'amfie_lang_' . $l->slug ] = sprintf( '<a href="%s"%s>%s <span class="count">(%s)</span></a>', esc_url( add_query_arg( 'lang', $l->slug, $base ) ), $cls, esc_html( $l->name ), esc_html( (string) $n ) );
			}
			return array_merge( $out, [ 'amfie_sep' => '<span style="opacity:.4">|</span>' ], $views );
		}
	);
}
