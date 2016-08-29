<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcodes config
 *
 * @var $config array Framework-based shortcodes config
 *
 * @filter us_config_shortcodes
 */

global $us_template_directory;

$config['us_blog']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_blog.php';
$config['us_portfolio']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_portfolio.php';
$config['us_social_links']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_social_links.php';
$config['us_logos']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_logos.php';
$config['vc_tta_tabs']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/vc_tta_tabs.php';
$config['us_person']['custom_vc_map'] = $us_template_directory . '/plugins-support/js_composer/map/us_person.php';
$config['us_person']['atts']['layout'] = 'card';

unset( $config['us_contacts'] );

return $config;
