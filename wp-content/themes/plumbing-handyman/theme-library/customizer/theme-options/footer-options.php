<?php
/**
 * Footer Options
 *
 * @package plumbing_handyman
 */

$wp_customize->add_section(
	'plumbing_handyman_footer_options',
	array(
		'panel' => 'plumbing_handyman_theme_options',
		'title' => esc_html__( 'Footer Options', 'plumbing-handyman' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_footer_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_footer_separators', array(
	'label' => __( 'Footer Settings', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_footer_options',
	'settings' => 'plumbing_handyman_footer_separators',
)));

// Footer Section - Enable Section.
$wp_customize->add_setting(
	'plumbing_handyman_enable_footer_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_footer_section',
		array(
			'label'    => esc_html__( 'Show / Hide Footer', 'plumbing-handyman' ),
			'section'  => 'plumbing_handyman_footer_options',
			'settings' => 'plumbing_handyman_enable_footer_section',
		)
	)
);

// column // 
$wp_customize->add_setting(
	'plumbing_handyman_footer_widget_column',
	array(
        'default'			=> '4',
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'plumbing_handyman_sanitize_select',
		
	)
);	

$wp_customize->add_control(
	'plumbing_handyman_footer_widget_column',
	array(
	    'label'   		=> __('Select Widget Column','plumbing-handyman'),
		'description' => __('Note: Default footer widgets are shown. Add your preferred widgets in (Appearance > Widgets > Footer) to see changes.', 'plumbing-handyman'),
	    'section' 		=> 'plumbing_handyman_footer_options',
		'type'			=> 'select',
		'choices'        => 
		array(
			'' => __( 'None', 'plumbing-handyman' ),
			'1' => __( '1 Column', 'plumbing-handyman' ),
			'2' => __( '2 Column', 'plumbing-handyman' ),
			'3' => __( '3 Column', 'plumbing-handyman' ),
			'4' => __( '4 Column', 'plumbing-handyman' )
		) 
	) 
);

//  BG Color // 
$wp_customize->add_setting('footer_background_color_setting', array(
    'default' => '#000',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_background_color_setting', array(
    'label' => __('Footer Background Color', 'plumbing-handyman'),
    'section' => 'plumbing_handyman_footer_options',
)));

// Footer Background Image Setting
$wp_customize->add_setting('footer_background_image_setting', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_background_image_setting', array(
    'label' => __('Footer Background Image', 'plumbing-handyman'),
    'section' => 'plumbing_handyman_footer_options',
)));

// Footer Background Attachment
$wp_customize->add_setting(
	'plumbing_handyman_footer_image_attachment_setting',
	array(
		'default'=> 'scroll',
		'sanitize_callback' => 'plumbing_handyman_sanitize_choices'
	)
);

$wp_customize->add_control(
	'plumbing_handyman_footer_image_attachment_setting',
	array(
		'type' => 'select',
		'label' => __('Footer Background Attatchment','plumbing-handyman'),
		'choices' => array(
			'fixed' => __('fixed','plumbing-handyman'),
			'scroll' => __('scroll','plumbing-handyman'),
		),
		'section'=> 'plumbing_handyman_footer_options',
  	)
);

//Footer Image Position
$wp_customize->add_setting(
	'plumbing_handyman_footer_img_position_setting',
	array(
        'default'			=> 'center center',
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'plumbing_handyman_sanitize_choices',
		
	)
);	

$wp_customize->add_control(
	'plumbing_handyman_footer_img_position_setting',
	array(
		'label'   		=> __('Footer Image Position','plumbing-handyman'),
	    'section' 		=> 'plumbing_handyman_footer_options',
		'type'			=> 'select',
		'choices'       => 
		array(
			'center center'   => __( 'Center', 'plumbing-handyman' ),
			'center top'   	  => __( 'Top', 'plumbing-handyman' ),
			'center bottom'   => __( 'Bottom', 'plumbing-handyman' ),
		) 
	) 
);

