<?php
/**
 * About Section
 *
 * @package plumbing_handyman
 */

$wp_customize->add_section(
	'plumbing_handyman_about_section',
	array(
		'panel'    => 'plumbing_handyman_front_page_options',
		'title'    => esc_html__( 'About Section', 'plumbing-handyman' ),
		'priority' => 10,
	)
);

// about Section - Enable Section.
$wp_customize->add_setting(
	'plumbing_handyman_enable_about_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_enable_about_section',
		array(
			'label'    => esc_html__( 'Enable About Section', 'plumbing-handyman' ),
			'section'  => 'plumbing_handyman_about_section',
			'settings' => 'plumbing_handyman_enable_about_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'plumbing_handyman_enable_about_section',
		array(
			'selector' => '#plumbing_handyman_about_section .section-link',
			'settings' => 'plumbing_handyman_enable_about_section',
		)
	);
}

// about Section - about Content
$wp_customize->add_setting(
	'plumbing_handyman_about_short_content',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_short_content',
	array(
		'label'           => sprintf( esc_html__( 'About Sub Heading', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_short_content',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - about Heading.
$wp_customize->add_setting(
	'plumbing_handyman_about_section_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_section_heading',
	array(
		'label'           => sprintf( esc_html__( 'About Heading', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_section_heading',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - about Content.
$wp_customize->add_setting(
	'plumbing_handyman_about_section_content',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_section_content',
	array(
		'label'           => sprintf( esc_html__( 'About Content', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_section_content',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - list text 1.
$wp_customize->add_setting(
	'plumbing_handyman_about_list_text_1',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_list_text_1',
	array(
		'label'           => sprintf( esc_html__( 'About List Text 1', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_list_text_1',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - list content 1.
$wp_customize->add_setting(
	'plumbing_handyman_about_list_content_1',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_list_content_1',
	array(
		'label'           => sprintf( esc_html__( 'About List Content 1', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_list_content_1',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - list text 2.
$wp_customize->add_setting(
	'plumbing_handyman_about_list_text_2',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_list_text_2',
	array(
		'label'           => sprintf( esc_html__( 'About List Text 2', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_list_text_2',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - list content 2.
$wp_customize->add_setting(
	'plumbing_handyman_about_list_content_2',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_list_content_2',
	array(
		'label'           => sprintf( esc_html__( 'About List Content 2', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_list_content_2',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - list text 3.
$wp_customize->add_setting(
	'plumbing_handyman_about_list_text_3',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_list_text_3',
	array(
		'label'           => sprintf( esc_html__( 'About List Text 3', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_list_text_3',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - list content 3.
$wp_customize->add_setting(
	'plumbing_handyman_about_list_content_3',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_list_content_3',
	array(
		'label'           => sprintf( esc_html__( 'About List Content 3', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_list_content_3',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - Button Label.
$wp_customize->add_setting(
	'plumbing_handyman_about_button_label_',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_button_label_',
	array(
		'label'           => sprintf( esc_html__( 'Button Label 1', 'plumbing-handyman' )),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_button_label_',
		'type'            => 'text',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

// about Section - Button Link.
$wp_customize->add_setting(
	'plumbing_handyman_about_button_link_' ,
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_button_link_' ,
	array(
		'label'           => sprintf( esc_html__( 'Button Link 1', 'plumbing-handyman' )  ),
		'section'         => 'plumbing_handyman_about_section',
		'settings'        => 'plumbing_handyman_about_button_link_' ,
		'type'            => 'url',
		'active_callback' => 'plumbing_handyman_is_about_section_enabled',
	)
);

//About image
$wp_customize->add_setting('plumbing_handyman_about_section_image',
	array(
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize,'plumbing_handyman_about_section_image',
		array(
			'label' => __('About Image','plumbing-handyman'),
			'section' => 'plumbing_handyman_about_section',
			'settings' => 'plumbing_handyman_about_section_image',
			'active_callback' => 'plumbing_handyman_is_about_section_enabled',
		)
	)
);

//Review content
$wp_customize->add_setting('plumbing_handyman_image_content', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('plumbing_handyman_image_content', array(
	'label'    => __('Review Content', 'plumbing-handyman'),
	'section'  => 'plumbing_handyman_about_section',
	'type'     => 'text',
	'active_callback' => 'plumbing_handyman_is_about_section_enabled',
));

//Review image
$wp_customize->add_setting('plumbing_handyman_team_image_1',
	array(
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize,'plumbing_handyman_team_image_1',
		array(
			'label' => __('Review Image 1','plumbing-handyman'),
			'section' => 'plumbing_handyman_about_section',
			'settings' => 'plumbing_handyman_team_image_1',
			'active_callback' => 'plumbing_handyman_is_about_section_enabled',
		)
	)
);

//Review text
$wp_customize->add_setting('plumbing_handyman_image_text', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('plumbing_handyman_image_text', array(
	'label'    => __('Review Title', 'plumbing-handyman'),
	'section'  => 'plumbing_handyman_about_section',
	'type'     => 'text',
	'active_callback' => 'plumbing_handyman_is_about_section_enabled',
));

//Review sub text
$wp_customize->add_setting('plumbing_handyman_image_sub_text', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_control('plumbing_handyman_image_sub_text', array(
	'label'    => __('Review Sub Title', 'plumbing-handyman'),
	'section'  => 'plumbing_handyman_about_section',
	'type'     => 'text',
	'active_callback' => 'plumbing_handyman_is_about_section_enabled',
));

$wp_customize->add_setting( 
	'plumbing_handyman_about_settings_upgraded_features',
	array(
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'plumbing_handyman_about_settings_upgraded_features', 
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
		'section' => 'plumbing_handyman_about_section'
	)
);