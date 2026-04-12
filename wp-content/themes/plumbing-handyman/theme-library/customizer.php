<?php
/**
 * Plumbing Handyman Theme Customizer
 *
 * @package plumbing_handyman
 */

// Sanitize callback.
require get_template_directory() . '/theme-library/customizer/sanitize-callback.php';

// Active Callback.
require get_template_directory() . '/theme-library/customizer/active-callback.php';

// Custom Controls.
require get_template_directory() . '/theme-library/customizer/custom-controls/custom-controls.php';
// Icon Controls.
require get_template_directory() . '/theme-library/customizer/custom-controls/icon-control.php';

function plumbing_handyman_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'plumbing_handyman_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'plumbing_handyman_customize_partial_blogdescription',
			)
		);
	}

	// Upsell Section.
	$wp_customize->add_section(
		new Plumbing_Handyman_Upsell_Section(
			$wp_customize,
			'upsell_section',
			array(
				'title'            => __( 'Plumbing Handyman Pro', 'plumbing-handyman' ),
				'button_text'      => __( 'Buy Pro', 'plumbing-handyman' ),
				'url'              => 'https://asterthemes.com/products/plumber-wordpress-theme',
				'background_color' => '#067EEF',
				'text_color'       => '#fff',
				'priority'         => 0,
			)
		)
	);

	// Doc Section.
	$wp_customize->add_section(
		new Plumbing_Handyman_Upsell_Section(
			$wp_customize,
			'doc_section',
			array(
				'title'            => __( 'Documentation', 'plumbing-handyman' ),
				'button_text'      => __( 'Free Doc', 'plumbing-handyman' ),
				'url'              => 'https://demo.asterthemes.com/docs/plumbing-handyman-free/',
				'background_color' => '#067EEF',
				'text_color'       => '#fff',
				'priority'         => 1,
			)
		)
	);

	// Theme Options.
	require get_template_directory() . '/theme-library/customizer/theme-options.php';

	// Front Page Options.
	require get_template_directory() . '/theme-library/customizer/front-page-options.php';

	// Colors.
	require get_template_directory() . '/theme-library/customizer/colors.php';

}
add_action( 'customize_register', 'plumbing_handyman_customize_register' );

function plumbing_handyman_customize_partial_blogname() {
	bloginfo( 'name' );
}

function plumbing_handyman_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function plumbing_handyman_custom_control_scripts() {

	wp_enqueue_style( 'plumbing-handyman-custom-controls-css', get_template_directory_uri() . '/resource/css/custom-controls.css', array(), '1.0', 'all' );

	wp_enqueue_script( 'plumbing-handyman-custom-controls-js', get_template_directory_uri() . '/resource/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'plumbing_handyman_custom_control_scripts' );