<?php
/**
 * Générateur de structure : Outils > « AMFIE – Structure ».
 * Idempotent : crée ce qui manque ; « Tout régénérer » réécrit le contenu des pages générées.
 * Nécessite Polylang (langues EN/FR, traductions liées, menus par langue).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'admin_menu',
	static function (): void {
		add_management_page( 'AMFIE – Structure', 'AMFIE – Structure', 'manage_options', 'amfie-seed', 'amfie_seed_screen' );
	}
);

function amfie_seed_screen(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div class="wrap"><h1>AMFIE – Structure du site</h1>';
	if ( isset( $_POST['amfie_seed_mode'] ) && check_admin_referer( 'amfie_seed' ) ) {
		$log = amfie_seed_run( 'force' === $_POST['amfie_seed_mode'] );
		echo '<h2>Journal</h2><pre style="background:#fff;padding:12px;max-height:480px;overflow:auto" id="amfie-seed-log">' . esc_html( implode( "\n", $log ) ) . '</pre>';
	}
	echo '<p>Crée les langues EN/FR (Polylang), les ' . count( amfie_page_defs() ) . ' pages × 2 langues composées avec les blocs <code>amfie/*</code>, les motifs synchronisés, les menus (principal, utilitaire, pied de page) et trois articles d’exemple.</p>';
	echo '<form method="post">';
	wp_nonce_field( 'amfie_seed' );
	echo '<p><button class="button button-primary" name="amfie_seed_mode" value="fill" id="amfie-seed-fill">Générer / compléter</button> ';
	echo '<button class="button" name="amfie_seed_mode" value="force" id="amfie-seed-force" onclick="return confirm(\'Réécrire le contenu des pages générées ?\')">Tout régénérer (écrase le contenu)</button></p></form></div>';
}

/** Exécute la génération et retourne le journal. */
function amfie_seed_run( bool $force = false ): array {
	$log = [];
	$say = static function ( string $m ) use ( &$log ): void {
		$log[] = $m;
	};

	if ( ! function_exists( 'PLL' ) || ! function_exists( 'pll_set_post_language' ) ) {
		return [ 'ERREUR : Polylang doit être actif.' ];
	}

	// 1. Permaliens + réglages de base
	update_option( 'permalink_structure', '/%postname%/' );
	$say( 'Permaliens : /%postname%/' );

	// 2. Langues
	$wanted = [
		'en' => [ 'name' => 'English', 'slug' => 'en', 'locale' => 'en_US', 'rtl' => 0, 'term_group' => 0, 'flag' => 'gb' ],
		'fr' => [ 'name' => 'Français', 'slug' => 'fr', 'locale' => 'fr_FR', 'rtl' => 0, 'term_group' => 1, 'flag' => 'fr' ],
	];
	$existing = PLL()->model->get_languages_list( [ 'fields' => 'slug' ] );
	foreach ( $wanted as $slug => $args ) {
		if ( in_array( $slug, $existing, true ) ) {
			continue;
		}
		$res = PLL()->model->add_language( $args );
		$say( is_wp_error( $res ) ? 'Langue ' . $slug . ' : ' . $res->get_error_message() : 'Langue créée : ' . $slug );
	}
	PLL()->model->clean_languages_cache();
	$opt                 = (array) get_option( 'polylang', [] );
	$opt['default_lang'] = 'en';
	$opt['hide_default'] = 0; // /en/… comme sur amfie.org
	$opt['force_lang']   = 1; // langue dans le chemin
	$opt['rewrite']      = 1;
	update_option( 'polylang', $opt );

	$langs = [ 'en', 'fr' ];

	// 3. Catégories
	$cat_defs = [ 'products' => [ 'Products', 'Produits' ], 'company-life' => [ 'Company life', 'Vie de la société' ], 'events' => [ 'Events', 'Événements' ] ];
	$cats     = [];
	foreach ( $cat_defs as $key => $names ) {
		$ids = [];
		foreach ( $langs as $i => $lang ) {
			$slug = $key . ( 'en' === $lang ? '' : '-fr' );
			$t    = get_term_by( 'slug', $slug, 'category' );
			if ( ! $t ) {
				$r = wp_insert_term( $names[ $i ], 'category', [ 'slug' => $slug ] );
				$t = is_wp_error( $r ) ? null : get_term( $r['term_id'], 'category' );
			}
			if ( $t ) {
				pll_set_term_language( $t->term_id, $lang );
				$ids[ $lang ] = $t->term_id;
			}
		}
		if ( 2 === count( $ids ) ) {
			pll_save_term_translations( $ids );
		}
		$cats[ $key ] = $ids;
	}
	$say( 'Catégories prêtes' );

	// 4. Pages (passe 1 : création)
	$defs = amfie_page_defs();
	$map  = []; // [lang][key] => id
	foreach ( $defs as $d ) {
		$ids = [];
		foreach ( $langs as $lang ) {
			$found = get_posts( [ 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => 1, 'meta_key' => '_amfie_key', 'meta_value' => $d['key'], 'lang' => $lang, 'fields' => 'ids' ] );
			if ( $found ) {
				$id = (int) $found[0];
			} else {
				$id = wp_insert_post(
					[ 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => $d['title'][ $lang ], 'post_name' => $d['slug'][ $lang ], 'post_content' => '' ],
					true
				);
				if ( is_wp_error( $id ) ) {
					$say( 'ERREUR page ' . $d['key'] . '/' . $lang . ' : ' . $id->get_error_message() );
					continue;
				}
				update_post_meta( $id, '_amfie_key', $d['key'] );
				update_post_meta( $id, '_wp_page_template', 'page-no-title' );
				pll_set_post_language( $id, $lang );
				$say( "Page créée : {$d['key']} [{$lang}] (#{$id})" );
			}
			$ids[ $lang ]         = $id;
			$map[ $lang ][ $d['key'] ] = $id;
		}
		if ( 2 === count( $ids ) ) {
			pll_save_post_translations( $ids );
		}
	}

	// 5. Motifs synchronisés
	$synced = []; // [lang][name] => id
	foreach ( amfie_synced_defs() as $name => $builder ) {
		foreach ( $langs as $lang ) {
			$t       = static fn( $en, $fr ) => 'fr' === $lang ? $fr : $en;
			$u       = static function ( $k ) use ( $map, $lang ): string {
				return isset( $map[ $lang ][ $k ] ) ? wp_make_link_relative( (string) get_permalink( $map[ $lang ][ $k ] ) ) : '#';
			};
			$content = $builder( $t, $u );
			$title   = 'AMFIE — ' . ( 'contact' === $name ? 'Appel à contact' : 'Processus digital' ) . ' (' . strtoupper( $lang ) . ')';
			$found   = get_posts( [ 'post_type' => 'wp_block', 'post_status' => 'any', 'numberposts' => 1, 'meta_key' => '_amfie_key', 'meta_value' => $name . '-' . $lang, 'fields' => 'ids' ] );
			if ( $found ) {
				$id = (int) $found[0];
				if ( $force ) {
					wp_update_post( [ 'ID' => $id, 'post_content' => wp_slash( $content ) ] );
				}
			} else {
				$id = (int) wp_insert_post( [ 'post_type' => 'wp_block', 'post_status' => 'publish', 'post_title' => $title, 'post_content' => wp_slash( $content ) ] );
				update_post_meta( $id, '_amfie_key', $name . '-' . $lang );
				$say( 'Motif synchronisé : ' . $title );
			}
			$synced[ $lang ][ $name ] = $id;
		}
	}

	// 6. Pages (passe 2 : contenu)
	foreach ( $defs as $d ) {
		foreach ( $langs as $lang ) {
			if ( empty( $map[ $lang ][ $d['key'] ] ) ) {
				continue;
			}
			$id = $map[ $lang ][ $d['key'] ];
			if ( ! $force && '' !== trim( (string) get_post_field( 'post_content', $id ) ) ) {
				continue;
			}
			$t = static fn( $en, $fr ) => 'fr' === $lang ? $fr : $en;
			$u = static function ( $k ) use ( $map, $lang ): string {
				return isset( $map[ $lang ][ $k ] ) ? wp_make_link_relative( (string) get_permalink( $map[ $lang ][ $k ] ) ) : '#';
			};
			$r = static function ( $name ) use ( $synced, $lang ): string {
				return '<!-- wp:block {"ref":' . (int) $synced[ $lang ][ $name ] . "} /-->\n\n";
			};
			wp_update_post( [ 'ID' => $id, 'post_content' => wp_slash( $d['body']( $t, $u, $r, $lang ) ), 'post_title' => wp_slash( $d['title'][ $lang ] ) ] );
			$say( "Contenu écrit : {$d['key']} [{$lang}]" );
		}
	}

	// 7. Page d'accueil
	if ( ! empty( $map['en']['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $map['en']['home'] );
		PLL()->model->clean_languages_cache(); // Polylang met en cache la page d'accueil de chaque langue
		update_option( 'blogname', 'AMFIE' );
		update_option( 'blogdescription', 'Financial cooperative association of international civil servants' );
		$say( 'Page d’accueil définie (Polylang gère la version FR)' );
		foreach ( $langs as $lg ) {
			$lo = PLL()->model->get_language( $lg );
			$say( "  debug accueil {$lg} : page_on_front=" . ( $lo->page_on_front ?? 'n/a' ) . ' / traduction=' . (int) pll_get_post( $map['en']['home'], $lg ) . ' / option=' . get_option( 'page_on_front' ) );
		}
	}

	// 8. Articles d'exemple
	foreach ( amfie_post_defs() as $p ) {
		$ids = [];
		foreach ( $langs as $lang ) {
			$found = get_posts( [ 'post_type' => 'post', 'post_status' => 'any', 'numberposts' => 1, 'meta_key' => '_amfie_key', 'meta_value' => $p['key'], 'lang' => $lang, 'fields' => 'ids' ] );
			if ( $found ) {
				$ids[ $lang ] = (int) $found[0];
				continue;
			}
			$id = wp_insert_post( [ 'post_type' => 'post', 'post_status' => 'publish', 'post_title' => $p['title'][ $lang ], 'post_name' => $p['slug'][ $lang ], 'post_excerpt' => $p['excerpt'][ $lang ], 'post_content' => wp_slash( amfie_p( esc_html( $p['excerpt'][ $lang ] ) ) ), 'post_date' => $p['date'] ] );
			if ( is_wp_error( $id ) || ! $id ) {
				continue;
			}
			update_post_meta( $id, '_amfie_key', $p['key'] );
			pll_set_post_language( $id, $lang );
			if ( ! empty( $cats[ $p['cat'] ][ $lang ] ) ) {
				wp_set_post_categories( $id, [ $cats[ $p['cat'] ][ $lang ] ] );
			}
			$ids[ $lang ] = $id;
			$say( "Article créé : {$p['key']} [{$lang}]" );
		}
		if ( 2 === count( $ids ) ) {
			pll_save_post_translations( $ids );
		}
	}

	// 9. Menus
	$theme   = get_stylesheet();
	$opt     = (array) get_option( 'polylang', [] );
	$labels  = [ 'primary' => 'Principal', 'utility' => 'Utilitaire', 'footer' => 'Pied de page' ];
	foreach ( amfie_menu_defs() as $location => $tree ) {
		foreach ( $langs as $lang ) {
			$name = 'AMFIE ' . $labels[ $location ] . ' ' . strtoupper( $lang );
			$menu = wp_get_nav_menu_object( $name );
			$mid  = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu( $name );
			foreach ( (array) wp_get_nav_menu_items( $mid ) as $old ) {
				wp_delete_post( $old->ID, true );
			}
			$add = static function ( array $items, int $parent ) use ( &$add, $mid, $lang, $map ): void {
				foreach ( $items as $it ) {
					$args = [ 'menu-item-title' => $it[ $lang ], 'menu-item-status' => 'publish', 'menu-item-parent-id' => $parent ];
					if ( isset( $it['page'] ) && ! empty( $map[ $lang ][ $it['page'] ] ) ) {
						$args += [ 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $map[ $lang ][ $it['page'] ] ];
					} else {
						$args += [ 'menu-item-type' => 'custom', 'menu-item-url' => $it['url'] ?? '#' ];
					}
					$item_id = wp_update_nav_menu_item( $mid, 0, $args );
					if ( ! is_wp_error( $item_id ) && ! empty( $it['children'] ) ) {
						$add( $it['children'], (int) $item_id );
					}
				}
			};
			$add( $tree, 0 );
			$opt['nav_menus'][ $theme ][ $location ][ $lang ] = $mid;
			$say( "Menu {$name} (#{$mid})" );
		}
	}
	update_option( 'polylang', $opt );
	// Emplacements « classiques » pour la langue par défaut (WPGraphQL, wp_nav_menu).
	$locs = (array) get_theme_mod( 'nav_menu_locations', [] );
	foreach ( [ 'primary', 'utility', 'footer' ] as $loc ) {
		$locs[ $loc ] = (int) ( $opt['nav_menus'][ $theme ][ $loc ]['en'] ?? 0 );
	}
	set_theme_mod( 'nav_menu_locations', $locs );

	flush_rewrite_rules( false );
	$say( 'Terminé. Réécriture des permaliens rafraîchie.' );
	return $log;
}
