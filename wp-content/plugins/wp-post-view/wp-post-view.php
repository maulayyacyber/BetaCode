<?php

/*
  Plugin Name: WP-post-view
  Plugin URI:
  Description:  Display visited views of each post. Tracks total views in each post. Furthermore, it also displays the total views in each row of the post in the administrator panel. Simply add this code "echo_post_views(get_the_ID());" anywhere to display AFTER "<?php if (have_posts ()) : while (have_posts ()) : the_post(); ?>" in single.php file.
  Version: 1.2
  Author: Towards IT Technology Pte Ltd
  Author URI: http://www.towardstech.com/
 */
/*
  Copyright 2011  Towards IT Technology  (email : sales@towardstech.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

//Activation
register_activation_hook(__FILE__, wpp_init());
Register_uninstall_hook(__FILE__, wpp_destroy());
add_action('admin_head', 'post_view_style');
add_action('manage_posts_custom_column', 'show_post_row_views', 10, 2);
add_filter('manage_posts_columns', 'show_post_header_views');

/**
 * When plugin activated, table is created.

 *
 * @global  $wpdb
 */
function wpp_init()
{
    global $wpdb;
    $table = $wpdb->prefix."postview";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
        $sql = "CREATE TABLE ".$table.
                " ( UNIQUE KEY id (post_id), post_id int(10) NOT NULL,
             view int(10),
            view_datetime datetime NOT NULL default '0000-00-00 00:00:00');";
        require_once ABSPATH.'wp-admin/includes/upgrade.php';
        $wpdb->query($sql);
    }
}

/**
 * When plugin deleted, table is deleted.
 *
 * @global $wpdb $wpdb
 */
function wpp_destroy()
{
    global $wpdb;
    $table = $wpdb->prefix."postview";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
        $sql = "DROP TABLE ".$table;
        require_once ABSPATH.'wp-admin/includes/upgrade.php';
        $wpdb->query($sql);
    }
}

/**
 * Some css adjustment.
 */
function post_view_style()
{
    echo
    '<style type="text/css">
	.column-views {
		width: 60px;
		text-align: right;
	}
	</style>';
}

/**
 * Display the views header column name.

 *
 *  * @param array $columns
 *
 * @return <type>
 */
function show_post_header_views($columns)
{
    $columns['views'] = __('Views');

    return $columns;
}

/**
 * Display the views amount in each row of the posts admin panel.
 *
 * @param <type> $column_name
 * @param <type> $post_id
 *
 * @return <type>
 */
function show_post_row_views($column_name, $post_id)
{
    if ($column_name != 'views') {
        return;
    }
    echo wp_get_post_views($post_id);
}

if (!function_exists('echo_post_views')) {

    /**
     * Echo, print or display the views of the post.
     *
     * @param <type> $post_id
     */
    function echo_post_views($post_id)
    {
        echo(wp_update_post_views($post_id) == 1) ? number_format_i18n(wp_get_post_views($post_id)) : 0;
    }
}

/**
 * Returns 1 if successfully updated post views.

 *
 *  * @global $wpdb $wpdb
 *
 * @param <type> $views
 * @param <type> $post_id
 *
 * @return <type>
 */
function wp_insert_post_views($views, $post_id)
{
    global $wpdb;
    $table = $wpdb->prefix."postview";

    $result = $wpdb->query("INSERT INTO $table VALUES($post_id,$views,NOW())");

    return ($result);
}

/**
 * Returns 1 if successfully updated post views.
 *
 * @global <type> $wpdb
 *
 * @param <type> $post_id
 *
 * @return <type>
 */
function wp_update_post_views($post_id)
{
    global $wpdb;
    $table = $wpdb->prefix."postview";

    $views = wp_get_post_views($post_id) + 1;
    if ($wpdb->query("SELECT view FROM $table WHERE post_id = '$post_id'") != 1) {
        wp_insert_post_views($views, $post_id);
    }
    $result = $wpdb->query("UPDATE $table SET view=$views WHERE post_id = '$post_id'");

    return ($result);
}

/**
 * Get the total post views.
 *
 * @global $wpdb $wpdb
 *
 * @param <type> $post_id
 *
 * @return <type>
 */
function wp_get_post_views($post_id)
{
    global $wpdb;

    $table = $wpdb->prefix."postview";
    $result = $wpdb->get_results("SELECT view FROM $table WHERE post_id = $post_id", ARRAY_A);

    return (!is_array($result) || empty($result)) ? "0" : sprintf("%s", $result[0]['view']);
}
