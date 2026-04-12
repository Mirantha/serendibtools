<?php

/**
 * Fundraiser Nonprofit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fundraiser Nonprofit
 */

define( 'FUNDRAISER_NONPROFIT_URL', trailingslashit( get_template_directory_uri() ) );

if ( ! function_exists( 'fundraiser_nonprofit_setup' ) ) {

	load_theme_textdomain( 'fundraiser-nonprofit', get_template_directory() . '/languages' );

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function fundraiser_nonprofit_setup() {

		// Add theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'customize-selective-refresh-widgets' );

		require get_template_directory() .'/inc/core/main.php';
	}
}
add_action( 'after_setup_theme', 'fundraiser_nonprofit_setup' );

/**
 * Enqueue scripts and styles
 */
function fundraiser_nonprofit_scripts() {
	$version = wp_get_theme( 'fundraiser-nonprofit' )->get( 'Version' );
	// Stylesheet
	wp_enqueue_style( 'fundraiser-nonprofit-styles', get_theme_file_uri( '/style.css' ), array(), $version );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), $version, 'all' );
	wp_enqueue_style('swiper-css', esc_url(get_template_directory_uri())."/assets/css/swiper-bundle.css");

	if ( file_exists( get_template_directory() . '/assets/css/theme-style.css' ) ) {
		wp_enqueue_style( 'fundraiser-nonprofit-theme-style', get_template_directory_uri() . '/assets/css/theme-style.css',  array(), $version );
	}

	$deps = array( 'fundraiser-nonprofit-animate' );
	global $wp_styles;
	if ( in_array( 'wc-blocks-vendors-style', $wp_styles->queue ) ) {
		$deps[] = 'wc-blocks-vendors-style';
	}

	if ( is_rtl() ) {
    	wp_enqueue_style( 'fundraiser-nonprofit-rtl-css', get_template_directory_uri() . '/assets/css/rtl.css', array( 'fundraiser-nonprofit-styles' ), $version );
	}

	wp_enqueue_style( 'fontawesome-style', esc_url(get_template_directory_uri()).'/assets/fontawesome/css/all.css' );

	wp_enqueue_script( 'fundraiser-nonprofit-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), '', true );

	wp_enqueue_script('swiper-js', esc_url(get_template_directory_uri()). '/assets/js/swiper-bundle.js', array('jquery'));

	// Scripts
	$deps = array( 'jquery' );
	wp_enqueue_script( 'animate', get_template_directory_uri() . '/assets/js/animate.js', $deps, $version );

}
add_action( 'wp_enqueue_scripts', 'fundraiser_nonprofit_scripts' );

/**
 * Add editor styles
 */
function fundraiser_nonprofit_editor_style() {
    wp_enqueue_style( 'fundraiser-nonprofit-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css' );
}
add_action( 'enqueue_block_assets', 'fundraiser_nonprofit_editor_style' );

/**
 * Enqueue assets scripts for both backend and frontend
 */
function fundraiser_nonprofit_block_assets()
{
    wp_enqueue_style( 'fundraiser-nonprofit-blocks-style', get_template_directory_uri() . '/assets/css/blocks.css' );
}
add_action( 'enqueue_block_assets', 'fundraiser_nonprofit_block_assets' );

function fundraiser_nonprofit_enqueue_admin_script($hook) {
    // Enqueue admin JS for notices
    wp_enqueue_script('fundraiser-nonprofit-welcome-notice', get_template_directory_uri() . '/inc/core/fundraiser-nonprofit-welcome-notice.js', array('jquery'), '', true);
    
    // Localize script to pass data to JavaScript
    wp_localize_script('fundraiser-nonprofit-welcome-notice', 'fundraiser_nonprofit_localize', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fundraiser_nonprofit_welcome_nonce'),
        'dismiss_nonce' => wp_create_nonce('fundraiser_nonprofit_welcome_nonce'), // Nonce for dismissal
        'redirect_url' => admin_url('themes.php?page=fundraiser-nonprofit-guide-page')
    ));
}
add_action('admin_enqueue_scripts', 'fundraiser_nonprofit_enqueue_admin_script');

/**
 * Load core file
 */
require get_theme_file_path( '/inc/core/init.php' );

/**
 * Tgm
 */
require get_theme_file_path( '/inc/Tgm/tgm.php' );

/**
 * Getstart
 */

require get_template_directory() .'/inc/core/customizer-notice/fundraiser-nonprofit-customizer-notify.php';

load_template( trailingslashit( get_template_directory() ) . '/inc/core/class-upgrade-pro.php' );

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );