<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_logos
 *
 * Dev note: if you want to change some of the default values or acceptable attributes, overload the shortcodes config.
 *
 * @var $shortcode string Current shortcode name
 * @var $shortcode_base string The original called shortcode name (differs if called an alias)
 * @var $content string Shortcode's inner content
 * @var $atts array Shortcode attributes
 *
 * @param $atts ['type'] string Type of displayed logos: 'carousel' / 'grid'
 * @param $atts ['columns'] int Quantity of displayed logos
 * @param $atts ['with_indents'] bool Add indents between items?
 * @param $atts ['style'] string Hover style: '1' / '2'
 * @param $atts ['arrows'] bool Show navigation arrows?
 * @param $atts ['auto_scroll'] bool Enable auto rotation?
 * @param $atts ['interval'] int Rotation interval
 * @param $atts ['orderby'] string Items order: '' / 'rand'
 * @param $atts ['el_class'] string Extra class name
 */

$atts = us_shortcode_atts( $atts, 'us_logos' );

$classes = '';

$atts['columns'] = intval( $atts['columns'] );
if ( $atts['columns'] < 1 OR $atts['columns'] > 8 ) {
	$atts['columns'] = 5;
}

$classes .= ' style_' . $atts['style'];

$classes .= ' nav_' . ( $atts['arrows'] ? 'arrows' : 'none' );

if ( $atts['with_indents'] ) {
	$classes .= ' with_indents';
}

if ( isset( $atts['type'] ) AND in_array( $atts['type'], array( 'grid', 'carousel' ) ) ) {
	$classes .= ' type_'.$atts['type'];
} else {
	$classes .= ' type_carousel';
}

if ( isset( $atts['columns'] ) ) {
	$classes .= ' cols_'.$atts['columns'];
}

if ( $atts['el_class'] != '' ) {
	$classes .= ' ' . $atts['el_class'];
}

// We need owl script for this
wp_enqueue_script( 'us-owl' );

$output = '<div class="w-logos' . $classes . '"><div class="w-logos-list"';
$output .= ' data-items="' . $atts['columns'] . '"';
$output .= ' data-autoplay="' . intval( ! ! $atts['auto_scroll'] ) . '"';
$output .= ' data-timeout="' . intval( $atts['interval'] * 1000 ) . '"';
$output .= ' data-nav="' . intval( ! ! $atts['arrows'] ) . '"';
$output .= '>';

$query_args = array(
	'post_type' => 'us_client',
	'nopaging' => TRUE,
);
if ( $atts['orderby'] == 'rand' ) {
	$query_args['orderby'] = 'rand';
}
us_open_wp_query_context();
global $wp_query;
$wp_query = new WP_Query( $query_args );
while ( have_posts() ){
	the_post();
	if ( has_post_thumbnail() ) {
		$tnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
		if ( $tnail ) {
			$url = rwmb_meta( 'us_client_url' );
			if ( $url != '' ) {
				$target = rwmb_meta( 'us_client_new_tab' ) ? ' target="_blank"' : '';
				$output .= '<a class="w-logos-item" href="' . esc_url( $url ) . '"' . $target . '>';
				$output .= '<img src="' . $tnail[0] . '" width="' . $tnail[1] . '" height="' . $tnail[2] . '" alt=""></a>';
			} else {
				$output .= '<div class="w-logos-item"><img src="' . $tnail[0] . '" width="' . $tnail[1] . '" height="' . $tnail[2] . '" alt=""></div>';
			}
		}
	}
}

$output .= '</div></div>';
us_close_wp_query_context();

echo $output;
