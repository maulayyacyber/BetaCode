<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

// Should be inited before the visual composer (that is 9)
add_action( 'init', 'us_create_post_types', 8 );
function us_create_post_types() {
	// Portfolio post type
	register_post_type( 'us_portfolio', array(
		'labels' => array(
			'name' => __( 'Portfolio Items', 'us' ),
			'singular_name' => __( 'Portfolio Item', 'us' ),
			'add_new' => __( 'Add Portfolio Item', 'us' ),
		),
		'public' => TRUE,
		'rewrite' => array( 'slug' => us_get_option( 'portfolio_slug', 'portfolio' ) ),
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'comments' ),
		'can_export' => TRUE,
		'capability_type' => 'us_portfolio',
		'map_meta_cap' => TRUE,
		'menu_icon' => 'dashicons-images-alt',
	) );

	// Portfolio categories
	register_taxonomy( 'us_portfolio_category', array( 'us_portfolio' ), array(
		'hierarchical' => TRUE,
		'label' => __( 'Portfolio Categories', 'us' ),
		'singular_label' => __( 'Portfolio Category', 'us' ),
		'rewrite' => array( 'slug' => us_get_option( 'portfolio_category_slug', 'portfolio_category' ) ),
	) );

	// Clients post type
	register_post_type( 'us_client', array(
		'labels' => array(
			'name' => __( 'Clients Logos', 'us' ),
			'singular_name' => __( 'Client Logo', 'us' ),
			'add_new' => __( 'Add Client Logo', 'us' ),
		),
		'public' => FALSE,
		'publicly_queryable' => FALSE,
		'exclude_from_search' => FALSE,
		'show_in_nav_menus' => FALSE,
		'show_ui' => TRUE,
		'has_archive' => FALSE,
		'query_var' => FALSE,
		'supports' => array( 'title', 'thumbnail' ),
		'can_export' => TRUE,
		'capability_type' => 'us_client',
		'map_meta_cap' => TRUE,
		'menu_icon' => 'dashicons-awards',
	) );

	// Portfolio slug may have changed, so we need to keep WP's rewrite rules fresh
	if ( get_transient( 'us_flush_rules' ) ) {
		flush_rewrite_rules();
		delete_transient( 'us_flush_rules' );
	}
}



add_filter( 'manage_us_portfolio_posts_columns', 'us_manage_portfolio_columns' );
function us_manage_portfolio_columns( $columns ) {
	$columns['us_portfolio_category']  = __( 'Categories', 'us' );
	if (isset($columns['comments'])) {
		$title = $columns['comments'];
		unset($columns['comments']);
		$columns['comments'] = $title;
	}
	if (isset($columns['date'])) {
		$title = $columns['date'];
		unset($columns['date']);
		$columns['date'] = $title;
	}

	return $columns;
}

add_action( 'manage_us_portfolio_posts_custom_column', 'us_manage_portfolio_custom_column', 10, 2 );
function us_manage_portfolio_custom_column( $column_name, $post_id ) {
	if ($column_name == 'us_portfolio_category') {
		if ( ! $terms = get_the_terms( $post_id, $column_name ) ) {
			echo '<span class="na">&ndash;</span>';
		} else {
			$termlist = array();
			foreach ( $terms as $term ) {
				$termlist[] = '<a href="' . admin_url( 'edit.php?' . $column_name . '=' . $term->slug . '&post_type=us_portfolio' ) . ' ">' . $term->name . '</a>';
			}

			echo implode( ', ', $termlist );
		}
	}
}

// TODO Move to a separate plugin for proper action order, and remove page refreshes
add_action( 'admin_init', 'us_add_theme_caps' );
function us_add_theme_caps() {
	global $wp_post_types;
	$role = get_role( 'administrator' );
	$force_refresh = FALSE;
	$custom_post_types = array( 'us_portfolio', 'us_client' );
	foreach ( $custom_post_types as $post_type ) {
		if ( ! isset( $wp_post_types[ $post_type ] ) ) {
			continue;
		}
		foreach ( $wp_post_types[ $post_type ]->cap as $cap ) {
			if ( ! $role->has_cap( $cap ) ) {
				$role->add_cap( $cap );
				$force_refresh = TRUE;
			}
		}
	}
	if ( $force_refresh AND current_user_can( 'manage_options' ) AND ! isset( $_COOKIE['us_cap_page_refreshed'] ) ) {
		// To prevent infinite refreshes when the DB is not writable
		setcookie( 'us_cap_page_refreshed' );
		header( 'Refresh: 0' );
	}
}
