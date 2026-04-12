<?php
/**
 * Reset Theme Settings
 *
 * @package plumbing_handyman
 */

$wp_customize->add_section(
	'plumbing_handyman_reset_theme_options',
	array(
		'panel' => 'plumbing_handyman_theme_options',
		'title' => esc_html__( 'Reset Theme Settings', 'plumbing-handyman' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_reset_theme_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_reset_theme_separators', array(
	'label' => __( 'Reset Theme', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_reset_theme_options',
	'settings' => 'plumbing_handyman_reset_theme_separators',
)));

//Reset Demo Import
$wp_customize->add_setting( 'plumbing_handyman_reset_demo_import_settings', array(
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control('plumbing_handyman_reset_demo_import_settings',array(
        'label'   => __( 'Reset Demo Import', 'plumbing-handyman' ),
        'section' => 'plumbing_handyman_reset_theme_options',
        'type'    => 'button',
        'input_attrs' => array(
            'onclick' => 'ResetDemoSettings()',
        ),
));

//Reset Global Color
$wp_customize->add_setting('plumbing_handyman_reset_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('plumbing_handyman_reset_color', array(
    'type'    => 'button',
    'label'   => __('Reset Global Color', 'plumbing-handyman'),
    'section' => 'plumbing_handyman_reset_theme_options',
    'input_attrs' => array(
        'onclick' => 'ResetGlobalColor()',
    ),
));