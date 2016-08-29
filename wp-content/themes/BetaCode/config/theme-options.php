<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's Theme Options config
 *
 * @var $config array Framework-based theme options config
 *
 * @return array Changed config
 */

// Material design menu dropdown effect default
$config['menuoptions']['fields']['menu_dropdown_effect']['std'] = 'mdesign';

// WooCommerce shop listing styles
$config['woocommerce']['fields'] = us_array_merge_insert( $config['woocommerce']['fields'], array(
	'shop_listing_style' => array(
		'title' => __( 'Products Grid Style', 'us' ),
		'description' => __( 'This option sets style of products grid for all pages', 'us' ),
		'std' => '2',
		'type' => 'select',
		'options' => array(
			'1' => __( 'Flat style', 'us' ),
			'2' => __( 'Card style', 'us' ),
		),
	),
), 'after', 'product_sidebar' );

unset( $config['styling']['fields']['rounded_corners'] );
unset( $config['styling']['fields']['links_underline'] );
unset( $config['styling']['fields']['color_menu_active_bg'] );
unset( $config['styling']['fields']['change_alt_content_colors'] );
unset( $config['styling']['fields']['color_alt_content_bg'] );
unset( $config['styling']['fields']['color_alt_content_bg_alt'] );
unset( $config['styling']['fields']['color_alt_content_border'] );
unset( $config['styling']['fields']['color_alt_content_heading'] );
unset( $config['styling']['fields']['color_alt_content_text'] );
unset( $config['styling']['fields']['color_alt_content_link'] );
unset( $config['styling']['fields']['color_alt_content_link_hover'] );
unset( $config['styling']['fields']['color_alt_content_primary'] );
unset( $config['styling']['fields']['color_alt_content_secondary'] );
unset( $config['styling']['fields']['color_alt_content_faded'] );
unset( $config['headeroptions']['fields']['header_socials_custom_color'] );
unset( $config['menuoptions']['fields']['menu_hover_effect'] );
unset( $config['blogoptions']['fields']['post_sharing_type']['options']['outlined'] );
unset( $config['blogoptions']['fields']['blog_layout']['options']['cards'] );
unset( $config['blogoptions']['fields']['archive_layout']['options']['cards'] );
unset( $config['blogoptions']['fields']['search_layout']['options']['cards'] );
unset( $config['footeroptions']['fields']['footer_layout'] );

return $config;
