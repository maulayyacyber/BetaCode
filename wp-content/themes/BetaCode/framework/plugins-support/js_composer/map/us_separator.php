<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_separator
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
vc_map( array(
	'base' => 'us_separator',
	'name' => __( 'Separator', 'us' ),
	'icon' => 'icon-wpb-ui-separator',
	'category' => __( 'Content', 'us' ),
	'description' => __( 'Horizontal separator line', 'us' ),
	'weight' => 340,
	'params' => array(
		array(
			'param_name' => 'type',
			'heading' => __( 'Separator Type', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Standard Line', 'us' ) => 'default',
				__( 'Full Width Line', 'us' ) => 'fullwidth',
				__( 'Short Line', 'us' ) => 'short',
				__( 'Invisible', 'us' ) => 'invisible',
			),
			'std' => $config['atts']['type'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 90,
		),
		array(
			'param_name' => 'size',
			'heading' => __( 'Separator Size', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Small', 'us' ) => 'small',
				__( 'Medium', 'us' ) => 'medium',
				__( 'Large', 'us' ) => 'large',
				__( 'Huge', 'us' ) => 'huge',
			),
			'std' => $config['atts']['size'],
			'holder' => 'div',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 80,
		),
		array(
			'param_name' => 'thick',
			'heading' => __( 'Line Thickness', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
			),
			'std' => $config['atts']['thick'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'default',
					'fullwidth',
					'short',
				)
			),
			'weight' => 70,
		),
		array(
			'param_name' => 'style',
			'heading' => __( 'Line Style', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Solid', 'us' ) => 'solid',
				__( 'Dashed', 'us' ) => 'dashed',
				__( 'Dotted', 'us' ) => 'dotted',
				__( 'Double', 'us' ) => 'double',
			),
			'std' => $config['atts']['style'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'default',
					'fullwidth',
					'short',
				)
			),
			'weight' => 60,
		),
		array(
			'param_name' => 'color',
			'heading' => __( 'Line Color', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Border (theme color)', 'us' ) => 'border',
				__( 'Primary (theme color)', 'us' ) => 'primary',
				__( 'Secondary (theme color)', 'us' ) => 'secondary',
				__( 'Custom Color', 'us' ) => 'custom',
			),
			'std' => $config['atts']['color'],
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'default',
					'fullwidth',
					'short',
				)
			),
			'weight' => 50,
		),
		array(
			'param_name' => 'bdcolor',
			'type' => 'colorpicker',
			'std' => $config['atts']['bdcolor'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array(
				'element' => 'color',
				'value' => array(
					'custom',
				)
			),
			'weight' => 40,
		),
		array(
			'param_name' => 'icon',
			'heading' => __( 'Icon', 'us' ),
			'description' => sprintf( __( '%s or %s icon name', 'us' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="http://designjockey.github.io/material-design-fonticons/" target="_blank">Material Design</a>' ),
			'type' => 'textfield',
			'std' => $config['atts']['icon'],
			'edit_field_class' => 'vc_col-sm-6 vc_column newline',
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'default',
					'fullwidth',
					'short',
				)
			),
			'weight' => 30,
		),
		array(
			'param_name' => 'text',
			'heading' => __( 'Text (optional)', 'us' ),
			'description' => __( 'Displays text in the middle of this separator', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['text'],
			'holder' => 'div',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'default',
					'fullwidth',
					'short',
				)
			),
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
vc_remove_element( 'vc_separator' );
vc_remove_element( 'vc_text_separator' );
