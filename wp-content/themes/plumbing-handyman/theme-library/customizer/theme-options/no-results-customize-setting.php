<?php
/**
 * No Results page
 *
 * @package plumbing_handyman
 */

/*=========================================
No Results Page
=========================================*/
$wp_customize->add_section(
	'no_results_pg_options', array(
		'title' => esc_html__( 'No Results Page', 'plumbing-handyman' ),
		'panel' => 'plumbing_handyman_theme_options',
	)
);

//  Title // 
$wp_customize->add_setting(
	'plumbing_handyman_pg_no_results_ttl',
	array(
        'default'			=> __('Nothing Found','plumbing-handyman'),
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'plumbing_handyman_sanitize_html',
	)
);	

$wp_customize->add_control( 
	'plumbing_handyman_pg_no_results_ttl',
	array(
	    'label'   => __('No Results Title','plumbing-handyman'),
	    'section' => 'no_results_pg_options',
		'type'           => 'text',
	)  
);

//  Text // 
$wp_customize->add_setting(
	'plumbing_handyman_pg_no_results_text',
	array(
        'default'			=> __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','plumbing-handyman'),
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'plumbing_handyman_sanitize_html',
	)
);	

$wp_customize->add_control( 
	'plumbing_handyman_pg_no_results_text',
	array(
	    'label'   => __('No Results Text','plumbing-handyman'),
	    'section' => 'no_results_pg_options',
		'type'           => 'text',
	)  
);