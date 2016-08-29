<?php
/*
Plugin Name: Sidebar Generator
Plugin URI: http://www.getson.info
Description: This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish. Version 1.1 now supports themes with multiple sidebars.
Version: 1.1.0
Author: Kyle Getson
Author URI: http://www.kylegetson.com
Copyright (C) 2009 Kyle Robert Getson
*/

/*
Copyright (C) 2009 Kyle Robert Getson, kylegetson.com and getson.info

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class sidebar_generator {

	public function __construct() {
		add_action( 'init', array( 'sidebar_generator', 'init' ) );
		add_action( 'admin_menu', array( 'sidebar_generator', 'admin_menu' ), 40 );
		add_action( 'admin_print_scripts', array( 'sidebar_generator', 'admin_print_scripts' ) );
		add_action( 'wp_ajax_add_sidebar', array( 'sidebar_generator', 'add_sidebar' ) );
		add_action( 'wp_ajax_remove_sidebar', array( 'sidebar_generator', 'remove_sidebar' ) );

		//edit posts/pages
		add_action( 'edit_form_advanced', array( 'sidebar_generator', 'edit_form' ) );
		add_action( 'edit_page_form', array( 'sidebar_generator', 'edit_form' ) );

		//save posts/pages
		add_action( 'edit_post', array( 'sidebar_generator', 'save_form' ) );
		add_action( 'publish_post', array( 'sidebar_generator', 'save_form' ) );
		add_action( 'save_post', array( 'sidebar_generator', 'save_form' ) );
		add_action( 'edit_page_form', array( 'sidebar_generator', 'save_form' ) );
	}

	public static function init() {
		//go through each sidebar and register it
		$sidebars = sidebar_generator::get_sidebars();

		if ( is_array( $sidebars ) ) {
			foreach ( $sidebars as $sidebar ) {
				$sidebar_class = sidebar_generator::name_to_class( $sidebar );

				global $wp_registered_sidebars;
				$i = count( $wp_registered_sidebars ) + 1;

				register_sidebar( array(
					'name' => $sidebar,
					'id' => "sidebar-$i",
					'class' => $sidebar_class,
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h4>',
					'after_title' => '</h4>',
				) );
			}
		}
	}

	public static function admin_print_scripts() {
		wp_print_scripts( array( 'sack' ) );
		?>
		<script>
			function add_sidebar(sidebar_name){

				var mysack = new sack("<?php echo admin_url('admin-ajax.php'); ?>");

				mysack.execute = 1;
				mysack.method = 'POST';
				mysack.setVar("action", "add_sidebar");
				mysack.setVar("sidebar_name", sidebar_name);
				mysack.encVar("cookie", document.cookie, false);
				mysack.onError = function(){
					alert('<?php _e('Ajax error. Cannot add sidebar', 'us') ?>')
				};
				mysack.runAJAX();
				return true;
			}

			function remove_sidebar(sidebar_name, num){

				var mysack = new sack("<?php echo admin_url('admin-ajax.php'); ?>");

				mysack.execute = 1;
				mysack.method = 'POST';
				mysack.setVar("action", "remove_sidebar");
				mysack.setVar("sidebar_name", sidebar_name);
				mysack.setVar("row_number", num);
				mysack.encVar("cookie", document.cookie, false);
				mysack.onError = function(){
					alert('<?php _e('Ajax error. Cannot add sidebar', 'us')?>')
				};
				mysack.runAJAX();
				//alert('hi!:::'+sidebar_name);
				return true;
			}
		</script>
		<?php
	}

	public static function add_sidebar() {
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace( array( "\n", "\r", "\t" ), '', $_POST['sidebar_name'] );
		$id = sidebar_generator::name_to_class( $name );
		if ( isset( $sidebars[ $id ] ) ) {
			die( "alert('" . __( 'Sidebar already exists, please use a different name.', 'us' ) . "')" );
		}

		$sidebars[ $id ] = $name;
		sidebar_generator::update_sidebars( $sidebars );

		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);

			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);

			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);

			//var cellLeft = row.insertCell(2);
			//var textNode = document.createTextNode('[<a href=\"javascript:void(0);\" onclick=\'return remove_sidebar_link($name);\'>" . __( 'Remove', 'us' ) . "</a>]');
			//cellLeft.appendChild(textNode)

			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
			linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\"$name\")');
			removeLink.setAttribute('href', 'javacript:void(0)');

			removeLink.appendChild(linkText);
			cellLeft.appendChild(removeLink);


		";

		die( "$js" );
	}

	public static function remove_sidebar() {
		$sidebars = sidebar_generator::get_sidebars();
		$name = str_replace( array( "\n", "\r", "\t" ), '', $_POST['sidebar_name'] );
		$id = sidebar_generator::name_to_class( $name );
		if ( ! isset( $sidebars[ $id ] ) ) {
			die( "alert('" . __( 'Sidebar does not exist.', 'us' ) . "')" );
		}
		$row_number = $_POST['row_number'];
		unset( $sidebars[ $id ] );
		sidebar_generator::update_sidebars( $sidebars );
		$js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)

		";
		die( $js );
	}

	public static function admin_menu() {
		add_submenu_page( 'us-theme-options', __( 'Sidebars', 'us' ), __( 'Sidebars', 'us' ), 'manage_options', 'us-sidebars', array(
			'sidebar_generator',
			'admin_page'
		) );
	}

	public static function admin_page() {
		?>
		<script>
			function remove_sidebar_link(name, num){
				var answer = confirm("<?php _e('Are you sure you want to remove', 'us') ?> " + name + "?\n<?php _e('This will remove any widgets you have assigned to this sidebar.', 'us' )?>");
				if (answer) {
					//alert('AJAX REMOVE');
					remove_sidebar(name, num);
				} else {
					return false;
				}
			}
			function add_sidebar_link(){
				var sidebar_name = prompt("<?php _e('Sidebar Name', 'us') ?>:", "");
				//alert(sidebar_name);
				add_sidebar(sidebar_name);
			}
		</script>
		<div class="wrap">
			<h2><?php _e( 'Sidebar Generator', 'us' ) ?></h2>

			<p>
				<?php _e( 'The sidebar name is for your use only. It will not be visible to any of your visitors. A CSS class is assigned to each of your sidebar, use this styling to customize the sidebars.', 'us' ) ?>
			</p>
			<br/>

			<div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" title="<?php _e( 'Add a sidebar', 'us' ) ?>">+ <?php _e( 'Add a sidebar', 'us' ) ?></a>
			</div>
			<br/>
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th><?php _e( 'Name', 'us' ) ?></th>
					<th><?php _e( 'CSS class', 'us' ) ?></th>
					<th><?php _e( 'Remove', 'us' ) ?></th>
				</tr>
				<?php
				$sidebars = sidebar_generator::get_sidebars();
				//$sidebars = array('bob','john','mike','asdf');
				if ( is_array( $sidebars ) && ! empty( $sidebars ) ) {
					$cnt = 0;
					foreach ( $sidebars as $sidebar ) {
						$alt = ( $cnt % 2 == 0 ? 'alternate' : '' );
						?>
						<tr class="<?php echo $alt ?>">
							<td><?php echo $sidebar; ?></td>
							<td><?php echo sidebar_generator::name_to_class( $sidebar ); ?></td>
							<td>
								<a href="javascript:void(0);" onclick="return remove_sidebar_link('<?php echo $sidebar; ?>',<?php echo $cnt + 1; ?>);" title="<?php _e( 'Remove this sidebar', 'us' ) ?>"><?php _e( 'remove', 'us' ) ?></a>
							</td>
						</tr>
						<?php
						$cnt ++;
					}
				} else {
					?>
					<tr>
						<td colspan="3"><?php _e( 'No Sidebars defined', 'us' ) ?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
		<?php
	}

	/**
	 * for saving the pages/post
	 */
	public static function save_form( $post_id ) {
		if ( ! empty( $_POST['sbg_edit'] ) ) {
			delete_post_meta( $post_id, 'sbg_selected_sidebar' );
			delete_post_meta( $post_id, 'sbg_selected_sidebar_replacement' );
			add_post_meta( $post_id, 'sbg_selected_sidebar', $_POST['sidebar_generator'] );
			add_post_meta( $post_id, 'sbg_selected_sidebar_replacement', $_POST['sidebar_generator_replacement'] );
		}
	}

	public static function edit_form() {
		global $post;
		$post_id = $post;
		if ( is_object( $post_id ) ) {
			$post_id = $post_id->ID;
		}
		$selected_sidebar = get_post_meta( $post_id, 'sbg_selected_sidebar', TRUE );
		if ( ! is_array( $selected_sidebar ) ) {
			$tmp = $selected_sidebar;
			$selected_sidebar = array();
			$selected_sidebar[0] = $tmp;
		}
		$selected_sidebar_replacement = get_post_meta( $post_id, 'sbg_selected_sidebar_replacement', TRUE );
		if ( ! is_array( $selected_sidebar_replacement ) ) {
			$tmp = $selected_sidebar_replacement;
			$selected_sidebar_replacement = array();
			$selected_sidebar_replacement[0] = $tmp;
		}
		?>

		<div id='sbg-sortables' class='meta-box-sortables'>
			<div id="sbg_box" class="postbox ">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'us' ) ?>"><br/></div>
				<h3 class='hndle'><span><?php _e( 'Sidebars', 'us' ) ?></span></h3>

				<div class="inside">
					<div class="sbg_container">
						<input name="sbg_edit" type="hidden" value="sbg_edit"/>

						<p>
							<?php _e( 'Select the sidebar you wish to display on this page.', 'us' ) ?><br/>
							<?php _e( '<strong>Note:</strong> You must first create the sidebar under Sidebars page.', 'us' ) ?>
						</p>
						<ul>
							<?php
							global $wp_registered_sidebars;
							//var_dump($wp_registered_sidebars);
							for ( $i = 0; $i < 1; $i ++ ) { ?>
								<li>
									<select name="sidebar_generator[<?php echo $i ?>]" style="display: none;">
										<option value="0"<?php if ( $selected_sidebar[ $i ] == '' ) {
											echo " selected";
										} ?>><?php _e( 'Default Sidebar', 'us' ) ?>
										</option>
										<?php
										$sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
										if ( is_array( $sidebars ) && ! empty( $sidebars ) ) {
											foreach ( $sidebars as $sidebar ) {
												if ( $selected_sidebar[ $i ] == $sidebar['name'] ) {
													echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
												} else {
													echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
												}
											}
										}
										?>
									</select>
									<select name="sidebar_generator_replacement[<?php echo $i ?>]">

										<?php

										$sidebar_replacements = $wp_registered_sidebars;//sidebar_generator::get_sidebars();
										if ( is_array( $sidebar_replacements ) && ! empty( $sidebar_replacements ) ) {
											foreach ( $sidebar_replacements as $sidebar ) {
												if ( $selected_sidebar_replacement[ $i ] == $sidebar['name'] ) {
													echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
												} else {
													echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
												}
											}
										}
										?>
									</select>

								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	/**
	 * called by the action get_sidebar. this is what places this into the theme
	 */
	public static function get_sidebar( $name = "0", $default = 'default_sidebar' ) {
		if ( ! is_singular() ) {
			if ( $name != "0" AND $name != "" AND is_active_sidebar( $name ) ) {
				dynamic_sidebar( $name );
			} else {
				dynamic_sidebar( $default );
			}

			return;//dont do anything
		}
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta( $post->ID, 'sbg_selected_sidebar', TRUE );
		$selected_sidebar_replacement = get_post_meta( $post->ID, 'sbg_selected_sidebar_replacement', TRUE );
		$did_sidebar = FALSE;
		//this page uses a generated sidebar
		if ( $selected_sidebar != '' && $selected_sidebar != "0" ) {
			echo "\n\n<!-- begin generated sidebar -->\n";
			if ( is_array( $selected_sidebar ) && ! empty( $selected_sidebar ) ) {
				for ( $i = 0; $i < sizeof( $selected_sidebar ); $i ++ ) {

					if ( $name == "0" && $selected_sidebar[ $i ] == "0" && $selected_sidebar_replacement[ $i ] == "0" ) {
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar( $default );//default behavior
						$did_sidebar = TRUE;
						break;
					} elseif ( $name == "0" && $selected_sidebar[ $i ] == "0" ) {
						//we are replacing the default sidebar with something
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar( $selected_sidebar_replacement[ $i ] );//default behavior
						$did_sidebar = TRUE;
						break;
					} elseif ( $selected_sidebar[ $i ] == $name ) {
						//we are replacing this $name
						//echo "\n\n<!-- [called $name selected {$selected_sidebar[$i]} replacement {$selected_sidebar_replacement[$i]}] -->";
						$did_sidebar = TRUE;
						dynamic_sidebar( $selected_sidebar_replacement[ $i ] );//default behavior
						break;
					}
					//echo "<!-- called=$name selected={$selected_sidebar[$i]} replacement={$selected_sidebar_replacement[$i]} -->\n";
				}
			}
			if ( $did_sidebar == TRUE ) {
				echo "\n<!-- end generated sidebar -->\n\n";

				return;
			}
			//go through without finding any replacements, lets just send them what they asked for
			if ( $name != "0" AND $name != "" AND is_active_sidebar( $name ) ) {
				dynamic_sidebar( $name );
			} else {
				dynamic_sidebar( $default );
			}
			echo "\n<!-- end generated sidebar -->\n\n";

			return;
		} else {
			if ( $name != "0" AND $name != "" AND is_active_sidebar( $name ) ) {
				dynamic_sidebar( $name );
			} else {
				dynamic_sidebar( $default );
			}
		}
	}

	/**
	 * replaces array of sidebar names
	 */
	public static function update_sidebars( $sidebar_array ) {
		$sidebars = update_option( 'sbg_sidebars', $sidebar_array );
	}

	/**
	 * gets the generated sidebars
	 */
	public static function get_sidebars() {
		$sidebars = get_option( 'sbg_sidebars' );

		return $sidebars;
	}

	public static function name_to_class( $name ) {
		$class = str_replace( array(
			' ',
			',',
			'.',
			'"',
			"'",
			'/',
			"\\",
			'+',
			'=',
			')',
			'(',
			'*',
			'&',
			'^',
			'%',
			'$',
			'#',
			'@',
			'!',
			'~',
			'`',
			'<',
			'>',
			'?',
			'[',
			']',
			'{',
			'}',
			'|',
			':',
		), '', $name );

		return $class;
	}

}

$sbg = new sidebar_generator;

function generated_dynamic_sidebar( $name = '0', $default = 'default_sidebar' ) {
	sidebar_generator::get_sidebar( $name, $default );

	return TRUE;
}

function generated_dynamic_sidebar_class( $name = '0' ) {
	global $post;
	$post_id = $post;
	if ( is_object( $post_id ) ) {
		$post_id = $post_id->ID;
	}
	$keys = get_post_meta( $post_id, 'sbg_selected_sidebar', TRUE );
	$values = get_post_meta( $post_id, 'sbg_selected_sidebar_replacement', TRUE );
	if ( is_array( $values ) AND is_array( $keys ) AND isset( $keys[ $name ] ) AND isset( $values[ $keys[ $name ] ] ) ) {
		return ' ' . sidebar_generator::name_to_class( $values[ $keys[ $name ] ] );
	}

	return '';
}