$wp_customize->add_setting('footer_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add Footer Text Transform Control
$wp_customize->add_control('footer_text_transform', array(
    'label' => __('Footer Heading Text Transform', 'plumbing-handyman'),
    'section' => 'plumbing_handyman_footer_options',
    'settings' => 'footer_text_transform',
    'type' => 'select',
    'choices' => array(
        'none' => __('None', 'plumbing-handyman'),
        'capitalize' => __('Capitalize', 'plumbing-handyman'),
        'uppercase' => __('Uppercase', 'plumbing-handyman'),
        'lowercase' => __('Lowercase', 'plumbing-handyman'),
    ),
));

// Footer Heading Alignment
$wp_customize->add_setting(
	'plumbing_handyman_footer_header_align',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'plumbing_handyman_footer_header_align',
	array(
		'label' => __('Footer Heading Alignment ','plumbing-handyman'),
		'section' => 'plumbing_handyman_footer_options',
		'type'			=> 'select',
		'choices' => 
		array(
			'left' => __('Left','plumbing-handyman'),
			'right' => __('Right','plumbing-handyman'),
			'center' => __('Center','plumbing-handyman'),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_copyright_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_copyright_separators', array(
	'label' => __( 'Copyright Settings', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_footer_options',
	'settings' => 'plumbing_handyman_copyright_separators',
)));

// Copyright Section - Enable Section.
$wp_customize->add_setting(
	'plumbing_handyman_enable_copyright_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_copyright_section',
		array(
			'label'    => esc_html__( 'Show / Hide Copyright', 'plumbing-handyman' ),
			'section'  => 'plumbing_handyman_footer_options',
			'settings' => 'plumbing_handyman_enable_copyright_section',
		)
	)
);

$wp_customize->add_setting(
	'plumbing_handyman_footer_copyright_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_footer_copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'plumbing-handyman' ),
		'section'  => 'plumbing_handyman_footer_options',
		'settings' => 'plumbing_handyman_footer_copyright_text',
		'type'     => 'textarea',
	)
);

//Copyright Alignment
$wp_customize->add_setting(
	'plumbing_handyman_footer_bottom_align',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'plumbing_handyman_footer_bottom_align',
	array(
		'label' => __('Copyright Alignment ','plumbing-handyman'),
		'section' => 'plumbing_handyman_footer_options',
		'type'			=> 'select',
		'choices' => 
		array(
			'left' => __('Left','plumbing-handyman'),
			'right' => __('Right','plumbing-handyman'),
			'center' => __('Center','plumbing-handyman'),
		),
	)
);

//Copyright Font Size
$wp_customize->add_setting( 
	'plumbing_handyman_copyright_font_size', 
	array(
		'default'           => 16,
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control( 'plumbing_handyman_copyright_font_size', 
	array(
		'type'        => 'number',
		'section'     => 'plumbing_handyman_footer_options',
		'label'       => __( 'copyright Font Size ', 'plumbing-handyman' ),
		'input_attrs' => 
		array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'plumbing_handyman_scroll_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Plumbing_Handyman_Separator_Custom_Control( $wp_customize, 'plumbing_handyman_scroll_separators', array(
	'label' => __( 'Scroll Top Settings', 'plumbing-handyman' ),
	'section' => 'plumbing_handyman_footer_options',
	'settings' => 'plumbing_handyman_scroll_separators',
)));

// Footer Options - Scroll Top.
$wp_customize->add_setting(
	'plumbing_handyman_scroll_top',
	array(
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_scroll_top',
		array(
			'label'   => esc_html__( 'Enable Scroll Top Button', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_footer_options',
		)
	)
);
// icon // 
$wp_customize->add_setting(
	'plumbing_handyman_scroll_btn_icon',
	array(
        'default' => 'fas fa-chevron-up',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Plumbing_Handyman_Change_Icon_Control($wp_customize, 
	'plumbing_handyman_scroll_btn_icon',
	array(
	    'label'   		=> __('Scroll Top Icon','plumbing-handyman'),
	    'section' 		=> 'plumbing_handyman_footer_options',
		'iconset' => 'fa',
	))  
);


$wp_customize->add_setting( 'plumbing_handyman_scroll_top_position', array(
    'default'           => 'bottom-right',
    'sanitize_callback' => 'plumbing_handyman_sanitize_scroll_top_position',
) );

// Add control for Scroll Top Button Position
$wp_customize->add_control( 'plumbing_handyman_scroll_top_position', array(
    'label'    => __( 'Scroll Top Button Position', 'plumbing-handyman' ),
    'section'  => 'plumbing_handyman_footer_options',
    'settings' => 'plumbing_handyman_scroll_top_position',
    'type'     => 'select',
    'choices'  => array(
        'bottom-right' => __( 'Bottom Right', 'plumbing-handyman' ),
        'bottom-left'  => __( 'Bottom Left', 'plumbing-handyman' ),
        'bottom-center'=> __( 'Bottom Center', 'plumbing-handyman' ),
    ),
) );

$wp_customize->add_setting( 'plumbing_handyman_scroll_top_shape', array(
    'default'           => 'box',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'plumbing_handyman_scroll_top_shape', array(
    'label'    => __( 'Scroll to Top Button Shape', 'plumbing-handyman' ),
    'section'  => 'plumbing_handyman_footer_options',
    'settings' => 'plumbing_handyman_scroll_top_shape',
    'type'     => 'radio',
    'choices'  => array(
        'box'        => __( 'Box', 'plumbing-handyman' ),
        'curved-box' => __( 'Curved Box', 'plumbing-handyman' ),
        'circle'     => __( 'Circle', 'plumbing-handyman' ),
    ),
) );