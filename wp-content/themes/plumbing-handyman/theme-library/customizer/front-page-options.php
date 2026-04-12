<?php
/**
 * Front Page Options
 *
 * @package Plumbing Handyman
 */

$wp_customize->add_panel(
	'plumbing_handyman_front_page_options',
	array(
		'title'    => esc_html__( 'Front Page Options', 'plumbing-handyman' ),
		'priority' => 20,
	)
);

// Header Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/header.php';

// Slider Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/slider.php';

// About Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/about.php';