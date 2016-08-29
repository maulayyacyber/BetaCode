<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Addons configuration
 *
 * @filter us_config_addons
 */

global $us_template_directory;

return array(
	array(
		'name' => 'WPBakery Visual Composer',
		'description' => __( 'Most popular drag & drop WordPress page builder. Save tons of time working on your website content.', 'us' ),
		'slug' => 'js_composer',
		'source' => $us_template_directory . '/vendor/plugins/js_composer.zip',
		'version' => '4.11.2.1',
		'changelog_url' => 'https://wpbakery.atlassian.net/wiki/display/VC/Release+Notes',
	),
	array(
		'name' => 'Slider Revolution',
		'description' => __( 'Most advanced responsive WordPress slider plugin, which allows to create beautiful and interactive sliders and presentations.', 'us' ),
		'slug' => 'revslider',
		'source' => '',
		'version' => '',
		'changelog_url' => 'http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380',
	),
	array(
		'name' => 'Ultimate Addons for Visual Composer',
		'description' => __( 'Powerful addon to Visual Composer, which includes many unique content elements.', 'us' ),
		'slug' => 'Ultimate_VC_Addons',
		'source' => '',
		'version' => '',
		'changelog_url' => 'http://codecanyon.net/item/ultimate-addons-for-visual-composer/6892199',
	),
	array(
		'name' => 'Header Builder',
		'description' => __( 'Unique addon that allows to modify website header using a special drag & drop builder. Create any header layout you can imagine!', 'us' ),
		'slug' => 'us-header-builder',
		'source' => '',
		'version' => '',
		'changelog_url' => 'https://help.us-themes.com/' . strtolower( US_THEMENAME ) . '/changelog/',
	),
);
