<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * UpSolution Widget: Contacts
 *
 * Class US_Widget_Login
 */
class US_Widget_Contacts extends US_Widget {

	/**
	 * Output the widget
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {

		parent::before_widget( $args, $instance );

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$output = $args['before_widget'];

		if ( $title ) {
			$output .= '<h4>' . $title . '</h4>';
		}

		$output .= '<div class="w-contacts"><div class="w-contacts-list">';

		$instance['address'] = apply_filters( 'wpml_translate_single_string', $instance['address'], 'Widgets', '(UpSolution) Contacts - Address' );
		$instance['phone'] = apply_filters( 'wpml_translate_single_string', $instance['phone'], 'Widgets', '(UpSolution) Contacts - Phone' );
		$instance['fax'] = apply_filters( 'wpml_translate_single_string', $instance['fax'], 'Widgets', '(UpSolution) Contacts - Fax' );
		$instance['email'] = apply_filters( 'wpml_translate_single_string', $instance['email'], 'Widgets', '(UpSolution) Contacts - Email' );

		foreach ( array( 'address', 'phone', 'fax' ) as $key ) {
			if ( empty( $instance[ $key ] ) ) {
				continue;
			}
			$output .= '<div class="w-contacts-item for_' . $key . '"><span class="w-contacts-item-value">' . $instance[ $key ] . '</span></div>';
		}

		if ( ! empty( $instance['email'] ) ) {
			$output .= '<div class="w-contacts-item for_email"><span class="w-contacts-item-value"><a href="mailto:' . $instance['email'] . '">' . $instance['email'] . '</a></span></div>';
		}

		$output .= '</div></div>';

		$output .= $args['after_widget'];

		echo $output;
	}

	function update($new_instance, $old_instance){

		//WMPL
		/**
		 * register strings for translation
		 */
		if (function_exists ( 'icl_register_string' )){
			icl_register_string('Widgets', '(UpSolution) Contacts - Address', $new_instance['address']);
			icl_register_string('Widgets', '(UpSolution) Contacts - Phone', $new_instance['phone']);
			icl_register_string('Widgets', '(UpSolution) Contacts - Fax', $new_instance['fax']);
			icl_register_string('Widgets', '(UpSolution) Contacts - Email', $new_instance['email']);
		}
		//\WMPL


		return $new_instance;
	}
}
