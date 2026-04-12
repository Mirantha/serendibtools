<?php
/**
 * Settings for Demo Import
 *
 * @package Whizzie
 * @since 1.0.0
 */

if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}

require trailingslashit( WHIZZIE_DIR ) . 'importer.php';

$current_theme = wp_get_theme();
$theme_title = $current_theme->get( 'Name' );

$land_excavator_config['page_slug'] 	= 'land-excavator';
$land_excavator_config['page_title']	= 'Get Started';

$land_excavator_config['steps'] = array(
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Demo Importer', 'land-excavator' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text_one'	=> __( 'Click On The Image To Import Customizer Demo', 'land-excavator' ),
		'can_skip'		=> true,
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'land-excavator' ),
		'icon'			=> 'yes',
	)
);

if( class_exists( 'ThemeWhizzie' ) ) {
	$ThemeWhizzie = new ThemeWhizzie( $land_excavator_config );
}