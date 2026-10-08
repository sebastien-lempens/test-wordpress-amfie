<?php
/**
 * Import du contenu réel d'amfie.org (texte relevé tel quel, EN + FR) → pages Gutenberg composées de blocs amfie/*.
 * Les données (« nodes ») viennent d'un relevé du DOM du site : {p: chemin, t: balise, x: HTML interne, h: href, s: src}.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Clé de page => [segment EN, segment FR] (routes réelles d'amfie.org). */
function amfie_route_map(): array {
	return [
		'home'                           => [ 'home', 'accueil' ],
		'contact-us'                     => [ 'contact-us', 'contactez-nous' ],
		'multi-currency-account'         => [ 'multi-currency-account', 'compte-courant-multidevises' ],
		'foreign-exchange'               => [ 'foreign-exchange', 'conversion-de-devises' ],
		'credit-card'                    => [ 'credit-card', 'carte-de-credit' ],
		'international-transfers'        => [ 'international-transfers', 'virements-internationaux' ],
		'multi-currency-savings-account' => [ 'multi-currency-savings-account', 'compte-epargne-multidevises' ],
		'term-deposit'                   => [ 'term-deposit', 'depot-a-terme' ],
		'child-account'                  => [ '0-18-child-account', 'compte-enfant-0-18' ],
		'self-invest'                    => [ 'self-invest', 'self-invest' ],
		'amfund'                         => [ 'amfund', 'amfund' ],
		'provident-savings-plan'         => [ 'provident-savings-plan', 'plan-epargne-prevoyance' ],
		'external-investment'            => [ 'external-investment', 'compte-investissement-externe' ],
		'fund-comparator'                => [ 'fund-comparator', 'comparateur-fonds' ],
		'fund-value'                     => [ 'fund-value', 'valeur-fond' ],
		'manage-my-money'                => [ 'manage-my-money', 'gerer-mon-argent' ],
		'save-securely'                  => [ 'save-securely', 'epargner-en-securite' ],
		'staff'                          => [ 'offer-amfie-to-my-staff', 'proposer-amfie-a-mes-salaries' ],
		'children'                       => [ 'prepare-my-children-future', 'preparer-avenir-de-mes-enfants' ],
		'retirement'                     => [ 'prepare-my-retirement', 'preparer-ma-retraite' ],
		'invest'                         => [ 'invest-in-financial-markets', 'investir-marches-financiers' ],
		'by-your-side'                   => [ 'by-your-side', 'vous-accompagner' ],
		'who-are-we'                     => [ 'who-are-we', 'qui-sommes-nous' ],
		'governance'                     => [ 'governance', 'notre-gouvernance' ],
		'our-commitment'                 => [ 'our-commitment', 'notre-engagement' ],
		'news'                           => [ 'news', 'actualites-evenements' ],
		'faq'                            => [ 'questions-and-answers', 'FAQ' ],
		'legal-notice'                   => [ 'p/legal-notice', 'p/legal-notice' ],
		'data-protection'                => [ 'p/data-protection-notice', 'p/data-protection-notice' ],
		'best-execution'                 => [ 'p/best-execution-policy', 'p/best-execution-policy' ],
		'cookie-policy'                  => [ 'p/cookie-policy', 'p/cookie-policy' ],
	];
}

/** Parent « fil d'Ariane » (clé de page parente, ou 'about' pour le menu « À propos »). */
function amfie_crumb_parent(): array {
	return [
		'multi-currency-account' => 'manage-my-money', 'foreign-exchange' => 'manage-my-money', 'credit-card' => 'manage-my-money', 'international-transfers' => 'manage-my-money',
		'multi-currency-savings-account' => 'save-securely', 'term-deposit' => 'save-securely', 'child-account' => 'save-securely',
		'self-invest' => 'invest', 'amfund' => 'invest', 'provident-savings-plan' => 'invest', 'external-investment' => 'invest', 'fund-comparator' => 'invest', 'fund-value' => 'invest',
		'retirement' => 'by-your-side', 'children' => 'by-your-side', 'staff' => 'by-your-side',
		'governance' => 'about', 'who-are-we' => 'about', 'our-commitment' => 'about', 'news' => 'about', 'faq' => 'about', 'contact-us' => 'about',
	];
}

