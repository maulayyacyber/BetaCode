<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Shortcode: us_counter
 *
 * Dev note: if you want to change some of the default values or acceptable attributes, overload the shortcodes config.
 *
 * @var $shortcode string Current shortcode name
 * @var $shortcode_base string The original called shortcode name (differs if called an alias)
 * @var $content string Shortcode's inner content
 * @var $atts array Shortcode attributes
 *
 * @param $atts ['initial'] mixed The initial number value (integer or float)
 * @param $atts ['target'] mixed The target number value (integer or float)
 * @param $atts ['color'] string number color: 'text' / 'primary' / 'secondary' / 'custom'
 * @param $atts ['custom_color'] string Custom color value
 * @param $atts ['size'] string Number size: 'small' / 'medium' / 'large'
 * @param $atts ['title'] string Title for the counter
 * @param $atts ['prefix'] string Number prefix
 * @param $atts ['suffix'] string Number suffix
 * @param $atts ['el_class'] string Extra class name
 */

$atts = us_shortcode_atts( $atts, 'us_counter' );

$classes = '';
$elm_atts = '';
$number_atts = '';

$classes .= ' size_' . $atts['size'];

if ( $atts['color'] == 'custom' ) {
	$number_atts .= ' style="color: ' . $atts['custom_color'] . '"';
}
$classes .= ' color_' . $atts['color'];

if ( ! empty( $atts['el_class'] ) ) {
	$classes .= ' ' . $atts['el_class'];
}

$elm_atts .= ' data-initial="' . $atts['initial'] . '"';
$elm_atts .= ' data-target="' . $atts['target'] . '"';
$elm_atts .= ' data-prefix="' . $atts['prefix'] . '"';
$elm_atts .= ' data-suffix="' . $atts['suffix'] . '"';

?>
<div class="w-counter<?php echo $classes ?>"<?php echo $elm_atts ?>>
	<div class="w-counter-h">
		<div class="w-counter-number"<?php echo $number_atts ?>>
			<?php echo $atts['prefix'] . $atts['initial'] . $atts['suffix'] ?>
		</div>
		<?php if ( ! empty ( $atts['title'] ) ): ?>
			<h6 class="w-counter-title"><?php echo $atts['title'] ?></h6>
		<?php endif; ?>
	</div>
</div>
