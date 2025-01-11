<?php

// ❗️ IMPORTANT: Replace all instances of the word 'themeslug' with the name of your theme.

/**
 * Gets the paths of some stylesheets.
 *
 * @return array An array of stylesheets URIs.
 */
function themeslug_get_stylesheets_paths() {
	return array(
		// Some custom stylesheets:
		get_parent_theme_file_uri( 'assets/css/base.css' ),
		get_parent_theme_file_uri( 'assets/css/layouts.css' ),
		get_parent_theme_file_uri( 'assets/css/utility-classes.css' ),
		// Active theme's main style.css file:
		get_stylesheet_uri()
	);
}

/**
 * Enqueues custom stylesheets on the front end of the website.
 *
 * @link https://developer.wordpress.org/themes/core-concepts/including-assets/#front-end-stylesheets
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 *
 * @return void
 */
function themeslug_enqueue_styles() {
	$css_paths = themeslug_get_stylesheets_paths();

	foreach ($css_paths as $path) {
		wp_enqueue_style( md5($path), $path );
	}
}
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_styles' );

/**
 * Enqueues custom stylesheets in the Editor.
 *
 * @link https://developer.wordpress.org/themes/core-concepts/including-assets/#editor-stylesheets
 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
 *
 * @return void
 */
function themeslug_editor_styles() {
	add_editor_style( themeslug_get_stylesheets_paths() );
}
add_action( 'after_setup_theme', 'themeslug_editor_styles' );

/**
 * Enqueues custom block stylesheets in the Editor and on the front end of the website.
 *
 * @link https://developer.wordpress.org/block-editor/how-to-guides/enqueueing-assets-in-the-editor/#theme-scripts-and-styles
 * @link https://developer.wordpress.org/themes/features/block-stylesheets/
 * @link https://developer.wordpress.org/news/2022/12/07/leveraging-theme-json-and-per-block-styles-for-more-performant-themes/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 *
 * @return void
 */
function themeslug_block_stylesheets() {
	// Adds the block name (with namespace) for each style.
	$blocks = array(
		'core/button',
		'core/columns',
		'core/media-text',
		'core/navigation',
		'core/post-template',
		'core/query-pagination',
		'core/query-pagination-next',
		'core/query-pagination-numbers',
		'core/query-pagination-previous',
		'core/site-logo',
	);

	// Loops through each block and enqueues its styles.
	foreach ( $blocks as $block ) {
		// Replaces slash with hyphen for filename.
		$slug = str_replace( '/', '-', $block );

		wp_enqueue_block_style( $block, array(
			'handle' => "themeslug-block-{$slug}",
			'src'    => get_theme_file_uri( "assets/css/blocks/{$slug}.css" ),
			'path'   => get_theme_file_path( "assets/css/blocks/{$slug}.css" )
		) );
	}
}
add_action( 'init', 'themeslug_block_stylesheets' );

/**
 * Registers block style variations.
 *
 * @link https://developer.wordpress.org/themes/features/block-style-variations/
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @return void
 */
// function themeslug_block_style_variations() {
	/**
	 * Description
	 */

	// register_block_style(
	// 	'core/_____',
	// 	array(
	// 		'name'         => '__________',
	// 		'label'        => __( '__________', 'themeslug' ),
	// 		'inline_style' => '
	// 			.wp-block-_____.is-style-__________ {
	// 				// Your block styles here...
	// 			}
	// 		'
	// 	)
	// );
// }
// add_action( 'init', 'themeslug_block_style_variations' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;
