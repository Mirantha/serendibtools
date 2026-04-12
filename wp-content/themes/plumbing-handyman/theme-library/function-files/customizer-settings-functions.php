<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package plumbing_handyman
 */


// Output inline CSS based on Customizer setting

// Breadcrumb - Enable Breadcrumb.
function plumbing_handyman_customizer_css_inline() {
	$plumbing_handyman_custom_css = '';
	$plumbing_handyman_enable_breadcrumb = get_theme_mod( 'plumbing_handyman_enable_breadcrumb', true );

	if ( ! $plumbing_handyman_enable_breadcrumb ) {
		$plumbing_handyman_custom_css .= 'nav.woocommerce-breadcrumb { 
            display: none; 
        }';
	}

	if ( ! empty( $plumbing_handyman_custom_css ) ) {
		wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_customizer_css_inline' );

//Global Color
function plumbing_handyman_customize_css() {
	$plumbing_handyman_primary_color = get_theme_mod( 'plumbing_handyman_primary_color', '#067EEF' );
    $plumbing_handyman_secondary_color = get_theme_mod( 'plumbing_handyman_secondary_color', '#002A66' );
	$plumbing_handyman_custom_css = ":root { --primary-color: {$plumbing_handyman_primary_color}; }";
    $plumbing_handyman_custom_css = ":root { --secondary_color: {$plumbing_handyman_secondary_color}; }";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_customize_css' );

//Google Fonts
function plumbing_handyman_enqueue_selected_fonts() {
    $plumbing_handyman_fonts_url = plumbing_handyman_get_fonts_url();
    if (!empty($plumbing_handyman_fonts_url)) {
        wp_enqueue_style('plumbing-handyman-google-fonts', $plumbing_handyman_fonts_url, array(), null);
    }
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_enqueue_selected_fonts');

//Set Width
function plumbing_handyman_layout_customizer_css() {
	$plumbing_handyman_margin = get_theme_mod( 'plumbing_handyman_layout_width_margin', 50 );
	$plumbing_handyman_custom_css = "body.site-boxed--layout #page { margin: 0 {$plumbing_handyman_margin}px; }";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_layout_customizer_css', 20 );

//Blog Content Alignment
function plumbing_handyman_blog_layout_customizer_css() {
	// Retrieve the blog layout option
	$plumbing_handyman_layout_option = get_theme_mod( 'plumbing_handyman_blog_layout_option_setting', 'Left' );

	// Determine text alignment based on option
	switch ( $plumbing_handyman_layout_option ) {
		case 'Right':
			$plumbing_handyman_text_align = 'right';
			break;
		case 'Default':
			$plumbing_handyman_text_align = 'center';
			break;
		case 'Left':
		default:
			$plumbing_handyman_text_align = 'left';
			break;
	}

	// Create custom CSS
	$plumbing_handyman_custom_css = ".mag-post-detail { text-align: {$plumbing_handyman_text_align}; }";

	// Attach CSS to theme style
	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_blog_layout_customizer_css' );

//Sidebar Width Setting
function plumbing_handyman_sidebar_width_customizer_css() {
	$plumbing_handyman_sidebar_width = get_theme_mod( 'plumbing_handyman_sidebar_width', '30' );

	$plumbing_handyman_custom_css = "
		.right-sidebar .asterthemes-wrapper .asterthemes-page {
			grid-template-columns: auto {$plumbing_handyman_sidebar_width}%;
		}
		.left-sidebar .asterthemes-wrapper .asterthemes-page {
			grid-template-columns: {$plumbing_handyman_sidebar_width}% auto;
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_sidebar_width_customizer_css' );


if ( ! function_exists( 'plumbing_handyman_get_page_title' ) ) {
    function plumbing_handyman_get_page_title() {
        $plumbing_handyman_title = '';

        if (is_404()) {
            $plumbing_handyman_title = esc_html__('Page Not Found', 'plumbing-handyman');
        } elseif (is_search()) {
            $plumbing_handyman_title = esc_html__('Search Results for: ', 'plumbing-handyman') . esc_html(get_search_query());
        } elseif (is_home() && !is_front_page()) {
            $plumbing_handyman_title = esc_html__('Blogs', 'plumbing-handyman');
        } elseif (function_exists('is_shop') && is_shop()) {
            $plumbing_handyman_title = esc_html__('Shop', 'plumbing-handyman');
        } elseif (is_page()) {
            $plumbing_handyman_title = get_the_title();
        } elseif (is_single()) {
            $plumbing_handyman_title = get_the_title();
        } elseif (is_archive()) {
            $plumbing_handyman_title = get_the_archive_title();
        } else {
            $plumbing_handyman_title = get_the_archive_title();
        }

        return apply_filters('plumbing_handyman_page_title', $plumbing_handyman_title);
    }
}

if ( ! function_exists( 'plumbing_handyman_has_page_header' ) ) {
    function plumbing_handyman_has_page_header() {
        // Default to true (display header)
        $plumbing_handyman_return = true;

        // Custom conditions for disabling the header
        if ('hide-all-devices' === get_theme_mod('plumbing_handyman_page_header_visibility', 'all-devices')) {
            $plumbing_handyman_return = false;
        }

        // Apply filters and return
        return apply_filters('plumbing_handyman_display_page_header', $plumbing_handyman_return);
    }
}

if ( ! function_exists( 'plumbing_handyman_page_header_style' ) ) {
    function plumbing_handyman_page_header_style() {
        $plumbing_handyman_style = get_theme_mod('plumbing_handyman_page_header_style', 'default');
        return apply_filters('plumbing_handyman_page_header_style', $plumbing_handyman_style);
    }
}

//Page Title Options
function plumbing_handyman_page_title_customizer_css() {
	$plumbing_handyman_layout_option = get_theme_mod( 'plumbing_handyman_page_header_layout', 'left' );
	$plumbing_handyman_custom_css = '';

	if ( $plumbing_handyman_layout_option === 'flex' ) {
		$plumbing_handyman_custom_css .= '
			.asterthemes-wrapper.page-header-inner {
				display: flex;
				justify-content: space-between;
				align-items: center;
			}
		';
	} else {
		$plumbing_handyman_custom_css .= "
			.asterthemes-wrapper.page-header-inner {
				text-align: {$plumbing_handyman_layout_option};
			}
		";
	}

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_page_title_customizer_css' );

//Set Height
function plumbing_handyman_pagetitle_height_css() {
	$plumbing_handyman_height = get_theme_mod( 'plumbing_handyman_pagetitle_height', 50 );

	$plumbing_handyman_custom_css = "
		header.page-header {
			padding: {$plumbing_handyman_height}px 0;
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_pagetitle_height_css' );

//Adjust Site Logo Width
function plumbing_handyman_site_logo_width() {
	$plumbing_handyman_logo_width = get_theme_mod( 'plumbing_handyman_site_logo_width', 160 );

	$plumbing_handyman_custom_css = "
		.site-logo img {
			max-width: {$plumbing_handyman_logo_width}px;
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_site_logo_width' );

//Menu Font Size
function plumbing_handyman_menu_font_size_css() {
	$plumbing_handyman_font_size = get_theme_mod( 'plumbing_handyman_menu_font_size', 15 );

	$plumbing_handyman_custom_css = "
		.main-navigation a {
			font-size: {$plumbing_handyman_font_size}px;
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_menu_font_size_css' );

//Menu Font Weight
function plumbing_handyman_menu_font_weight_css() {
	$plumbing_handyman_font_weight = get_theme_mod( 'plumbing_handyman_menu_font_weight', 500 );

	$plumbing_handyman_custom_css = "
		.main-navigation a {
		    font-weight: {$plumbing_handyman_font_weight};
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_menu_font_weight_css' );

//Menu text transform
function plumbing_handyman_menu_text_transform_css() {
	$plumbing_handyman_text_transform = get_theme_mod( 'plumbing_handyman_menu_text_transform', 'capitalize' );

	$plumbing_handyman_custom_css = "
		.main-navigation a {
			text-transform: {$plumbing_handyman_text_transform};
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_menu_text_transform_css' );

// Featured Image Dimension
function plumbing_handyman_custom_featured_image_css() {
    $plumbing_handyman_dimension = get_theme_mod('plumbing_handyman_blog_post_featured_image_dimension', 'default');
    $plumbing_handyman_width = get_theme_mod('plumbing_handyman_blog_post_featured_image_custom_width', '');
    $plumbing_handyman_height = get_theme_mod('plumbing_handyman_blog_post_featured_image_custom_height', '');
    
    if ($plumbing_handyman_dimension === 'custom' && $plumbing_handyman_width && $plumbing_handyman_height) {
        $plumbing_handyman_custom_css = "body:not(.single-post) .mag-post-single .mag-post-img img { width: {$plumbing_handyman_width}px !important; height: {$plumbing_handyman_height}px !important; }";
        wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_custom_featured_image_css');

// Featured Image Border Radius
function plumbing_handyman_featured_image_border_radius_css() {
	$plumbing_handyman_radius = get_theme_mod( 'plumbing_handyman_featured_image_border_radius', 10 );

	$plumbing_handyman_custom_css = "
		.mag-post-single img {
			border-radius: {$plumbing_handyman_radius}px;
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_featured_image_border_radius_css' );

//Heading Font Size
function plumbing_handyman_sidebar_widget_font_size_css() {
	$plumbing_handyman_sidebar_widget_font_size = get_theme_mod( 'plumbing_handyman_sidebar_widget_font_size', 24 );

	$plumbing_handyman_custom_css = "
		h2.wp-block-heading,
		aside#secondary .widgettitle,
		aside#secondary .widget-title {
			font-size: {$plumbing_handyman_sidebar_widget_font_size}px;
		}
	";

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_sidebar_widget_font_size_css' );

// Woocommerce Related Products Settings
function plumbing_handyman_related_product_css() {
    $plumbing_handyman_related_product_show_hide = get_theme_mod( 'plumbing_handyman_related_product_show_hide', true );

    if ( ! $plumbing_handyman_related_product_show_hide ) {
        $plumbing_handyman_custom_css = '
            .related.products {
                display: none;
            }
        ';
        wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_related_product_css' );

// Product Sale Badge Position
function plumbing_handyman_product_sale_position_customizer_css() {
    $plumbing_handyman_position = get_theme_mod('plumbing_handyman_product_sale_position', 'left');
    $plumbing_handyman_css = '.woocommerce ul.products li.product .onsale {';
    if ($plumbing_handyman_position === 'left') {
        $plumbing_handyman_css .= 'right: auto; left: 0px;';
    } else {
        $plumbing_handyman_css .= 'left: auto; right: 0px;';
    }
    $plumbing_handyman_css .= '}';
    wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_css);
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_product_sale_position_customizer_css');

//Footer Social Icon Alignment
function plumbing_handyman_footer_icons_alignment_css() {
    $plumbing_handyman_footer_social_align = get_theme_mod( 'plumbing_handyman_footer_social_align', 'center' );   
    ?>
    <style type="text/css">
        .socialicons {
            text-align: <?php echo esc_attr( $plumbing_handyman_footer_social_align ); ?> 
        }

        /* Mobile Specific */
        @media screen and (max-width: 575px) {
            .socialicons {
                text-align: center;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'plumbing_handyman_footer_icons_alignment_css' );

// Footer Copyright Alignment
function plumbing_handyman_footer_copyright_alignment_css() {
    $plumbing_handyman_align = get_theme_mod('plumbing_handyman_footer_bottom_align', 'center');
    $plumbing_handyman_css = "
        .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
            justify-content: {$plumbing_handyman_align};
        }
        @media screen and (max-width: 575px) {
            .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
                justify-content: center;
                text-align: center;
            }
        }
    ";
    wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_css);
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_footer_copyright_alignment_css');

// Footer Copyright Font Size
function plumbing_handyman_copyright_font_size_css() {
    $plumbing_handyman_font_size = get_theme_mod('plumbing_handyman_copyright_font_size', 16);
    $plumbing_handyman_css = ".site-footer-bottom .site-info span {
        font-size: {$plumbing_handyman_font_size}px;
    }";
    wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_css);
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_copyright_font_size_css');

// Preloader Background Color
function plumbing_handyman_preloader_background_colors_css() {
    $plumbing_handyman_color = get_theme_mod('plumbing_handyman_preloader_background_color_setting', '');
    if (!empty($plumbing_handyman_color)) {
        $plumbing_handyman_css = "#loader {
            background-color: {$plumbing_handyman_color};
        }";
        wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_css);
    }
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_preloader_background_colors_css');

// Preloader Background Image
function plumbing_handyman_preloader_background_image_css() {
    $plumbing_handyman_image_url = get_theme_mod('plumbing_handyman_preloader_background_image_setting', '');
    if (!empty($plumbing_handyman_image_url)) {
        $plumbing_handyman_css = "#loader {
            background-image: url('{$plumbing_handyman_image_url}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }";
        wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_css);
    }
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_preloader_background_image_css');

// Footer Heading Alignment
function plumbing_handyman_footer_heading_alignment_css() {
    $plumbing_handyman_align = get_theme_mod('plumbing_handyman_footer_header_align', 'left');
    $plumbing_handyman_css = "
        .site-footer h4,
        footer#colophon h2.wp-block-heading,
        footer#colophon .widgettitle,
        footer#colophon .widget-title {
            text-align: {$plumbing_handyman_align};
        }
    ";
    wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_css);
}
add_action('wp_enqueue_scripts', 'plumbing_handyman_footer_heading_alignment_css');

//First Capital Letter
function plumbing_handyman_show_first_caps() {
	$plumbing_handyman_first_caps = get_theme_mod('plumbing_handyman_show_first_caps', false);
	$plumbing_handyman_css = '';
	if ( $plumbing_handyman_first_caps ) {
	$plumbing_handyman_css .= '
		.mag-post-single .mag-post-detail .mag-post-excerpt p:first-of-type::first-letter {
		    font-size: 55px;
			font-weight: 600;
			margin-right: 6px;
			line-height: 1;
			display: inline-block;
			vertical-align: baseline;
		}';
	} else {
		$plumbing_handyman_css .= '
		.mag-post-single .mag-post-detail .mag-post-excerpt p:first-of-type::first-letter {
			display: none;
		}';
	}
	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_show_first_caps' );

// Slider Button Color
function plumbing_handyman_slider_button_color_css() {
	$plumbing_handyman_btn_color      = get_theme_mod('plumbing_handyman_slider_btn_color');
    $plumbing_handyman_btn_bg_color   = get_theme_mod('plumbing_handyman_slider_btn_bg_color');
    $plumbing_handyman_btn_border_color = get_theme_mod('plumbing_handyman_slider_btn_border_color');

    $plumbing_handyman_custom_css = '';

    if ( !empty($plumbing_handyman_btn_color) ) {
        $plumbing_handyman_custom_css .= "
        #plumbing_handyman_slider_section .banner-slider-btn a.asterthemes-button{
            color: {$plumbing_handyman_btn_color};
        }";
    }

    if ( !empty($plumbing_handyman_btn_bg_color) ) {
        $plumbing_handyman_custom_css .= "
        #plumbing_handyman_slider_section .banner-slider-btn a.asterthemes-button{
            background-color: {$plumbing_handyman_btn_bg_color};
        }";
    }

    if ( !empty($plumbing_handyman_btn_border_color) ) {
        $plumbing_handyman_custom_css .= "
        #plumbing_handyman_slider_section .banner-slider-btn a.asterthemes-button{
            border-color: {$plumbing_handyman_btn_border_color};
        }";
    }

    wp_add_inline_style('plumbing-handyman-style', $plumbing_handyman_custom_css);
}
add_action('wp_enqueue_scripts','plumbing_handyman_slider_button_color_css');

// Topbar Padding Dynamic CSS
function plumbing_handyman_topbar_padding_css(){
	$padding = get_theme_mod('plumbing_handyman_topbar_padding');
	$custom_css = ".top-header-part{
		padding-top: {$padding}px !important;
		padding-bottom: {$padding}px !important;
	}";
	wp_add_inline_style('plumbing-handyman-style',$custom_css);

}
add_action('wp_enqueue_scripts','plumbing_handyman_topbar_padding_css');