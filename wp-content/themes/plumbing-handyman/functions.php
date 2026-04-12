<?php
/**
 * Plumbing Handyman functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package plumbing_handyman
 */

if ( ! defined( 'PLUMBING_HANDYMAN_VERSION' ) ) {
	define( 'PLUMBING_HANDYMAN_VERSION', '1.0.0' );
}

$plumbing_handyman_theme_data = wp_get_theme();
if( ! defined( 'PLUMBING_HANDYMAN_THEME_VERSION' ) ) define ( 'PLUMBING_HANDYMAN_THEME_VERSION', $plumbing_handyman_theme_data->get( 'Version' ) );
if( ! defined( 'PLUMBING_HANDYMAN_THEME_NAME' ) ) define( 'PLUMBING_HANDYMAN_THEME_NAME', $plumbing_handyman_theme_data->get( 'Name' ) );

if ( ! function_exists( 'plumbing_handyman_setup' ) ) :
	
	function plumbing_handyman_setup() {
		
		load_theme_textdomain( 'plumbing-handyman', get_template_directory() . '/languages' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'plumbing-handyman' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'woocommerce',
			)
		);

		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio', 
		) );

		add_theme_support(
			'custom-background',
			apply_filters(
				'plumbing_handyman_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );

		/*
		* This theme styles the visual editor to resemble the theme style,
		* specifically font, colors, icons, and column width.
		*/
		add_editor_style( '/resource/css/editor-style.css' );

		/*  Demo Import */
		require get_parent_theme_file_path( '/theme-wizard/config.php' );

	}
endif;
add_action( 'after_setup_theme', 'plumbing_handyman_setup' );

function plumbing_handyman_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'plumbing_handyman_content_width', 640 );
}
add_action( 'after_setup_theme', 'plumbing_handyman_content_width', 0 );

