<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme Options Field: Select Scheme
 *
 * Drop-down selector field.
 *
 * @var $name string Field name
 * @var $id string Field ID
 * @var $field array Field options
 *
 * @param $field ['title'] string Field title
 * @param $field ['description'] string Field title
 *
 * @var $value string Current value
 */

// Could already be defined in parent function
if ( ! isset( $style_schemes ) ) {
	$style_schemes = us_config( 'style-schemes' );
}

$output = '<div class="usof-select"><select name="' . $name . '">';
foreach ( $style_schemes as $key => &$style_scheme ) {
	$output .= '<option value="' . esc_attr( $key ) . '"' . selected( $value, $key, FALSE ) . '>' . $style_scheme['title'] . '</option>';
}
$output .= '</select></div>';
$output .= '<div class="usof-form-row-control-json"' . us_pass_data_to_js( $style_schemes ) . '></div>';

echo $output;

