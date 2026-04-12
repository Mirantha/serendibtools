<?php
/**
 * Sidebar Position
 *
 * @package plumbing_handyman
 */

$wp_customize->add_section(
	'plumbing_handyman_sidebar_position',
	array(
		'title' => esc_html__( 'Sidebar Position', 'plumbing-handyman' ),
		'panel' => 'plumbing_handyman_theme_options',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_global_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_global_sidebar_separator', array(
	'label' => __( 'Global Sidebar Position', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_sidebar_position',
	'settings' => 'plumbing_handyman_global_sidebar_separator',
)));

// Sidebar Position - Global Sidebar Position.
$wp_customize->add_setting(
	'plumbing_handyman_sidebar_position',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'plumbing-handyman' ),
		'section' => 'plumbing_handyman_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'plumbing-handyman' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'plumbing-handyman' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'plumbing-handyman' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_page_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_page_sidebar_separator', array(
	'label' => __( 'Page Sidebar Position', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_sidebar_position',
	'settings' => 'plumbing_handyman_page_sidebar_separator',
)));

// Sidebar Position - Page Sidebar Position.
$wp_customize->add_setting(
	'plumbing_handyman_page_sidebar_position',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'plumbing-handyman' ),
		'section' => 'plumbing_handyman_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'plumbing-handyman' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'plumbing-handyman' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'plumbing-handyman' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_post_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_post_sidebar_separator', array(
	'label' => __( 'Post Sidebar Position', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_sidebar_position',
	'settings' => 'plumbing_handyman_post_sidebar_separator',
)));

// Sidebar Position - Post Sidebar Position.
$wp_customize->add_setting(
	'plumbing_handyman_post_sidebar_position',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'plumbing-handyman' ),
		'section' => 'plumbing_handyman_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'plumbing-handyman' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'plumbing-handyman' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'plumbing-handyman' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_sidebar_width_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_sidebar_width_separator', array(
	'label' => __( 'Sidebar Width Setting', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_sidebar_position',
	'settings' => 'plumbing_handyman_sidebar_width_separator',
)));


$wp_customize->add_setting( 'plumbing_handyman_sidebar_width', array(
	'default'           => '30',
	'sanitize_callback' => 'plumbing_handyman_sanitize_range_value',
) );

$wp_customize->add_control(new Plumbing_Handyman_Customize_Range_Control($wp_customize, 'plumbing_handyman_sidebar_width', array(
	'section'     => 'plumbing_handyman_sidebar_position',
	'label'       => __( 'Adjust Sidebar Width', 'plumbing-handyman' ),
	'description' => __( 'Adjust the width of the sidebar.', 'plumbing-handyman' ),
	'input_attrs' => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
)));

$wp_customize->add_setting( 'plumbing_handyman_sidebar_widget_font_size', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'plumbing_handyman_sidebar_widget_font_size', array(
    'type'        => 'number',
    'section'     => 'plumbing_handyman_sidebar_position',
    'label'       => __( 'Sidebar Widgets Heading Font Size ', 'plumbing-handyman' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));