<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Modifying shortcode: vc_tta_section
 *
 * @var $shortcode string Current shortcode name
 * @var $config array Shortcode's config
 *
 * @param $config ['atts'] array Shortcode's attributes and default values
 */
if ( version_compare( WPB_VC_VERSION, '4.6', '<' ) ) {
	// Oops: the modified shorcode doesn't exist in current VC version. Doing nothing.
	return;
}

if ( ! vc_is_page_editable() ) {
	vc_remove_param( 'vc_tta_section', 'add_icon' );
	vc_remove_param( 'vc_tta_section', 'i_type' );
	vc_remove_param( 'vc_tta_section', 'i_icon_fontawesome' );
	vc_remove_param( 'vc_tta_section', 'i_icon_openiconic' );
	vc_remove_param( 'vc_tta_section', 'i_icon_typicons' );
	vc_remove_param( 'vc_tta_section', 'i_icon_entypo' );
	vc_remove_param( 'vc_tta_section', 'i_icon_linecons' );
	vc_remove_param( 'vc_tta_section', 'i_icon_monosocial' );
	vc_remove_param( 'vc_tta_section', 'i_position' );
	vc_add_params( 'vc_tta_section', array(
		array(
			'param_name' => 'icon',
			'heading' => __( 'Icon', 'us' ),
			'description' => sprintf( __( '%s or %s icon name', 'us' ), '<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>', '<a href="http://designjockey.github.io/material-design-fonticons/" target="_blank">Material Design</a>' ),
			'type' => 'textfield',
			'std' => $config['atts']['icon'],
		),
		array(
			'param_name' => 'i_position',
			'heading' => __( 'Icon position', 'us' ),
			'type' => 'dropdown',
			'value' => array(
				__( 'Before title', 'us' ) => 'left',
				__( 'After title', 'us' ) => 'right',
			),
			'std' => $config['atts']['i_position'],
			'dependency' => array( 'element' => 'icon', 'not_empty' => TRUE ),
		),
		array(
			'param_name' => 'active',
			'heading' => __( 'Active', 'us' ),
			'type' => 'checkbox',
			'value' => array( __( 'Show this section when the page loads', 'us' ) => TRUE ),
			( ( $config['atts']['active'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['active'],
		),
		array(
			'param_name' => 'indents',
			'heading' => __( 'Full Size Content', 'us' ),
			'type' => 'checkbox',
			'value' => array( __( 'Remove paddings in the section\'s content area', 'us' ) => 'none' ),
			( ( $config['atts']['indents'] !== FALSE ) ? 'std' : '_std' ) => $config['atts']['indents'],
		),
		array(
			'param_name' => 'bg_color',
			'heading' => __( 'Background Color', 'us' ),
			'type' => 'colorpicker',
			'value' => '',
			'std' => $config['atts']['bg_color'],
			'holder' => 'div',
			'class' => '',
		),
		array(
			'param_name' => 'text_color',
			'heading' => __( 'Text Color', 'us' ),
			'type' => 'colorpicker',
			'value' => '',
			'std' => $config['atts']['text_color'],
			'holder' => 'div',
			'class' => '',
		),
	) );
	// The only available way to preserve param order :(
	// TODO When some vc_modify_param will be available, reorder params by other means
	vc_remove_param( 'vc_tta_section', 'el_class' );
	vc_add_params( 'vc_tta_section', array(
		array(
			'param_name' => 'el_class',
			'heading' => __( 'Extra class name', 'us' ),
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'us' ),
			'type' => 'textfield',
			'std' => $config['atts']['el_class'],
		),
	) );
}
