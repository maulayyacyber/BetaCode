<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

add_action( 'widgets_init', 'us_register_sidebars' );
function us_register_sidebars() {
	$config = us_config( 'sidebars' );
	foreach ( $config as $sidebar ) {
		register_sidebar( $sidebar );
	}
}
