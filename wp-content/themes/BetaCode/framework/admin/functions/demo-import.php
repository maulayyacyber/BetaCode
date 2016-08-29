<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

add_action( 'admin_menu', 'us_add_demo_import_page', 30 );
function us_add_demo_import_page() {
	add_submenu_page( 'us-theme-options', __( 'Demo Import', 'us' ), __( 'Demo Import', 'us' ), 'manage_options', 'us-demo-import', 'us_demo_import' );
}

function us_demo_import() {
	global $us_template_directory_uri;
	$config = us_config( 'demo-import', array() );
	if ( count( $config ) < 1 ) {
		return;
	}
	reset( $config );
	$default_demo = key( $config );
	?>
	<div class="w-message content" style="display:none;">
		<div class="g-preloader type_1"></div>
		
		<h1 class="w-message-title"><?php _e( 'Importing Demo Content...', 'us' ) ?></h1>

		<p class="w-message-text">
			<?php _e( 'Please be patient and do not navigate away from this page while the import is in&nbsp;progress.', 'us' ) ?>
			<?php _e( 'This can take a while if your server is slow (inexpensive hosting).', 'us' ) ?>
		</p>
		<p class="w-message-text">
			<?php _e( 'You will be notified via this page when the import is completed.', 'us' ) ?>
		</p>
	</div>

	<div class="w-message error" style="display:none;">
		<h1 class="w-message-title"><?php _e( 'Failed to import Demo Content', 'us' ) ?></h1>
		
		<p class="w-message-text">
			<?php _e( 'You will be notified via this page when the import is completed.', 'us' ) ?>
		</p>
	</div>

	<div class="w-message success" style="display:none;">
		<h1 class="w-message-title"><?php _e( 'Import completed', 'us' ) ?></h1>

		<p class="w-message-text">
			<?php
			echo sprintf( __( 'Now you can see the result at <a href="%s" target="_blank">your site</a><br> or start customize via <a href="%s">Theme Options</a>.', 'us' ), site_url(), admin_url( 'admin.php?page=us-theme-options' ) );
			?>
		</p>
	</div>

	<form class="w-importer" action="?page=us-demo-import" method="post">

		<?php if ( count( $config ) > 1 ): ?>
			<h1 class="w-importer-title"><?php _e( 'Choose the demo which you want to import', 'us' ) ?></h1>
			<div class="w-importer-list">
				<?php foreach ( $config as $name => $import ): ?>
					<div class="w-importer-item">
						<input class="w-importer-item-radio" id="demo_<?php echo $name; ?>" type="radio" value="<?php echo $name; ?>" name="demo">
						<label class="w-importer-item-preview" for="demo_<?php echo $name; ?>" title="<?php _e( 'Click to choose', 'us' ) ?>">
							<h2 class="w-importer-item-title"><?php echo $import['title']; ?></h2>
							<img src="<?php echo $import['image'] ?>" alt="<?php echo $import['title']; ?>">
						</label>

						<div class="w-importer-item-btn">
							<a class="button" href="<?php echo $import['preview_url']; ?>" target="_blank"><?php _e( 'Preview', 'us' ) ?></a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<?php
			$name = key( $config );
			?>
			<h1 class="w-importer-title"><?php _e( 'Demo Import', 'us' ) ?>
				(<a target="_blank" href="<?php echo $config[ $name ]['preview_url'] ?>"><?php _e( 'preview', 'us' ) ?></a>)
			</h1>
			<input type="hidden" name="demo" value="<?php echo $name ?>">
		<?php endif; ?>


		<div class="w-importer-options" style="<?php if ( count( $config ) > 1 ): ?>display: none;<?php endif; ?>">

			<div class="w-importer-option theme-options">
				<label class="w-importer-option-check">
					<input id="demo_content" type="checkbox" value="ON" name="demo_content" checked="checked">
					<span class="w-importer-option-title"><?php _ex( 'Import Demo Content', 'verb', 'us' ) ?></span>
				</label>
			</div>
			<div class="w-importer-option theme-options">
				<label class="w-importer-option-check">
					<input id="theme_options" type="checkbox" value="ON" name="theme_options" checked="checked">
					<span class="w-importer-option-title"><?php _e( 'Import Theme Options', 'us' ) ?></span>
				</label>
			</div>
			<div class="w-importer-option rev-slider">
				<label class="w-importer-option-check">
					<input id="rev_slider" type="checkbox" value="ON"
					       name="rev_slider"<?php if ( ! class_exists( 'RevSlider' ) ) {
						echo ' disabled="disabled"';
					} ?>>
					<span class="w-importer-option-title"><?php _e( 'Import Revolution Sliders', 'us' ) ?></span>
					<?php
					$sliders_avaliable_for = array();
					foreach ( $config as $name => $import ) {
						if ( isset( $import['sliders'] ) AND is_array( $import['sliders'] ) AND ! empty ( $import['sliders'] ) ) {
							$sliders_avaliable_for[ $name ] = $import['title'];
						}
					}
					?>
				</label>
				<?php if ( count( $sliders_avaliable_for ) > 0 AND ! class_exists( 'RevSlider' ) ): ?>
					<span class="w-importer-option-note"> &mdash;
						<?php echo sprintf( __( '<a href="%s">install and activate</a> %s plugin if you want sliders to be imported', 'us' ), admin_url('admin.php?page=us-addons'), '<strong>Slider Revolution</strong>' ) ?>
					</span>
				<?php endif; ?>
			</div>

			<div class="w-importer-note">
				<strong><?php _e( 'Important Notes', 'us' ) ?>:</strong>
				<ol>
					<li><?php _e( 'We recommend to run Demo Import on a clean WordPress installation.', 'us' ) ?></li>
					<li><?php _e( 'To reset your installation we recommend <a href="http://wordpress.org/plugins/wordpress-database-reset/" target="_blank">Wordpress Database Reset</a> plugin.', 'us' ) ?></li>
					<li><?php _e( 'The Demo Import will not import the images we have used in our live demos, due to copyright / license reasons.', 'us' ) ?></li>
					<li><?php _e( 'Do not run the Demo Import multiple times one after another, it will result in double content.', 'us' ) ?></li>
				</ol>
			</div>

			<input type="hidden" name="action" value="perform_import">
			<input class="button-primary size_big" type="submit" value="<?php _e( 'Import', 'us' ) ?>" id="import_demo_data">

		</div>

	</form>
	<script>
		jQuery(function($){
			var import_running = false,
				slidersAvailableFor = <?php echo json_encode(array_keys($sliders_avaliable_for)); ?>,
				sliderOptionState = false;

			$('.w-importer-item').click(function(){
				$('html, body').stop(true, false).animate({
					scrollTop: Math.floor($('.w-importer-options').offset().top)+'px'
				}, {
					duration: 800
				});
			});

			$('.w-importer-item-preview').click(function(){
				var demoName = $(this).attr('for').substr(5);
				if ($('.w-importer-options').css('display') == 'none') {
					$('.w-importer-options').slideDown();
				}

				if ($.inArray(demoName, slidersAvailableFor) !== -1) {
					$('.w-importer-option.rev-slider').slideDown();
					$('.w-importer-note.for_slider').slideDown();
				} else {
					$('.w-importer-option.rev-slider').slideUp();
					$('.w-importer-note.for_slider').slideUp();
				}
			});

			$('.w-importer-option-check').click(function(){
				var demo = $('input[name=demo]:checked').val() || '<?php echo $default_demo; ?>',
					$button = $('#import_demo_data');

				if ($('#demo_content').is(':checked') || $('#theme_options').is(':checked') || ($('#rev_slider').is(':checked') && $.inArray(demo, slidersAvailableFor) !== -1)) {
					$button.removeClass('disabled');
				} else {
					$button.addClass('disabled');
				}
			});
			$('#import_demo_data').click(function(){
				if (import_running) return false;
				$("html, body").animate({
					scrollTop: 0
				}, {
					duration: 300
				});
				var demo = $('input[name=demo]:checked').val() || '<?php echo $default_demo; ?>',
					importQueue = [],
					processQueue = function(){
						if (importQueue.length != 0) {
							// Importing something
							var importAction = importQueue.shift();
							$.ajax({
								type: 'POST',
								url: '<?php echo admin_url('admin-ajax.php'); ?>',
								data: {
									action: importAction,
									demo: demo
								},
								success: function(data) {
									console.log(importAction);
									console.log(data);
									if (data.success) {
										processQueue();
									} else {
										$('.w-message.error .w-message-title').html(data.error_title);
										$('.w-message.error .w-message-text').html(data.error_description);
										$('.w-message.content, .w-message.options, .w-message.sliders').slideUp();
										$('.w-message.error').slideDown();
									}
								}
							});
						}
						else {
							// Import is completed
							$('.w-message.content, .w-message.options, .w-message.sliders').slideUp();
							$('.w-message.success').slideDown();
							import_running = false;
						}
					};
				if ($('#demo_content').is(':checked')) importQueue.push('us_demo_import_content');
				if ($('#theme_options').is(':checked')) importQueue.push('us_demo_import_options');
				if ($('#rev_slider').is(':checked') && $.inArray(demo, slidersAvailableFor) !== -1) importQueue.push('us_demo_import_sliders');

				if (importQueue.length == 0) return false;

				import_running = true;
				$('.w-importer').slideUp(null, function(){
					$('.w-message.content').slideDown();
				});

				processQueue();

				return false;
			});
		});
	</script>
	<?php
}

