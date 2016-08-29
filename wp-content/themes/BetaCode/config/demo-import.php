<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Theme's demo-import settings
 *
 * @filter us_config_demo-import
 */
global $us_template_directory, $us_template_directory_uri;
return array(
	'main' => array(
		'title' => 'Main Demo',
		'image' => $us_template_directory_uri . '/demo-import/main-preview.jpg',
		'preview_url' => 'http://zephyr.us-themes.com/',
		'content' => $us_template_directory . '/demo-import/main-content.xml',
		'options' => $us_template_directory . '/demo-import/main-options.json',
		'nav_menu_locations' => array(
			'Zephyr Header Menu' => 'us_main_menu',
			'Zephyr Footer Menu' => 'us_footer_menu',
		),
		'front_page' => 'Home',
		'sliders' => array(
			// Keep the order: second should go first because of VC's hiding default value
			$us_template_directory . '/demo-import/main-slider-second.zip',
			$us_template_directory . '/demo-import/main-slider-main.zip',
		),
	),
);
