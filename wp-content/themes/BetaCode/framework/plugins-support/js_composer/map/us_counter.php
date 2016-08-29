<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_counter
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
vc_map( array(
	'base' => 'us_counter',
	'name' => __( 'Counter', 'us' ),
	'icon' => 'icon-wpb-ui-separator',
	'category' => __( 'Content', 'us' ),
	'weight' => 190,
	'params' => array(
		array(
			'param_name' => 'initial',
			'heading' => __( 'The initial number value', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['initial'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 90,
		),
		array(
			'param_name' => 'target',
			'heading' => __( 'The final number value', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['target'],
			'holder' => 'span',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 80,
		),
		array(
			'param_name' => 'color',
			'heading' => __( 'Number Color', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Heading (theme color)', 'us' ) => 'text',
				__( 'Primary (theme color)', 'us' ) => 'primary',
				__( 'Secondary (theme color)', 'us' ) => 'secondary',
				__( 'Custom Color', 'us' ) => 'custom',
			),
			'std' => $config['atts']['color'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 70,
		),
		array(
			'param_name' => 'size',
			'heading' => __( 'Number Size', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Small', 'us' ) => 'small',
				__( 'Medium', 'us' ) => 'medium',
				__( 'Large', 'us' ) => 'large',
			),
			'std' => $config['atts']['size'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 60,
		),
		array(
			'param_name' => 'custom_color',
			'type' => 'colorpicker',
			'std' => $config['atts']['custom_color'],
			'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
			'weight' => 50,
		),
		array(
			'param_name' => 'title',
			'heading' => __( 'Title', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['title'],
			'holder' => 'span',
			'weight' => 40,
		),
		array(
			'param_name' => 'prefix',
			'heading' => __( 'Prefix (optional)', 'us' ),
			'description' => __( 'Text before number', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['prefix'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 30,
		),
		array(
			'param_name' => 'suffix',
			'heading' => __( 'Suffix (optional)', 'us' ),
			'description' => __( 'Text after number', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['suffix'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 20,
		),
		array(
			'param_name' => 'el_class',
			'heading' => __( 'Extra class name', 'us' ),
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['el_class'],
			'weight' => 10,
		),
	),
) );

