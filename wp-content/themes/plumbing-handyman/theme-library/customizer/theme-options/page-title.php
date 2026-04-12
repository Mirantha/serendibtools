<?php
/**
 * Pige Title Options
 *
 * @package plumbing_handyman
 */



$wp_customize->add_section(
	'plumbing_handyman_page_title_options',
	array(
		'panel' => 'plumbing_handyman_theme_options',
		'title' => esc_html__( 'Page Title', 'plumbing-handyman' ),
	)
);

$wp_customize->add_setting(
    'plumbing_handyman_page_header_visibility',
    array(
        'default'           => 'all-devices',
        'sanitize_callback' => 'plumbing_handyman_sanitize_select',
    )
);

$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'plumbing_handyman_page_header_visibility',
        array(
            'label'    => esc_html__( 'Page Header Visibility', 'plumbing-handyman' ),
            'type'     => 'select',
            'section'  => 'plumbing_handyman_page_title_options',
            'settings' => 'plumbing_handyman_page_header_visibility',
            'priority' => 10,
            'choices'  => array(
                'all-devices'        => esc_html__( 'Show on all devices', 'plumbing-handyman' ),
                'hide-tablet'        => esc_html__( 'Hide on Tablet', 'plumbing-handyman' ),
                'hide-mobile'        => esc_html__( 'Hide on Mobile', 'plumbing-handyman' ),
                'hide-tablet-mobile' => esc_html__( 'Hide on Tablet & Mobile', 'plumbing-handyman' ),
                'hide-all-devices'   => esc_html__( 'Hide on all devices', 'plumbing-handyman' ),
            ),
        )
    )
);


$wp_customize->add_setting( 'plumbing_handyman_page_title_background_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_page_title_background_separator', array(
	'label' => __( 'Page Title BG Image & Color Setting', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_page_title_options',
	'settings' => 'plumbing_handyman_page_title_background_separator',
)));


$wp_customize->add_setting(
	'plumbing_handyman_page_header_style',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
		'default'           => False,
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_page_header_style',
		array(
			'label'   => esc_html__('Page Title Background Image', 'plumbing-handyman'),
			'section' => 'plumbing_handyman_page_title_options',
		)
	)
);

$wp_customize->add_setting( 'plumbing_handyman_page_header_background_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'plumbing_handyman_page_header_background_image', array(
    'label'    => __( 'Background Image', 'plumbing-handyman' ),
    'section'  => 'plumbing_handyman_page_title_options',
	'description' => __('Choose either a background image or a color. If a background image is selected, the background color will not be visible.', 'plumbing-handyman'),
    'settings' => 'plumbing_handyman_page_header_background_image',
	'active_callback' => 'plumbing_handyman_is_pagetitle_bcakground_image_enabled',
)));


$wp_customize->add_setting('plumbing_handyman_page_header_image_height', array(
	'default'           => 200,
	'sanitize_callback' => 'plumbing_handyman_sanitize_range_value',
));

$wp_customize->add_control(new Plumbing_Handyman_Customize_Range_Control($wp_customize, 'plumbing_handyman_page_header_image_height', array(
		'label'       => __('Image Height', 'plumbing-handyman'),
		'section'     => 'plumbing_handyman_page_title_options',
		'settings'    => 'plumbing_handyman_page_header_image_height',
		'active_callback' => 'plumbing_handyman_is_pagetitle_bcakground_image_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 1000,
			'step' => 5,
		),
)));


$wp_customize->add_setting('plumbing_handyman_page_title_background_color_setting', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'plumbing_handyman_page_title_background_color_setting', array(
    'label' => __('Page Title Background Color', 'plumbing-handyman'),
    'section' => 'plumbing_handyman_page_title_options',
)));

$wp_customize->add_setting('plumbing_handyman_pagetitle_height', array(
    'default'           => 50,
    'sanitize_callback' => 'plumbing_handyman_sanitize_range_value',
));

$wp_customize->add_control(new Plumbing_Handyman_Customize_Range_Control($wp_customize, 'plumbing_handyman_pagetitle_height', array(
    'label'       => __('Set Height', 'plumbing-handyman'),
    'description' => __('This setting controls the page title height when no background image is set. If a background image is set, this setting will not apply.', 'plumbing-handyman'),
    'section'     => 'plumbing_handyman_page_title_options',
    'settings'    => 'plumbing_handyman_pagetitle_height',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 300,
        'step' => 5,
    ),
)));


$wp_customize->add_setting( 'plumbing_handyman_page_title_style_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_page_title_style_separator', array(
	'label' => __( 'Page Title Styling Setting', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_page_title_options',
	'settings' => 'plumbing_handyman_page_title_style_separator',
)));

$wp_customize->add_setting( 'plumbing_handyman_page_header_heading_tag', array(
	'default'   => 'h1',
	'sanitize_callback' => 'plumbing_handyman_sanitize_select',
) );

$wp_customize->add_control( 'plumbing_handyman_page_header_heading_tag', array(
	'label'   => __( 'Page Title Heading Tag', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_page_title_options',
	'type'    => 'select',
	'choices' => array(
		'h1' => __( 'H1', 'plumbing-handyman' ),
		'h2' => __( 'H2', 'plumbing-handyman' ),
		'h3' => __( 'H3', 'plumbing-handyman' ),
		'h4' => __( 'H4', 'plumbing-handyman' ),
		'h5' => __( 'H5', 'plumbing-handyman' ),
		'h6' => __( 'H6', 'plumbing-handyman' ),
		'p' => __( 'p', 'plumbing-handyman' ),
		'a' => __( 'a', 'plumbing-handyman' ),
		'div' => __( 'div', 'plumbing-handyman' ),
		'span' => __( 'span', 'plumbing-handyman' ),
	),
) );

$wp_customize->add_setting('plumbing_handyman_page_header_layout', array(
	'default' => 'left',
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('plumbing_handyman_page_header_layout', array(
	'label' => __('Style', 'plumbing-handyman'),
	'section' => 'plumbing_handyman_page_title_options',
	'description' => __('"Flex Layout Style" wont work below 600px (mobile media)', 'plumbing-handyman'),
	'settings' => 'plumbing_handyman_page_header_layout',
	'type' => 'radio',
	'choices' => array(
		'left' => __('Classic', 'plumbing-handyman'),
		'right' => __('Aligned Right', 'plumbing-handyman'),
		'center' => __('Centered Focus', 'plumbing-handyman'),
		'flex' => __('Flex Layout', 'plumbing-handyman'),
	),
));