<?php
/**
 * Industrial Lite Theme Customizer
 *
 * @package Industrial Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function industrial_lite_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'industrial_lite_custom_controls' );

function industrial_lite_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'industrial_lite_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'industrial_lite_customize_partial_blogdescription',  
	));

	//add home page setting pannel
	$IndustrialLiteParentPanel = new Industrial_Lite_WP_Customize_Panel( $wp_customize, 'industrial_lite_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'industrial-lite' ),
		'priority' => 10,
	));

	$wp_customize->add_panel( $IndustrialLiteParentPanel );

	$HomePageParentPanel = new Industrial_Lite_WP_Customize_Panel( $wp_customize, 'industrial_lite_homepage_panel', array(
		'title' => __( 'Homepage Settings', 'industrial-lite' ),
		'panel' => 'industrial_lite_panel_id',
	));

	$wp_customize->add_panel( $HomePageParentPanel );

	//Top Bar
	$wp_customize->add_section( 'industrial_lite_topbar', array(
    	'title'      => __( 'Top Bar Settings', 'industrial-lite' ),
		'panel' => 'industrial_lite_homepage_panel'
	) );

   	// Header Background color
	$wp_customize->add_setting('industrial_lite_header_background_color', array(
		'default'           => '#f7c02e',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_header_background_color', array(
		'label'    => __('Header Background Color', 'industrial-lite'),
		'section'  => 'header_image',
	)));

	$wp_customize->add_setting('industrial_lite_header_img_position',array(
	  'default' => 'center top',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_header_img_position',array(
		'type' => 'select',
		'label' => __('Header Image Position','industrial-lite'),
		'section' => 'header_image',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'industrial-lite' ),
			'center top'   => esc_html__( 'Top', 'industrial-lite' ),
			'right top'   => esc_html__( 'Top Right', 'industrial-lite' ),
			'left center'   => esc_html__( 'Left', 'industrial-lite' ),
			'center center'   => esc_html__( 'Center', 'industrial-lite' ),
			'right center'   => esc_html__( 'Right', 'industrial-lite' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'industrial-lite' ),
			'center bottom'   => esc_html__( 'Bottom', 'industrial-lite' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'industrial-lite' ),
		),
	));

	$wp_customize->add_setting( 'industrial_lite_topbar_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_topbar_hide_show',
       array(
      'label' => esc_html__( 'Show / Hide Topbar','industrial-lite' ),
      'section' => 'industrial_lite_topbar'
    )));

    $wp_customize->add_setting('industrial_lite_topbar_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_topbar_padding_top_bottom',array(
		'label'	=> __('Topbar Padding Top Bottom','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'text'
	));

    //Sticky Header
	$wp_customize->add_setting( 'industrial_lite_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_sticky_header',array(
        'label' => esc_html__( 'Show / Hide Sticky Header','industrial-lite' ),
        'section' => 'industrial_lite_topbar'
    )));

    $wp_customize->add_setting('industrial_lite_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_header_search',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_header_search',array(
      	'label' => esc_html__( 'Show / Hide Search','industrial-lite' ),
      	'section' => 'industrial_lite_topbar'
    )));

    $wp_customize->add_setting('industrial_lite_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_search_icon',array(
		'label'	=> __('Add Search Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_topbar',
		'setting'	=> 'industrial_lite_search_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('industrial_lite_search_close_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_search_close_icon',array(
		'label'	=> __('Add Search Close Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_topbar',
		'setting'	=> 'industrial_lite_search_close_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('industrial_lite_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_search_font_size',array(
		'label'	=> __('Search Font Size','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'text'
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('industrial_lite_location', array( 
		'selector' => '.top-bar span', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_location', 
	));

    $wp_customize->add_setting('industrial_lite_location_icon',array(
		'default'	=> 'fas fa-map-marker-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_location_icon',array(
		'label'	=> __('Add Location Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_topbar',
		'setting'	=> 'industrial_lite_location_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('industrial_lite_location',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_location',array(
		'label'	=> __('Add Location','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '123 lorem ipsum is a dummy text, USA', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_phone_icon',array(
		'label'	=> __('Add Phone Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_topbar',
		'setting'	=> 'industrial_lite_phone_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('industrial_lite_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'industrial_lite_sanitize_phone_number'
	));
	$wp_customize->add_control('industrial_lite_phone_number',array(
		'label'	=> __('Add Phone Number','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '+00 1234 567 890', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_email_address_icon',array(
		'default'	=> 'fas fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_email_address_icon',array(
		'label'	=> __('Add Email Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_topbar',
		'setting'	=> 'industrial_lite_email_address_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('industrial_lite_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));
	$wp_customize->add_control('industrial_lite_email_address',array(
		'label'	=> __('Add Email Address','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'example@gmail.com', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_top_btn_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('industrial_lite_top_btn_url',array(
		'label'	=> __('Add Button URL','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'https://example.com/', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'url'
	));

	$wp_customize->add_setting('industrial_lite_top_btn_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_top_btn_text',array(
		'label'	=> __('Add Button Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'GET A QUOTE', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_topbar',
		'type'=> 'text'
	));

	//Menus Settings
	$wp_customize->add_section( 'industrial_lite_menu_section' , array(
    	'title' => __( 'Menus Settings', 'industrial-lite' ),
		'panel' => 'industrial_lite_homepage_panel'
	) );

	$wp_customize->add_setting('industrial_lite_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_menu_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_navigation_menu_font_weight',array(
        'default' => 700,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','industrial-lite'),
        'section' => 'industrial_lite_menu_section',
        'choices' => array(
        	'100' => __('100','industrial-lite'),
            '200' => __('200','industrial-lite'),
            '300' => __('300','industrial-lite'),
            '400' => __('400','industrial-lite'),
            '500' => __('500','industrial-lite'),
            '600' => __('600','industrial-lite'),
            '700' => __('700','industrial-lite'),
            '800' => __('800','industrial-lite'),
            '900' => __('900','industrial-lite'),
        ),
	) );

	// text trasform
	$wp_customize->add_setting('industrial_lite_menu_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_menu_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Menus Text Transform','industrial-lite'),
		'choices' => array(
            'Uppercase' => __('Uppercase','industrial-lite'),
            'Capitalize' => __('Capitalize','industrial-lite'),
            'Lowercase' => __('Lowercase','industrial-lite'),
        ),
		'section'=> 'industrial_lite_menu_section',
	));

	$wp_customize->add_setting('industrial_lite_menus_item_style',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_menus_item_style',array(
        'type' => 'select',
        'section' => 'industrial_lite_menu_section',
		'label' => __('Menu Item Hover Style','industrial-lite'),
		'choices' => array(
            'None' => __('None','industrial-lite'),
            'Zoom In' => __('Zoom In','industrial-lite'),
        ),
	) );

	$wp_customize->add_setting('industrial_lite_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_header_menus_color', array(
		'label'    => __('Menus Color', 'industrial-lite'),
		'section'  => 'industrial_lite_menu_section',
	)));

	$wp_customize->add_setting('industrial_lite_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'industrial-lite'),
		'section'  => 'industrial_lite_menu_section',
	)));

	$wp_customize->add_setting('industrial_lite_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'industrial-lite'),
		'section'  => 'industrial_lite_menu_section',
	)));

	$wp_customize->add_setting('industrial_lite_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'industrial-lite'),
		'section'  => 'industrial_lite_menu_section',
	)));

	//Social links
	$wp_customize->add_section(
		'industrial_lite_social_links', array(
			'title'		=>	__('Social Links', 'industrial-lite'),
			'priority'	=>	null,
			'panel'		=>	'industrial_lite_homepage_panel'
		));

	$wp_customize->add_setting('industrial_lite_social_icons',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_social_icons',array(
		'label' =>  __('Steps to setup social icons','industrial-lite'),
		'description' => __('<p>1. Go to Dashboard >> Appearance >> Widgets</p>
			<p>2. Add Vw Social Icon Widget in Social Media.</p>
			<p>3. Add social icons url and save.</p>','industrial-lite'),
		'section'=> 'industrial_lite_social_links',
		'type'=> 'hidden'
	));
	$wp_customize->add_setting('industrial_lite_social_icon_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_social_icon_btn',array(
		'description' => "<a target='_blank' href='". admin_url('widgets.php') ." '>Setup Social Icons</a>",
		'section'=> 'industrial_lite_social_links',
		'type'=> 'hidden'
	));

	//Slider
	$wp_customize->add_section( 'industrial_lite_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'industrial-lite' ),
    	'description' => __('Free theme has 3 slides options, For unlimited slides and more options <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/industrial-wordpress-theme">GET PRO</a>','industrial-lite'),
		'panel' => 'industrial_lite_homepage_panel'
	) );

	$wp_customize->add_setting( 'industrial_lite_slider_arrows',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','industrial-lite' ),
      	'section' => 'industrial_lite_slidersettings'
    )));

    $wp_customize->add_setting('industrial_lite_slider_type',array(
        'default' => 'Default slider',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	) );
	$wp_customize->add_control('industrial_lite_slider_type', array(
        'type' => 'select',
        'label' => __('Slider Type','industrial-lite'),
        'section' => 'industrial_lite_slidersettings',
        'choices' => array(
            'Default slider' => __('Default slider','industrial-lite'),
            'Advance slider' => __('Advance slider','industrial-lite'),
        ),
	));

	$wp_customize->add_setting('industrial_lite_advance_slider_shortcode',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_advance_slider_shortcode',array(
		'label'	=> __('Add Slider Shortcode','industrial-lite'),
		'section'=> 'industrial_lite_slidersettings',
		'type'=> 'text',
		'active_callback' => 'industrial_lite_advance_slider'
	));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('industrial_lite_slider_arrows',array(
		'selector'        => '#slider .inner_carousel h1',
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_slider_arrows',
	));

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'industrial_lite_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'industrial_lite_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'industrial_lite_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'industrial-lite' ),
			'description' => __('Slider image size (1600 x 900)','industrial-lite'),
			'section'  => 'industrial_lite_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'industrial_lite_default_slider'
		) );
	}

	$wp_customize->add_setting('industrial_lite_slider_button_text',array(
		'default'=> 'Read More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_slidersettings',
		'type'=> 'text',
		'active_callback' => 'industrial_lite_default_slider'
	));

	$wp_customize->add_setting('industrial_lite_slider_button_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('industrial_lite_slider_button_link',array(
		'label'	=> esc_html__('Add Button Link','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'www.example-info.com', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_slidersettings',
		'type'=> 'url'
	));

	//content layout
	$wp_customize->add_setting('industrial_lite_slider_content_option',array(
        'default' => 'Left',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Industrial_Lite_Image_Radio_Control($wp_customize, 'industrial_lite_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','industrial-lite'),
        'section' => 'industrial_lite_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/slider-content3.png',
    ),'active_callback' => 'industrial_lite_default_slider'
    )));

    //Slider content padding
    $wp_customize->add_setting('industrial_lite_slider_content_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_slider_content_padding_top_bottom',array(
		'label'	=> __('Slider Content Padding Top Bottom','industrial-lite'),
		'description'	=> __('Enter a value in %. Example:20%','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_slidersettings',
		'type'=> 'text',
		'active_callback' => 'industrial_lite_default_slider'
	));

	$wp_customize->add_setting('industrial_lite_slider_content_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_slider_content_padding_left_right',array(
		'label'	=> __('Slider Content Padding Left Right','industrial-lite'),
		'description'	=> __('Enter a value in %. Example:20%','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '50%', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_slidersettings',
		'type'=> 'text',
		'active_callback' => 'industrial_lite_default_slider'
	));

    //Slider excerpt
	$wp_customize->add_setting( 'industrial_lite_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','industrial-lite' ),
		'section'     => 'industrial_lite_slidersettings',
		'type'        => 'range',
		'settings'    => 'industrial_lite_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),'active_callback' => 'industrial_lite_default_slider'
	) );

	//Slider height
	$wp_customize->add_setting('industrial_lite_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_slider_height',array(
		'label'	=> __('Slider Height','industrial-lite'),
		'description'	=> __('Specify the slider height (px).','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_slidersettings',
		'type'=> 'text',
		'active_callback' => 'industrial_lite_default_slider'
	));

	$wp_customize->add_setting( 'industrial_lite_slider_speed', array(
		'default'  => 4000,
		'sanitize_callback'	=> 'industrial_lite_sanitize_float'
	) );
	$wp_customize->add_control( 'industrial_lite_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','industrial-lite'),
		'section' => 'industrial_lite_slidersettings',
		'type'  => 'number',
		'active_callback' => 'industrial_lite_default_slider'
	) );

	//Opacity
	$wp_customize->add_setting('industrial_lite_slider_opacity_color',array(
      'default'              =>'',
      'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));

	$wp_customize->add_control( 'industrial_lite_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','industrial-lite' ),
	'section'     => 'industrial_lite_slidersettings',
	'type'        => 'select',
	'settings'    => 'industrial_lite_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr(__('0','industrial-lite')),
      '0.1' =>  esc_attr(__('0.1','industrial-lite')),
      '0.2' =>  esc_attr(__('0.2','industrial-lite')),
      '0.3' =>  esc_attr(__('0.3','industrial-lite')),
      '0.4' =>  esc_attr(__('0.4','industrial-lite')),
      '0.5' =>  esc_attr(__('0.5','industrial-lite')),
      '0.6' =>  esc_attr(__('0.6','industrial-lite')),
      '0.7' =>  esc_attr(__('0.7','industrial-lite')),
      '0.8' =>  esc_attr(__('0.8','industrial-lite')),
      '0.9' =>  esc_attr(__('0.9','industrial-lite'))
	),'active_callback' => 'industrial_lite_default_slider'
	));

	$wp_customize->add_setting( 'industrial_lite_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_slider_image_overlay',array(
      	'label' => esc_html__( 'Slider Image Overlay','industrial-lite' ),
      	'section' => 'industrial_lite_slidersettings',
      	'active_callback' => 'industrial_lite_default_slider'
    )));

    $wp_customize->add_setting('industrial_lite_slider_image_overlay_color', array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'industrial-lite'),
		'section'  => 'industrial_lite_slidersettings',
		'active_callback' => 'industrial_lite_default_slider'
	)));

	//About Us Section
	$wp_customize->add_section('industrial_lite_about', array(
		'title'       => __('About Us Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_about_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_about_text',array(
		'description' => __('<p>1. More options for about us section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for about us section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_about',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_about_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_about_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_about',
		'type'=> 'hidden'
	));

	//Partners Section
	$wp_customize->add_section('industrial_lite_partners', array(
		'title'       => __('Partners Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_partners_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_partners_text',array(
		'description' => __('<p>1. More options for partners section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for partners section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_partners',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_partners_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_partners_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_partners',
		'type'=> 'hidden'
	));
 
	//Our Services section
	$wp_customize->add_section( 'industrial_lite_services_section' , array(
    	'title'      => __( 'Services Settings', 'industrial-lite' ),
    	'description' => __('For more options of the services section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/industrial-wordpress-theme">GET PRO</a>','industrial-lite'),
		'priority'   => null,
		'panel' => 'industrial_lite_homepage_panel'
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'industrial_lite_section_title', array( 
		'selector' => '#serv-section h2', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_section_title',
	));

	$wp_customize->add_setting('industrial_lite_services_title_icon',array(
		'default'	=> 'fas fa-industry',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_services_title_icon',array(
		'label'	=> __('Add Title Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_services_section',
		'setting'	=> 'industrial_lite_services_title_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('industrial_lite_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_section_title',array(
		'label'	=> __('Add Section Title','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'SERVICES WE PROVIDE', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_services_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_section_small_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_section_small_title',array(
		'label'	=> __('Add Section Small Title','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'OUR SERVICES', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_services_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('industrial_lite_our_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'industrial_lite_sanitize_choices',
	));
	$wp_customize->add_control('industrial_lite_our_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Services','industrial-lite'),
		'description' => __('Image Size (370 x 270)','industrial-lite'),
		'section' => 'industrial_lite_services_section',
	));

	//Services excerpt
	$wp_customize->add_setting( 'industrial_lite_services_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_services_excerpt_number', array(
		'label'       => esc_html__( 'Services Excerpt length','industrial-lite' ),
		'section'     => 'industrial_lite_services_section',
		'type'        => 'range',
		'settings'    => 'industrial_lite_services_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Projects Section
	$wp_customize->add_section('industrial_lite_projects', array(
		'title'       => __('Projects Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_projects_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_projects_text',array(
		'description' => __('<p>1. More options for projects section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for projects section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_projects',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_projects_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_projects_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_projects',
		'type'=> 'hidden'
	));

	//Team Section
	$wp_customize->add_section('industrial_lite_team', array(
		'title'       => __('Team Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_team_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_team_text',array(
		'description' => __('<p>1. More options for team section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for team section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_team',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_team_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_team_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_team',
		'type'=> 'hidden'
	));

	//Testimonial Section
	$wp_customize->add_section('industrial_lite_testimonial', array(
		'title'       => __('Testimonial Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_testimonial_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_testimonial_text',array(
		'description' => __('<p>1. More options for testimonial section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for testimonial section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_testimonial',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_testimonial_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_testimonial_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_testimonial',
		'type'=> 'hidden'
	));

	//Blogs Section
	$wp_customize->add_section('industrial_lite_blogs', array(
		'title'       => __('Blogs Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_blogs_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_blogs_text',array(
		'description' => __('<p>1. More options for blogs section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for blogs section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_blogs',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_blogs_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_blogs_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_blogs',
		'type'=> 'hidden'
	));

	//Choose Us Section
	$wp_customize->add_section('industrial_lite_choose_us', array(
		'title'       => __('Choose Us Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_choose_us_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_choose_us_text',array(
		'description' => __('<p>1. More options for choose us section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for choose us section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_choose_us',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_choose_us_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_choose_us_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_choose_us',
		'type'=> 'hidden'
	));

	//Faq Section
	$wp_customize->add_section('industrial_lite_faq', array(
		'title'       => __('Faq Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_faq_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_faq_text',array(
		'description' => __('<p>1. More options for faq section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for faq section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_faq',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_faq_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_faq_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_faq',
		'type'=> 'hidden'
	));

	//Home Contact Section
	$wp_customize->add_section('industrial_lite_home_contact', array(
		'title'       => __('Home Contact Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_home_contact_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_home_contact_text',array(
		'description' => __('<p>1. More options for home contact section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for home contact section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_home_contact',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_home_contact_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_home_contact_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_home_contact',
		'type'=> 'hidden'
	));

	//our shop Section
	$wp_customize->add_section('industrial_lite_our_shop', array(
		'title'       => __('Our Shop Section', 'industrial-lite'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','industrial-lite'),
		'priority'    => null,
		'panel'       => 'industrial_lite_homepage_panel',
	));

	$wp_customize->add_setting('industrial_lite_our_shop_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_our_shop_text',array(
		'description' => __('<p>1. More options for our shop section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for our shop section.</p>','industrial-lite'),
		'section'=> 'industrial_lite_our_shop',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('industrial_lite_our_shop_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_our_shop_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(INDUSTRIAL_LITE_BUY_NOW).">More Info</a>",
		'section'=> 'industrial_lite_our_shop',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('industrial_lite_footer',array(
		'title'	=> __('Footer Settings','industrial-lite'),
		'description' => __('For more options of the footer section <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/industrial-wordpress-theme">GET PRO</a>','industrial-lite'),
		'panel' => 'industrial_lite_homepage_panel',
	));	

	$wp_customize->add_setting( 'industrial_lite_footer_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_footer_hide_show',array(
      'label' => esc_html__( 'Show / Hide Footer','industrial-lite' ),
      'section' => 'industrial_lite_footer'
    )));

 	// font size
	$wp_customize->add_setting('industrial_lite_button_footer_font_size',array(
		'default'=> 30,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_button_footer_font_size',array(
		'label'	=> __('Footer Heading Font Size','industrial-lite'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'industrial_lite_footer',
	));

	$wp_customize->add_setting('industrial_lite_button_footer_heading_letter_spacing',array(
		'default'=> 1,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_button_footer_heading_letter_spacing',array(
		'label'	=> __('Heading Letter Spacing','industrial-lite'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
	),
		'section'=> 'industrial_lite_footer',
	));

	// text trasform
	$wp_customize->add_setting('industrial_lite_button_footer_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_button_footer_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Heading Text Transform','industrial-lite'),
		'choices' => array(
      'Uppercase' => __('Uppercase','industrial-lite'),
      'Capitalize' => __('Capitalize','industrial-lite'),
      'Lowercase' => __('Lowercase','industrial-lite'),
    ),
		'section'=> 'industrial_lite_footer',
	));

	$wp_customize->add_setting('industrial_lite_footer_heading_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_footer_heading_weight',array(
        'type' => 'select',
        'label' => __('Heading Font Weight','industrial-lite'),
        'section' => 'industrial_lite_footer',
        'choices' => array(
        	'100' => __('100','industrial-lite'),
            '200' => __('200','industrial-lite'),
            '300' => __('300','industrial-lite'),
            '400' => __('400','industrial-lite'),
            '500' => __('500','industrial-lite'),
            '600' => __('600','industrial-lite'),
            '700' => __('700','industrial-lite'),
            '800' => __('800','industrial-lite'),
            '900' => __('900','industrial-lite'),
        ),
	) );
	
	$wp_customize->add_setting('industrial_lite_footer_template',array(
	  'default'	=> esc_html('industrial_lite-footer-one'),
	  'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_footer_template',array(
	      'label'	=> esc_html__('Footer style','industrial-lite'),
	      'section'	=> 'industrial_lite_footer',
	      'setting'	=> 'industrial_lite_footer_template',
	      'type' => 'select',
	      'choices' => array(
	          'industrial_lite-footer-one' => esc_html__('Style 1', 'industrial-lite'),
	          'industrial_lite-footer-two' => esc_html__('Style 2', 'industrial-lite'),
	          'industrial_lite-footer-three' => esc_html__('Style 3', 'industrial-lite'),
	          'industrial_lite-footer-four' => esc_html__('Style 4', 'industrial-lite'),
	          'industrial_lite-footer-five' => esc_html__('Style 5', 'industrial-lite'),
	          )
	));

	$wp_customize->add_setting('industrial_lite_footer_background_color', array(
		'default'           => '#002e5b',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_footer_background_color', array(
		'label'    => __('Footer Background Color', 'industrial-lite'),
		'section'  => 'industrial_lite_footer',
	)));

	$wp_customize->add_setting('industrial_lite_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'industrial_lite_footer_background_image',array(
        'label' => __('Footer Background Image','industrial-lite'),
        'section' => 'industrial_lite_footer'
	)));

	$wp_customize->add_setting('industrial_lite_footer_img_position',array(
	  'default' => 'center center',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','industrial-lite'),
		'section' => 'industrial_lite_footer',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'industrial-lite' ),
			'center top'   => esc_html__( 'Top', 'industrial-lite' ),
			'right top'   => esc_html__( 'Top Right', 'industrial-lite' ),
			'left center'   => esc_html__( 'Left', 'industrial-lite' ),
			'center center'   => esc_html__( 'Center', 'industrial-lite' ),
			'right center'   => esc_html__( 'Right', 'industrial-lite' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'industrial-lite' ),
			'center bottom'   => esc_html__( 'Bottom', 'industrial-lite' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'industrial-lite' ),
		),
	));

	// Footer
	$wp_customize->add_setting('industrial_lite_img_footer',array(
		'default'=> 'scroll',
		'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_img_footer',array(
		'type' => 'select',
		'label'	=> __('Footer Background Attatchment','industrial-lite'),
		'choices' => array(
            'fixed' => __('fixed','industrial-lite'),
            'scroll' => __('scroll','industrial-lite'),
        ),
		'section'=> 'industrial_lite_footer',
	));

	$wp_customize->add_setting('industrial_lite_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','industrial-lite'),
        'section' => 'industrial_lite_footer',
        'choices' => array(
        	'Left' => __('Left','industrial-lite'),
            'Center' => __('Center','industrial-lite'),
            'Right' => __('Right','industrial-lite')
        ),
	) );

	$wp_customize->add_setting('industrial_lite_footer_widgets_content',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_footer_widgets_content',array(
        'type' => 'select',
        'label' => __('Footer Widget Content','industrial-lite'),
        'section' => 'industrial_lite_footer',
        'choices' => array(
        	'Left' => __('Left','industrial-lite'),
            'Center' => __('Center','industrial-lite'),
            'Right' => __('Right','industrial-lite')
        ),
	) );

	// footer padding
	$wp_customize->add_setting('industrial_lite_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_footer_padding',array(
		'label'	=> __('Footer Top Bottom Padding','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'industrial-lite' ),
    ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));

	// footer social icon
  	$wp_customize->add_setting( 'industrial_lite_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_footer_icon',array(
		'label' => esc_html__( 'Footer Social Icon','industrial-lite' ),
		'section' => 'industrial_lite_footer'
    )));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('industrial_lite_footer_text', array( 
		'selector' => '#footer-2 .copyright p', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_footer_text', 
	));

	$wp_customize->add_setting( 'industrial_lite_copyright_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_copyright_hide_show',array(
      'label' => esc_html__( 'Show / Hide Copyright','industrial-lite' ),
      'section' => 'industrial_lite_footer'
    )));

	$wp_customize->add_setting('industrial_lite_copyright_background_color', array(
		'default'           => '#f7c02e',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'industrial-lite'),
		'section'  => 'industrial_lite_footer',
	)));
	
	$wp_customize->add_setting('industrial_lite_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('industrial_lite_footer_text',array(
		'label'	=> __('Copyright Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('industrial_lite_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_copyright_font_size',array(
		'label'	=> __('Copyright Font Size','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Industrial_Lite_Image_Radio_Control($wp_customize, 'industrial_lite_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','industrial-lite'),
        'section' => 'industrial_lite_footer',
        'settings' => 'industrial_lite_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

    $wp_customize->add_setting('industrial_lite_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','industrial-lite' ),
      	'section' => 'industrial_lite_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('industrial_lite_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('industrial_lite_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_footer',
		'setting'	=> 'industrial_lite_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('industrial_lite_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_scroll_to_top_width',array(
		'label'	=> __('Icon Width','industrial-lite'),
		'description'	=> __('Enter a value in pixels Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_scroll_to_top_height',array(
		'label'	=> __('Icon Height','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('industrial_lite_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Industrial_Lite_Image_Radio_Control($wp_customize, 'industrial_lite_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','industrial-lite'),
        'section' => 'industrial_lite_footer',
        'settings' => 'industrial_lite_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

    // footer social icon
	$wp_customize->add_setting( 'industrial_lite_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
  	) );
	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_footer_icon',array(
		'label' => esc_html__( 'Show / Hide Footer Social Icon','industrial-lite' ),
		'section' => 'industrial_lite_footer'
  	)));

    $wp_customize->add_setting('industrial_lite_align_footer_social_icon',array(
        'default' => 'center',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_align_footer_social_icon',array(
        'type' => 'select',
        'label' => __('Social Icon Alignment ','industrial-lite'),
        'section' => 'industrial_lite_footer',
        'choices' => array(
            'left' => __('Left','industrial-lite'),
            'right' => __('Right','industrial-lite'),
            'center' => __('Center','industrial-lite'),
        ),
	) );

	$wp_customize->add_setting( 'industrial_lite_copyright_sticky',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_copyright_sticky',array(
      'label' => esc_html__( 'Show / Hide Sticky Copyright','industrial-lite' ),
      'section' => 'industrial_lite_footer'
    )));

   $wp_customize->add_setting('industrial_lite_footer_social_icons_font_size',array(
       'default'=> 16,
       'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('industrial_lite_footer_social_icons_font_size',array(
    'label' => __('Social Icon Font Size','industrial-lite'),
    	'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'industrial_lite_footer',
	 ));

    //Blog Post
	$wp_customize->add_panel( $IndustrialLiteParentPanel );

	$BlogPostParentPanel = new Industrial_Lite_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'industrial-lite' ),
		'panel' => 'industrial_lite_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'industrial_lite_post_settings', array(
		'title' => __( 'Post Settings', 'industrial-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Blog layout
    $wp_customize->add_setting('industrial_lite_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
    ));
    $wp_customize->add_control(new Industrial_Lite_Image_Radio_Control($wp_customize, 'industrial_lite_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','industrial-lite'),
        'section' => 'industrial_lite_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
    ))));

	$wp_customize->add_setting('industrial_lite_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','industrial-lite'),
        'description' => __('Here you can change the sidebar layout for posts. ','industrial-lite'),
        'section' => 'industrial_lite_post_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','industrial-lite'),
            'Right Sidebar' => __('Right Sidebar','industrial-lite'),
            'One Column' => __('One Column','industrial-lite'),
            'Three Columns' => __('Three Columns','industrial-lite'),
            'Four Columns' => __('Four Columns','industrial-lite'),
            'Grid Layout' => __('Grid Layout','industrial-lite')
        ),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('industrial_lite_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_toggle_postdate', 
	));

  	$wp_customize->add_setting('industrial_lite_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_post_settings',
		'setting'	=> 'industrial_lite_toggle_postdate_icon',
		'type'		=> 'icon'
	))); 

	$wp_customize->add_setting( 'industrial_lite_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_toggle_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','industrial-lite' ),
        'section' => 'industrial_lite_post_settings'
    )));

    $wp_customize->add_setting('industrial_lite_toggle_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_post_settings',
		'setting'	=> 'industrial_lite_toggle_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'industrial_lite_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','industrial-lite' ),
		'section' => 'industrial_lite_post_settings'
    )));

    $wp_customize->add_setting('industrial_lite_toggle_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_post_settings',
		'setting'	=> 'industrial_lite_toggle_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'industrial_lite_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','industrial-lite' ),
		'section' => 'industrial_lite_post_settings'
    )));

    $wp_customize->add_setting('industrial_lite_toggle_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_post_settings',
		'setting'	=> 'industrial_lite_toggle_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'industrial_lite_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','industrial-lite' ),
		'section' => 'industrial_lite_post_settings'
    )));

    $wp_customize->add_setting( 'industrial_lite_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
	));
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_featured_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','industrial-lite' ),
		'section' => 'industrial_lite_post_settings'
    )));

    $wp_customize->add_setting( 'industrial_lite_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'industrial_lite_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','industrial-lite' ),
		'section'     => 'industrial_lite_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Featured Image
	$wp_customize->add_setting('industrial_lite_blog_post_featured_image_dimension',array(
       'default' => 'default',
       'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
	));
  	$wp_customize->add_control('industrial_lite_blog_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Blog Post Featured Image Dimension','industrial-lite'),
		'section'	=> 'industrial_lite_post_settings',
		'choices' => array(
		'default' => __('Default','industrial-lite'),
		'custom' => __('Custom Image Size','industrial-lite'),
      ),
  	));

	$wp_customize->add_setting('industrial_lite_blog_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('industrial_lite_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'industrial-lite' ),),
		'section'=> 'industrial_lite_post_settings',
		'type'=> 'text',
		'active_callback' => 'industrial_lite_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('industrial_lite_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'industrial-lite' ),),
		'section'=> 'industrial_lite_post_settings',
		'type'=> 'text',
		'active_callback' => 'industrial_lite_blog_post_featured_image_dimension'
	));

    $wp_customize->add_setting( 'industrial_lite_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','industrial-lite' ),
		'section'     => 'industrial_lite_post_settings',
		'type'        => 'range',
		'settings'    => 'industrial_lite_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('industrial_lite_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','industrial-lite'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','industrial-lite'),
		'section'=> 'industrial_lite_post_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('industrial_lite_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog posts','industrial-lite'),
        'section' => 'industrial_lite_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','industrial-lite'),
            'Without Blocks' => __('Without Blocks','industrial-lite')
        ),
	) );

    $wp_customize->add_setting('industrial_lite_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','industrial-lite'),
        'section' => 'industrial_lite_post_settings',
        'choices' => array(
        	'Content' => __('Content','industrial-lite'),
            'Excerpt' => __('Excerpt','industrial-lite'),
            'No Content' => __('No Content','industrial-lite')
        ),
	) );

	$wp_customize->add_setting('industrial_lite_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','industrial-lite' ),
      'section' => 'industrial_lite_post_settings'
    )));

	$wp_customize->add_setting( 'industrial_lite_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
    ));
    $wp_customize->add_control( 'industrial_lite_blog_pagination_type', array(
        'section' => 'industrial_lite_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'industrial-lite' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'industrial-lite' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'industrial-lite' ),
    )));

	$wp_customize->add_setting('industrial_lite_show_first_caps', array(
	    'default'           => false,
	    'transport'         => 'refresh',
	    'sanitize_callback' => 'industrial_lite_switch_sanitization',
	));

	$wp_customize->add_control(new Industrial_lite_Toggle_Switch_Custom_Control(
	    $wp_customize,
	    'industrial_lite_show_first_caps',
	    array(
	        'label'   => esc_html__('First Cap (First Capital Letter)', 'industrial-lite'),
	        'section' => 'industrial_lite_post_settings',
	    )
	));

    // Button Settings
	$wp_customize->add_section( 'industrial_lite_button_settings', array(
		'title' => __( 'Button Settings', 'industrial-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('industrial_lite_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_button_text', 
	));

	$wp_customize->add_setting('industrial_lite_button_text',array(
		'default'=> esc_html__( 'Read More', 'industrial-lite' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_button_text',array(
		'label'	=> __('Add Button Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_button_settings',
		'type'=> 'text'
	));

	// font size button
	$wp_customize->add_setting('industrial_lite_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_button_font_size',array(
		'label'	=> __('Button Font Size','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'industrial-lite' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'industrial_lite_button_settings',
	));

	$wp_customize->add_setting( 'industrial_lite_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('industrial_lite_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_button_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_button_letter_spacing',array(
		'label'	=> __('Button Letter Spacing','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'industrial-lite' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'industrial_lite_button_settings',
	));

	// text trasform
	$wp_customize->add_setting('industrial_lite_button_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','industrial-lite'),
		'choices' => array(
            'Uppercase' => __('Uppercase','industrial-lite'),
            'Capitalize' => __('Capitalize','industrial-lite'),
            'Lowercase' => __('Lowercase','industrial-lite'),
        ),
		'section'=> 'industrial_lite_button_settings',
	));

	// Related Post Settings
	$wp_customize->add_section( 'industrial_lite_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'industrial-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('industrial_lite_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_related_post_title', 
	));

    $wp_customize->add_setting( 'industrial_lite_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_related_post',array(
		'label' => esc_html__( 'Show / Hide Related Post','industrial-lite' ),
		'section' => 'industrial_lite_related_posts_settings'
    )));

    $wp_customize->add_setting('industrial_lite_related_post_title',array(
		'default'=> 'Related Post',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_related_post_title',array(
		'label'	=> __('Add Related Post Title','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('industrial_lite_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'industrial_lite_sanitize_float'
	));
	$wp_customize->add_control('industrial_lite_related_posts_count',array(
		'label'	=> __('Add Related Post Count','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'industrial_lite_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','industrial-lite' ),
		'section'     => 'industrial_lite_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'industrial_lite_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'industrial_lite_related_toggle_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'industrial_lite_switch_sanitization'
  	));
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_related_toggle_postdate',array(
	    'label' => esc_html__( 'Show / Hide Post Date','industrial-lite' ),
	    'section' => 'industrial_lite_related_posts_settings'
  	)));

  	$wp_customize->add_setting('industrial_lite_related_postdate_icon',array(
	    'default' => 'fas fa-calendar-alt',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
  	$wp_customize,'industrial_lite_related_postdate_icon',array(
	    'label' => __('Add Post Date Icon','industrial-lite'),
	    'transport' => 'refresh',
	    'section' => 'industrial_lite_related_posts_settings',
	    'setting' => 'industrial_lite_related_postdate_icon',
	    'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'industrial_lite_related_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
  	));
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_related_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','industrial-lite' ),
		'section' => 'industrial_lite_related_posts_settings'
  	)));

  	$wp_customize->add_setting('industrial_lite_related_author_icon',array(
	    'default' => 'fas fa-user',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
  	$wp_customize,'industrial_lite_related_author_icon',array(
	    'label' => __('Add Author Icon','industrial-lite'),
	    'transport' => 'refresh',
	    'section' => 'industrial_lite_related_posts_settings',
	    'setting' => 'industrial_lite_related_author_icon',
	    'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'industrial_lite_related_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
  	) );
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_related_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','industrial-lite' ),
		'section' => 'industrial_lite_related_posts_settings'
  	)));

  	$wp_customize->add_setting('industrial_lite_related_comments_icon',array(
	    'default' => 'fa fa-comments',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
  	$wp_customize,'industrial_lite_related_comments_icon',array(
	    'label' => __('Add Comments Icon','industrial-lite'),
	    'transport' => 'refresh',
	    'section' => 'industrial_lite_related_posts_settings',
	    'setting' => 'industrial_lite_related_comments_icon',
	    'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'industrial_lite_related_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
  	) );
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_related_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','industrial-lite' ),
		'section' => 'industrial_lite_related_posts_settings'
  	)));

  	$wp_customize->add_setting('industrial_lite_related_time_icon',array(
	    'default' => 'fas fa-clock',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
  	$wp_customize,'industrial_lite_related_time_icon',array(
	    'label' => __('Add Time Icon','industrial-lite'),
	    'transport' => 'refresh',
	    'section' => 'industrial_lite_related_posts_settings',
	    'setting' => 'industrial_lite_related_time_icon',
	    'type'    => 'icon'
  	)));

  	$wp_customize->add_setting('industrial_lite_related_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_related_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','industrial-lite'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','industrial-lite'),
		'section'=> 'industrial_lite_related_posts_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_related_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
	));
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_related_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','industrial-lite' ),
		'section' => 'industrial_lite_related_posts_settings'
 	)));

  	$wp_customize->add_setting( 'industrial_lite_related_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_related_image_box_shadow', array(
		'label'       => esc_html__( 'Related post Image Box Shadow','industrial-lite' ),
		'section'     => 'industrial_lite_related_posts_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

  	$wp_customize->add_setting('industrial_lite_related_button_text',array(
		'default'=> esc_html__('Read More','industrial-lite'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_related_button_text',array(
		'label'	=> esc_html__('Add Button Text','industrial-lite'),
		'input_attrs' => array(
      'placeholder' => esc_html__( 'Read More', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_related_posts_settings',
		'type'=> 'text'
	));


	// Single Posts Settings
	$wp_customize->add_section( 'industrial_lite_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'industrial-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

  	$wp_customize->add_setting('industrial_lite_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_single_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_single_blog_settings',
		'setting'	=> 'industrial_lite_single_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'industrial_lite_single_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'industrial_lite_switch_sanitization'
	) );
	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_postdate',array(
	    'label' => esc_html__( 'Show / Hide Date','industrial-lite' ),
	   'section' => 'industrial_lite_single_blog_settings'
	)));

	$wp_customize->add_setting('industrial_lite_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_single_author_icon',array(
		'label'	=> __('Add Author Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_single_blog_settings',
		'setting'	=> 'industrial_lite_single_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'industrial_lite_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'industrial_lite_switch_sanitization'
	) );
	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_author',array(
	    'label' => esc_html__( 'Show / Hide Author','industrial-lite' ),
	    'section' => 'industrial_lite_single_blog_settings'
	)));

   	$wp_customize->add_setting('industrial_lite_single_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_single_comments_icon',array(
		'label'	=> __('Add Comments Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_single_blog_settings',
		'setting'	=> 'industrial_lite_single_comments_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'industrial_lite_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'industrial_lite_switch_sanitization'
	) );
	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_comments',array(
	    'label' => esc_html__( 'Show / Hide Comments','industrial-lite' ),
	    'section' => 'industrial_lite_single_blog_settings'
	)));

  	$wp_customize->add_setting('industrial_lite_single_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_single_time_icon',array(
		'label'	=> __('Add Time Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_single_blog_settings',
		'setting'	=> 'industrial_lite_single_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'industrial_lite_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'industrial_lite_switch_sanitization'
	) );
	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_time',array(
	    'label' => esc_html__( 'Show / Hide Time','industrial-lite' ),
	    'section' => 'industrial_lite_single_blog_settings'
	)));

	$wp_customize->add_setting( 'industrial_lite_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_post_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Post Breadcrumb','industrial-lite' ),
		'section' => 'industrial_lite_single_blog_settings'
    )));

   	// Single Posts Category
  	$wp_customize->add_setting( 'industrial_lite_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_post_category',array(
		'label' => esc_html__( 'Show / Hide Post Category','industrial-lite' ),
		'section' => 'industrial_lite_single_blog_settings'
    )));

    $wp_customize->add_setting( 'industrial_lite_singlepost_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_singlepost_image_box_shadow', array(
		'label'       => esc_html__( 'Single post Image Box Shadow','industrial-lite' ),
		'section'     => 'industrial_lite_single_blog_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('industrial_lite_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','industrial-lite'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','industrial-lite'),
		'section'=> 'industrial_lite_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_toggle_tags',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
	));
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_toggle_tags', array(
		'label' => esc_html__( 'Show / Hide Tags','industrial-lite' ),
		'section' => 'industrial_lite_single_blog_settings'
    )));

	$wp_customize->add_setting( 'industrial_lite_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
	));
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Show / Hide Post Navigation','industrial-lite' ),
		'section' => 'industrial_lite_single_blog_settings'
    )));

	// Featured Image Hover Effect
	$wp_customize->add_setting(
		'industrial_lite_featured_image_hover',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'industrial_lite_featured_image_hover',
		array(
			'label'   => __( 'Featured Image Hover Effect', 'industrial-lite' ),
			'section' => 'industrial_lite_single_blog_settings',
			'type'    => 'select',
			'choices' => array(
				'none'      => __( 'None', 'industrial-lite' ),
				'zoom-in'   => __( 'Zoom In', 'industrial-lite' ),
				'zoom-out'  => __( 'Zoom Out', 'industrial-lite' ),
				'scale'     => __( 'Scale', 'industrial-lite' ),
				'grayscale' => __( 'Grayscale', 'industrial-lite' ),
				'blur'      => __( 'Blur', 'industrial-lite' ),
				'bright'    => __( 'Bright', 'industrial-lite' ),
				'sepia'     => __( 'Sepia', 'industrial-lite' ),
				'translate' => __( 'Translate', 'industrial-lite' ),
			),
		)
	);

	//navigation text
	$wp_customize->add_setting('industrial_lite_single_blog_prev_navigation_text',array(
		'default'=> 'PREVIOUS',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_single_blog_next_navigation_text',array(
		'default'=> 'NEXT',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_single_blog_comment_title',array(
		'default'=> 'Leave a Reply',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('industrial_lite_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_single_blog_comment_button_text',array(
		'default'=> 'Post Comment',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('industrial_lite_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_single_blog_comment_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_single_blog_comment_width',array(
		'label'	=> __('Comment Form Width','industrial-lite'),
		'description'	=> __('Enter a value in %. Example:50%','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '100%', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_single_blog_settings',
		'type'=> 'text'
	));

	// Grid layout setting
	$wp_customize->add_section( 'industrial_lite_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'industrial-lite' ),
		'panel' => 'blog_post_parent_panel',
	));

  	$wp_customize->add_setting('industrial_lite_grid_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_grid_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_grid_layout_settings',
		'setting'	=> 'industrial_lite_grid_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'industrial_lite_grid_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_grid_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','industrial-lite' ),
        'section' => 'industrial_lite_grid_layout_settings'
    )));

	$wp_customize->add_setting('industrial_lite_grid_author_icon',array(
		'default'	=> 'far fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_grid_author_icon',array(
		'label'	=> __('Add Author Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_grid_layout_settings',
		'setting'	=> 'industrial_lite_grid_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'industrial_lite_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_grid_author',array(
		'label' => esc_html__( 'Show / Hide Author','industrial-lite' ),
		'section' => 'industrial_lite_grid_layout_settings'
    )));

   	$wp_customize->add_setting('industrial_lite_grid_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_grid_comments_icon',array(
		'label'	=> __('Add Comments Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_grid_layout_settings',
		'setting'	=> 'industrial_lite_grid_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'industrial_lite_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_grid_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','industrial-lite' ),
		'section' => 'industrial_lite_grid_layout_settings'
    )));

	$wp_customize->add_setting('industrial_lite_grid_button_text',array(
		'default'=> esc_html__('Read More','industrial-lite'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_grid_button_text',array(
		'label'	=> esc_html__('Add Button Text','industrial-lite'),
		'input_attrs' => array(
        'placeholder' => esc_html__( 'Read More', 'industrial-lite' ),
      ),
		'section'=> 'industrial_lite_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_grid_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_grid_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_grid_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
	));
  	$wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_grid_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','industrial-lite' ),
		'section' => 'industrial_lite_grid_layout_settings'
  	)));

 	$wp_customize->add_setting('industrial_lite_grid_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_grid_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','industrial-lite'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','industrial-lite'),
		'section'=> 'industrial_lite_grid_layout_settings',
		'type'=> 'text'
	));  

  	$wp_customize->add_setting('industrial_lite_display_grid_posts_settings',array(
	    'default' => 'Into Blocks',
	    'transport' => 'refresh',
	    'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_display_grid_posts_settings',array(
	    'type' => 'select',
	    'label' => __('Display Grid Posts','industrial-lite'),
	    'section' => 'industrial_lite_grid_layout_settings',
	    'choices' => array(
	    	'Into Blocks' => __('Into Blocks','industrial-lite'),
	      	'Without Blocks' => __('Without Blocks','industrial-lite')
	    ),
	) );

	$wp_customize->add_setting( 'industrial_lite_grid_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_grid_featured_image_border_radius', array(
		'label'       => esc_html__( 'Grid Featured Image Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'industrial_lite_grid_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_grid_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Grid Featured Image Box Shadow','industrial-lite' ),
		'section'     => 'industrial_lite_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

   	// other settings
	$OtherParentPanel = new Industrial_Lite_WP_Customize_Panel( $wp_customize, 'industrial_lite_other_panel_id', array(
		'title' => __( 'Others Settings', 'industrial-lite' ),
		'panel' => 'industrial_lite_panel_id',
	));

	$wp_customize->add_panel( $OtherParentPanel );

	// Layout
	$wp_customize->add_section( 'industrial_lite_left_right', array(
    	'title'      => esc_html__( 'General Settings', 'industrial-lite' ),
		'panel' => 'industrial_lite_other_panel_id'
	) );

	$wp_customize->add_setting('industrial_lite_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control(new Industrial_Lite_Image_Radio_Control($wp_customize, 'industrial_lite_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','industrial-lite'),
        'description' => __('Here you can change the width layout of Website.','industrial-lite'),
        'section' => 'industrial_lite_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('industrial_lite_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','industrial-lite'),
        'description' => __('Here you can change the sidebar layout for pages. ','industrial-lite'),
        'section' => 'industrial_lite_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','industrial-lite'),
            'Right Sidebar' => __('Right Sidebar','industrial-lite'),
            'One Column' => __('One Column','industrial-lite')
        ),
	) );

	$wp_customize->add_setting( 'industrial_lite_single_page_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_single_page_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Page Breadcrumb','industrial-lite' ),
		'section' => 'industrial_lite_left_right'
    )));

	// Progress Bar
	$wp_customize->add_setting( 'industrial_lite_progress_bar', array(
		'default'           => 0, 
		'transport'         => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization',
	));

	$wp_customize->add_control(
		new Industrial_Lite_Toggle_Switch_Custom_Control(
			$wp_customize,
			'industrial_lite_progress_bar',
			array(
				'label'   => esc_html__( 'Show / Hide Progress Bar', 'industrial-lite' ),
				'section' => 'industrial_lite_left_right',
			)
		)
	);

	//Wow Animation
	$wp_customize->add_setting( 'industrial_lite_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_animation',array(
        'label' => esc_html__( 'Show / Hide Animations','industrial-lite' ),
        'description' => __('Here you can disable overall site animation effect','industrial-lite'),
        'section' => 'industrial_lite_left_right'
    )));

    $wp_customize->add_setting('industrial_lite_reset_all_settings',array(
      'sanitize_callback'	=> 'sanitize_text_field',
   	));
   	$wp_customize->add_control(new Industrial_Lite_Reset_Custom_Control($wp_customize, 'industrial_lite_reset_all_settings',array(
      'type' => 'reset_control',
      'label' => __('Reset All Settings', 'industrial-lite'),
      'description' => 'industrial_lite_reset_all_settings',
      'section' => 'industrial_lite_left_right'
   	)));

	//Pre-Loader
	$wp_customize->add_setting( 'industrial_lite_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_loader_enable',array(
        'label' => esc_html__( 'Show / Hide Pre-Loader','industrial-lite' ),
        'section' => 'industrial_lite_left_right'
    )));

	$wp_customize->add_setting('industrial_lite_preloader_bg_color', array(
		'default'           => '#f7c02e',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'industrial-lite'),
		'section'  => 'industrial_lite_left_right',
	)));

	$wp_customize->add_setting('industrial_lite_preloader_border_color', array(
		'default'           => '#002e5b',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'industrial-lite'),
		'section'  => 'industrial_lite_left_right',
	)));

	$wp_customize->add_setting('industrial_lite_preloader_bg_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'industrial_lite_preloader_bg_img',array(
        'label' => __('Preloader Background Image','industrial-lite'),
        'section' => 'industrial_lite_left_right'
	)));

	$wp_customize->add_setting('industrial_lite_bradcrumbs_alignment',array(
        'default' => 'Left',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_bradcrumbs_alignment',array(
        'type' => 'select',
        'label' => __('Bradcrumbs Alignment','industrial-lite'),
        'section' => 'industrial_lite_left_right',
        'choices' => array(
            'Left' => __('Left','industrial-lite'),
            'Right' => __('Right','industrial-lite'),
            'Center' => __('Center','industrial-lite'),
        ),
	) );

	$wp_customize->add_setting( 'industrial_lite_sticky_sidebar',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_sticky_sidebar',array(
      'label' => esc_html__( 'Show / Hide Sticky Sidebar','industrial-lite' ),
      'section' => 'industrial_lite_left_right'
    )));

    //404 Page Setting
	$wp_customize->add_section('industrial_lite_404_page',array(
		'title'	=> __('404 Page Settings','industrial-lite'),
		'panel' => 'industrial_lite_other_panel_id',
	));	

	$wp_customize->add_setting('industrial_lite_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('industrial_lite_404_page_title',array(
		'label'	=> __('Add Title','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('industrial_lite_404_page_content',array(
		'label'	=> __('Add Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_404_page_button_text',array(
		'label'	=> __('Add Button Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Go Back', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('industrial_lite_no_results_page',array(
		'title'	=> __('No Results Page Settings','industrial-lite'),
		'panel' => 'industrial_lite_other_panel_id',
	));	

	$wp_customize->add_setting('industrial_lite_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('industrial_lite_no_results_page_title',array(
		'label'	=> __('Add Title','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('industrial_lite_no_results_page_content',array(
		'label'	=> __('Add Text','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('industrial_lite_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','industrial-lite'),
		'panel' => 'industrial_lite_other_panel_id',
	));	

	$wp_customize->add_setting('industrial_lite_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_social_icon_padding',array(
		'label'	=> __('Icon Padding','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_social_icon_width',array(
		'label'	=> __('Icon Width','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_social_icon_height',array(
		'label'	=> __('Icon Height','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('industrial_lite_responsive_media',array(
		'title'	=> __('Responsive Media','industrial-lite'),
		'panel' => 'industrial_lite_other_panel_id',
	));

	$wp_customize->add_setting( 'industrial_lite_resp_topbar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_resp_topbar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Topbar','industrial-lite' ),
      'section' => 'industrial_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'industrial_lite_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','industrial-lite' ),
      'section' => 'industrial_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'industrial_lite_resp_slider_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','industrial-lite' ),
      'section' => 'industrial_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'industrial_lite_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','industrial-lite' ),
      'section' => 'industrial_lite_responsive_media'
    )));

   	$wp_customize->add_setting( 'industrial_lite_responsive_preloader_hide',array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_responsive_preloader_hide',array(
        'label' => esc_html__( 'Show / Hide Preloader','industrial-lite' ),
        'section' => 'industrial_lite_responsive_media'
    )));

    $wp_customize->add_setting( 'industrial_lite_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ));  
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','industrial-lite' ),
      'section' => 'industrial_lite_responsive_media'
    )));

    $wp_customize->add_setting('industrial_lite_resp_menu_toggle_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'industrial_lite_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'industrial-lite'),
		'section'  => 'industrial_lite_responsive_media',
	)));

    $wp_customize->add_setting('industrial_lite_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_responsive_media',
		'setting'	=> 'industrial_lite_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('industrial_lite_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Industrial_Lite_Fontawesome_Icon_Chooser(
        $wp_customize,'industrial_lite_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','industrial-lite'),
		'transport' => 'refresh',
		'section'	=> 'industrial_lite_responsive_media',
		'setting'	=> 'industrial_lite_res_close_menus_icon',
		'type'		=> 'icon'
	)));

	

    //Woocommerce settings
	$wp_customize->add_section('industrial_lite_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'industrial-lite'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Shop Page Featured Image
	$wp_customize->add_setting( 'industrial_lite_shop_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_shop_featured_image_border_radius', array(
		'label'       => esc_html__( 'Shop Page Featured Image Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'industrial_lite_shop_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_shop_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Shop Page Featured Image Box Shadow','industrial-lite' ),
		'section'     => 'industrial_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'industrial_lite_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_woocommerce_shop_page_sidebar', ) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'industrial_lite_woocommerce_shop_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','industrial-lite' ),
		'section' => 'industrial_lite_woocommerce_section'
    )));

    $wp_customize->add_setting('industrial_lite_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','industrial-lite'),
        'section' => 'industrial_lite_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','industrial-lite'),
            'Right Sidebar' => __('Right Sidebar','industrial-lite'),
        ),
	) );

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'industrial_lite_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'industrial_lite_customize_partial_industrial_lite_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'industrial_lite_woocommerce_single_product_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','industrial-lite' ),
		'section' => 'industrial_lite_woocommerce_section'
    )));

    $wp_customize->add_setting('industrial_lite_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','industrial-lite'),
        'section' => 'industrial_lite_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','industrial-lite'),
            'Right Sidebar' => __('Right Sidebar','industrial-lite'),
        ),
	) );

    //Products per page
    $wp_customize->add_setting('industrial_lite_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'industrial_lite_sanitize_float'
	));
	$wp_customize->add_control('industrial_lite_products_per_page',array(
		'label'	=> __('Products Per Page','industrial-lite'),
		'description' => __('Display on shop page','industrial-lite'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('industrial_lite_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_products_per_row',array(
		'label'	=> __('Products Per Row','industrial-lite'),
		'description' => __('Display on shop page','industrial-lite'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('industrial_lite_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'industrial_lite_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','industrial-lite' ),
		'section'     => 'industrial_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'industrial_lite_products_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('industrial_lite_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_products_button_border_radius', array(
		'default'              => '5',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_products_button_border_radius', array(
		'label'       => esc_html__( 'Products Button Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products Sale Badge
	$wp_customize->add_setting('industrial_lite_woocommerce_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'industrial_lite_sanitize_choices'
	));
	$wp_customize->add_control('industrial_lite_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','industrial-lite'),
        'section' => 'industrial_lite_woocommerce_section',
        'choices' => array(
            'left' => __('Left','industrial-lite'),
            'right' => __('Right','industrial-lite'),
        ),
	) );

	$wp_customize->add_setting('industrial_lite_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_woocommerce_sale_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_woocommerce_sale_padding_top_bottom',array(
		'label'	=> __('Sale Padding Top Bottom','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('industrial_lite_woocommerce_sale_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('industrial_lite_woocommerce_sale_padding_left_right',array(
		'label'	=> __('Sale Padding Left Right','industrial-lite'),
		'description'	=> __('Enter a value in pixels. Example:20px','industrial-lite'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'industrial-lite' ),
        ),
		'section'=> 'industrial_lite_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'industrial_lite_woocommerce_sale_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'industrial_lite_sanitize_number_range'
	) );
	$wp_customize->add_control( 'industrial_lite_woocommerce_sale_border_radius', array(
		'label'       => esc_html__( 'Sale Border Radius','industrial-lite' ),
		'section'     => 'industrial_lite_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

  	// Related Product
    $wp_customize->add_setting( 'industrial_lite_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'industrial_lite_switch_sanitization'
    ) );
    $wp_customize->add_control( new Industrial_Lite_Toggle_Switch_Custom_Control( $wp_customize, 'industrial_lite_related_product_show_hide',array(
        'label' => esc_html__( 'Related product','industrial-lite' ),
        'section' => 'industrial_lite_woocommerce_section'
    )));

    // Has to be at the top
	$wp_customize->register_panel_type( 'Industrial_Lite_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'Industrial_Lite_WP_Customize_Section' );
}

add_action( 'customize_register', 'industrial_lite_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class Industrial_Lite_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'industrial_lite_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class Industrial_Lite_WP_Customize_Section extends WP_Customize_Section {	
	    public $section;
	    public $type = 'industrial_lite_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function industrial_lite_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'industrial_lite_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Industrial_Lite_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Industrial_Lite_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Industrial_Lite_Customize_Section_Pro( $manager,'industrial_lite_upgrade_pro_link', array(
			'priority'   => 1,
			'title'    => esc_html__( 'INDUSTRIAL PRO', 'industrial-lite' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'industrial-lite' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/products/industrial-wordpress-theme'),
		) )	);

		$manager->add_section(new Industrial_Lite_Customize_Section_Pro($manager,'industrial_lite_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'industrial-lite' ),
			'pro_text' => esc_html__( 'DOCS', 'industrial-lite' ),
			'pro_url'  => esc_url('https://preview.vwthemesdemo.com/docs/free-vw-industrial-lite/'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'industrial-lite-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'industrial-lite-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );

		wp_localize_script(
		'industrial-lite-customize-controls',
		'industrial_lite_customizer_params',
		array(
			'ajaxurl' =>	admin_url( 'admin-ajax.php' )
		));
	}
}

// Doing this customizer thang!
Industrial_Lite_Customize::get_instance();