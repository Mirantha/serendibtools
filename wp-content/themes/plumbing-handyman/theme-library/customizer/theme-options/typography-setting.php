<?php
/**
 * Typography Setting
 *
 * @package plumbing_handyman
 */

// Typography Setting
$wp_customize->add_section(
    'plumbing_handyman_typography_setting',
    array(
        'panel' => 'plumbing_handyman_theme_options',
        'title' => esc_html__( 'Typography Setting', 'plumbing-handyman' ),
    )
);

$wp_customize->add_setting(
    'plumbing_handyman_site_title_font',
    array(
        'default'           => 'Roboto Flex',
        'sanitize_callback' => 'plumbing_handyman_sanitize_google_fonts',
    )
);

$wp_customize->add_control(
    'plumbing_handyman_site_title_font',
    array(
        'label'    => esc_html__( 'Site Title Font Family', 'plumbing-handyman' ),
        'section'  => 'plumbing_handyman_typography_setting',
        'settings' => 'plumbing_handyman_site_title_font',
        'type'     => 'select',
        'choices'  => plumbing_handyman_get_all_google_font_families(),
    )
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'plumbing_handyman_site_description_font',
	array(
		'default'           => 'Familjen Grotesk',
		'sanitize_callback' => 'plumbing_handyman_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'plumbing-handyman' ),
		'section'  => 'plumbing_handyman_typography_setting',
		'settings' => 'plumbing_handyman_site_description_font',
		'type'     => 'select',
		'choices'  => plumbing_handyman_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'plumbing_handyman_header_font',
	array(
		'default'           => 'Roboto Flex',
		'sanitize_callback' => 'plumbing_handyman_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_header_font',
	array(
		'label'    => esc_html__( 'Heading Font Family', 'plumbing-handyman' ),
		'section'  => 'plumbing_handyman_typography_setting',
		'settings' => 'plumbing_handyman_header_font',
		'type'     => 'select',
		'choices'  => plumbing_handyman_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'plumbing_handyman_content_font',
	array(
		'default'           => 'Familjen Grotesk',
		'sanitize_callback' => 'plumbing_handyman_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_content_font',
	array(
		'label'    => esc_html__( 'Content Font Family', 'plumbing-handyman' ),
		'section'  => 'plumbing_handyman_typography_setting',
		'settings' => 'plumbing_handyman_content_font',
		'type'     => 'select',
		'choices'  => plumbing_handyman_get_all_google_font_families(),
	)
);