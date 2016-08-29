<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_image_slider
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
vc_map( array(
	'base' => 'us_image_slider',
	'name' => __( 'Image Slider', 'us' ),
	'icon' => 'icon-wpb-images-stack',
	'category' => __( 'Content', 'us' ),
	'weight' => 350,
	'params' => array(
		array(
			'param_name' => 'ids',
			'heading' => __( 'Images', 'us' ),
			'description' => __( 'Select images from media library.', 'us' ),
			'type' => 'attach_images',
			'std' => $config['atts']['ids'],
			'weight' => 110,
		),
		array(
			'param_name' => 'arrows',
			'heading' => __( 'Navigation Arrows', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Show always', 'us' ) => 'always',
				__( 'Show on hover', 'us' ) => 'hover',
				__( 'Hide', 'us' ) => 'hide',
			),
			'std' => $config['atts']['arrows'],
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'weight' => 100,
		),
		array(
			'param_name' => 'nav',
			'heading' => __( 'Additional Navigation', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'None', 'us' ) => 'none',
				__( 'Dots', 'us' ) => 'dots',
				__( 'Thumbs', 'us' ) => 'thumbs',
			),
			'std' => $config['atts']['nav'],
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'weight' => 90,
		),
		array(
			'param_name' => 'transition',
			'heading' => __( 'Transition Effect', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Slide', 'us' ) => 'slide',
				__( 'Fade', 'us' ) => 'crossfade',
			),
			'std' => $config['atts']['transition'],
			'edit_field_class' => 'vc_col-sm-4 vc_column',
			'weight' => 80,
		),
		array(
			'param_name' => 'autoplay',
			'type' => 'checkbox',
			'value' => array( __( 'Enable Auto Rotation', 'us' ) => TRUE ),
			( ( $config['atts']['autoplay'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['autoplay'],
			'weight' => 70,
		),
		array(
			'param_name' => 'autoplay_period',
			'heading' => __( 'Auto Rotation Period (milliseconds)', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['autoplay_period'],
			'dependency' => array( 'element' => 'autoplay', 'not_empty' => TRUE ),
			'weight' => 60,
		),
		array(
			'param_name' => 'fullscreen',
			'type' => 'checkbox',
			'value' => array( __( 'Allow Full Screen view', 'us' ) => TRUE ),
			( ( $config['atts']['fullscreen'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['fullscreen'],
			'weight' => 50,
		),
		array(
			'param_name' => 'orderby',
			'type' => 'checkbox',
			'value' => array( __( 'Display items in random order', 'us' ) => 'rand' ),
			( ( $config['atts']['orderby'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['orderby'],
			'weight' => 40,
		),
		array(
			'param_name' => 'img_size',
			'heading' => __( 'Images Size', 'us' ),
			'type' => 'dropdown',
			'value' => us_image_sizes_select_values( array( 'large', 'tnail-masonry', 'tnail-3x2', 'tnail-1x1', 'tnail-1x1-small', 'medium', 'thumbnail', 'full' ) ),
			'std' => $config['atts']['img_size'],
			'weight' => 30,
		),
		array(
			'param_name' => 'img_fit',
			'heading' => __( 'Images Fit', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Scaledown - Image won\'t be stretched if it\'s smaller than the area', 'us' ) => 'scaledown',
				__( 'Contain - Image will fit inside the area', 'us' ) => 'contain',
				__( 'Cover - Image will cover the whole area', 'us' ) => 'cover',
			),
			'std' => $config['atts']['img_fit'],
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
vc_remove_element( 'vc_simple_slider' );