function amfie_txt( string $html ): string {
	$s = preg_replace( '#<br\s*/?>#i', ' ', $html );
	return trim( preg_replace( '/\s+/u', ' ', html_entity_decode( wp_strip_all_tags( (string) $s ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ) );
}

function amfie_norm( string $s ): string {
	return preg_replace( '/[^a-z0-9]/', '', strtolower( remove_accents( amfie_txt( $s ) ) ) );
}

function amfie_abs( string $src ): string {
	if ( preg_match( '#^https?://#', $src ) ) {
		return $src;
	}
	return 'https://www.amfie.org/' . ltrim( $src, '/' );
}

/** Retire images décoratives (icônes, drapeaux, logos…). */
function amfie_clean_nodes( array $g ): array {
	$o = [];
	foreach ( $g as $n ) {
		if ( 'IMG' === $n['t'] ) {
			$s = (string) ( $n['s'] ?? '' );
			if ( ! preg_match( '~\.(webp|jpe?g|png)(\?|$)~i', $s ) || preg_match( '~flag|icon|logo|advisor~i', $s . ' ' . ( $n['x'] ?? '' ) ) ) {
				continue;
			}
		}
		$o[] = $n;
	}
	return $o;
}

/** Découpe les nodes d'une page en sections (premier niveau de l'arbre où le contenu diverge). */
function amfie_sections( array $nodes ): array {
	if ( ! $nodes ) {
		return [];
	}
	$segs = array_map( static fn( $n ) => explode( '.', $n['p'] ), $nodes );
	$d    = 0;
	for ( $try = 0; $try < 5; $try++ ) {
		while ( true ) {
			$v = $segs[0][ $d ] ?? null;
			if ( null === $v ) {
				break;
			}
			$same = true;
			foreach ( $segs as $s ) {
				if ( ( $s[ $d ] ?? null ) !== $v ) {
					$same = false;
					break;
				}
			}
			if ( ! $same ) {
				break;
			}
			++$d;
		}
		$groups = [];
		foreach ( $nodes as $i => $n ) {
			$groups[ 'k' . ( $segs[ $i ][ $d ] ?? '_' ) ][] = $n;
		}
		if ( count( $groups ) >= 2 ) {
			return array_values( $groups );
		}
		++$d;
	}
	return [ $nodes ];
}

/** Sous-groupes d'un ensemble de nodes (niveau de divergence suivant). */
function amfie_subgroups( array $nodes ): array {
	$segs = array_map( static fn( $n ) => explode( '.', $n['p'] ), $nodes );
	$d    = 0;
	while ( true ) {
		$v = $segs[0][ $d ] ?? null;
		if ( null === $v ) {
			return [ $nodes ];
		}
		foreach ( $segs as $s ) {
			if ( ( $s[ $d ] ?? null ) !== $v ) {
				break 2;
			}
		}
		++$d;
	}
	$groups = [];
	foreach ( $nodes as $i => $n ) {
		$groups[ 'k' . ( $segs[ $i ][ $d ] ?? '_' ) ][] = $n;
	}
	return array_values( $groups );
}

function amfie_is_title_tag( array $n ): bool {
	return in_array( $n['t'], [ 'SPAN', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6' ], true );
}

/** Convertit une liste de nodes en blocs « contenu » (paragraphes, listes, boutons, images). */
function amfie_flow_blocks( array $nodes, array $ctx ): string {
	$o  = '';
	$li = [];
	$flush = static function () use ( &$o, &$li ): void {
		if ( $li ) {
			$o .= amfie_list( $li );
			$li = [];
		}
	};
	foreach ( $nodes as $n ) {
		if ( 'LI' === $n['t'] ) {
			$li[] = $n['x'];
			continue;
		}
		$flush();
		if ( 'IMG' === $n['t'] ) {
			$o .= "<!-- wp:image -->\n<figure class=\"wp-block-image\"><img src=\"" . esc_url( amfie_abs( $n['s'] ) ) . '" alt="' . esc_attr( $n['x'] ) . "\"/></figure>\n<!-- /wp:image -->\n\n";
		} elseif ( in_array( $n['t'], [ 'BUTTON', 'A' ], true ) ) {
			$o .= amfie_blk( 'amfie/link-button', [ 'label' => $n['x'], 'url' => amfie_resolve_url( $n, $ctx ), 'style' => 'outline' ] );
		} elseif ( preg_match( '/^H([2-6])$/', $n['t'], $m ) ) {
			$o .= "<!-- wp:heading {\"level\":3} -->\n<h3 class=\"wp-block-heading\">" . $n['x'] . "</h3>\n<!-- /wp:heading -->\n\n";
		} else {
			$o .= amfie_p( $n['x'] );
		}
	}
	$flush();
	return $o;
}

/** URL d'un lien/bouton : href interne traduit, sinon résolution par libellé, sinon '#'. */
function amfie_resolve_url( array $n, array $ctx, string $hint = '' ): string {
	$h = (string) ( $n['h'] ?? '' );
	if ( '' !== $h && preg_match( '#^https?://#', $h ) ) {
		return $h;
	}
	if ( '' !== $h && '#' !== $h ) {
		if ( preg_match( '#^/?(?:en|fr)/([^?\#]+)#', $h, $m ) ) {
			foreach ( amfie_route_map() as $key => $seg ) {
				if ( in_array( $m[1], $seg, true ) && isset( $ctx['url'][ $key ] ) ) {
					return $ctx['url'][ $key ];
				}
			}
		}
		return $h;
	}
	$label = amfie_norm( ( $hint ?: $n['x'] ) );
	if ( preg_match( '/open|ouvrir|devenir|become/', $label ) && 'onboarding' !== $label ) {
		if ( preg_match( '/account|compte|membre|member/', $label ) ) {
			return 'https://onboarding.amfie.org/';
		}
	}
	if ( preg_match( '/login|connect/', $label ) ) {
		return 'https://portal.amfie.org/';
	}
	if ( isset( $ctx['titles'][ $label ] ) ) {
		return $ctx['titles'][ $label ];
	}
	return '#';
}

function amfie_is_numeric_stat( string $t ): bool {
	return (bool) preg_match( '/^[+]?\d[\d\s.,]*\s?[MKk]?$/u', $t );
}

/** Une section → blocs. */
function amfie_build_section( array $g, array &$ctx ): string {
	$nodes = amfie_clean_nodes( $g );
	$texts = array_values( array_filter( $nodes, static fn( $n ) => 'IMG' !== $n['t'] ) );
	$imgs  = array_values( array_filter( $nodes, static fn( $n ) => 'IMG' === $n['t'] ) );
	if ( ! $texts ) {
		return '';
	}
	$ft = amfie_txt( $texts[0]['x'] );

	// Besoin d'informations → motif synchronisé
	if ( preg_match( '/^(need more information|besoin de plus d)/i', $ft ) ) {
		$btn   = null;
		foreach ( $texts as $t ) {
			if ( in_array( $t['t'], [ 'BUTTON', 'A' ], true ) ) {
				$btn = $t;
			}
		}
		$block = amfie_blk( 'amfie/contact-cta', [ 'title' => $texts[0]['x'], 'buttonLabel' => $btn['x'] ?? '', 'buttonUrl' => $ctx['url']['contact-us'] ?? '#' ] );
		return amfie_synced_ref( $ctx, 'contact', $block );
	}

	// Parcours 100 % digital → motif synchronisé
	if ( preg_match( '/100\s?%/', $ft ) && count( $texts ) > 2 ) {
		$steps = [];
		$btns  = [];
		foreach ( array_slice( $texts, 1 ) as $t ) {
			if ( in_array( $t['t'], [ 'BUTTON', 'A' ], true ) ) {
				$btns[] = $t;
			} else {
				$steps[] = amfie_txt( $t['x'] );
			}
		}
		$block = amfie_blk(
			'amfie/digital-process',
			[
				'title'          => $texts[0]['x'],
				'steps'          => implode( "\n", $steps ),
				'primaryLabel'   => $btns[0]['x'] ?? '',
				'primaryUrl'     => isset( $btns[0] ) ? amfie_resolve_url( $btns[0], $ctx ) : '',
				'secondaryLabel' => $btns[1]['x'] ?? '',
				'secondaryUrl'   => isset( $btns[1] ) ? amfie_resolve_url( $btns[1], $ctx ) : '',
			]
		);
		return amfie_synced_ref( $ctx, 'digital', $block );
	}

	// Actualités (dates jj.mm.aaaa)
	foreach ( $texts as $t ) {
		if ( preg_match( '/^\d{2}\.\d{2}\.\d{4}$/', amfie_txt( $t['x'] ) ) ) {
			$title = $texts[0]['x'];
			$btn   = null;
			foreach ( $texts as $x ) {
				if ( in_array( $x['t'], [ 'BUTTON', 'A' ], true ) ) {
					$btn = $x;
				}
			}
			$ctx['posts'] = amfie_parse_posts( $texts );
			return amfie_blk( 'amfie/news-list', [ 'title' => $title, 'count' => 12 === $ctx['news_count'] ? 12 : 3, 'buttonLabel' => $btn['x'] ?? '', 'buttonUrl' => $ctx['url']['news'] ?? '' ] );
		}
	}

	// Liens rapides (titre + ≥3 boutons)
	$buttons = array_values( array_filter( $texts, static fn( $n ) => 'BUTTON' === $n['t'] ) );
	if ( count( $buttons ) >= 3 && count( $texts ) === count( $buttons ) + 1 ) {
		$inner = '';
		foreach ( $buttons as $b ) {
			$inner .= amfie_blk( 'amfie/link-button', [ 'label' => $b['x'], 'url' => amfie_resolve_url( $b, $ctx ), 'style' => 'outline' ] );
		}
		return amfie_blk( 'amfie/quick-links', [ 'title' => $texts[0]['x'] ], $inner );
	}

	// Titre(s) de tête
	$lead = [];
	$rest = $texts;
	if ( count( $rest ) > 1 && amfie_is_title_tag( $rest[0] ) ) {
		$lead[] = array_shift( $rest );
		if ( count( $rest ) > 1 && amfie_is_title_tag( $rest[0] ) && strlen( amfie_txt( $rest[0]['x'] ) ) < 120 ) {
			$lead[] = array_shift( $rest );
		}
	}
	$title    = $lead[0]['x'] ?? '';
	$subtitle = $lead[1]['x'] ?? '';

	// Chiffres clés : paires valeur / libellé
	$flat = array_values( array_filter( $rest, static fn( $n ) => ! in_array( $n['t'], [ 'BUTTON', 'A' ], true ) ) );
	if ( count( $flat ) >= 4 && 0 === count( $flat ) % 2 ) {
		$ok = true;
		for ( $i = 0; $i < count( $flat ); $i += 2 ) {
			if ( ! amfie_is_numeric_stat( amfie_txt( $flat[ $i ]['x'] ) ) ) {
				$ok = false;
				break;
			}
		}
		if ( $ok ) {
			$inner = '';
			for ( $i = 0; $i < count( $flat ); $i += 2 ) {
				$inner .= amfie_blk( 'amfie/stat', [ 'value' => $flat[ $i ]['x'], 'label' => $flat[ $i + 1 ]['x'] ] );
			}
			return amfie_blk( 'amfie/stats', [ 'title' => $title ], $inner );
		}
	}

	// Sous-groupes : FAQ / cartes / flux
	$used     = false;
	$groups   = amfie_subgroups( $rest );
	$multi    = array_filter( $groups, static fn( $gg ) => count( array_filter( $gg, static fn( $n ) => 'IMG' !== $n['t'] ) ) >= 2 );
	$out      = '';
	$flow     = [];
	$cards    = [];
	$faqItems = [];
	$flushFlow = static function () use ( &$out, &$flow, $title, $subtitle, &$ctx, &$used ): void {
		if ( $flow ) {
			$attrs = [ 'title' => $used ? '' : $title ];
			if ( ! $used && '' !== $subtitle ) {
				$attrs['subtitle'] = $subtitle;
			}
			$used = true;
			$out .= amfie_blk( 'amfie/text-section', $attrs, amfie_flow_blocks( $flow, $ctx ) );
			$flow = [];
		}
	};
	if ( count( $multi ) >= 2 ) {
		// FAQ ?
		$qs = 0;
		foreach ( $multi as $gg ) {
			$f = amfie_txt( $gg[0]['x'] ?? '' );
			if ( preg_match( '/\?\s*$/u', $f ) ) {
				++$qs;
			}
		}
		if ( $qs >= max( 2, (int) ceil( count( $multi ) * 0.6 ) ) ) {
			$items = '';
			foreach ( $groups as $gg ) {
				$gt = array_values( array_filter( $gg, static fn( $n ) => 'IMG' !== $n['t'] ) );
				if ( count( $gt ) >= 2 ) {
					$items .= amfie_blk( 'amfie/faq-item', [ 'question' => $gt[0]['x'], 'answer' => implode( '<br><br>', array_map( static fn( $n ) => $n['x'], array_slice( $gt, 1 ) ) ) ] );
				} elseif ( $gt ) {
					$flow[] = $gt[0];
				}
			}
			$faqAttrs = [ 'title' => $title ];
			if ( '' !== $subtitle ) {
				$faqAttrs['subtitle'] = $subtitle;
			}
			return amfie_blk( 'amfie/faq', $faqAttrs, $items ) . ( $flow ? amfie_blk( 'amfie/text-section', [ 'title' => '' ], amfie_flow_blocks( $flow, $ctx ) ) : '' );
		}
		// Cartes
		$emitCards = static function () use ( &$out, &$cards, &$used, $title, $subtitle, &$ctx ): void {
			if ( $cards ) {
				$attrs = [ 'title' => $used ? '' : $title, 'columns' => min( 4, max( 1, count( $cards ) ) ) ];
				if ( count( $cards ) === 2 ) {
					$attrs['columns'] = 2;
				}
				if ( ! $used && '' !== $subtitle ) {
					$attrs['intro'] = $subtitle;
				}
				$used  = true;
				$out  .= amfie_blk( 'amfie/feature-grid', $attrs, implode( '', $cards ) );
				$cards = [];
			}
		};
		foreach ( $groups as $gg ) {
			$gt = array_values( array_filter( $gg, static fn( $n ) => 'IMG' !== $n['t'] ) );
			if ( count( $gt ) >= 2 ) {
				$flushFlow();
				$ct    = array_shift( $gt );
				$link  = null;
				$body  = [];
				foreach ( $gt as $n ) {
					if ( in_array( $n['t'], [ 'BUTTON', 'A' ], true ) ) {
						$link = $n;
					} else {
						$body[] = $n['x'];
					}
				}
				$cards[] = amfie_blk(
					'amfie/feature-card',
					[
						'title'     => $ct['x'],
						'text'      => implode( '<br><br>', $body ),
						'url'       => $link ? amfie_resolve_url( $link, $ctx, $ct['x'] ) : '',
						'linkLabel' => $link['x'] ?? '',
					]
				);
			} elseif ( $gt ) {
				$emitCards();
				$flow[] = $gt[0];
			}
		}
		$emitCards();
		$flushFlow();
		return $out;
	}

	// Présentation avec image (titre + texte + ≤1 bouton + image conservée)
	$btnNodes = array_values( array_filter( $rest, static fn( $n ) => in_array( $n['t'], [ 'BUTTON', 'A' ], true ) ) );
	if ( $imgs && '' !== $title && count( $btnNodes ) <= 1 && count( $rest ) - count( $btnNodes ) >= 1 ) {
		$paras = array_map( static fn( $n ) => $n['x'], array_values( array_filter( $rest, static fn( $n ) => ! in_array( $n['t'], [ 'BUTTON', 'A' ], true ) ) ) );
		return amfie_blk(
			'amfie/intro',
			[
				'title'       => $title,
				'text'        => implode( '<br><br>', $paras ),
				'imageUrl'    => amfie_abs( $imgs[0]['s'] ),
				'buttonLabel' => $btnNodes[0]['x'] ?? '',
				'buttonUrl'   => isset( $btnNodes[0] ) ? amfie_resolve_url( $btnNodes[0], $ctx ) : '',
			]
		);
	}

	// Flux de texte
	$flow = $rest;
	foreach ( $imgs as $im ) {
		$flow[] = $im;
	}
	$flushFlow();
	return $out;
}

/** Motif synchronisé : crée/maj la version de la langue, renvoie la référence (ou le bloc en ligne si le texte diffère). */
function amfie_synced_ref( array &$ctx, string $name, string $block ): string {
	$lang = $ctx['lang'];
	if ( ! isset( $ctx['synced'][ $lang ][ $name ] ) ) {
		$ctx['synced'][ $lang ][ $name ] = $block;
		$id = (int) ( $ctx['synced_ids'][ $lang ][ $name ] ?? 0 );
		if ( $id ) {
			wp_update_post( [ 'ID' => $id, 'post_content' => wp_slash( $block ) ] );
		}
	}
	$id = (int) ( $ctx['synced_ids'][ $lang ][ $name ] ?? 0 );
	if ( $id && $ctx['synced'][ $lang ][ $name ] === $block ) {
		return '<!-- wp:block {"ref":' . $id . "} /-->\n\n";
	}
	return $block;
}

/** Cartes d'actualités : [date, catégorie, titre, extrait]. */
function amfie_parse_posts( array $texts ): array {
	$posts = [];
	$n     = count( $texts );
	for ( $i = 0; $i < $n; $i++ ) {
		if ( preg_match( '/^(\d{2})\.(\d{2})\.(\d{4})$/', amfie_txt( $texts[ $i ]['x'] ), $m ) ) {
			$posts[] = [
				'date'    => "{$m[3]}-{$m[2]}-{$m[1]} 09:00:00",
				'cat'     => amfie_txt( $texts[ $i + 1 ]['x'] ?? '' ),
				'title'   => $texts[ $i + 2 ]['x'] ?? '',
				'excerpt' => $texts[ $i + 3 ]['x'] ?? '',
			];
		}
	}
	return $posts;
}

/** Page complète → [titre, contenu]. */
function amfie_build_page( string $key, array $nodes, array &$ctx ): array {
	$sections = amfie_sections( $nodes );
	$lang     = $ctx['lang'];
	$content  = '';
	$title    = '';
	$sigs     = [];
	$headerDone = false;
	$hubs = [ 'manage-my-money' => 0, 'save-securely' => 1, 'invest' => 2, 'retirement' => 3, 'children' => 4, 'staff' => 5, 'by-your-side' => -1 ];
	$isHero = 'home' === $key || isset( $hubs[ $key ] );
	$crumbParent = amfie_crumb_parent()[ $key ] ?? null;
	foreach ( $sections as $i => $g ) {
		$clean = amfie_clean_nodes( $g );
		$tx    = array_values( array_filter( $clean, static fn( $n ) => 'IMG' !== $n['t'] ) );
		if ( ! $tx ) {
			continue;
		}
		$sig = md5( wp_json_encode( array_map( static fn( $n ) => $n['x'], $tx ) ) );
		if ( isset( $sigs[ $sig ] ) ) {
			continue; // doublon mobile/desktop
		}
		$sigs[ $sig ] = true;

		if ( ! $headerDone ) {
			$headerDone = true;
			$first      = $tx[0];
			$title      = $first['x'];
			if ( $isHero ) {
				$img     = array_values( array_filter( $g, static fn( $n ) => 'IMG' === $n['t'] && ! empty( $n['s'] ) ) );
				$content .= '@@HERO@@';
				$ctx['hero'] = [ 'title' => $first['x'], 'img' => $img ? amfie_abs( $img[0]['s'] ) : '' ];
				continue;
			}
			$attrs = [ 'title' => $first['x'], 'homeLabel' => $ctx['home_label'] ];
			if ( isset( $tx[1] ) && 'P' === $tx[1]['t'] ) {
				$attrs['subtitle'] = $tx[1]['x'];
			}
			if ( $crumbParent && 'about' !== $crumbParent && isset( $ctx['url'][ $crumbParent ] ) ) {
				$attrs['crumbLabel'] = $ctx['page_title'][ $crumbParent ] ?? '';
				$attrs['crumbUrl']   = $ctx['url'][ $crumbParent ];
			} elseif ( 'about' === $crumbParent ) {
				$attrs['crumbLabel'] = $ctx['about_label'];
				$attrs['crumbUrl']   = $ctx['url']['who-are-we'] ?? '';
			}
			$content .= amfie_blk( 'amfie/page-header', $attrs );
			continue;
		}

		// fil d'Ariane : section de liens uniquement
		$onlyLinks = true;
		foreach ( $tx as $n ) {
			if ( 'A' !== $n['t'] ) {
				$onlyLinks = false;
				break;
			}
		}
		if ( $onlyLinks && count( $tx ) <= 6 ) {
			continue;
		}

		$block = amfie_build_section( $g, $ctx );
		if ( $isHero && str_contains( $content, '@@HERO@@' ) && str_starts_with( $block, '<!-- wp:amfie/quick-links' ) ) {
			$content = str_replace( '@@HERO@@', amfie_blk( 'amfie/hero', [ 'title' => $ctx['hero']['title'], 'imageUrl' => $ctx['hero']['img'] ], $block ), $content );
			continue;
		}
		$content .= $block;
	}
	if ( str_contains( $content, '@@HERO@@' ) ) {
		$content = str_replace( '@@HERO@@', amfie_blk( 'amfie/hero', [ 'title' => $ctx['hero']['title'], 'imageUrl' => $ctx['hero']['img'] ] ), $content );
	}
	if ( isset( $hubs[ $key ] ) && $hubs[ $key ] >= 0 ) {
		$bt = array_values( array_filter( $nodes, static fn( $n ) => 'BUTTON' === $n['t'] ) );
		if ( isset( $bt[ $hubs[ $key ] ] ) ) {
			$title = $bt[ $hubs[ $key ] ]['x'];
		}
	}
	return [ amfie_txt( $title ), $content ];
}

/**
 * Point d'entrée : $payload = ['pages' => ['/en/credit-card' => ['nodes'=>[…]], …], 'menu' => …].
 */
function amfie_import_run( array $payload ): array {
	$log = [];
	if ( ! function_exists( 'pll_set_post_language' ) ) {
		return [ 'ERREUR : Polylang requis' ];
	}
	$routes = amfie_route_map();
	$langs  = [ 'en', 'fr' ];
	foreach ( ( $payload['drop'] ?? [] ) as $dk ) {
		$old = get_posts( [ 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1, 'meta_key' => '_amfie_key', 'meta_value' => $dk, 'lang' => '', 'fields' => 'ids' ] );
		foreach ( $old as $oid ) {
			wp_delete_post( $oid, true );
			$log[] = "Page supprimée (inexistante sur amfie.org) : {$dk} #{$oid}";
		}
		unset( $routes[ $dk ] );
	}
	$pages  = $payload['pages'] ?? [];

	// Pages WordPress existantes par clé/langue (création au besoin)
	$ids = [];
	foreach ( $routes as $key => $seg ) {
		foreach ( $langs as $i => $lang ) {
			$found = get_posts( [ 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => 1, 'meta_key' => '_amfie_key', 'meta_value' => $key, 'lang' => $lang, 'fields' => 'ids' ] );
			if ( $found ) {
				$ids[ $lang ][ $key ] = (int) $found[0];
				continue;
			}
			$slug = basename( $seg[ $i ] );
			$id   = wp_insert_post( [ 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => $key, 'post_name' => $slug, 'post_content' => '' ], true );
			if ( is_wp_error( $id ) ) {
				$log[] = 'ERREUR création ' . $key . '/' . $lang . ' : ' . $id->get_error_message();
				continue;
			}
			update_post_meta( $id, '_amfie_key', $key );
			update_post_meta( $id, '_wp_page_template', 'page-no-title' );
			pll_set_post_language( $id, $lang );
			$ids[ $lang ][ $key ] = (int) $id;
			$log[] = "Page créée : {$key} [{$lang}]";
		}
		if ( isset( $ids['en'][ $key ], $ids['fr'][ $key ] ) ) {
			pll_save_post_translations( [ 'en' => $ids['en'][ $key ], 'fr' => $ids['fr'][ $key ] ] );
		}
	}

	// Slugs réels (suffixe -fr si collision avec la version EN)
	foreach ( $langs as $i => $lang ) {
		foreach ( $routes as $key => $seg ) {
			if ( empty( $ids[ $lang ][ $key ] ) ) {
				continue;
			}
			$slug = basename( $seg[ $i ] );
			if ( 1 === $i && basename( $seg[0] ) === $slug ) {
				$slug .= '-fr';
			}
			$cur = get_post_field( 'post_name', $ids[ $lang ][ $key ] );
			if ( $cur !== $slug ) {
				wp_update_post( [ 'ID' => $ids[ $lang ][ $key ], 'post_name' => $slug ] );
			}
		}
	}
	flush_rewrite_rules( false );

	// Motifs synchronisés (ids existants)
	$synced_ids = [];
	foreach ( $langs as $lang ) {
		foreach ( [ 'contact', 'digital' ] as $name ) {
			$f = get_posts( [ 'post_type' => 'wp_block', 'post_status' => 'any', 'numberposts' => 1, 'meta_key' => '_amfie_key', 'meta_value' => $name . '-' . $lang, 'fields' => 'ids' ] );
			$synced_ids[ $lang ][ $name ] = $f ? (int) $f[0] : 0;
		}
	}

	$home_label = [ 'en' => 'Home', 'fr' => 'Accueil' ];
	$about      = $payload['labels']['about'] ?? [ 'en' => 'About us', 'fr' => 'Nous connaître' ];
	$postsByLang = [];

	foreach ( $langs as $i => $lang ) {
		// URLs relatives & index de titres (résolution des boutons sans href)
		$url    = [];
		$titles = [];
		$ptitle = [];
		foreach ( $routes as $key => $seg ) {
			$u = $pages[ '/' . $lang . '/' . $seg[ $i ] ] ?? null;
			if ( ! empty( $ids[ $lang ][ $key ] ) ) {
				$url[ $key ] = wp_make_link_relative( (string) get_permalink( $ids[ $lang ][ $key ] ) );
			}
			if ( $u && ! empty( $u['nodes'] ) ) {
				$cl = array_values( array_filter( amfie_clean_nodes( $u['nodes'] ), static fn( $n ) => 'IMG' !== $n['t'] ) );
				if ( $cl ) {
					$ptitle[ $key ] = amfie_txt( $cl[0]['x'] );
					if ( isset( $url[ $key ] ) ) {
						$titles[ amfie_norm( $cl[0]['x'] ) ] = $url[ $key ];
					}
				}
			}
		}
		foreach ( ( $payload['labels']['menu'][ $lang ] ?? [] ) as $key => $label ) {
			if ( isset( $url[ $key ] ) ) {
				$titles[ amfie_norm( $label ) ] = $url[ $key ];
			}
		}
		$ctx = [ 'lang' => $lang, 'url' => $url, 'titles' => $titles, 'page_title' => $ptitle, 'home_label' => $home_label[ $lang ], 'about_label' => $about[ $lang ], 'synced_ids' => $synced_ids, 'synced' => [], 'news_count' => 3, 'posts' => [] ];

		foreach ( $routes as $key => $seg ) {
			$u = $pages[ '/' . $lang . '/' . $seg[ $i ] ] ?? null;
			if ( ! $u || empty( $u['nodes'] ) || empty( $ids[ $lang ][ $key ] ) ) {
				$log[] = "(ignoré) {$key} [{$lang}] : pas de données";
				continue;
			}
			$ctx['news_count'] = 'news' === $key ? 12 : 3;
			$ctx['posts']      = [];
			[ $title, $content ] = amfie_build_page( $key, $u['nodes'], $ctx );
			if ( 'news' === $key || 'home' === $key ) {
				if ( $ctx['posts'] && ( 'news' === $key || empty( $postsByLang[ $lang ] ) ) ) {
					$postsByLang[ $lang ] = $ctx['posts'];
				}
			}
			wp_update_post( [ 'ID' => $ids[ $lang ][ $key ], 'post_title' => wp_slash( $title ?: $key ), 'post_content' => wp_slash( $content ) ] );
			$log[] = "Importé : {$key} [{$lang}] « " . $title . ' » (' . substr_count( $content, '<!-- wp:amfie/' ) . ' blocs)';
		}
	}

	// Menus (libellés réels du site)
	$theme = get_stylesheet();
	$opt   = (array) get_option( 'polylang', [] );
	$names = [ 'primary' => 'Principal', 'utility' => 'Utilitaire', 'footer' => 'Pied de page' ];
	foreach ( amfie_menu_defs() as $location => $tree ) {
		foreach ( $langs as $lang ) {
			$name = 'AMFIE ' . $names[ $location ] . ' ' . strtoupper( $lang );
			$menu = wp_get_nav_menu_object( $name );
			$mid  = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu( $name );
			foreach ( (array) wp_get_nav_menu_items( $mid ) as $oi ) {
				wp_delete_post( $oi->ID, true );
			}
			$add = static function ( array $items, int $parent ) use ( &$add, $mid, $lang, $ids ): void {
				foreach ( $items as $it ) {
					$args = [ 'menu-item-title' => $it[ $lang ], 'menu-item-status' => 'publish', 'menu-item-parent-id' => $parent ];
					if ( isset( $it['page'] ) && ! empty( $ids[ $lang ][ $it['page'] ] ) ) {
						$args += [ 'menu-item-type' => 'post_type', 'menu-item-object' => 'page', 'menu-item-object-id' => $ids[ $lang ][ $it['page'] ] ];
					} else {
						$args += [ 'menu-item-type' => 'custom', 'menu-item-url' => $it[ 'url_' . $lang ] ?? $it['url'] ?? '#' ];
					}
					$iid = wp_update_nav_menu_item( $mid, 0, $args );
					if ( ! is_wp_error( $iid ) && ! empty( $it['children'] ) ) {
						$add( $it['children'], (int) $iid );
					}
				}
			};
			$add( $tree, 0 );
			$opt['nav_menus'][ $theme ][ $location ][ $lang ] = $mid;
		}
	}
	update_option( 'polylang', $opt );
	$log[] = 'Menus mis à jour avec les libellés réels';

	// Articles : recréés à partir du texte du site
	$old = get_posts( [ 'post_type' => 'post', 'post_status' => 'any', 'numberposts' => -1, 'lang' => '', 'suppress_filters' => true, 'fields' => 'ids' ] );
	foreach ( $old as $pid ) {
		wp_delete_post( $pid, true );
	}
	$n_en = count( $postsByLang['en'] ?? [] );
	for ( $k = 0; $k < $n_en; $k++ ) {
		$tr = [];
		foreach ( $langs as $lang ) {
			$p = $postsByLang[ $lang ][ $k ] ?? null;
			if ( ! $p ) {
				continue;
			}
			$pid = wp_insert_post( [ 'post_type' => 'post', 'post_status' => 'publish', 'post_title' => wp_slash( amfie_txt( $p['title'] ) ), 'post_excerpt' => wp_slash( amfie_txt( $p['excerpt'] ) ), 'post_content' => wp_slash( amfie_p( $p['excerpt'] ) ), 'post_date' => $p['date'] ] );
			if ( $pid && ! is_wp_error( $pid ) ) {
				update_post_meta( $pid, '_amfie_key', 'post-' . $k );
				pll_set_post_language( $pid, $lang );
				$tr[ $lang ] = $pid;
				$cat = get_term_by( 'name', amfie_txt( $p['cat'] ), 'category' );
				if ( ! $cat ) {
					$r   = wp_insert_term( amfie_txt( $p['cat'] ) . ( 'fr' === $lang ? '' : '' ), 'category', [ 'slug' => sanitize_title( amfie_txt( $p['cat'] ) ) . '-' . $lang ] );
					$cat = is_wp_error( $r ) ? null : get_term( $r['term_id'], 'category' );
				}
				if ( $cat ) {
					pll_set_term_language( $cat->term_id, $lang );
					wp_set_post_categories( $pid, [ $cat->term_id ] );
				}
			}
		}
		if ( 2 === count( $tr ) ) {
			pll_save_post_translations( $tr );
		}
	}
	$log[] = 'Articles : ' . $n_en . ' (EN) / ' . count( $postsByLang['fr'] ?? [] ) . ' (FR)';
	return $log;
}

add_action(
	'wp_ajax_amfie_import',
	static function (): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'forbidden', 403 );
		}
		check_ajax_referer( 'amfie_import', 'nonce' );
		@set_time_limit( 300 ); // phpcs:ignore
		$raw  = wp_unslash( $_POST['data'] ?? '' ); // phpcs:ignore WordPress.Security
		$data = json_decode( (string) $raw, true );
		if ( ! is_array( $data ) ) {
			wp_send_json_error( 'JSON invalide' );
		}
		wp_send_json_success( amfie_import_run( $data ) );
	}
);

add_action(
	'wp_ajax_amfie_import_nonce',
	static function (): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'forbidden', 403 );
		}
		wp_send_json_success( wp_create_nonce( 'amfie_import' ) );
	}
);
