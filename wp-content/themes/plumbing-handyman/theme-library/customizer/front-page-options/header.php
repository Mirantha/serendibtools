<?php
/**
 * Header Section Settings
 *
 * @package plumbing_handyman
 */


// ---------------------------------------- HEADER OPTIONS ----------------------------------------------------

$wp_customize->add_section(
	'plumbing_handyman_header_options',
	array(
		'panel' => 'plumbing_handyman_front_page_options',
		'title' => esc_html__( 'Header Options', 'plumbing-handyman' ),
        'priority' => 1,
	)
);


// Add setting for sticky header
$wp_customize->add_setting(
	'plumbing_handyman_enable_sticky_header',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
		'default'           => false,
	)
);

// Add control for sticky header setting
$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_sticky_header',
		array(
			'label'   => esc_html__( 'Enable Sticky Header', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_header_options',
		)
	)
);

// Enable Slider Section
$wp_customize->add_setting(
	'plumbing_handyman_enable_topbar',
	array(
		'default'           => false,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_topbar',
		array(
			'label'    => esc_html__( 'Enable Topbar', 'plumbing-handyman' ),
			'section'  => 'plumbing_handyman_header_options',
			'settings' => 'plumbing_handyman_enable_topbar',
		)
	)
);

// Contact Section - Phone Icon.
$wp_customize->add_setting(
    'plumbing_handyman_header_phone_icon',
    array(
        'default' => 'fas fa-phone-volume', // Set default icon here
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Plumbing_Handyman_Change_Icon_Control(
    $wp_customize, 
    'plumbing_handyman_header_phone_icon',
    array(
        'label'    => __('Phone Icon','plumbing-handyman'),
        'section'  => 'plumbing_handyman_header_options',
        'iconset'  => 'fa',
    )
));

// Contact Section - Phone Number.
$wp_customize->add_setting(
	'plumbing_handyman_phone_number',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_phone_number',
	array(
		'label'           => esc_html__( 'Phone Number', 'plumbing-handyman' ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_phone_number',
		'type'            => 'text',
	)
);

// Topbar Section - Topbar Mail icon.
$wp_customize->add_setting(
    'plumbing_handyman_email_icon',
    array(
        'default' => 'fas fa-envelope', // Set default icon here
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Plumbing_Handyman_Change_Icon_Control(
    $wp_customize, 
    'plumbing_handyman_email_icon',
    array(
        'label'    => __('Topbar Email Icon','plumbing-handyman'),
        'section'  => 'plumbing_handyman_header_options',
        'iconset'  => 'fa',
    )
));

// Topbar Section - Topbar Email Label.
$wp_customize->add_setting(
	'plumbing_handyman_email_topbar_address',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_email_topbar_address',
	array(
		'label'           => esc_html__( 'Topbar Email', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_email_topbar_address',
		'type'            => 'text',
	)
);

// Topbar Section - location icon.
$wp_customize->add_setting(
    'plumbing_handyman_location_header_icon',
    array(
        'default' => 'fas fa-map-marker-alt', 
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Plumbing_Handyman_Change_Icon_Control(
    $wp_customize, 
    'plumbing_handyman_location_header_icon',
    array(
        'label'    => __('Topbar Location Icon','plumbing-handyman'),
        'section'  => 'plumbing_handyman_header_options',
        'iconset'  => 'fa',
    )
));

// Topbar Section - Topbar Location.
$wp_customize->add_setting(
	'plumbing_handyman_header_location',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_header_location',
	array(
		'label'           => esc_html__( 'Topbar Location', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_header_location',
		'type'            => 'text',
	)
);
// Header Options - Enable Social Icons.
$wp_customize->add_setting(
	'plumbing_handyman_enable_header_icon_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_header_icon_section',
		array(
			'label'    => esc_html__( 'Enable Social', 'plumbing-handyman' ),
			'section'  => 'plumbing_handyman_header_options',
			'settings' => 'plumbing_handyman_enable_header_icon_section',
		)
	)
);

// Add setting for Facebook Link
$wp_customize->add_setting(
	'plumbing_handyman_header_facebook_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_header_facebook_link',
	array(
		'label'           => esc_html__( 'Facebook Link', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_header_facebook_link',
		'type'      => 'url'
	)
);

// Add setting for Twitter Link
$wp_customize->add_setting(
	'plumbing_handyman_header_twitter_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_header_twitter_link',
	array(
		'label'           => esc_html__( 'Twitter Link', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_header_twitter_link',
		'type'      => 'url'
	)
);

// Add setting for Instagram Link
$wp_customize->add_setting(
	'plumbing_handyman_header_instagram_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_header_instagram_link',
	array(
		'label'           => esc_html__( 'Instagram Link', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_header_instagram_link',
		'type'      => 'url'
	)
);

// Add setting for Pinterest Link
$wp_customize->add_setting(
	'plumbing_handyman_header_pinterest_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_header_pinterest_link',
	array(
		'label'           => esc_html__( 'Pinterest Link', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_header_pinterest_link',
		'type'      => 'url'
	)
);

// Header Section - Button Label.
$wp_customize->add_setting(
	'plumbing_handyman_topheader_button_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_topheader_button_text',
	array(
		'label'           => esc_html__( 'Button Label', 'plumbing-handyman'  ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_topheader_button_text',
		'type'            => 'text',
	)
);

// Header Section - Button Link.
$wp_customize->add_setting(
	'plumbing_handyman_topheader_button_url',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_topheader_button_url',
	array(
		'label'           => esc_html__( 'Button Link', 'plumbing-handyman' ),
		'section'         => 'plumbing_handyman_header_options',
		'settings'        => 'plumbing_handyman_topheader_button_url',
		'type'            => 'url',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_menu_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_menu_separator', array(
	'label' => __( 'Menu Settings', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_header_options',
	'settings' => 'plumbing_handyman_menu_separator',
)));

$wp_customize->add_setting( 'plumbing_handyman_menu_font_size', array(
    'default'           => 15,
    'sanitize_callback' => 'absint',
));

// Add control for site title size
$wp_customize->add_control( 'plumbing_handyman_menu_font_size', array(
    'type'        => 'number',
    'section'     => 'plumbing_handyman_header_options',
    'label'       => __( 'Menu Font Size ', 'plumbing-handyman' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));

// Add setting for menu font weight
$wp_customize->add_setting('plumbing_handyman_menu_font_weight', array(
    'default'           => '500',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add control for menu font weight
$wp_customize->add_control('plumbing_handyman_menu_font_weight', array(
    'type'     => 'select',
    'section'  => 'plumbing_handyman_header_options', 
    'label'    => __('Menu Font Weight', 'plumbing-handyman'),
    'choices'  => array(
		'100' => __('100','plumbing-handyman'),
		'200' => __('200','plumbing-handyman'),
		'300' => __('300','plumbing-handyman'),
		'400' => __('400','plumbing-handyman'),
		'500' => __('500','plumbing-handyman'),
		'600' => __('600','plumbing-handyman'),
		'700' => __('700','plumbing-handyman'),
		'800' => __('800','plumbing-handyman'),
		'900' => __('900','plumbing-handyman'),
    ),
));

$wp_customize->add_setting( 'plumbing_handyman_menu_text_transform', array(
    'default'           => 'capitalize', // Default value for text transform
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for menu text transform
$wp_customize->add_control( 'plumbing_handyman_menu_text_transform', array(
    'type'     => 'select',
    'section'  => 'plumbing_handyman_header_options', // Adjust the section as needed
    'label'    => __( 'Menu Text Transform', 'plumbing-handyman' ),
    'choices'  => array(
        'none'       => __( 'None', 'plumbing-handyman' ),
        'capitalize' => __( 'Capitalize', 'plumbing-handyman' ),
        'uppercase'  => __( 'Uppercase', 'plumbing-handyman' ),
        'lowercase'  => __( 'Lowercase', 'plumbing-handyman' ),
    ),
) );

// Menu Text Color 
$wp_customize->add_setting(
	'plumbing_handyman_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'plumbing_handyman_menu_text_color', 
		array(
			'label' => __('Menu Color', 'plumbing-handyman'),
			'section' => 'plumbing_handyman_header_options',
		)
	)
);

// Sub Menu Text Color 
$wp_customize->add_setting(
	'plumbing_handyman_sub_menu_text_color', 
	array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize, 
		'plumbing_handyman_sub_menu_text_color', 
		array(
			'label' => __('Sub Menu Color', 'plumbing-handyman'),
			'section' => 'plumbing_handyman_header_options',
		)
	)
);

// Topbar Padding Setting
$wp_customize->add_setting('plumbing_handyman_topbar_padding',array(
		'default' => '',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control('plumbing_handyman_topbar_padding',array(
		'label' => __('Topbar Padding','plumbing-handyman'),
		'section' => 'plumbing_handyman_header_options',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1
		)
	)
);

$wp_customize->add_setting( 
	'plumbing_handyman_header_settings_upgraded_features',
	array(
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'plumbing_handyman_header_settings_upgraded_features', 
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
		'section' => 'plumbing_handyman_header_options'
	)
);