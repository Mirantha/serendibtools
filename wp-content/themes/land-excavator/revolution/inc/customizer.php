<?php
/**
 * Land Excavator Theme Customizer
 *
 * @package Land Excavator
 */

function Land_Excavator_Customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'revolution/inc/fontawesome-change.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'Land_Excavator_Customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'Land_Excavator_Customize_partial_blogdescription',
			)
		);
	}

	/*
    * Theme Options Panel
    */
	$wp_customize->add_panel('land_excavator_panel', array(
		'priority' => 25,
		'capability' => 'edit_theme_options',
		'title' => __('Excavator Theme Options', 'land-excavator'),
	));

	/*
	* Customizer main header section
	*/

	$wp_customize->add_setting(
		'land_excavator_site_title_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_site_title_text',
		array(
			'label'       => __('Enable Title', 'land-excavator'),
			'description' => __('Enable or Disable Title from the site', 'land-excavator'),
			'section'     => 'title_tagline',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'land_excavator_site_tagline_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 0,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_site_tagline_text',
		array(
			'label'       => __('Enable Tagline', 'land-excavator'),
			'description' => __('Enable or Disable Tagline from the site', 'land-excavator'),
			'section'     => 'title_tagline',
			'type'        => 'checkbox',
		)
	);

		$wp_customize->add_setting(
		'land_excavator_logo_width',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '150',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_logo_width',
		array(
			'label'       => __('Logo Width in PX', 'land-excavator'),
			'section'     => 'title_tagline',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 100,
	             'max' => 300,
	             'step' => 1,
	         ),
		)
	);

	/* WooCommerce custom settings */

	$wp_customize->add_section('woocommerce_custom_settings', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('WooCommerce Custom Settings', 'land-excavator'),
		'panel'       => 'woocommerce',
	));

	$wp_customize->add_setting(
		'land_excavator_per_columns',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_per_columns',
		array(
			'label'       => __('Product Per Single Row', 'land-excavator'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 4,
	             'step' => 1,
	         ),
		)
	);

	$wp_customize->add_setting(
		'land_excavator_product_per_page',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '6',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_product_per_page',
		array(
			'label'       => __('Product Per One Page', 'land-excavator'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 12,
	             'step' => 1,
	         ),
		)
	);

	/*Related Products Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_related_product',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_related_product',
		array(
			'label'       => __('Enable Related Product', 'land-excavator'),
			'description' => __('Checked to show Related Product', 'land-excavator'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'custom_related_products_number',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'custom_related_products_number',
		array(
			'label'       => __('Related Product Count', 'land-excavator'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 20,
	             'step' => 1,
	         ),
		)
	);

	$wp_customize->add_setting(
		'custom_related_products_number_per_row',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'custom_related_products_number_per_row',
		array(
			'label'       => __('Related Product Per Row', 'land-excavator'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 4,
	             'step' => 1,
	         ),
		)
	);

	/*Archive Product layout*/
	$wp_customize->add_setting('land_excavator_archive_product_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
	));
	$wp_customize->add_control('land_excavator_archive_product_layout',array(
        'type' => 'select',
        'label' => esc_html__('Archive Product Layout','land-excavator'),
        'section' => 'woocommerce_custom_settings',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','land-excavator'),
            'layout-2' => esc_html__('Sidebar On Left','land-excavator'),
			'layout-3' => esc_html__('Full Width Layout','land-excavator')
        ),
	) );

	/*Single Product layout*/
	$wp_customize->add_setting('land_excavator_single_product_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
	));
	$wp_customize->add_control('land_excavator_single_product_layout',array(
        'type' => 'select',
        'label' => esc_html__('Single Product Layout','land-excavator'),
        'section' => 'woocommerce_custom_settings',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','land-excavator'),
            'layout-2' => esc_html__('Sidebar On Left','land-excavator'),
			'layout-3' => esc_html__('Full Width Layout','land-excavator')
        ),
	) );

	$wp_customize->add_setting('land_excavator_woocommerce_product_sale',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
        'default'           => 'Right',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
    ));
    $wp_customize->add_control('land_excavator_woocommerce_product_sale',array(
        'label'       => esc_html__( 'Woocommerce Product Sale Positions','land-excavator' ),
        'type' => 'select',
        'section' => 'woocommerce_custom_settings',
        'choices' => array(
            'Right' => __('Right','land-excavator'),
            'Left' => __('Left','land-excavator'),
            'Center' => __('Center','land-excavator')
        ),
    ) );

	/*Additional Options*/
	$wp_customize->add_section('land_excavator_additional_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Additional Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	/*Main Slider Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_sticky_header',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => false,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_sticky_header',
		array(
			'label'       => __('Enable Sticky Header', 'land-excavator'),
			'description' => __('Checked to enable sticky header', 'land-excavator'),
			'section'     => 'land_excavator_additional_section',
			'type'        => 'checkbox',
		)
	);

	/*Main Slider Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_preloader',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 0,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_preloader',
		array(
			'label'       => __('Enable Preloader', 'land-excavator'),
			'description' => __('Checked to show preloader', 'land-excavator'),
			'section'     => 'land_excavator_additional_section',
			'type'        => 'checkbox',
		)
	);

	/*Breadcrumbs Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_breadcrumbs',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_breadcrumbs',
		array(
			'label'       => __('Enable Breadcrumbs', 'land-excavator'),
			'description' => __('Checked to show Breadcrumbs', 'land-excavator'),
			'section'     => 'land_excavator_additional_section',
			'type'        => 'checkbox',
		)
	);

	/*Pagination Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_pagination',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_pagination',
		array(
			'label'       => __('Enable Pagination', 'land-excavator'),
			'description' => __('Checked to show Pagination', 'land-excavator'),
			'section'     => 'land_excavator_additional_section',
			'type'        => 'checkbox',
		)
	);

	/*Pagination Select Type Option*/
	$wp_customize->add_setting('land_excavator_pagination_type',array(
        'default' => 'type-1',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
	));
	$wp_customize->add_control('land_excavator_pagination_type',array(
        'type' => 'select',
        'label' => esc_html__('Select Pagination Type','land-excavator'),
        'section' => 'land_excavator_additional_section',
        'choices' => array(
            'type-1' => esc_html__('Type 1','land-excavator'),
            'type-2' => esc_html__('Type 2','land-excavator'),
        ),
	) );

	/*Post layout*/
	$wp_customize->add_setting('land_excavator_archive_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
	));
	$wp_customize->add_control('land_excavator_archive_layout',array(
        'type' => 'select',
        'label' => esc_html__('Posts Layout','land-excavator'),
        'section' => 'land_excavator_additional_section',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','land-excavator'),
            'layout-2' => esc_html__('Sidebar On Left','land-excavator'),
			'layout-3' => esc_html__('Full Width Layout','land-excavator')
        ),
	) );

	/*single post layout*/
	$wp_customize->add_setting('land_excavator_post_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
	));
	$wp_customize->add_control('land_excavator_post_layout',array(
        'type' => 'select',
        'label' => esc_html__('Single Post Layout','land-excavator'),
        'section' => 'land_excavator_additional_section',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','land-excavator'),
            'layout-2' => esc_html__('Sidebar On Left','land-excavator'),
			'layout-3' => esc_html__('Full Width Layout','land-excavator')
        ),
	) );

	/*single page layout*/
	$wp_customize->add_setting('land_excavator_page_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
	));
	$wp_customize->add_control('land_excavator_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Single Page Layout','land-excavator'),
        'section' => 'land_excavator_additional_section',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','land-excavator'),
            'layout-2' => esc_html__('Sidebar On Left','land-excavator'),
			'layout-3' => esc_html__('Full Width Layout','land-excavator')
        ),
	) );

	/*Archive Post Options*/
	$wp_customize->add_section('land_excavator_blog_post_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Blog Page Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	$wp_customize->add_setting('land_excavator_enable_blog_post_title',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_blog_post_title',array(
		'label'       => __('Enable Blog Post Title', 'land-excavator'),
		'description' => __('Checked To Show Blog Post Title', 'land-excavator'),
		'section'     => 'land_excavator_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_blog_post_meta',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_blog_post_meta',array(
		'label'       => __('Enable Blog Post Meta', 'land-excavator'),
		'description' => __('Checked To Show Blog Post Meta Feilds', 'land-excavator'),
		'section'     => 'land_excavator_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_blog_post_tags',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_blog_post_tags',array(
		'label'       => __('Enable Blog Post Tags', 'land-excavator'),
		'description' => __('Checked To Show Blog Post Tags', 'land-excavator'),
		'section'     => 'land_excavator_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_blog_post_image',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_blog_post_image',array(
		'label'       => __('Enable Blog Post Image', 'land-excavator'),
		'description' => __('Checked To Show Blog Post Image', 'land-excavator'),
		'section'     => 'land_excavator_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_blog_post_content',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_blog_post_content',array(
		'label'       => __('Enable Blog Post Content', 'land-excavator'),
		'description' => __('Checked To Show Blog Post Content', 'land-excavator'),
		'section'     => 'land_excavator_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_blog_post_button',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_blog_post_button',array(
		'label'       => __('Enable Blog Post Read More Button', 'land-excavator'),
		'description' => __('Checked To Show Blog Post Read More Button', 'land-excavator'),
		'section'     => 'land_excavator_blog_post_section',
		'type'        => 'checkbox',
	));

	/*Blog post Content layout*/
	$wp_customize->add_setting('land_excavator_blog_Post_content_layout',array(
        'default' => 'Left',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
	));
	$wp_customize->add_control('land_excavator_blog_Post_content_layout',array(
        'type' => 'select',
        'label' => esc_html__('Blog Post Content Layout','land-excavator'),
        'section' => 'land_excavator_blog_post_section',
        'choices' => array(
            'Left' => esc_html__('Left','land-excavator'),
            'Center' => esc_html__('Center','land-excavator'),
            'Right' => esc_html__('Right','land-excavator')
        ),
	) );

	/*Excerpt*/
    $wp_customize->add_setting(
		'land_excavator_excerpt_limit',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '25',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_excerpt_limit',
		array(
			'label'       => __('Excerpt Limit', 'land-excavator'),
			'section'     => 'land_excavator_blog_post_section',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 2,
	             'max' => 50,
	             'step' => 2,
	         ),
		)
	);

	/*Archive Button Text*/
	$wp_customize->add_setting(
		'land_excavator_read_more_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'Continue Reading....',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_read_more_text',
		array(
			'label'       => __('Edit Button Text ', 'land-excavator'),
			'section'     => 'land_excavator_blog_post_section',
			'type'        => 'text',
		)
	);

	/*Single Post Options*/
	$wp_customize->add_section('land_excavator_single_post_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Single Post Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	$wp_customize->add_setting('land_excavator_enable_single_blog_post_title',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_single_blog_post_title',array(
		'label'       => __('Enable Single Post Title', 'land-excavator'),
		'description' => __('Checked To Show Single Blog Post Title', 'land-excavator'),
		'section'     => 'land_excavator_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_single_blog_post_meta',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_single_blog_post_meta',array(
		'label'       => __('Enable Single Post Meta', 'land-excavator'),
		'description' => __('Checked To Show Single Blog Post Meta Feilds', 'land-excavator'),
		'section'     => 'land_excavator_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_single_blog_post_tags',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_single_blog_post_tags',array(
		'label'       => __('Enable Single Post Tags', 'land-excavator'),
		'description' => __('Checked To Show Single Blog Post Tags', 'land-excavator'),
		'section'     => 'land_excavator_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_single_post_image',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_single_post_image',array(
		'label'       => __('Enable Single Post Image', 'land-excavator'),
		'description' => __('Checked To Show Single Post Image', 'land-excavator'),
		'section'     => 'land_excavator_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('land_excavator_enable_single_blog_post_content',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));
	$wp_customize->add_control('land_excavator_enable_single_blog_post_content',array(
		'label'       => __('Enable Single Post Content', 'land-excavator'),
		'description' => __('Checked To Show Single Blog Post Content', 'land-excavator'),
		'section'     => 'land_excavator_single_post_section',
		'type'        => 'checkbox',
	));

	/*Related Post Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_related_post',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_related_post',
		array(
			'label'       => __('Enable Related Post', 'land-excavator'),
			'description' => __('Checked to show Related Post', 'land-excavator'),
			'section'     => 'land_excavator_single_post_section',
			'type'        => 'checkbox',
		)
	);

	/*Related post Edit Text*/
	$wp_customize->add_setting(
		'land_excavator_related_post_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'Related Post',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_related_post_text',
		array(
			'label'       => __('Edit Related Post Text ', 'land-excavator'),
			'section'     => 'land_excavator_single_post_section',
			'type'        => 'text',
		)
	);	

	/*Related Post Per Page*/
	$wp_customize->add_setting(
		'land_excavator_related_post_count',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_related_post_count',
		array(
			'label'       => __('Related Post Count', 'land-excavator'),
			'section'     => 'land_excavator_single_post_section',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 9,
	             'step' => 1,
	         ),
		)
	);

	/* Comment Section Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_comment_section',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_comment_section',
		array(
			'label'       => __('Enable Comment Section', 'land-excavator'),
			'description' => __('Checked to show Comment Section', 'land-excavator'),
			'section'     => 'land_excavator_single_post_section',
			'type'        => 'checkbox',
		)
	);

		/*
	* Customizer Global COlor
	*/

	/*Global Color Options*/
	$wp_customize->add_section('land_excavator_global_color_section', array(
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Global Color Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	$wp_customize->add_setting( 'land_excavator_primary_color',
		array(
		'default'           => '#EDB509',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'land_excavator_primary_color',
		array(
			'label'      => esc_html__( 'Primary Color', 'land-excavator' ),
			'section'    => 'land_excavator_global_color_section',
			'settings'   => 'land_excavator_primary_color',
		) ) 
	);

	/*Typography Options*/
	$wp_customize->add_section( 'land_excavator_typography_section', array(
		'panel'       => 'land_excavator_panel',
        'title'    => __( 'Typography Options', 'land-excavator' ),
        'priority' => 2,
    ) );

    $wp_customize->add_setting( 'land_excavator_font_family', array(
		'default'           => 'default',
		'sanitize_callback' => 'land_excavator_sanitize_font_family',
	) );
	
	$wp_customize->add_control( 'land_excavator_font_family', array(
		'label'    => __( 'Global Font Family', 'land-excavator' ),
		'section'  => 'land_excavator_typography_section',
		'type'     => 'select',
		'choices'  => array(
			'default'          => __( 'Default (Theme Font)', 'land-excavator' ),
			'bad_script'       => 'Bad Script',
			'roboto'           => 'Roboto',
			'playfair_display' => 'Playfair Display',
			'open_sans'        => 'Open Sans',
			'lobster'          => 'Lobster',
			'merriweather'     => 'Merriweather',
			'oswald'           => 'Oswald',
			'raleway'          => 'Raleway',
			// Add new fonts here
			'poppins'            => 'Poppins',
			'lato'               => 'Lato',
			'source_sans_pro'    => 'Source Sans Pro',
			'quicksand'          => 'Quicksand',
			'nunito'             => 'Nunito',
			'montserrat'         => 'Montserrat',
			'roboto_condensed'   => 'Roboto Condensed',
			'playfair_display_sc'=> 'Playfair Display SC',
			'alegreya'           => 'Alegreya',
			'fira_sans'          => 'Fira Sans',
		),
	) );
	
	/*Main Header Options*/
	$wp_customize->add_section('land_excavator_header_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Main Header Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	/*
	* Customizer main header section
	*/

	/*Main Header Options*/
	$wp_customize->add_section('land_excavator_header_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Main Header Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	$wp_customize->add_setting(
		'land_excavator_header_search',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => false,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_header_search',
		array(
			'label'       => __('Enable Disable Search', 'land-excavator'),
			'description' => __('Enable or Disable header Search', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'checkbox',
		)
	);

	/*Main Header Phone Text*/
	$wp_customize->add_setting(
		'land_excavator_header_info_phone',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'Toll Free: +1234-567-7890',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'land_excavator_header_info_phone',
		array(
			'label'       => __('Edit Phone Number ', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting('land_excavator_header_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Land_Excavator_Icon_Changer(
        $wp_customize,'land_excavator_header_phone_icon',array(
		'label'	=> __('Phone Number Icon','land-excavator'),
		'transport' => 'refresh',
		'section'	=> 'land_excavator_header_section',
		'type'		=> 'icon'
	)));

	/*Main Header Phone Text*/
	$wp_customize->add_setting(
		'land_excavator_header_info_email',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'excavator123456@example.com',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'land_excavator_header_info_email',
		array(
			'label'       => __('Edit Email Address ', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting('land_excavator_header_mail_icon',array(
		'default'	=> 'fas fa-envelope-open',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Land_Excavator_Icon_Changer(
        $wp_customize,'land_excavator_header_mail_icon',array(
		'label'	=> __('Mail Icon','land-excavator'),
		'transport' => 'refresh',
		'section'	=> 'land_excavator_header_section',
		'type'		=> 'icon'
	)));

	/*Facebook Link*/
	$wp_customize->add_setting(
		'land_excavator_facebook_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'land_excavator_facebook_link_option',
		array(
			'label'       => __('Edit Facebook Link', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'url',
		)
	);

	/*Twitter Link*/
	$wp_customize->add_setting(
		'land_excavator_twitter_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'land_excavator_twitter_link_option',
		array(
			'label'       => __('Edit Twitter Link', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'url',
		)
	);

	/*Instagram Link*/
	$wp_customize->add_setting(
		'land_excavator_instagram_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'land_excavator_instagram_link_option',
		array(
			'label'       => __('Edit Instagram Link', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'url',
		)
	);

	/*linked Link*/
	$wp_customize->add_setting(
		'land_excavator_linkedin_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'land_excavator_linkedin_link_option',
		array(
			'label'       => __('Edit Linkedin Link', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'url',
		)
	);

	/*linked Link*/
	$wp_customize->add_setting(
		'land_excavator_pinterest_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'land_excavator_pinterest_link_option',
		array(
			'label'       => __('Edit Pinterest Link', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'url',
		)
	);

	$wp_customize->add_setting(
		'land_excavator_youtube_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'land_excavator_youtube_link_option',
		array(
			'label'       => __('Edit Youtube Link', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'url',
		)
	);

	/*Main Header Button Text*/
	$wp_customize->add_setting(
		'land_excavator_header_button_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'Get A Quote',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_header_button_text',
		array(
			'label'       => __('Edit Button Text ', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'text',
		)
	);

	/*Main Header Button Link*/
	$wp_customize->add_setting(
		'land_excavator_header_button_link',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'land_excavator_header_button_link',
		array(
			'label'       => __('Edit Button Link ', 'land-excavator'),
			'section'     => 'land_excavator_header_section',
			'type'        => 'url',
		)
	);

	/*
	* Customizer main slider section
	*/
	/*Main Slider Options*/
	$wp_customize->add_section('land_excavator_slider_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Main Slider Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	/*Main Slider Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_slider',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 0,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_slider',
		array(
			'label'       => __('Enable Main Slider', 'land-excavator'),
			'description' => __('Checked to show the main slider', 'land-excavator'),
			'section'     => 'land_excavator_slider_section',
			'type'        => 'checkbox',
		)
	);

	for ($i=1; $i <= 3; $i++) { 

		/*Main Slider Image*/
		$wp_customize->add_setting(
			'land_excavator_slider_image'.$i,
			array(
				'capability'    => 'edit_theme_options',
		        'default'       => '',
		        'transport'     => 'postMessage',
		        'sanitize_callback' => 'esc_url_raw',
	    	)
	    );

		$wp_customize->add_control( 
			new WP_Customize_Image_Control( $wp_customize, 
				'land_excavator_slider_image'.$i, 
				array(
			        'label' => __('Edit Slider Image ', 'land-excavator') .$i,
			        'description' => __('Edit the slider image.', 'land-excavator'),
			        'section' => 'land_excavator_slider_section',
				)
			)
		);

		/*Main Slider Heading*/
		$wp_customize->add_setting(
			'land_excavator_slider_top_text'.$i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'land_excavator_slider_top_text'.$i,
			array(
				'label'       => __('Edit Slider Top Text ', 'land-excavator') .$i,
				'description' => __('Edit the slider Top text.', 'land-excavator'),
				'section'     => 'land_excavator_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Heading*/
		$wp_customize->add_setting(
			'land_excavator_slider_heading'.$i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'land_excavator_slider_heading'.$i,
			array(
				'label'       => __('Edit Heading Text ', 'land-excavator') .$i,
				'description' => __('Edit the slider heading text.', 'land-excavator'),
				'section'     => 'land_excavator_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Content*/
		$wp_customize->add_setting(
			'land_excavator_slider_text'.$i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'land_excavator_slider_text'.$i,
			array(
				'label'       => __('Edit Content Text ', 'land-excavator') .$i,
				'description' => __('Edit the slider content text.', 'land-excavator'),
				'section'     => 'land_excavator_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Button1 Text*/
		$wp_customize->add_setting(
			'land_excavator_slider_button1_text'.$i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'land_excavator_slider_button1_text'.$i,
			array(
				'label'       => __('Edit Button #1 Text ', 'land-excavator') .$i,
				'description' => __('Edit the slider button text.', 'land-excavator'),
				'section'     => 'land_excavator_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Button1 URL*/
		$wp_customize->add_setting(
			'land_excavator_slider_button1_link'.$i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'land_excavator_slider_button1_link'.$i,
			array(
				'label'       => __('Edit Button #1 URL ', 'land-excavator') .$i,
				'description' => __('Edit the slider button url.', 'land-excavator'),
				'section'     => 'land_excavator_slider_section',
				'type'        => 'url',
			)
		);

		/*Main Slider Button2 Text*/
		$wp_customize->add_setting(
			'land_excavator_slider_button2_text'.$i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'land_excavator_slider_button2_text'.$i,
			array(
				'label'       => __('Edit Button #2 Text ', 'land-excavator') .$i,
				'description' => __('Edit the slider button text.', 'land-excavator'),
				'section'     => 'land_excavator_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Button1 URL*/
		$wp_customize->add_setting(
			'land_excavator_slider_button2_link'.$i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'land_excavator_slider_button2_link'.$i,
			array(
				'label'       => __('Edit Button #2 URL ', 'land-excavator') .$i,
				'description' => __('Edit the slider button url.', 'land-excavator'),
				'section'     => 'land_excavator_slider_section',
				'type'        => 'url',
			)
		);
	}

	// Project section
	$wp_customize->add_section('land_excavator_projetcs_sec', array(
	    'priority'       => 5,
	    'capability'     => 'edit_theme_options',
	    'title'          => __('Our Best Project Section', 'land-excavator'),
	    'panel'          => 'land_excavator_panel',
	));

	// Enable/disable section
	$wp_customize->add_setting('land_excavator_projetcs_sec_show', array(
	    'capability'        => 'edit_theme_options',
	    'default'           => 0,
	    'sanitize_callback' => 'land_excavator_sanitize_checkbox',
	));

	$wp_customize->add_control('land_excavator_projetcs_sec_show', array(
	    'label'    => __('Enable Our Projects Section', 'land-excavator'),
	    'section'  => 'land_excavator_projetcs_sec',
	    'type'     => 'checkbox',
	));

	// Section heading text
	$wp_customize->add_setting('land_excavator_projetcs_main_text', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('land_excavator_projetcs_main_text', array(
	    'label'   => esc_html__('Add Section Small Title', 'land-excavator'),
	    'section' => 'land_excavator_projetcs_sec',
	    'type'    => 'text',
	));

	// Section heading
	$wp_customize->add_setting('land_excavator_projetcs_main_heading', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('land_excavator_projetcs_main_heading', array(
	    'label'   => esc_html__('Add Section Small Heading', 'land-excavator'),
	    'section' => 'land_excavator_projetcs_sec',
	    'type'    => 'text',
	));

	// Number of tabs
	$wp_customize->add_setting('land_excavator_projetcs_number', array(
	    'default'           => 6,
	    'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('land_excavator_projetcs_number', array(
	    'label'       => esc_html__('No of Tabs to show', 'land-excavator'),
	    'section'     => 'land_excavator_projetcs_sec',
	    'type'        => 'number',
	    'input_attrs' => array(
	        'step' => 1,
	        'min'  => 0,
	        'max'  => 6,
	    ),
	));

	// Dynamically adding tabs
	$featured_post = absint(get_theme_mod('land_excavator_projetcs_number', 6));
	for ( $j = 1; $j <= $featured_post; $j++ ) {
	    $wp_customize->add_setting('land_excavator_projetcs_text'.$j, array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		));
		$wp_customize->add_control('land_excavator_projetcs_text'.$j, array(
		    'label'   => esc_html__('Edit Tab Text ', 'land-excavator').$j, 
		    'section' => 'land_excavator_projetcs_sec',
		    'type'    => 'text',
		));

	    $categories = get_categories();
	    $cat_posts = array('select' => 'Select');
	    foreach ($categories as $category) {
	        $cat_posts[$category->slug] = $category->name;
	    }

	    $wp_customize->add_setting('land_excavator_projetcs_category'.$j, array(
	        'default'           => 'uncategorized',
	        'sanitize_callback' => 'land_excavator_sanitize_choices',
	    ));

	    $wp_customize->add_control('land_excavator_projetcs_category'.$j, array(
	        'type'    => 'select',
	        'choices' => $cat_posts,
	        'label'   => __('Select Category to display projects', 'land-excavator'),
	        'section' => 'land_excavator_projetcs_sec',
	    ));
	}

	/*
	* Customizer Footer Section
	*/
	/*Footer Options*/
	$wp_customize->add_section('land_excavator_footer_section', array(
		'priority'       => 6,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Footer Options', 'land-excavator'),
		'panel'       => 'land_excavator_panel',
	));

	/*Footer Enable Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_footer',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'land_excavator_enable_footer',
		array(
			'label'       => __('Enable Footer', 'land-excavator'),
			'description' => __('Checked to show Footer', 'land-excavator'),
			'section'     => 'land_excavator_footer_section',
			'type'        => 'checkbox',
		)
	);

	/*Footer bg image Option*/
	$wp_customize->add_setting('land_excavator_footer_bg_image',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'land_excavator_footer_bg_image',array(
        'label' => __('Footer Background Image','land-excavator'),
        'section' => 'land_excavator_footer_section',
        'priority' => 1,
    )));

	/*Footer Social Menu Option*/
	$wp_customize->add_setting(
		'land_excavator_footer_social_menu',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_footer_social_menu',
		array(
			'label'       => __('Enable Footer Social Menu', 'land-excavator'),
			'description' => __('Checked to show the footer social menu. Go to Dashboard >> Appearance >> Menus >> Create New Menu >> Add Custom Link >> Add Social Menu >> Checked Social Menu >> Save Menu.', 'land-excavator'),
			'section'     => 'land_excavator_footer_section',
			'type'        => 'checkbox',
		)
	);	

	/*Go To Top Option*/
	$wp_customize->add_setting(
		'land_excavator_enable_go_to_top_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'land_excavator_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'land_excavator_enable_go_to_top_option',
		array(
			'label'       => __('Enable Go To Top', 'land-excavator'),
			'description' => __('Checked to enable Go To Top option.', 'land-excavator'),
			'section'     => 'land_excavator_footer_section',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting('land_excavator_go_to_top_position',array(
        'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 'Right',
        'sanitize_callback' => 'land_excavator_sanitize_choices'
    ));
    $wp_customize->add_control('land_excavator_go_to_top_position',array(
        'type' => 'select',
        'section' => 'land_excavator_footer_section',
        'label' => esc_html__('Go To Top Positions','land-excavator'),
        'choices' => array(
            'Right' => __('Right','land-excavator'),
            'Left' => __('Left','land-excavator'),
            'Center' => __('Center','land-excavator')
        ),
    ) );

	/*Footer Copyright Text Enable*/
	$wp_customize->add_setting(
		'land_excavator_copyright_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'land_excavator_copyright_option',
		array(
			'label'       => __('Edit Copyright Text', 'land-excavator'),
			'description' => __('Edit the Footer Copyright Section.', 'land-excavator'),
			'section'     => 'land_excavator_footer_section',
			'type'        => 'text',
		)
	);
}
add_action( 'customize_register', 'Land_Excavator_Customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function Land_Excavator_Customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function Land_Excavator_Customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Land_Excavator_Customize_preview_js() {
	wp_enqueue_script( 'land-excavator-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), LAND_EXCAVATOR_VERSION, true );
}
add_action( 'customize_preview_init', 'Land_Excavator_Customize_preview_js' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Land_Excavator_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $land_excavator_instance = null;

		if ( is_null( $land_excavator_instance ) ) {
			$land_excavator_instance = new self;
			$land_excavator_instance->setup_actions();
		}

		return $land_excavator_instance;
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
	 * @param  object  $land_excavator_manager
	 * @return void
	*/
	public function sections( $land_excavator_manager ) {
		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/revolution/inc/section-pro.php' );

		// Register custom section types.
		$land_excavator_manager->register_section_type( 'land_excavator_Customize_Section_Pro' );

		// Register sections.
		$land_excavator_manager->add_section( new Land_Excavator_Customize_Section_Pro( $land_excavator_manager,'land_excavator_go_pro', array(
			'priority'   => 1,
			'title'    => LAND_EXCAVATOR_PRO_NAME,
			'pro_text' => esc_html__( 'Buy Pro', 'land-excavator' ),
			'pro_url'    => esc_url( LAND_EXCAVATOR_BUY_NOW ),
		) )	);

		// Register sections.
		$land_excavator_manager->add_section( new Land_Excavator_Customize_Section_Pro( $land_excavator_manager,'land_excavator_lite_documentation', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Lite Documentation', 'land-excavator' ),
			'pro_text' => esc_html__( 'Instruction', 'land-excavator' ),
			'pro_url'    => esc_url( LAND_EXCAVATOR_LITE_DOC ),
		) )	);

		$land_excavator_manager->add_section( new Land_Excavator_Customize_Section_Pro( $land_excavator_manager, 'land_excavator_live_demo', array(
		    'priority'   => 1,
		    'title'      => esc_html__( 'Pro Theme Demo', 'land-excavator' ),
		    'pro_text'   => esc_html__( 'Live Preview', 'land-excavator' ),
		    'pro_url'    => esc_url( LAND_EXCAVATOR_LIVE_DEMO ),
		) ) );	
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'land-excavator-customize-controls', trailingslashit( get_template_directory_uri() ) . '/revolution/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'land-excavator-customize-controls', trailingslashit( get_template_directory_uri() ) . '/revolution/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Land_Excavator_Customize::get_instance();