// Content Import
add_action( 'wp_ajax_us_demo_import_content', 'us_demo_import_content' );
function us_demo_import_content() {
	global $us_template_directory;
	$config = us_config( 'demo-import', array() );

	set_time_limit( 0 );

	if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
		define( 'WP_LOAD_IMPORTERS', TRUE );
	}

	//select which files to import
	$aviable_demos = array_keys( $config );
	$demo_version = $aviable_demos[0];
	if ( in_array( $_POST['demo'], $aviable_demos ) ) {
		$demo_version = $_POST['demo'];
	}

	if ( ! isset( $config[ $demo_version ]['content'] ) OR empty( $config[ $demo_version ]['content'] ) ) {
		wp_send_json( array( 'success' => false, 'error_title' => __( 'Failed to import Demo Content', 'us' ), 'error_description' => __( 'Incorrect Demo Import configuration.', 'us' ), ) );
	}

	if ( ! file_exists( $config[ $demo_version ]['content'] ) ) {
		wp_send_json( array( 'success' => false, 'error_title' => __( 'Failed to import Demo Content', 'us' ), 'error_description' => __( 'Wrong path to the XML file or file is missing.', 'us' ), ) );
	}

	require_once( $us_template_directory . '/framework/vendor/wordpress-importer/wordpress-importer.php' );

	$wp_import = new WP_Import();
	$wp_import->fetch_attachments = TRUE;

	ob_start();
	$wp_import->import( $config[ $demo_version ]['content'] );
	ob_end_clean();

	// Set menu
	if ( isset( $config[ $demo_version ]['nav_menu_locations'] ) ) {
		$locations = get_theme_mod( 'nav_menu_locations' );
		$menus = wp_get_nav_menus();

		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				if ( is_object( $menu ) AND isset( $config[ $demo_version ]['nav_menu_locations'][ $menu->name ] ) ) {
					$nav_location_key = $config[ $demo_version ]['nav_menu_locations'][ $menu->name ];
					$locations[ $nav_location_key ] = $menu->term_id;
				}
			}
		}

		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// Set Front Page
	if ( isset( $config[ $demo_version ]['front_page'] ) ) {
		$front_page = get_page_by_title( $config[ $demo_version ]['front_page'] );

		if ( isset( $front_page->ID ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page->ID );
		}
	}

	wp_send_json_success();
}

