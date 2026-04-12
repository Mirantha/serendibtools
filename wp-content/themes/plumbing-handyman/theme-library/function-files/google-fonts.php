<?php
function plumbing_handyman_get_all_google_fonts() {
    $plumbing_handyman_webfonts_json = get_template_directory() . '/theme-library/google-webfonts.json';
    if ( ! file_exists( $plumbing_handyman_webfonts_json ) ) {
        return array();
    }

    $plumbing_handyman_fonts_json_data = file_get_contents( $plumbing_handyman_webfonts_json );
    if ( false === $plumbing_handyman_fonts_json_data ) {
        return array();
    }

    $plumbing_handyman_all_fonts = json_decode( $plumbing_handyman_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $plumbing_handyman_google_fonts = array();
    foreach ( $plumbing_handyman_all_fonts as $plumbing_handyman_font ) {
        $plumbing_handyman_google_fonts[ $plumbing_handyman_font['family'] ] = array(
            'family'   => $plumbing_handyman_font['family'],
            'variants' => $plumbing_handyman_font['variants'],
        );
    }
    return $plumbing_handyman_google_fonts;
}

function plumbing_handyman_get_all_google_font_families() {
    $plumbing_handyman_google_fonts  = plumbing_handyman_get_all_google_fonts();
    $plumbing_handyman_font_families = array();
    foreach ( $plumbing_handyman_google_fonts as $plumbing_handyman_font ) {
        $plumbing_handyman_font_families[ $plumbing_handyman_font['family'] ] = $plumbing_handyman_font['family'];
    }
    return $plumbing_handyman_font_families;
}

function plumbing_handyman_get_fonts_url() {
    $plumbing_handyman_fonts_url = '';
    $plumbing_handyman_fonts     = array();

    $plumbing_handyman_all_fonts = plumbing_handyman_get_all_google_fonts();

    if ( ! empty( get_theme_mod( 'plumbing_handyman_site_title_font', 'Roboto Flex' ) ) ) {
        $plumbing_handyman_fonts[] = get_theme_mod( 'plumbing_handyman_site_title_font', 'Roboto Flex' );
    }

    if ( ! empty( get_theme_mod( 'plumbing_handyman_site_description_font', 'Familjen Grotesk' ) ) ) {
        $plumbing_handyman_fonts[] = get_theme_mod( 'plumbing_handyman_site_description_font', 'Familjen Grotesk' );
    }

    if ( ! empty( get_theme_mod( 'plumbing_handyman_header_font', 'Roboto Flex' ) ) ) {
        $plumbing_handyman_fonts[] = get_theme_mod( 'plumbing_handyman_header_font', 'Roboto Flex' );
    }

    if ( ! empty( get_theme_mod( 'plumbing_handyman_content_font', 'Familjen Grotesk' ) ) ) {
        $plumbing_handyman_fonts[] = get_theme_mod( 'plumbing_handyman_content_font', 'Familjen Grotesk' );
    }

    $plumbing_handyman_fonts = array_unique( $plumbing_handyman_fonts );

    foreach ( $plumbing_handyman_fonts as $plumbing_handyman_font ) {
        $plumbing_handyman_variants      = $plumbing_handyman_all_fonts[ $plumbing_handyman_font ]['variants'];
        $plumbing_handyman_font_family[] = $plumbing_handyman_font . ':' . implode( ',', $plumbing_handyman_variants );
    }

    $plumbing_handyman_query_args = array(
        'family' => urlencode( implode( '|', $plumbing_handyman_font_family ) ),
    );

    if ( ! empty( $plumbing_handyman_font_family ) ) {
        $plumbing_handyman_fonts_url = add_query_arg( $plumbing_handyman_query_args, 'https://fonts.googleapis.com/css' );
    }

    return $plumbing_handyman_fonts_url;
}