<?php
/**
 * Petits helpers de rendu partagés par les render.php des blocs.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Valeur d'attribut brute (string). */
function amfie_attr( array $a, string $key, string $default = '' ): string {
	return isset( $a[ $key ] ) && is_scalar( $a[ $key ] ) ? (string) $a[ $key ] : $default;
}

/** Texte riche (gras, italique, liens) : on laisse passer le HTML sûr. */
function amfie_rich( array $a, string $key ): string {
	return wp_kses_post( amfie_attr( $a, $key ) );
}

/**
 * Permalien d'une page WP, traduit dans la langue courante (Polylang).
 * Retourne '' si aucune page choisie / page non publiée (l'appelant retombe alors sur l'URL statique).
 */
function amfie_page_url( int $page_id ): string {
	if ( $page_id <= 0 ) {
		return '';
	}
	if ( function_exists( 'pll_get_post' ) && function_exists( 'pll_current_language' ) ) {
		$lang = pll_current_language();
		$tr   = $lang ? (int) pll_get_post( $page_id, $lang ) : 0;
		if ( $tr > 0 ) {
			$page_id = $tr;
		}
	}
	if ( 'publish' !== get_post_status( $page_id ) ) {
		return '';
	}
	return (string) get_permalink( $page_id );
}

/**
 * href d'un amfie/link-button selon son type : page (traduite) [+ ancre], ancre locale, ou URL libre.
 * linkType vide = rétrocompatibilité (pageId > 0 => page, sinon URL).
 */
function amfie_link_href( array $a ): string {
	$page_id = (int) ( $a['pageId'] ?? 0 );
	$type    = amfie_attr( $a, 'linkType' ) ?: ( $page_id > 0 ? 'page' : 'url' );
	$anchor  = preg_replace( '/\s+/', '-', ltrim( trim( amfie_attr( $a, 'anchor' ) ), '#' ) );
	$frag    = '' !== $anchor ? '#' . $anchor : '';

	if ( 'anchor' === $type ) {
		return $frag;
	}
	if ( 'page' === $type ) {
		$url = amfie_page_url( $page_id );
		if ( '' !== $url ) {
			return $url . $frag;
		}
	}
	return amfie_attr( $a, 'url' );
}

/** Bouton/lien. $style : solid | outline | ghost. */
function amfie_button( string $label, string $url, string $style = 'solid' ): string {
	if ( '' === trim( wp_strip_all_tags( $label ) ) ) {
		return '';
	}
	$url = '' !== $url ? $url : '#';
	return sprintf(
		'<a class="amfie-btn amfie-btn--%s" href="%s">%s</a>',
		esc_attr( $style ),
		esc_url( $url ),
		wp_kses_post( $label )
	);
}

/** Fil d'Ariane déclaratif (libellé + URL du parent saisis dans le bloc). */
function amfie_breadcrumb( array $a ): string {
	$home_label = amfie_attr( $a, 'homeLabel', 'Home' );
	$parts      = [ sprintf( '<a href="%s">%s</a>', esc_url( home_url( '/' ) ), esc_html( $home_label ) ) ];
	if ( '' !== amfie_attr( $a, 'crumbLabel' ) ) {
		$parts[] = sprintf(
			'<a href="%s">%s</a>',
			esc_url( amfie_attr( $a, 'crumbUrl', '#' ) ),
			esc_html( amfie_attr( $a, 'crumbLabel' ) )
		);
	}
	$parts[] = '<span aria-current="page">' . esc_html( wp_strip_all_tags( amfie_attr( $a, 'title' ) ) ) . '</span>';
	return '<nav class="amfie-breadcrumb" aria-label="Breadcrumb">' . implode( ' <span aria-hidden="true">/</span> ', $parts ) . '</nav>';
}

/** Découpe un textarea en lignes non vides. */
function amfie_lines( string $text ): array {
	return array_values( array_filter( array_map( 'trim', preg_split( '/\R/', $text ) ?: [] ), 'strlen' ) );
}
