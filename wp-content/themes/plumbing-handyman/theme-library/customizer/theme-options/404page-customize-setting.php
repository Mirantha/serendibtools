<?php
/**
 * 404 page
 *
 * @package plumbing_handyman
 */

/*=========================================
404 Page
=========================================*/
$wp_customize->add_section(
	'404_pg_options', array(
		'title' => esc_html__( '404 Page', 'plumbing-handyman' ),
		'panel' => 'plumbing_handyman_theme_options',
	)
);

//  Title // 
$wp_customize->add_setting(
	'plumbing_handyman_pg_404_ttl',
	array(
        'default'			=> __('404 Page Not Found','plumbing-handyman'),
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'plumbing_handyman_sanitize_html',
	)
);	

$wp_customize->add_control( 
	'plumbing_handyman_pg_404_ttl',
	array(
	    'label'   => __('Title','plumbing-handyman'),
	    'section' => '404_pg_options',
		'type'           => 'text',
	)  
);

$wp_customize->add_setting('plumbing_handyman_pg_404_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'plumbing_handyman_pg_404_image', array(
        'label'    => __('404 Page Image', 'plumbing-handyman'),
        'section'  => '404_pg_options', // Add this section if it doesn't exist
        'settings' => 'plumbing_handyman_pg_404_image',
    )));

    // Existing settings for 404 title, text, button label, and link
    $wp_customize->add_setting('plumbing_handyman_pg_404_ttl', array(
        'default' => __( '404 Page Not Found', 'plumbing-handyman' ),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('plumbing_handyman_pg_404_ttl', array(
        'label'    => __('404 Page Title', 'plumbing-handyman'),
        'section'  => '404_pg_options',
        'settings' => 'plumbing_handyman_pg_404_ttl',
    ));

    $wp_customize->add_setting('plumbing_handyman_pg_404_text', array(
        'default' => __( 'Apologies, but the page you are seeking cannot be found.', 'plumbing-handyman' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('plumbing_handyman_pg_404_text', array(
        'label'    => __('404 Page Text', 'plumbing-handyman'),
        'section'  => '404_pg_options',
        'settings' => 'plumbing_handyman_pg_404_text',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('plumbing_handyman_pg_404_btn_lbl', array(
        'default' => __( 'Go Back Home', 'plumbing-handyman' ),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('plumbing_handyman_pg_404_btn_lbl', array(
        'label'    => __('404 Button Label', 'plumbing-handyman'),
        'section'  => '404_pg_options',
        'settings' => 'plumbing_handyman_pg_404_btn_lbl',
    ));

    $wp_customize->add_setting('plumbing_handyman_pg_404_btn_link', array(
        'default'           => esc_url(home_url('/')),
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('plumbing_handyman_pg_404_btn_link', array(
        'label'    => __('404 Button Link', 'plumbing-handyman'),
        'section'  => '404_pg_options',
        'settings' => 'plumbing_handyman_pg_404_btn_link',
    ));