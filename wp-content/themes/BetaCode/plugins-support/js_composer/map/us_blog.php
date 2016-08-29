<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Overloading framework's VC shortcode mapping of: us_blog
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
 
global $us_template_directory;
require $us_template_directory . '/framework/plugins-support/js_composer/map/us_blog.php';

vc_remove_param( 'us_blog', 'filter_style' );
vc_remove_param( 'us_blog', 'layout' );
vc_add_param( 'us_blog', array(
	'param_name' => 'layout',
	'heading' => __( 'Layout', 'us' ),
	'type' => 'dropdown',
	'value' => array(
		__( 'Classic', 'us' ) => 'classic',
		__( 'Masonry', 'us' ) => 'masonry',
		__( 'Tiles', 'us' ) => 'tiles',
		__( 'Small Circle Image', 'us' ) => 'smallcircle',
		__( 'Small Square Image', 'us' ) => 'smallsquare',
		__( 'Latest Posts', 'us' ) => 'latest',
		__( 'Compact', 'us' ) => 'compact',
	),
	'std' => $config['atts']['layout'],
	'admin_label' => TRUE,
	'edit_field_class' => 'vc_col-sm-6 vc_column',
	'weight' => 130,
) );
