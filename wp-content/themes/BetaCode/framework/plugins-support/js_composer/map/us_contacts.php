<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_contacts
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
vc_map( array(
	'name' => __( 'Contacts', 'us' ),
	'base' => 'us_contacts',
	'icon' => 'icon-wpb-ui-separator',
	'category' => __( 'Content', 'us' ),
	'weight' => 140,
	'params' => array(
		array(
			'param_name' => 'address',
			'heading' => __( 'Address', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['address'],
			'weight' => 50,
		),
		array(
			'param_name' => 'phone',
			'heading' => __( 'Phone', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['phone'],
			'weight' => 40,
		),
		array(
			'param_name' => 'fax',
			'heading' => __( 'Fax', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['fax'],
			'weight' => 30,
		),
		array(
			'param_name' => 'email',
			'heading' => __( 'Email', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['email'],
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