function plumbing_handyman_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'plumbing-handyman' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'plumbing-handyman' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// Regsiter 4 footer widgets.
	$plumbing_handyman_footer_widget_column = get_theme_mod('plumbing_handyman_footer_widget_column','4');
	for ($plumbing_handyman_i=1; $plumbing_handyman_i<=$plumbing_handyman_footer_widget_column; $plumbing_handyman_i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'plumbing-handyman' )  . $plumbing_handyman_i,
			'id' => 'footer-widget-' . $plumbing_handyman_i,
			'description' => __( 'The Footer Widget Area', 'plumbing-handyman' )  . $plumbing_handyman_i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
}
add_action( 'widgets_init', 'plumbing_handyman_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function plumbing_handyman_scripts() {
	// Append .min if SCRIPT_DEBUG is false.
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Fontawesome style.
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/resource/css/fontawesome-all.css" );

	// Main style.
	wp_enqueue_style( 'plumbing-handyman-style', get_template_directory_uri() . '/style.css', array(), PLUMBING_HANDYMAN_VERSION );

	// RTL style.
	wp_style_add_data('plumbing-handyman-style', 'rtl', 'replace');

	if (get_theme_mod('plumbing_handyman_enable_animation', true) == true){
		// Animate CSS
		wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/resource/css/animate.css' );
		// Wow script.
		wp_enqueue_script( 'wow-jquery', get_template_directory_uri() . '/resource/js/wow.js', array('jquery'),'' ,true );
	}

	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/resource/css/owl.carousel.css" );

	// Navigation script.
	wp_enqueue_script( 'plumbing-handyman-navigation-script', get_template_directory_uri() . '/resource/js/navigation.js', array(), PLUMBING_HANDYMAN_VERSION, true );

	// Custom script.
	wp_enqueue_script( 'plumbing-handyman-custom-script', get_template_directory_uri() . '/resource/js/custom.js', array( 'jquery' ), PLUMBING_HANDYMAN_VERSION, true );


	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/resource/js/owl.carousel.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Include the file.
	require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

	// Load the webfont.
	wp_enqueue_style(
		'Roboto Flex',
		Plumbing_Handyman_wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap' ),
		array(),
		'1.0'
	);

	// Load the webfont.
	wp_enqueue_style(
		'Familjen Grotesk',
		Plumbing_Handyman_wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400..700;1,400..700&display=swap' ),
		array(),
		'1.0'
	);
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_scripts' );

//Change number of products per page 
add_filter( 'loop_shop_per_page', 'plumbing_handyman_products_per_page' );
function plumbing_handyman_products_per_page( $cols ) {
  	return  get_theme_mod( 'plumbing_handyman_products_per_page',9);
}

// Change number or products per row 
add_filter('loop_shop_columns', 'plumbing_handyman_loop_columns');
	if (!function_exists('plumbing_handyman_loop_columns')) {
	function plumbing_handyman_loop_columns() {
		return get_theme_mod( 'plumbing_handyman_products_per_row', 3 );
	}
}

/**
 * Include wptt webfont loader.
 */
require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme-library/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme-library/function-files/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme-library/function-files/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme-library/customizer.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/theme-library/function-files/google-fonts.php';

/**
 * Dynamic CSS
 */
require get_template_directory() . '/theme-library/dynamic-css.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/theme-library/function-files/class-breadcrumb-trail.php';

/**
 * Customizer Settings Functions
*/
require get_template_directory() . '/theme-library/function-files/customizer-settings-functions.php';

/**
 * Getting Started
*/
require get_template_directory() . '/theme-library/getting-started/getting-started.php';

function plumbing_handyman_links_setup() {
	if ( ! defined( 'PLUMBING_HANDYMAN_PREMIUM_PAGE' ) ) {
	define('PLUMBING_HANDYMAN_PREMIUM_PAGE',__('https://asterthemes.com/products/plumber-wordpress-theme','plumbing-handyman'));
	}
	if ( ! defined( 'PLUMBING_HANDYMAN_THEME_PAGE' ) ) {
		define('PLUMBING_HANDYMAN_THEME_PAGE',__('https://asterthemes.com/products/plumbing-handyman','plumbing-handyman'));
	}
	if ( ! defined( 'PLUMBING_HANDYMAN_SUPPORT' ) ) {
	define('PLUMBING_HANDYMAN_SUPPORT',__('https://wordpress.org/support/theme/plumbing-handyman/','plumbing-handyman'));
	}
	if ( ! defined( 'PLUMBING_HANDYMAN_REVIEW' ) ) {
	define('PLUMBING_HANDYMAN_REVIEW',__('https://wordpress.org/support/theme/plumbing-handyman/reviews/','plumbing-handyman'));
	}
	if ( ! defined( 'PLUMBING_HANDYMAN_PRO_DEMO' ) ) {
	define('PLUMBING_HANDYMAN_PRO_DEMO',__('https://demo.asterthemes.com/plumbing-handyman/','plumbing-handyman'));
	}
	if ( ! defined( 'PLUMBING_HANDYMAN_THEME_DOCUMENTATION' ) ) {
	define('PLUMBING_HANDYMAN_THEME_DOCUMENTATION',__('https://demo.asterthemes.com/docs/plumbing-handyman-free/','plumbing-handyman'));
	}
	if ( ! defined( 'PLUMBING_HANDYMAN_PREMIUM_DOCUMENTATION' ) ) {
	define('PLUMBING_HANDYMAN_PREMIUM_DOCUMENTATION',__('https://demo.asterthemes.com/docs/plumber-wordpress-theme-pro/','plumbing-handyman'));
	}
	if ( ! defined( 'PLUMBING_HANDYMAN_BUNDLE_PAGE' ) ) {
		define('PLUMBING_HANDYMAN_BUNDLE_PAGE',__('https://asterthemes.com/products/wp-theme-bundle','plumbing-handyman'));
	}
}
add_action('after_setup_theme', 'plumbing_handyman_links_setup');

// Enqueue Customizer live preview script
function plumbing_handyman_customizer_live_preview() {
    wp_enqueue_script(
        'plumbing-handyman-customizer',
        get_template_directory_uri() . '/resource/js/customizer.js',
        array('jquery', 'customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'plumbing_handyman_customizer_live_preview');

// Featured Image Dimension
function plumbing_handyman_blog_post_featured_image_dimension(){
	if(get_theme_mod('plumbing_handyman_blog_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

// Reset all theme settings
function plumbing_handyman_reset_demo_import_settings() {
    if (current_user_can('manage_options')) {
        // List only demo import-related settings to reset
		remove_theme_mod('plumbing_handyman_enable_topbar');
		remove_theme_mod('plumbing_handyman_phone_number');
		remove_theme_mod('plumbing_handyman_email_topbar_address');
		remove_theme_mod('plumbing_handyman_header_location');
		remove_theme_mod('plumbing_handyman_enable_header_icon_section');
		remove_theme_mod('plumbing_handyman_header_facebook_link');
		remove_theme_mod('plumbing_handyman_header_twitter_link');
		remove_theme_mod('plumbing_handyman_header_instagram_link');
		remove_theme_mod('plumbing_handyman_header_pinterest_link');
		remove_theme_mod('plumbing_handyman_topheader_button_text');
		remove_theme_mod('plumbing_handyman_topheader_button_url');
		remove_theme_mod('plumbing_handyman_enable_slider_section');
		remove_theme_mod('plumbing_handyman_slider_heading');
		remove_theme_mod('plumbing_handyman_one_word_heading');
		remove_theme_mod('plumbing_handyman_slider_button_label');
		remove_theme_mod('plumbing_handyman_slider_button_link');
		remove_theme_mod('plumbing_handyman_slider_slider_category');
		remove_theme_mod('plumbing_handyman_enable_about_section');
		remove_theme_mod('plumbing_handyman_about_short_content');
		remove_theme_mod('plumbing_handyman_about_section_heading');
		remove_theme_mod('plumbing_handyman_about_section_content');
		remove_theme_mod('plumbing_handyman_about_list_text_1');
		remove_theme_mod('plumbing_handyman_about_list_content_1');
		remove_theme_mod('plumbing_handyman_about_list_text_2');
		remove_theme_mod('plumbing_handyman_about_list_content_2');
		remove_theme_mod('plumbing_handyman_about_list_text_3');
		remove_theme_mod('plumbing_handyman_about_list_content_3');
		remove_theme_mod('plumbing_handyman_about_button_label_');
		remove_theme_mod('plumbing_handyman_about_button_link_');
		remove_theme_mod('plumbing_handyman_image_content');
		remove_theme_mod('plumbing_handyman_image_text');
		remove_theme_mod('plumbing_handyman_image_sub_text');
		remove_theme_mod('plumbing_handyman_team_image_1');

        wp_send_json_success(array('message' => __('Demo import settings have been reset.', 'plumbing-handyman')));
    } else {
        wp_send_json_error(array('message' => __('Permission denied.', 'plumbing-handyman')));
    }
}
add_action('wp_ajax_plumbing_handyman_reset_demo_import_settings', 'plumbing_handyman_reset_demo_import_settings'); 