//Import Options
add_action( 'wp_ajax_us_demo_import_options', 'us_demo_import_options' );
function us_demo_import_options() {
	$config = us_config( 'demo-import', array() );

	//select which files to import
	$aviable_demos = array_keys( $config );
	$demo_version = $aviable_demos[0];
	if ( in_array( $_POST['demo'], $aviable_demos ) ) {
		$demo_version = $_POST['demo'];
	}

	if ( ! isset( $config[ $demo_version ]['options'] ) OR empty( $config[ $demo_version ]['options'] ) ) {
		wp_send_json( array( 'success' => false, 'error_title' => __( 'Failed to import Theme Options', 'us' ), 'error_description' => __( 'Incorrect Demo Import configuration.', 'us' ), ) );
	}

	if ( ! file_exists( $config[ $demo_version ]['options'] ) ) {
		wp_send_json( array( 'success' => false, 'error_title' => __( 'Failed to import Theme Options', 'us' ), 'error_description' => __( 'Wrong path to the JSON file or file is missing.', 'us'), ) );
	}
	$updated_options = json_decode( file_get_contents( $config[ $demo_version ]['options'] ), TRUE );

	if ( ! is_array( $updated_options ) ) {
		// Wrong file configuration
		wp_send_json( array( 'success' => false, 'error_title' => __( 'Failed to import Theme Options', 'us' ), 'error_description' => __( 'Wrong file format of Theme Options data.', 'us'), ) );
	}

	usof_save_options( $updated_options );

	wp_send_json_success();
}

//Import Slider
add_action( 'wp_ajax_us_demo_import_sliders', 'us_demo_import_sliders' );
function us_demo_import_sliders() {
	global $us_template_directory;
	$config = us_config( 'demo-import', array() );

	//select which files to import
	$aviable_demos = array_keys( $config );
	$demo_version = $aviable_demos[0];
	if ( in_array( $_POST['demo'], $aviable_demos ) ) {
		$demo_version = $_POST['demo'];
	}

	if ( ! class_exists( 'RevSlider' ) OR ! isset( $config[ $demo_version ]['sliders'] ) OR empty( $config[ $demo_version ]['sliders'] ) ) {
		wp_send_json( array( 'success' => false, 'error_title' => __( 'Failed to import Revolution Sliders', 'us' ), 'error_description' => __( 'Incorrect Demo Import configuration.', 'us' ), ) );
	}

	ob_start();
	foreach ( $config[ $demo_version ]['sliders'] as $slider ) {
		echo $slider;
		$_FILES["import_file"]["tmp_name"] = $slider;
		$slider = new RevSlider();
		$response = $slider->importSliderFromPost();
		unset( $slider );
	}
	ob_end_clean();

	wp_send_json_success();
}
