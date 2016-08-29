<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_testimonial
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 * @param $config ['content'] string Shortcode's default content
 */
vc_map( array(
	'base' => 'us_testimonial',
	'name' => __( 'Testimonial', 'us' ),
	'icon' => 'icon-wpb-ui-separator-label',
	'category' => __( 'Content', 'us' ),
	'weight' => 270,
	'params' => array(
		array(
			'param_name' => 'style',
			'heading' => __( 'Quote Style', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Card Style', 'us' ) => '1',
				__( 'Flat Style', 'us' ) => '2',
			),
			'std' => $config['atts']['style'],
			'weight' => 70,
		),
		array(
			'param_name' => 'content',
			'heading' => __( 'Quote Text', 'us' ),
			'type' => 'textarea',
			'std' => $config['content'],
			'admin_label' => TRUE,
			'weight' => 60,
		),
		array(
			'param_name' => 'author',
			'heading' => __( 'Author Name', 'us' ),
			'description' => __( 'Enter the Name of the Person to quote', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['author'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 50,
		),
		array(
			'param_name' => 'company',
			'heading' => __( 'Author Subtitle', 'us' ),
			'description' => __( 'Can be used for a job description', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['company'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 40,
		),
		array(
			'param_name' => 'img',
			'heading' => __( 'Author Photo (optional)', 'us' ),
			'type' => 'attach_image',
			'std' => $config['atts']['img'],
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'weight' => 30,
		),
		array(
			'param_name' => 'link',
			'heading' => __( 'Author Link (optional)', 'us' ),
			'description' => __( 'Applies to the Name and to the Photo', 'us' ),
			'type' => 'vc_link',
			'std' => $config['atts']['link'],
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
