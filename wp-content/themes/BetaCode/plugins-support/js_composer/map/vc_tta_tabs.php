<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: vc_tta_tabs
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */

global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/vc_tta_tabs.php';

vc_remove_param( 'vc_tta_tabs', 'stretch' );
vc_remove_param( 'vc_tta_tabs', 'layout' );
vc_add_param( 'vc_tta_tabs', array(
	'param_name' => 'layout',
	'heading' => __( 'Tabs Layout', 'us' ),
	'type' => 'dropdown',
	'value' => array(
		__( 'Default', 'us' ) => 'default',
		__( 'Timeline', 'us' ) => 'timeline',
	),
	'std' => $config['atts']['layout'],
	'weight' => 180,
) );
