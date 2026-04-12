<?php
function plumbing_handyman_sanitize_select( $plumbing_handyman_input, $plumbing_handyman_setting ) {
	$plumbing_handyman_input = sanitize_key( $plumbing_handyman_input );
	$plumbing_handyman_choices = $plumbing_handyman_setting->manager->get_control( $plumbing_handyman_setting->id )->choices;
	return ( array_key_exists( $plumbing_handyman_input, $plumbing_handyman_choices ) ? $plumbing_handyman_input : $plumbing_handyman_setting->default );
}

function plumbing_handyman_sanitize_switch( $plumbing_handyman_input ) {
	if ( true === $plumbing_handyman_input ) {
		return true;
	} else {
		return false;
	}
}

function plumbing_handyman_sanitize_google_fonts( $plumbing_handyman_input, $plumbing_handyman_setting ) {
	$plumbing_handyman_choices = $plumbing_handyman_setting->manager->get_control( $plumbing_handyman_setting->id )->choices;
	return ( array_key_exists( $plumbing_handyman_input, $plumbing_handyman_choices ) ? $plumbing_handyman_input : $plumbing_handyman_setting->default );
}
/**
 * Sanitize HTML input.
 *
 * @param string $plumbing_handyman_input HTML input to sanitize.
 * @return string Sanitized HTML.
 */
function plumbing_handyman_sanitize_html( $plumbing_handyman_input ) {
    return wp_kses_post( $plumbing_handyman_input );
}

// Sanitize Scroll Top Position
function plumbing_handyman_sanitize_scroll_top_position( $plumbing_handyman_input ) {
    $valid_positions = array( 'bottom-right', 'bottom-left', 'bottom-center' );
    if ( in_array( $plumbing_handyman_input, $valid_positions ) ) {
        return $plumbing_handyman_input;
    } else {
        return 'bottom-right'; // Default to bottom-right if invalid value
    }
}

function plumbing_handyman_sanitize_choices( $plumbing_handyman_input, $plumbing_handyman_setting ) {
	global $wp_customize; 
	$control = $wp_customize->get_control( $plumbing_handyman_setting->id ); 
	if ( array_key_exists( $plumbing_handyman_input, $control->choices ) ) {
		return $plumbing_handyman_input;
	} else {
		return $plumbing_handyman_setting->default;
	}
}

function plumbing_handyman_sanitize_range_value( $plumbing_handyman_number, $plumbing_handyman_setting ) {

	// Ensure input is an absolute integer.
	$plumbing_handyman_number = absint( $plumbing_handyman_number );

	// Get the input attributes associated with the setting.
	$plumbing_handyman_atts = $plumbing_handyman_setting->manager->get_control( $plumbing_handyman_setting->id )->input_attrs;

	// Get minimum number in the range.
	$plumbing_handyman_min = ( isset( $plumbing_handyman_atts['min'] ) ? $plumbing_handyman_atts['min'] : $plumbing_handyman_number );

	// Get maximum number in the range.
	$plumbing_handyman_max = ( isset( $plumbing_handyman_atts['max'] ) ? $plumbing_handyman_atts['max'] : $plumbing_handyman_number );

	// Get step.
	$plumbing_handyman_step = ( isset( $plumbing_handyman_atts['step'] ) ? $plumbing_handyman_atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $plumbing_handyman_min <= $plumbing_handyman_number && $plumbing_handyman_number <= $plumbing_handyman_max && is_int( $plumbing_handyman_number / $plumbing_handyman_step ) ? $plumbing_handyman_number : $plumbing_handyman_setting->default );
}