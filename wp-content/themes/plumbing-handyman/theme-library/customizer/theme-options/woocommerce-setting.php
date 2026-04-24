<?php
/**
 * WooCommerce Settings
 *
 * @package plumbing_handyman
 */

$wp_customize->add_section(
	'plumbing_handyman_woocommerce_settings',
	array(
		'panel' => 'plumbing_handyman_theme_options',
		'title' => esc_html__( 'WooCommerce Settings', 'plumbing-handyman' ),
	)
);

//WooCommerce - Products per page.
$wp_customize->add_setting( 'plumbing_handyman_products_per_page', array(
    'default'           => 9,
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control( 'plumbing_handyman_products_per_page', array(
    'type'        => 'number',
    'section'     => 'plumbing_handyman_woocommerce_settings',
    'label'       => __( 'Products Per Page', 'plumbing-handyman' ),
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
));

//WooCommerce - Products per row.
$wp_customize->add_setting( 'plumbing_handyman_products_per_row', array(
    'default'           => '3',
    'sanitize_callback' => 'plumbing_handyman_sanitize_choices',
) );

$wp_customize->add_control( 'plumbing_handyman_products_per_row', array(
    'label'    => __( 'Products Per Row', 'plumbing-handyman' ),
    'section'  => 'plumbing_handyman_woocommerce_settings',
    'settings' => 'plumbing_handyman_products_per_row',
    'type'     => 'select',
    'choices'  => array(
        '2' => '2',
		'3' => '3',
		'4' => '4',
    ),
) );

//WooCommerce - Show / Hide Related Product.
$wp_customize->add_setting(
	'plumbing_handyman_related_product_show_hide',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_related_product_show_hide',
		array(
			'label'   => esc_html__( 'Show / Hide Related product', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_woocommerce_settings',
		)
	)
);

// WooCommerce - Product Sale Position.
$wp_customize->add_setting(
	'plumbing_handyman_product_sale_position', 
	array(
		'default' => 'left',
		'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(
	'plumbing_handyman_product_sale_position', 
	array(
		'label' => __('Product Sale Position', 'plumbing-handyman'),
		'section' => 'plumbing_handyman_woocommerce_settings',
		'settings' => 'plumbing_handyman_product_sale_position',
		'type' => 'radio',
		'choices' => 
	array(
		'left' => __('Left', 'plumbing-handyman'),
		'right' => __('Right', 'plumbing-handyman'),
	),
));

// WooCommerce Pages Product Border Radius
$wp_customize->add_setting(
	'plumbing_handyman_woocommerce_product_border_radius',
	array(
		'default'           => 3,
		'sanitize_callback' => 'plumbing_handyman_sanitize_range_value',
	)
);
$wp_customize->add_control(
	new Plumbing_Handyman_Customize_Range_Control(
		$wp_customize,
		'plumbing_handyman_woocommerce_product_border_radius',
		array(
			'label'       => __( 'Product Border Radius Setting', 'plumbing-handyman' ),
			'description' => __( 'Adjust the border radius of WooCommerce product boxes.', 'plumbing-handyman' ),
			'section'     => 'plumbing_handyman_woocommerce_settings',
			'settings'    => 'plumbing_handyman_woocommerce_product_border_radius',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 50,
				'step' => 1,
			),
		)
	)
);