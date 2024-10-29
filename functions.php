<?php

/**
 * IMPORTANT❗️:
 * Replace all instances of the word 'themeslug' with the name of your theme.
 */

/**
 * Load stylesheets on the front end of the website.
 *
 * @link https://developer.wordpress.org/themes/core-concepts/including-assets/#front-end-stylesheets
 */

function themeslug_enqueue_styles() {
	// Load custom stylesheets
	wp_enqueue_style( 'base-style', get_parent_theme_file_uri( 'assets/css/base.css' ) );
	wp_enqueue_style( 'layouts-style', get_parent_theme_file_uri( 'assets/css/layouts.css' ) );
	wp_enqueue_style( 'utility-classes-style', get_parent_theme_file_uri( 'assets/css/utility-classes.css' ) );
	// wp_enqueue_style( 'gravity-forms-style', get_parent_theme_file_uri( 'assets/css/gravity-forms.css' ) );

	// Load the theme's style.css file
	wp_enqueue_style( 'themeslug-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_styles' );

/**
 * Load stylesheets in the editor.
 *
 * @link https://developer.wordpress.org/themes/core-concepts/including-assets/#editor-stylesheets
 */

function themeslug_setup() {
	add_editor_style( array(
		// Load another custom stylesheets
		get_parent_theme_file_uri( 'assets/css/base.css' ),
		get_parent_theme_file_uri( 'assets/css/layouts.css' ),
		get_parent_theme_file_uri( 'assets/css/utility-classes.css' ),
		// get_parent_theme_file_uri( 'assets/css/gravity-forms.css' ),

		// Load the active theme's main style.css file
		get_stylesheet_uri()
	) );
}

add_action( 'after_setup_theme', 'themeslug_setup' );

/**
 * Enqueue custom block stylesheets.
 *
 * @link https://developer.wordpress.org/themes/features/block-stylesheets/
 * @link https://developer.wordpress.org/news/2022/12/07/leveraging-theme-json-and-per-block-styles-for-more-performant-themes/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 */

function themeslug_block_stylesheets() {
	// Add the block name (with namespace) for each style
	$blocks = array(
		'core/button',
		'core/navigation',
		'core/query-pagination',
		'core/site-logo',
	);

	// Loop through each block and enqueue its styles
	foreach ( $blocks as $block ) {
		// Replace slash with hyphen for filename
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
 * Register custom block style variations.
 *
 * @link https://developer.wordpress.org/themes/features/block-style-variations/
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 */

function themeslug_block_style_variations() {
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
}

add_action( 'init', 'themeslug_block_style_variations' );
