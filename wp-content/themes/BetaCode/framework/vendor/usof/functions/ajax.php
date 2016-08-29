<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

add_action( 'wp_ajax_usof_save', 'usof_ajax_save' );
function usof_ajax_save() {

	if ( ! check_admin_referer( 'usof-actions' ) ) {
		wp_send_json_error( array(
			'message' => __( 'Cannot verify your request, plese refresh the page', 'us' ),
		) );
	}

	do_action( 'usof_before_ajax_save' );

	global $usof_options;
	usof_load_options_once();

	$updated_options = array_merge( usof_defaults(), $usof_options );

	$post_options = us_maybe_get_post_json( 'usof_options' );

	if ( empty( $post_options ) ) {
		wp_send_json_error( array(
			'message' => __( 'There\'s no options to save', 'us' ),
		) );
	}

	foreach ( $post_options as $key => $value ) {
		if ( isset( $updated_options[ $key ] ) ) {
			$updated_options[ $key ] = $value;
		}
	}

	usof_save_options( $updated_options );

	do_action( 'usof_after_ajax_save' );

	wp_send_json_success( array(
		'message' => __( 'Options were saved', 'us' ),
	) );
}

add_action( 'wp_ajax_usof_reset', 'usof_ajax_reset' );
function usof_ajax_reset() {

	if ( ! check_admin_referer( 'usof-actions' ) ) {
		wp_send_json_error( array(
			'message' => __( 'Cannot verify your request, plese refresh the page', 'us' ),
		) );
	}

	$updated_options = usof_defaults();
	usof_save_options( $updated_options );
	wp_send_json_success( array(
		'message' => __( 'Options were reset', 'us' ),
		'usof_options' => $updated_options,
	) );
}

add_action( 'wp_ajax_usof_backup', 'usof_ajax_backup' );
function usof_ajax_backup() {

	if ( ! check_admin_referer( 'usof-actions' ) ) {
		wp_send_json_error( array(
			'message' => __( 'Cannot verify your request, plese refresh the page', 'us' ),
		) );
	}

	global $usof_options;
	usof_load_options_once();

	$theme = wp_get_theme();
	if ( is_child_theme() ) {
		$theme = wp_get_theme( $theme->get( 'Template' ) );
	}
	$theme_name = $theme->get( 'Name' );

	$backup = array(
		'time' => current_time( 'mysql', TRUE ),
		'usof_options' => $usof_options,
	);
	$backup_time = strtotime( $backup['time'] ) + get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;

	update_option( 'usof_backup_' . $theme_name, $backup, FALSE );

	wp_send_json_success( array(
		'message' => __( 'Backup was created', 'us' ),
		'status' => __( 'Last Backup', 'us' ) . ': <span>' . date_i18n( 'F j, Y, g:i a', $backup_time ) . '</span>',
	) );
}

add_action( 'wp_ajax_usof_restore_backup', 'usof_ajax_restore_backup' );
function usof_ajax_restore_backup() {

	if ( ! check_admin_referer( 'usof-actions' ) ) {
		wp_send_json_error( array(
			'message' => __( 'Cannot verify your request, plese refresh the page', 'us' ),
		) );
	}

	global $usof_options;

	$theme = wp_get_theme();
	if ( is_child_theme() ) {
		$theme = wp_get_theme( $theme->get( 'Template' ) );
	}
	$theme_name = $theme->get( 'Name' );

	$backup = get_option( 'usof_backup_' . $theme_name );
	if ( ! $backup OR ! is_array( $backup ) OR ! isset( $backup['usof_options'] ) ) {
		wp_send_json_error( array(
			'message' => __( 'There\'s no backup to restore', 'us' ),
		) );
	}

	$usof_options = $backup['usof_options'];
	update_option( 'usof_options_' . $theme_name, $usof_options, TRUE );

	wp_send_json_success( array(
		'message' => __( 'Backup was restored', 'us' ),
		'usof_options' => $usof_options,
	) );
}
