<?php
/**
 * Plugin Name: AMFIE Blocks
 * Description: Bibliothèque de blocs Gutenberg modulaires pour le site AMFIE + générateur de structure (pages, menus, FR/EN via Polylang).
 * Version: 1.0.0
 * Requires at least: 6.5
 * Requires PHP: 8.0
 * Text Domain: amfie-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AMFIE_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'AMFIE_BLOCKS_URL', plugin_dir_url( __FILE__ ) );
define( 'AMFIE_BLOCKS_VERSION', '1.0.0' );

require_once AMFIE_BLOCKS_DIR . 'includes/helpers.php';
require_once AMFIE_BLOCKS_DIR . 'includes/editor-lockdown.php';

/**
 * Catégorie d'inserter dédiée.
 */
add_filter(
	'block_categories_all',
	static function ( array $categories ): array {
		array_unshift(
			$categories,
			[
				'slug'  => 'amfie',
				'title' => 'AMFIE',
				'icon'  => null,
			]
		);
		return $categories;
	}
);

/**
 * Enregistre les assets partagés puis chaque bloc (blocks/<nom>/block.json).
 */
add_action(
	'init',
	static function (): void {
		wp_register_script(
			'amfie-blocks-editor',
			AMFIE_BLOCKS_URL . 'assets/editor.js',
			[ 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n', 'wp-data', 'wp-core-data', 'wp-html-entities', 'wp-editor' ],
			AMFIE_BLOCKS_VERSION,
			true
		);
		wp_register_style( 'amfie-blocks-style', AMFIE_BLOCKS_URL . 'assets/style.css', [], AMFIE_BLOCKS_VERSION );

		foreach ( glob( AMFIE_BLOCKS_DIR . 'blocks/*/block.json' ) ?: [] as $file ) {
			register_block_type( dirname( $file ) );
		}
	}
);

/**
 * Emplacements de menus (active aussi Apparence > Menus sur un thème bloc,
 * et expose les menus à WPGraphQL via `menus(where:{location})`).
 */
add_action(
	'after_setup_theme',
	static function (): void {
		register_nav_menus(
			[
				'primary' => 'Menu principal',
				'utility' => 'Menu utilitaire (ouvrir un compte, connexion)',
				'footer'  => 'Pied de page (documents légaux)',
			]
		);
	}
);

/**
 * Filet de sécurité Polylang : si la racine d'une langue (/en/, /fr/) est servie comme « blog »
 * alors qu'une page d'accueil statique existe, on redirige vers la page d'accueil traduite.
 */
add_action(
	'template_redirect',
	static function (): void {
		if ( ! is_home() || is_paged() || ! (int) get_option( 'page_on_front' ) || ! function_exists( 'pll_current_language' ) || ! function_exists( 'pll_get_post' ) ) {
			return;
		}
		$lang = pll_current_language();
		$id   = $lang ? (int) pll_get_post( (int) get_option( 'page_on_front' ), $lang ) : 0;
		if ( $id && 'publish' === get_post_status( $id ) ) {
			wp_safe_redirect( get_permalink( $id ), 302 );
			exit;
		}
	}
);

if ( is_admin() ) {
	require_once AMFIE_BLOCKS_DIR . 'includes/content.php';
	require_once AMFIE_BLOCKS_DIR . 'includes/seeder.php';
	require_once AMFIE_BLOCKS_DIR . 'includes/importer.php';
}
