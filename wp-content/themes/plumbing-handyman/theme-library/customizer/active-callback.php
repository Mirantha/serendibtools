<?php
/**
 * Active Callbacks
 *
 * @package plumbing_handyman
 */

// Theme Options.
function plumbing_handyman_is_pagination_enabled( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_enable_pagination' )->value() );
}
function plumbing_handyman_is_breadcrumb_enabled( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_enable_breadcrumb' )->value() );
}
function plumbing_handyman_is_layout_enabled( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_website_layout' )->value() );
}
function plumbing_handyman_is_pagetitle_bcakground_image_enabled( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_page_header_style' )->value() );
}
function plumbing_handyman_is_preloader_style( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_enable_preloader' )->value() );
}

// Header Options.
function plumbing_handyman_is_topbar_enabled( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_Setting( 'plumbing_handyman_enable_topbar' )->value() );
}

// Slider Slider Section.
function plumbing_handyman_is_slider_section_enabled( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_enable_slider_section' )->value() );
}
function plumbing_handyman_is_slider_slider_section_and_content_type_post_enabled( $plumbing_handyman_control ) {
	$plumbing_handyman_content_type = $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_slider_slider_content_type' )->value();
	return ( plumbing_handyman_is_slider_section_enabled( $plumbing_handyman_control ) && ( 'post' === $plumbing_handyman_content_type ) );
}
function plumbing_handyman_is_slider_slider_section_and_content_type_page_enabled( $plumbing_handyman_control ) {
	$plumbing_handyman_content_type = $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_slider_slider_content_type' )->value();
	return ( plumbing_handyman_is_slider_section_enabled( $plumbing_handyman_control ) && ( 'page' === $plumbing_handyman_content_type ) );
}

// About section.
function plumbing_handyman_is_post_tab_section_and_content_type_page_enabled( $plumbing_handyman_control ) {
	$plumbing_handyman_content_type = $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_slider_slider_content_type' )->value();
	return ( plumbing_handyman_is_slider_section_enabled( $plumbing_handyman_control ) && ( 'page' === $plumbing_handyman_content_type ) );
}
function plumbing_handyman_is_post_tab_section_and_content_type_post_enabled( $plumbing_handyman_control ) {
	$plumbing_handyman_content_type = $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_slider_slider_content_type' )->value();
	return ( plumbing_handyman_is_slider_section_enabled( $plumbing_handyman_control ) && ( 'post' === $plumbing_handyman_content_type ) );
}
function plumbing_handyman_is_about_section_enabled( $plumbing_handyman_control ) {
	return ( $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_enable_about_section' )->value() );
}
function plumbing_handyman_is_about_section_and_content_type_post_enabled( $plumbing_handyman_control ) {
	$plumbing_handyman_content_type = $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_about_content_type' )->value();
	return ( plumbing_handyman_is_about_section_enabled( $plumbing_handyman_control ) && ( 'post' === $plumbing_handyman_content_type ) );
}
function plumbing_handyman_is_about_section_and_content_type_page_enabled( $plumbing_handyman_control ) {
	$plumbing_handyman_content_type = $plumbing_handyman_control->manager->get_setting( 'plumbing_handyman_about_content_type' )->value();
	return ( plumbing_handyman_is_about_section_enabled( $plumbing_handyman_control ) && ( 'page' === $plumbing_handyman_content_type ) );
}