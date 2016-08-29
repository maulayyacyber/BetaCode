<?php defined('ABSPATH') OR die('This script cannot be accessed directly.');

/**
 * Theme's sidebars
 *
 * @filter us_config_sidebars
 */

return array(
	'default_sidebar' => array(
		'name' => 'Default Sidebar',
		'id' => 'default_sidebar',
		'description' => __( 'This is the default sidebar. You can choose from the theme\'s options page where the widgets from this sidebar will be shown.', 'us' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	),
	'footer_first' => array(
		'name' => __( 'Footer First Widget', 'us' ),
		'id' => 'footer_first',
		'description' => __( 'Placeholder for First Footer Widget.', 'us' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	),
	'footer_second' => array(
		'name' => __( 'Footer Second Widget', 'us' ),
		'id' => 'footer_second',
		'description' => __( 'Placeholder for Second Footer Widget.', 'us' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'footer_third' => array(
		'name' => __( 'Footer Third Widget', 'us' ),
		'id' => 'footer_third',
		'description' => __( 'Placeholder for Third Footer Widget.', 'us' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
	'footer_fourth' => array(
		'name' => __( 'Footer Fourth Widget', 'us' ),
		'id' => 'footer_fourth',
		'description' => __( 'Placeholder for Fourth Footer Widget.', 'us' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	),
);
