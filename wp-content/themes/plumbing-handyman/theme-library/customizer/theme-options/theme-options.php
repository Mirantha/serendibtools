<?php
/**
 * Header Options
 *
 * @package plumbing_handyman
 */

// ---------------------------------------- GENERAL OPTIONBS ----------------------------------------------------
// ---------------------------------------- PRELOADER ----------------------------------------------------

$wp_customize->add_section(
	'plumbing_handyman_general_options',
	array(
		'panel' => 'plumbing_handyman_theme_options',
		'title' => esc_html__( 'General Options', 'plumbing-handyman' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_preloader_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_preloader_separator', array(
	'label' => __( 'Enable / Disable Site Preloader Section', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_general_options',
	'settings' => 'plumbing_handyman_preloader_separator',
) ) );


// General Options - Enable Preloader.
$wp_customize->add_setting(
	'plumbing_handyman_enable_preloader',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_preloader',
		array(
			'label'   => esc_html__( 'Enable Preloader', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_general_options',
		)
	)
);

// Preloader Style Setting
$wp_customize->add_setting(
	'plumbing_handyman_preloader_style',
	array(
		'default'           => 'style1',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_preloader_style',
	array(
		'type'     => 'select',
		'label'    => esc_html__('Select Preloader Styles', 'plumbing-handyman'),
		'active_callback' => 'plumbing_handyman_is_preloader_style',
		'section'  => 'plumbing_handyman_general_options',
		'choices'  => array(
			'style1' => esc_html__('Style 1', 'plumbing-handyman'),
			'style2' => esc_html__('Style 2', 'plumbing-handyman'),
			'style3' => esc_html__('Style 3', 'plumbing-handyman'),
		),
	)
);

// Preloader Background Color Setting
$wp_customize->add_setting(
	'plumbing_handyman_preloader_background_color_setting',
	 array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 'plumbing_handyman_preloader_background_color_setting', 
		array(
			'label' => __('Preloader Background Color', 'plumbing-handyman'),
			'active_callback' => 'plumbing_handyman_is_preloader_style',
			'section' => 'plumbing_handyman_general_options',
		)
	)
);

// Preloader Background Image Setting
$wp_customize->add_setting(
	'plumbing_handyman_preloader_background_image_setting', 
	array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize, 'plumbing_handyman_preloader_background_image_setting',
		 array(
			'label' => __('Preloader Background Image', 'plumbing-handyman'),
			'active_callback' => 'plumbing_handyman_is_preloader_style',
			'section' => 'plumbing_handyman_general_options',
		)
	)
);

// ---------------------------------------- Website layout ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_layuout_separator', array(
	'label' => __( 'Website Layout Setting', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_general_options',
	'settings' => 'plumbing_handyman_layuout_separator',
)));


$wp_customize->add_setting(
	'plumbing_handyman_website_layout',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_website_layout',
		array(
			'label'   => esc_html__('Boxed Layout', 'plumbing-handyman'),
			'section' => 'plumbing_handyman_general_options',
		)
	)
);

$wp_customize->add_setting('plumbing_handyman_layout_width_margin', array(
	'default'           => 50,
	'sanitize_callback' => 'plumbing_handyman_sanitize_range_value',
));

$wp_customize->add_control(new Plumbing_Handyman_Customize_Range_Control($wp_customize, 'plumbing_handyman_layout_width_margin', array(
		'label'       => __('Set Width', 'plumbing-handyman'),
		'description' => __('Adjust the width around the website layout by moving the slider. Use this setting to customize the appearance of your site to fit your design preferences.', 'plumbing-handyman'),
		'section'     => 'plumbing_handyman_general_options',
		'settings'    => 'plumbing_handyman_layout_width_margin',
		'active_callback' => 'plumbing_handyman_is_layout_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 130,
			'step' => 1,
		),
)));

// ---------------------------------------- BREADCRUMB ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_breadcrumb_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_breadcrumb_separators', array(
	'label' => __( 'Enable / Disable Breadcrumb Section', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_general_options',
	'settings' => 'plumbing_handyman_breadcrumb_separators',
)));

// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'plumbing_handyman_enable_breadcrumb',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_general_options',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'plumbing_handyman_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'plumbing-handyman' ),
		'active_callback' => 'plumbing_handyman_is_breadcrumb_enabled',
		'section'         => 'plumbing_handyman_general_options',
	)
);

// ----------------------------------------SITE IDENTITY----------------------------------------------------

// Site Logo - Enable Setting.
$wp_customize->add_setting(
	'plumbing_handyman_enable_site_logo',
	array(
		'default'           => true, // Default is to display the logo.
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch', // Sanitize using a custom switch function.
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_site_logo',
		array(
			'label'    => esc_html__( 'Enable Site Logo', 'plumbing-handyman' ),
			'section'  => 'title_tagline', // Section to add this control.
			'settings' => 'plumbing_handyman_enable_site_logo',
		)
	)
);

// Site Title - Enable Setting.
$wp_customize->add_setting(
	'plumbing_handyman_enable_site_title_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_site_title_setting',
		array(
			'label'    => esc_html__( 'Enable Site Title', 'plumbing-handyman' ),
			'section'  => 'title_tagline',
			'settings' => 'plumbing_handyman_enable_site_title_setting',
		)
	)
);

// Tagline - Enable Setting.
$wp_customize->add_setting(
	'plumbing_handyman_enable_tagline_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_tagline_setting',
		array(
			'label'    => esc_html__( 'Enable Tagline', 'plumbing-handyman' ),
			'section'  => 'title_tagline',
			'settings' => 'plumbing_handyman_enable_tagline_setting',
		)
	)
);

$wp_customize->add_setting( 'plumbing_handyman_site_title_size', array(
    'default'           => 25, // Default font size in pixels
    'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
) );

// Add control for site title size
$wp_customize->add_control( 'plumbing_handyman_site_title_size', array(
    'type'        => 'number',
    'section'     => 'title_tagline', // You can change this section to your preferred section
    'label'       => __( 'Site Title Font Size ', 'plumbing-handyman' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
) );

$wp_customize->add_setting('plumbing_handyman_site_logo_width', array(
    'default'           => 160,
    'sanitize_callback' => 'plumbing_handyman_sanitize_range_value',
));

$wp_customize->add_control(new Plumbing_Handyman_Customize_Range_Control($wp_customize, 'plumbing_handyman_site_logo_width', array(
    'label'       => __('Adjust Site Logo Width', 'plumbing-handyman'),
    'description' => __('This setting controls the Width of Site Logo', 'plumbing-handyman'),
    'section'     => 'title_tagline',
    'settings'    => 'plumbing_handyman_site_logo_width',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 400,
        'step' => 5,
    ),
)));

// ---------------------------------------- ANIMATION ----------------------------------------------------

$wp_customize->add_setting( 'plumbing_handyman_animation_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_animation_separator', array(
	'label' => __( 'Enable / Disable Animation', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_general_options',
	'settings' => 'plumbing_handyman_animation_separator',
) ) );
// Animation Enable / Disable
$wp_customize->add_setting(
	'plumbing_handyman_enable_animation',array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);
$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control($wp_customize,'plumbing_handyman_enable_animation',array(
			'label'   => esc_html__( 'Enable Animation', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_general_options',
		)
	)
);