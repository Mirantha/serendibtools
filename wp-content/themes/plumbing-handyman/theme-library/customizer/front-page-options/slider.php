<?php
/**
 * Slider Section Settings
 *
 * @package plumbing_handyman
 */

// Add Slider Section
$wp_customize->add_section(
	'plumbing_handyman_slider_section',
	array(
		'panel'    => 'plumbing_handyman_front_page_options',
		'title'    => esc_html__( 'Slider Section', 'plumbing-handyman' ),
		'priority' => 10,
	)
);

// Enable Slider Section
$wp_customize->add_setting(
	'plumbing_handyman_enable_slider_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_slider_section',
		array(
			'label'    => esc_html__( 'Enable Slider Section', 'plumbing-handyman' ),
			'section'  => 'plumbing_handyman_slider_section',
			'settings' => 'plumbing_handyman_enable_slider_section',
		)
	)
);

//  Heading Label.
$wp_customize->add_setting(
	'plumbing_handyman_slider_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_slider_heading',
	array(
		'label'           => esc_html__( 'Slider Sub Heading', 'plumbing-handyman' ),
		'section'         => 'plumbing_handyman_slider_section',
		'settings'        => 'plumbing_handyman_slider_heading',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_slider_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_slider_separators', array(
	'label' => __( 'Select Slider Category', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_slider_section',
	'settings' => 'plumbing_handyman_slider_separators',
	'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
)));

// Slider Category Setting
$wp_customize->add_setting(
	'plumbing_handyman_slider_slider_category',
	array(
		'default'           => 'slider',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Customize_Category_Dropdown_Control(
		$wp_customize,
		'plumbing_handyman_slider_slider_category',
		array(
			'label'    => __( 'Select Slider Category', 'plumbing-handyman' ),
			'section'  => 'plumbing_handyman_slider_section',
			'settings' => 'plumbing_handyman_slider_slider_category',
			'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
		)
	)
);

// Button Label
$wp_customize->add_setting(
	'plumbing_handyman_slider_button_label',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_slider_button_label',
	array(
		'label'           => esc_html__( 'Button Label', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_slider_section',
		'settings'        => 'plumbing_handyman_slider_button_label',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
	)
);

// Button Link
$wp_customize->add_setting(
	'plumbing_handyman_slider_button_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_slider_button_link',
	array(
		'label'           => esc_html__( 'Button Link', 'plumbing-handyman' ),
		'section'         => 'plumbing_handyman_slider_section',
		'settings'        => 'plumbing_handyman_slider_button_link',
		'type'            => 'url',
		'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
	)
);

//Image 1
$wp_customize->add_setting('plumbing_handyman_slider_image', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'plumbing_handyman_slider_image', array(
    'label' => __('Slider Image', 'plumbing-handyman'),
    'section' => 'plumbing_handyman_slider_section',
	'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
)));

// Section Text
$wp_customize->add_setting('plumbing_handyman_one_word_heading', 
	array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('plumbing_handyman_one_word_heading', 
	array(
	'label'       => __('Slider Word', 'plumbing-handyman'),
	'section'     => 'plumbing_handyman_slider_section',   
	'settings'    => 'plumbing_handyman_one_word_heading',
	'type'            => 'text',
	'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
	)
);

// Slider Button Label Color
$wp_customize->add_setting('plumbing_handyman_slider_btn_color',array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'plumbing_handyman_slider_btn_color',array(
			'label'           => __('Slider Button Label Color', 'plumbing-handyman'),
			'section'         => 'plumbing_handyman_slider_section',
			'settings'        => 'plumbing_handyman_slider_btn_color',
			'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
		)
	)
);
// Slider Button Background Color
$wp_customize->add_setting('plumbing_handyman_slider_btn_bg_color',array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'plumbing_handyman_slider_btn_bg_color',array(
			'label'           => __('Slider Button Background Color', 'plumbing-handyman'),
			'section'         => 'plumbing_handyman_slider_section',
			'settings'        => 'plumbing_handyman_slider_btn_bg_color',
			'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
		)
	)
);

// Slider Button Border Color
$wp_customize->add_setting('plumbing_handyman_slider_btn_border_color',array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'plumbing_handyman_slider_btn_border_color',array(
            'label'           => __('Slider Button Border Color', 'plumbing-handyman'),
            'section'         => 'plumbing_handyman_slider_section',
            'settings'        => 'plumbing_handyman_slider_btn_border_color',
            'active_callback' => 'plumbing_handyman_is_slider_section_enabled',
        )
    )
);

$wp_customize->add_setting( 
	'plumbing_handyman_slider_settings_upgraded_features',
	array(
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'plumbing_handyman_slider_settings_upgraded_features', 
	array(
		'type'=> 'hidden',
		'description' => "
			<div class='customizer-upgraded-features'>
				<i class='fas fa-info-circle'></i>
				<span class='pro-text'>
					Unlock Premium <strong>Features</strong> ?<br>
					<a target='_blank' href='". esc_url(PLUMBING_HANDYMAN_PREMIUM_PAGE) ." '>Upgrade Pro</a>
				</div>
			</div>
		",
		'section' => 'plumbing_handyman_slider_section'
	)
);
