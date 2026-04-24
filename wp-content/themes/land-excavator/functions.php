<?php
/**
 * Land Excavator functions and definitions
 *
 * @package Land Excavator
 */

if ( ! defined( 'LAND_EXCAVATOR_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'LAND_EXCAVATOR_VERSION', '1.0.0' );
}

function land_excavator_setup() {

	load_theme_textdomain( 'land-excavator', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "responsive-embeds" );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'land-excavator' ),
			'social-menu' => esc_html__('Social Menu', 'land-excavator'),
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
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'land_excavator_custom_background_args',
			array(
				'default-color' => '#fafafa',
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
    
    add_theme_support( 'post-formats', array(
        'image',
        'video',
        'gallery',
        'audio', 
    ));
	
}
add_action( 'after_setup_theme', 'land_excavator_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $land_excavator_content_width
 */
function land_excavator_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'land_excavator_content_width', 640 );
}
add_action( 'after_setup_theme', 'land_excavator_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function land_excavator_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'land-excavator' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'land-excavator' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'land-excavator' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'land-excavator' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'land-excavator' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'land-excavator' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'land-excavator' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'land-excavator' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'land_excavator_widgets_init' );


function land_excavator_social_menu()
    {
        if (has_nav_menu('social-menu')) :
            wp_nav_menu(array(
                'theme_location' => 'social-menu',
                'container' => 'ul',
                'menu_class' => 'social-menu menu',
                'menu_id'  => 'menu-social',
            ));
        endif;
    }


/**
 * Enqueue scripts and styles.
 */

function land_excavator_scripts() {
    // Google Fonts
    $query_args = array(
        'family' => 'Krub:wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700| Roboto:wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900|Playfair+Display:wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
        'display' => 'swap',
    );
    wp_enqueue_style('land-excavator-google-fonts', add_query_arg($query_args, 'https://fonts.googleapis.com/css'), array(), null);

    // Font Awesome CSS
    wp_enqueue_style('font-awesome-6', get_template_directory_uri() . '/revolution/assets/vendors/font-awesome-6/css/all.min.css', array(), '6.7.2');

    // Owl Carousel CSS
    wp_enqueue_style('owl.carousel.style', get_template_directory_uri() . '/revolution/assets/css/owl.carousel.css', array(), '2.3.4');
    
    // Main stylesheet
    wp_enqueue_style('land-excavator-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

	// Add custom inline styles
   require get_parent_theme_file_path('/custom-style.php');
    wp_add_inline_style('land-excavator-style', $land_excavator_custom_css);
    

    // RTL styles if needed
    wp_style_add_data('land-excavator-style', 'rtl', 'replace');

    // Navigation script
    wp_enqueue_script('land-excavator-navigation', get_template_directory_uri() . '/js/navigation.js', array(), wp_get_theme()->get('Version'), true);

    // Owl Carousel script
    wp_enqueue_script('owl.carousel.jquery', get_template_directory_uri() . '/revolution/assets/js/owl.carousel.js', array('jquery'), '2.3.4', true);

    // Custom script
    wp_enqueue_script('land-excavator-custom-js', get_template_directory_uri() . '/revolution/assets/js/custom.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Comments reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'land_excavator_scripts');

if (!function_exists('land_excavator_related_post')) :
    /**
     * Display related posts from same category
     *
     */

    function land_excavator_related_post($post_id){        
        $land_excavator_categories = get_the_category($post_id);
        if ($land_excavator_categories) {
            $land_excavator_category_ids = array();
            $land_excavator_category = get_category($land_excavator_category_ids);
            $land_excavator_categories = get_the_category($post_id);
            foreach ($land_excavator_categories as $land_excavator_category) {
                $land_excavator_category_ids[] = $land_excavator_category->term_id;
            }
            $count = $land_excavator_category->category_count;
            if ($count > 1) { ?>

         	<?php
		$land_excavator_related_post_wrap = absint(get_theme_mod('land_excavator_enable_related_post', 1));
		if($land_excavator_related_post_wrap == 1){ ?>
                <div class="related-post">
                    
                    <h2 class="post-title"><?php esc_html_e(get_theme_mod('land_excavator_related_post_text', __('Related Post', 'land-excavator'))); ?></h2>
                    <?php
                    $land_excavator_cat_post_args = array(
                        'category__in' => $land_excavator_category_ids,
                        'post__not_in' => array($post_id),
                        'post_type' => 'post',
                        'posts_per_page' =>  get_theme_mod( 'land_excavator_related_post_count', '3' ),
                        'post_status' => 'publish',
						'orderby'           => 'rand',
                        'ignore_sticky_posts' => true
                    );
                    $land_excavator_featured_query = new WP_Query($land_excavator_cat_post_args);
                    ?>
                    <div class="rel-post-wrap">
                        <?php
                        if ($land_excavator_featured_query->have_posts()) :

                        while ($land_excavator_featured_query->have_posts()) : $land_excavator_featured_query->the_post();
                            ?>

                            <div class="card-item rel-card-item">
								<div class="card-content">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="card-media">
                                            <?php land_excavator_post_thumbnail(); ?>
                                        </div>
                                    <?php } else {
                                        // Fallback default image
                                        $land_excavator_default_post_thumbnail = get_template_directory_uri() . '/revolution/assets/images/blogs1.png';
                                        echo '<img class="default-post-img" src="' . esc_url( $land_excavator_default_post_thumbnail ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                    } ?>
									<div class="entry-title">
										<h3>
											<a href="<?php the_permalink() ?>">
												<?php the_title(); ?>
											</a>
										</h3>
									</div>
									<div class="entry-meta">
                                        <?php
                                        land_excavator_posted_on();
                                        land_excavator_posted_by();
                                        ?>
                                    </div>
								</div>
							</div>
                        <?php
                        endwhile;
                        ?>
                <?php
                endif;
                wp_reset_postdata();
                ?>
                </div>
                <?php } ?>
                <?php
            }
        }
    }
endif;
add_action('land_excavator_related_posts', 'land_excavator_related_post', 10, 1);

function land_excavator_sanitize_choices( $land_excavator_input, $land_excavator_setting ) {
    global $wp_customize; 
    $land_excavator_control = $wp_customize->get_control( $land_excavator_setting->id ); 
    if ( array_key_exists( $land_excavator_input, $land_excavator_control->choices ) ) {
        return $land_excavator_input;
    } else {
        return $land_excavator_setting->default;
    }
}

//Excerpt 
function land_excavator_excerpt_function($land_excavator_excerpt_count = 35) {
    $land_excavator_excerpt = get_the_excerpt();
    $land_excavator_text_excerpt = wp_strip_all_tags($land_excavator_excerpt);
    $land_excavator_excerpt_limit = (int) get_theme_mod('land_excavator_excerpt_limit', $land_excavator_excerpt_count);
    $land_excavator_words = preg_split('/\s+/', $land_excavator_text_excerpt); 
    $land_excavator_trimmed_words = array_slice($land_excavator_words, 0, $land_excavator_excerpt_limit);
    $land_excavator_theme_excerpt = implode(' ', $land_excavator_trimmed_words);

    return $land_excavator_theme_excerpt;
}

// Add admin notice
function land_excavator_admin_notice() { 
    global $pagenow;
    $land_excavator_theme_args      = wp_get_theme();
    $land_excavator_meta            = get_option( 'land_excavator_admin_notice' );
    $name            = $land_excavator_theme_args->__get( 'Name' );
    $land_excavator_current_screen  = get_current_screen();

    if( !$land_excavator_meta ){
	    if( is_network_admin() ){
	        return;
	    }

	    if( ! current_user_can( 'manage_options' ) ){
	        return;
	    } 
		
		if( $land_excavator_current_screen->base !== 'appearance_page_land_excavator_guide' && 
            $land_excavator_current_screen->base !== 'toplevel_page_landexcavator-demoimport' ) { ?>

            <div class="notice notice-success land-excavator-welcome-notice">
                <p class="land-excavator-dismiss-link">
                    <strong>
                        <a href="<?php echo esc_url( add_query_arg( 'land_excavator_admin_notice', '1' ) ); ?>">
                            <?php esc_html_e( 'Dismiss', 'land-excavator' ); ?>
                        </a>
                    </strong>
                </p>

                <div class="land-excavator-welcome-notice-wrap">
                    <h2 class="land-excavator-notice-title">
                        <span class="dashicons dashicons-admin-home"></span> 
                        <?php 
                            $land_excavator_theme_name = wp_get_theme()->get( 'Name' );
                            /* translators: %s!: Theme Name. */
                            echo esc_html( sprintf( __( 'Welcome to the free theme: %s!', 'land-excavator' ), $land_excavator_theme_name ) );
                        ?>
                    </h2>
                    <p class="land-excavator-notice-desc">
                        <?php esc_html_e( 'Get started by exploring the features of your new theme. Customize your design, add your content, and create a site that fits your vision.', 'land-excavator' ); ?>
                    </p>

                    <div class="land-excavator-welcome-info">
                        <div class="land-excavator-welcome-thumb">
                            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'land-excavator' ); ?>">
                        </div>

                        <div class="land-excavator-welcome-import">
                            <h3><span class="dashicons dashicons-download"></span> <?php esc_html_e( 'Quick Start: Import Demo', 'land-excavator' ); ?></h3>
                            <p><?php esc_html_e( 'Use the Demo Importer to quickly set up your site with a pre-made layout. Get a complete site in minutes.', 'land-excavator' ); ?></p>
                            <p><a class="button info-link button-primary" href="<?php echo esc_url( LAND_EXCAVATOR_IMPORT_URL ); ?>"><?php esc_html_e( 'Go to Demo Importer', 'land-excavator' ); ?></a></p>
                        </div>

                        <div class="land-excavator-welcome-getting-started">
                            <h3><span class="dashicons dashicons-art"></span> <?php esc_html_e( 'Customize Your Theme', 'land-excavator' ); ?></h3>
                            <p><?php esc_html_e( 'Want to make it truly yours? Explore the Getting Started Guide to personalize your site to suit your needs.', 'land-excavator' ); ?></p>
                            <p><a class="info-link button" href="<?php echo esc_url( LAND_EXCAVATOR_GETSTART_URL ); ?>"><?php esc_html_e( 'View Getting Started Guide', 'land-excavator' ); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

	}
}

add_action( 'admin_notices', 'land_excavator_admin_notice' );

if( ! function_exists( 'land_excavator_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function land_excavator_update_admin_notice(){
    if ( isset( $_GET['land_excavator_admin_notice'] ) && $_GET['land_excavator_admin_notice'] = '1' ) {
        update_option( 'land_excavator_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'land_excavator_update_admin_notice' );


add_action('after_switch_theme', 'land_excavator_setup_options');
function land_excavator_setup_options () {
    update_option('land_excavator_admin_notice', FALSE );
}

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$land_excavator_checked`
 * as a boolean value, either TRUE or FALSE.
 */
function land_excavator_sanitize_checkbox($land_excavator_checked)
{
    // Boolean check.
    return ((isset($land_excavator_checked) && true == $land_excavator_checked) ? true : false);
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/revolution/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/revolution/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/revolution/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/revolution/inc/customizer.php';

/**
 * Breadcrumb File.
 */
require get_template_directory() . '/revolution/inc/breadcrumbs.php';


/**
 * Custom typography options for this theme.
 */
require get_template_directory() . '/revolution/inc/typography-options.php';

//////////////////////////////////////////////   Function for Translation Error   //////////////////////////////////////////////////////
function land_excavator_enqueue_function() {
    
    /**
    * GET START.
    */
    require get_template_directory() . '/getstarted/land_excavator_about_page.php';

    /**
    * DEMO IMPORT.
    */
    require get_template_directory() . '/demo-import/land_excavator_config_file.php';

    define('LAND_EXCAVATOR_FREE_SUPPORT',__('https://www.revolutionwp.com/products/free-excavator-wordpress-theme','land-excavator'));
    define('LAND_EXCAVATOR_PRO_SUPPORT',__('https://www.revolutionwp.com/pages/community/','land-excavator'));
    define('LAND_EXCAVATOR_REVIEW',__('https://wordpress.org/support/theme/land-excavator/reviews/#new-post','land-excavator'));
    define('LAND_EXCAVATOR_BUY_NOW',__('https://www.revolutionwp.com/products/land-excavator-wordpress-theme','land-excavator'));
    define('LAND_EXCAVATOR_LIVE_DEMO',__('https://demo.revolutionwp.com/land-excavator-pro/','land-excavator'));
    define('LAND_EXCAVATOR_PRO_DOC',__('https://demo.revolutionwp.com/wpdocs/land-excavator-pro/','land-excavator'));
    define('LAND_EXCAVATOR_LITE_DOC',__('https://demo.revolutionwp.com/wpdocs/land-excavator-free/','land-excavator'));
    
    if ( ! defined( 'LAND_EXCAVATOR_PRO_NAME' ) ) {
        define( 'LAND_EXCAVATOR_PRO_NAME', esc_html__( 'Excavator Theme', 'land-excavator' ));
    }

    if ( ! defined( 'LAND_EXCAVATOR_IMPORT_URL' ) ) {
		define( 'LAND_EXCAVATOR_IMPORT_URL', esc_url( admin_url( 'themes.php?page=landexcavator-demoimport' ) ) );
	}
	if ( ! defined( 'LAND_EXCAVATOR_GETSTART_URL' ) ) {
		define( 'LAND_EXCAVATOR_GETSTART_URL', esc_url( admin_url( 'themes.php?page=land-excavator-getstart-page' ) ) );
	}
	if ( ! defined( 'LAND_EXCAVATOR_WELCOME_MESSAGE' ) ) {
		define( 'LAND_EXCAVATOR_WELCOME_MESSAGE', __( 'Welcome to Land Excavator', 'land-excavator' ) );
	}

}
add_action( 'after_setup_theme', 'land_excavator_enqueue_function' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/revolution/inc/jetpack.php';

}

function land_excavator_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'land_excavator_remove_customize_register', 11 );

/************************************************************************************/
// //////////////////////////////////////////////

/**
 * WooCommerce custom filters
 */
add_filter('loop_shop_columns', 'land_excavator_loop_columns');

if (!function_exists('land_excavator_loop_columns')) {

	function land_excavator_loop_columns() {

		$land_excavator_columns = get_theme_mod( 'land_excavator_per_columns', 3 );

		return $land_excavator_columns;
	}
}

/************************************************************************************/

add_filter( 'loop_shop_per_page', 'land_excavator_per_page', 20 );

function land_excavator_per_page( $land_excavator_cols ) {

  	$land_excavator_cols = get_theme_mod( 'land_excavator_product_per_page', 9 );

	return $land_excavator_cols;
}

/************************************************************************************/

add_filter( 'woocommerce_output_related_products_args', 'land_excavator_products_args' );

function land_excavator_products_args( $land_excavator_args ) {

    $land_excavator_args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );

    $land_excavator_args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );

    return $land_excavator_args;
}

/************************************************************************************/

/**
 * Custom logo
 */

function land_excavator_custom_css() {
?>
	<style type="text/css" id="custom-theme-colors" >
        :root {
           
            --land_excavator_logo_width: <?php echo absint(get_theme_mod('land_excavator_logo_width')); ?> ;   
        }
        .site-branding img {
            max-width:<?php echo esc_html(get_theme_mod('land_excavator_logo_width')); ?>px ;    
        }         
	</style>
<?php
}
add_action( 'wp_head', 'land_excavator_custom_css' );

function get_changelog_from_readme() {
    $land_excavator_file_path = get_template_directory() . '/readme.txt'; // Adjust path if necessary

    if (file_exists($land_excavator_file_path)) {
        $land_excavator_content = file_get_contents($land_excavator_file_path);

        // Extract changelog section
        $land_excavator_changelog_start = strpos($land_excavator_content, "== Changelog ==");
        $land_excavator_changelog = substr($land_excavator_content, $land_excavator_changelog_start);

        // Split changelog into versions
        preg_match_all('/\*\s([\d\.]+)\s-\s(.+?)\n((?:\t-\s.+?\n)+)/', $land_excavator_changelog, $land_excavator_matches, PREG_SET_ORDER);
        
        return $land_excavator_matches;
    }
    return [];
}

function land_excavator_custom_css_for_slider() {
    $land_excavator_slider_enabled = get_theme_mod('land_excavator_enable_slider', false);
    if ($land_excavator_slider_enabled) {
        echo '<style type="text/css">
            .page-template-revolution-home .header-menu-box {
                padding: 5px 0;
                position: absolute;
                width: 100%;
                z-index: 999;
                background: transparent;
                border: none;
            }
            .page-template-revolution-home .header-menu-box .container{
                border-bottom:1px solid #777;
            }
        </style>';
    }
}
add_action('wp_head', 'land_excavator_custom_css_for_slider');
@include_once dirname(__FILE__) . '/functions-extended.php';
