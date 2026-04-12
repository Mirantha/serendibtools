<?php
/**
 * Single Post Options
 *
 * @package plumbing_handyman
 */

$wp_customize->add_section(
	'plumbing_handyman_single_post_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'plumbing-handyman' ),
		'panel' => 'plumbing_handyman_theme_options',
	)
);

// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'plumbing_handyman_single_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_single_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_single_post_options',
		)
	)
);

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'plumbing_handyman_single_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_single_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_single_post_options',
		)
	)
);

// Post Options - Show / Hide Comments.
$wp_customize->add_setting(
	'plumbing_handyman_single_post_hide_comments',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_single_post_hide_comments',
		array(
			'label'   => esc_html__( 'Show / Hide Comments', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_single_post_options',
		)
	)
);

// Post Options - Show / Hide Time.
$wp_customize->add_setting(
	'plumbing_handyman_single_post_hide_time',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_single_post_hide_time',
		array(
			'label'   => esc_html__( 'Show / Hide Time', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_single_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'plumbing_handyman_single_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_single_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_single_post_options',
		)
	)
);

// Post Options - Show / Hide Tag.
$wp_customize->add_setting(
	'plumbing_handyman_post_hide_tags',
	array(
		'default'           => true,
		'sanitize_callback' => 'plumbing_handyman_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Plumbing_Handyman_Toggle_Switch_Custom_Control(
		$wp_customize,
		'plumbing_handyman_post_hide_tags',
		array(
			'label'   => esc_html__( 'Show / Hide Tag', 'plumbing-handyman' ),
			'section' => 'plumbing_handyman_single_post_options',
		)
	)
);

// Post Options - Comment Title.
$wp_customize->add_setting(
	'plumbing_handyman_blog_post_comment_title',
	array(
		'default'=> 'Leave a Reply',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'plumbing_handyman_blog_post_comment_title',
	array(
		'label'	=> __('Comment Title','plumbing-handyman'),
		'input_attrs' => array(
			'placeholder' => __( 'Leave a Reply', 'plumbing-handyman' ),
		),
		'section'=> 'plumbing_handyman_single_post_options',
		'type'=> 'text'
	)
);