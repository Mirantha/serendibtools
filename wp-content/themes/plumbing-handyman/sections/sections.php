<?php
/**
 * Render homepage sections.
 */
function plumbing_handyman_homepage_sections() {
	$plumbing_handyman_homepage_sections = array_keys( plumbing_handyman_get_homepage_sections() );

	foreach ( $plumbing_handyman_homepage_sections as $plumbing_handyman_section ) {
		require get_template_directory() . '/sections/' . $plumbing_handyman_section . '.php';
	}
}