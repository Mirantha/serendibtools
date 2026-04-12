<?php
/**
 * Dynamic CSS
 */
function plumbing_handyman_dynamic_css() {
	$plumbing_handyman_primary_color = get_theme_mod( 'plumbing_handyman_primary_color', '#067EEF' );
	$plumbing_handyman_secondary_color = get_theme_mod( 'plumbing_handyman_secondary_color', '#002A66' );

	$plumbing_handyman_site_title_font       = get_theme_mod( 'plumbing_handyman_site_title_font', 'Roboto Flex' );
	$plumbing_handyman_site_description_font = get_theme_mod( 'plumbing_handyman_site_description_font', 'Familjen Grotesk' );
	$plumbing_handyman_header_font           = get_theme_mod( 'plumbing_handyman_header_font', 'Roboto Flex' );
	$plumbing_handyman_content_font          = get_theme_mod( 'plumbing_handyman_content_font', 'Familjen Grotesk' );

	// Enqueue Google Fonts
	$plumbing_handyman_fonts_url = plumbing_handyman_get_fonts_url();
	if ( ! empty( $plumbing_handyman_fonts_url ) ) {
		wp_enqueue_style( 'plumbing-handyman-google-fonts', esc_url( $plumbing_handyman_fonts_url ), array(), null );
	}

	$plumbing_handyman_custom_css  = '';
	$plumbing_handyman_custom_css .= '
    /* Color */
    :root {
        --primary-color: ' . esc_attr( $plumbing_handyman_primary_color ) . ';
		--secondary-color: ' . esc_attr( $plumbing_handyman_secondary_color ) . ';
        --header-text-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
    }
    ';

	$plumbing_handyman_custom_css .= '
    /* Typography */
    :root {
        --font-heading: "' . esc_attr( $plumbing_handyman_header_font ) . '", sans-serif;
        --font-content: "' . esc_attr( $plumbing_handyman_content_font ) . '", sans-serif;
    }


    body,
	button, input, select, optgroup, textarea, p {
        font-family: "' . esc_attr( $plumbing_handyman_content_font ) . '", sans-serif;
	}

	.site-identity p.site-title, h1.site-title a, h1.site-title, p.site-title a, .site-branding h1.site-title a, header.site-header .header-main-wrapper:not(.transparent-header) .bottom-header-outer-wrapper .bottom-header-part .bottom-header-part-wrapper .site-branding .site-identity .site-title .slider-text {
        font-family: "' . esc_attr( $plumbing_handyman_site_title_font ) . '", serif;
	}
    
	p.site-description {
        font-family: "' . esc_attr( $plumbing_handyman_site_description_font ) . '", sans-serif !important;
	}
    ';

	wp_add_inline_style( 'plumbing-handyman-style', $plumbing_handyman_custom_css );
}
add_action( 'wp_enqueue_scripts', 'plumbing_handyman_dynamic_css', 99 );