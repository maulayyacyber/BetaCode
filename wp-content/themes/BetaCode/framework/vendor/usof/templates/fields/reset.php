<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme Options Field: Transfer
 *
 * Transfer theme options data
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

$output = '<div class="usof-control for_reset status_clear">';
$output .= '<button class="usof-button type_reset" type="button"><span>' . __( 'Reset Options', 'us' ) . '</span>';
$output .= '<span class="usof-preloader"></span></button>';
$output .= '<div class="usof-control-message"></div></div>';

echo $output;
