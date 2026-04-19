<?php
/**
 * Jocelyne Bosschot — theme bootstrap.
 *
 * @package JocelyneBosschot
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'JB_THEME_VERSION', '1.0.0' );
define( 'JB_THEME_DIR', get_template_directory() );
define( 'JB_THEME_URI', get_template_directory_uri() );

require_once JB_THEME_DIR . '/inc/seo.php';
require_once JB_THEME_DIR . '/inc/content.php';
require_once JB_THEME_DIR . '/inc/contact.php';

function jb_setup() {
	load_theme_textdomain( 'jocelyne-bosschot', JB_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Navigation principale', 'jocelyne-bosschot' ),
		'footer'  => __( 'Navigation pied de page', 'jocelyne-bosschot' ),
	) );
}
add_action( 'after_setup_theme', 'jb_setup' );

function jb_enqueue_assets() {
	wp_enqueue_style(
		'jb-google-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'jb-theme',
		JB_THEME_URI . '/assets/css/theme.css',
		array( 'jb-google-fonts' ),
		JB_THEME_VERSION
	);

	wp_enqueue_script(
		'jb-theme',
		JB_THEME_URI . '/assets/js/theme.js',
		array(),
		JB_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'jb_enqueue_assets' );

function jb_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'jb_resource_hints', 10, 2 );

function jb_body_classes( $classes ) {
	$classes[] = 'jb-theme';
	if ( is_front_page() ) {
		$classes[] = 'jb-front-page';
	}
	return $classes;
}
add_filter( 'body_class', 'jb_body_classes' );

function jb_document_title_parts( $title ) {
	if ( is_front_page() ) {
		$title['title']    = __( 'Jocelyne Bosschot — Sculpture Céramique', 'jocelyne-bosschot' );
		$title['tagline']  = __( 'Saint-Laurent-du-Var', 'jocelyne-bosschot' );
	}
	return $title;
}
add_filter( 'document_title_parts', 'jb_document_title_parts' );
