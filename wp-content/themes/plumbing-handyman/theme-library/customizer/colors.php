<?php
/**
 * Color Option
 *
 * @package plumbing_handyman
 */

// Primary Color.
$wp_customize->add_setting(
	'plumbing_handyman_primary_color',
	array(
		'default'           => '#067EEF',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'plumbing_handyman_primary_color',
		array(
			'label'    => __( 'Primary Color', 'plumbing-handyman' ),
			'section'  => 'colors',
			'priority' => 5,
		)
	)
);

// Secondary Color.
$wp_customize->add_setting(
	'plumbing_handyman_secondary_color',
	array(
		'default'           => '#002A66',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'plumbing_handyman_secondary_color',
		array(
			'label'    => __( 'Secondary Color', 'plumbing-handyman' ),
			'section'  => 'colors',
			'priority' => 5,
		)
	)
);

