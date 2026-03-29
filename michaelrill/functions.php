<?php
/**
 * Michael Rill theme functions and definitions.
 *
 * @package MichaelRill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for WordPress features.
 */
function michaelrill_setup() {
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Post formats — we use 'aside' for link posts.
	add_theme_support( 'post-formats', array( 'aside' ) );

	// Custom logo support matching the current 72×72 logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 72,
		'width'       => 72,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// HTML5 markup for core elements.
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Add RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Register navigation menu.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'michaelrill' ),
	) );
}
add_action( 'after_setup_theme', 'michaelrill_setup' );

/**
 * Set the content width based on the theme's design.
 */
function michaelrill_content_width() {
	$GLOBALS['content_width'] = 645;
}
add_action( 'after_setup_theme', 'michaelrill_content_width', 0 );

/**
 * Enqueue styles and scripts.
 */
function michaelrill_scripts() {
	// Main stylesheet.
	wp_enqueue_style(
		'michaelrill-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Mobile navigation toggle.
	wp_enqueue_script(
		'michaelrill-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'michaelrill_scripts' );

/**
 * Register self-hosted fonts via @font-face.
 */
function michaelrill_fonts() {
	$font_url = get_template_directory_uri() . '/assets/fonts/';
	$css = "
		@font-face {
			font-family: 'Manrope';
			font-style: normal;
			font-weight: 200 800;
			font-display: fallback;
			src: url('{$font_url}Manrope-VariableFont_wght.woff2') format('woff2');
		}
		@font-face {
			font-family: 'Fira Code';
			font-style: normal;
			font-weight: 300 700;
			font-display: fallback;
			src: url('{$font_url}FiraCode-VariableFont_wght.woff2') format('woff2');
		}
	";
	wp_add_inline_style( 'michaelrill-style', $css );
}
add_action( 'wp_enqueue_scripts', 'michaelrill_fonts' );

/**
 * Strip the "Category:", "Tag:", etc. prefix from archive titles.
 */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

/**
 * Output the post date in a consistent format.
 */
function michaelrill_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	echo '<div class="entry-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></div>';
}

/**
 * Output category list for a post.
 */
function michaelrill_post_categories() {
	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		echo '<div class="entry-categories">' . $categories_list . '</div>';
	}
}

/**
 * Output tag list for a post.
 */
function michaelrill_post_tags() {
	$tags_list = get_the_tag_list( '', ', ' );
	if ( $tags_list ) {
		echo '<div class="entry-tags">' . $tags_list . '</div>';
	}
}
