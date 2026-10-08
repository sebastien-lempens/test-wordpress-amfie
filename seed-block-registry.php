<?php
/**
 * Bootstraps the WPGraphQL Gutenberg block registry server-side.
 * Equivalent of wp.blocks.getBlockTypes() posted from the editor.
 * Safe to re-run after adding/removing custom blocks.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WPGraphQLGutenberg\Blocks\Registry;

$to_array = static function ( $value ) {
	return is_array( $value ) ? $value : [];
};

$block_types = [];

foreach ( WP_Block_Type_Registry::get_instance()->get_all_registered() as $bt ) {
	$attributes = isset( $bt->attributes ) && is_array( $bt->attributes ) ? $bt->attributes : [];

	$block_types[] = [
		'api_version'      => $bt->api_version ?: 1,
		'name'             => $bt->name,
		'title'            => is_scalar( $bt->title ) ? (string) $bt->title : '',
		'category'         => is_scalar( $bt->category ) ? (string) $bt->category : null,
		'parent'           => isset( $bt->parent ) ? $to_array( $bt->parent ) : null,
		'ancestor'         => isset( $bt->ancestor ) ? $to_array( $bt->ancestor ) : null,
		'icon'             => is_scalar( $bt->icon ) ? (string) $bt->icon : '',
		'description'      => is_scalar( $bt->description ) ? (string) $bt->description : '',
		'keywords'         => $to_array( $bt->keywords ),
		'textdomain'       => is_scalar( $bt->textdomain ) ? (string) $bt->textdomain : '',
		'styles'           => $to_array( $bt->styles ),
		'variations'       => $to_array( $bt->variations ),
		'example'          => isset( $bt->example ) && is_array( $bt->example ) ? $bt->example : null,
		'attributes'       => $attributes,
		'supports'         => $to_array( $bt->supports ),
		'provides_context' => $to_array( $bt->provides_context ),
		'uses_context'     => $to_array( $bt->uses_context ),
	];
}

Registry::update_registry( Registry::normalize( $block_types ) );

WP_CLI::success( sprintf( 'Block registry seeded with %d block types.', count( $block_types ) ) );
