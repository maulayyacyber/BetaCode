<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_btn
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
vc_map( array(
	'base' => 'us_btn',
	'name' => __( 'Button', 'us' ),
	'icon' => 'icon-wpb-ui-button',
	'category' => __( 'Content', 'us' ),
	'weight' => 330,
	'params' => array(
		array(
			'param_name' => 'text',
			'heading' => __( 'Button Label', 'us' ),
			'type' => 'textfield',
			'value' => __( 'Click Me', 'us' ),
			'std' => $config['atts']['text'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'holder' => 'button',
			'class' => 'wpb_button',
			'weight' => 120,
		),
		array(
			'param_name' => 'link',
			'heading' => __( 'Button Link', 'us' ),
			'type' => 'vc_link',
			'std' => $config['atts']['link'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 110,
		),
		array(
			'param_name' => 'style',
			'heading' => __( 'Button Style', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Raised', 'us' ) => 'raised',
				__( 'Flat', 'us' ) => 'flat',
			),
			'std' => $config['atts']['style'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 100,
		),
		array(
			'param_name' => 'color',
			'heading' => __( 'Button Color', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Primary (theme color)', 'us' ) => 'primary',
				__( 'Secondary (theme color)', 'us' ) => 'secondary',
				__( 'Light (theme color)', 'us' ) => 'light',
				__( 'Contrast (theme color)', 'us' ) => 'contrast',
				__( 'Black', 'us' ) => 'black',
				__( 'White', 'us' ) => 'white',
				__( 'Custom colors', 'us' ) => 'custom',
			),
			'std' => $config['atts']['color'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 90,
		),
		array(
			'param_name' => 'bg_color',
			'heading' => __( 'Background Color', 'us' ),
			'type' => 'colorpicker',
			'std' => $config['atts']['bg_color'],
			'class' => '',
			'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
			'weight' => 80,
		),
		array(
			'param_name' => 'text_color',
			'heading' => __( 'Text Color', 'us' ),
			'type' => 'colorpicker',
			'std' => $config['atts']['text_color'],
			'class' => '',
			'dependency' => array( 'element' => 'color', 'value' => 'custom' ),
			'weight' => 70,
		),
		array(
			'param_name' => 'size',
			'heading' => __( 'Button Size', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['size'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 60,
		),
		array(
			'param_name' => 'align',
			'heading' => __( 'Button Alignment', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Left', 'us' ) => 'left',
				__( 'Center', 'us' ) => 'center',
				__( 'Right', 'us' ) => 'right',
			),
			'std' => $config['atts']['align'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 50,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Icon', 'us' ),
			'description' => sprintf( __( '%s or %s icon name', 'us' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="http://designjockey.github.io/material-design-fonticons/" target="_blank">Material Design</a>' ),
			'param_name' => 'icon',
			'std' => $config['atts']['icon'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 40,
		),
		array(
			'param_name' => 'iconpos',
			'heading' => __( 'Icon Position', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Left', 'us' ) => 'left',
				__( 'Right', 'us' ) => 'right',
			),
			'std' => $config['atts']['iconpos'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 30,
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
	'js_view' => 'VcButtonView',
) );
vc_remove_element( 'vc_button' );
vc_remove_element( 'vc_button2' );
