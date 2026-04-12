<?php

require get_theme_file_path( '/inc/Tgm/class-tgm-plugin-activation.php' );
/**
 * Recommended plugins.
 */
function fundraiser_nonprofit_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'CBX Bookmark & Favorite', 'fundraiser-nonprofit' ),
			'slug'             => 'cbxwpbookmark',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'fundraiser_nonprofit_register_recommended_plugins' );