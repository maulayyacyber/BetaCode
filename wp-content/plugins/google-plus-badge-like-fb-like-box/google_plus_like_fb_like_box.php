<?php
/*
Plugin Name: Google Plus Badge Follow Box
Plugin URI: http://www.aidful.com/google-plus-badge-follow-box/
Description: Google Plus Badge Follow Box like FB Like Box with Plus one button, Follow button and Profile pics of followers.
Version: 0.1.8
Author: Manivannan M
Author URI: http://www.aidful.com
License: GPLv2 or Later
*/

class Google_Plus_Like_FB_Like extends WP_Widget {

	function Google_Plus_Like_FB_Like() {
	
		/* Widget settings */
		$widget_ops = array( 'classname' => 'google_plus_follow_box', 'description' => __('Google Plus Badge / Follow Box widget for Google+ Profile / Page', 'google_plus_follow_box' ));

		/* Widget control settings */
		$control_ops = array('id_base' => 'google_plus_follow_box');

		/* Create the widget */
		parent::__construct('google_plus_follow_box', 'Google+ Follow Box', $widget_ops, $control_ops);

	}


	/* Widget form creation */
	function form( $instance ) {
	
		/* Default widget settings */
		$defaults = array(
		'title' => 'Google+ Badge',
		'google' => '108151203181049867089',
		'select_width' => '250',
		'select_height' => '250',
		'remove_plus_one' => 'false',
		'remove_border' => 'false'
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e('Google+ ID:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" value="<?php echo $instance['google']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('select_width'); ?>"><?php _e('Select Width'); ?></label>
			<select name="<?php echo $this->get_field_name('select_width'); ?>" id="<?php echo $this->get_field_id('select_width'); ?>" class="widefat">
			<?php 
			$options = array('150', '200', '250', '300', '350', '400', '450', '500', '550', '600', '650', '700', '750', '800');
			foreach ($options as $option) { ?>
				<option <?php selected( $instance['select_width'], $option ); ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
			<?php	}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('select_height'); ?>"><?php _e('Select Height'); ?></label>
			<select name="<?php echo $this->get_field_name('select_height'); ?>" id="<?php echo $this->get_field_id('select_height'); ?>" class="widefat">
			<?php 
			$options = array('150', '200', '250', '300', '350', '400', '450', '500', '550', '600', '650', '700', '750', '800');
			foreach ($options as $option) { ?>
				<option <?php selected( $instance['select_height'], $option ); ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
			<?php	}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('remove_plus_one'); ?>"><input id="<?php echo $this->get_field_id( 'remove_plus_one' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'remove_plus_one' ); ?>" value="1" <?php checked( 1, $instance['remove_plus_one'] ); ?>/> <?php esc_html_e( 'Remove Plus One button', 'google_plus_follow_box' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('remove_border'); ?>"><input id="<?php echo $this->get_field_id( 'remove_border' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'remove_border' ); ?>" value="1" <?php checked( 1, $instance['remove_border'] ); ?>/> <?php esc_html_e( 'Remove border from widget', 'google_plus_follow_box' ); ?></label>
		</p>

	<?php
	}

	/* Widget update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
	
		$instance['google'] = $new_instance['google'];

		$instance['select_width'] = $new_instance['select_width'];

		$instance['select_height'] = strip_tags($new_instance['select_height'] );

		$instance['remove_plus_one'] = $new_instance['remove_plus_one'];

		$instance['remove_border'] = $new_instance['remove_border'];

		return $instance;
	}

	/* Widget display */
	function widget( $args, $instance ) {
		extract( $args );

		/* Available Widget Options */
		$title = apply_filters('widget_title', $instance['title'] );
		$google = $instance['google'];
		$select_width = $instance['select_width'];
		$select_height = $instance['select_height'];
		$remove_plus_one = $instance['remove_plus_one'];
		$remove_border = $instance['remove_border'];


		/* Before widget */
		echo $before_widget;

		/* Check if title is set */
		if ( $title )
			echo $before_title . $title . $after_title;
	   	?>

		<?php if ( $select_height == '150' ) {
        		$height = 150;
        	} else if ( $select_height == '200' ) {
       			$height = 200;
        	} else if ( $select_height == '250' ) {
        		$height = 250;
        	} else if ( $select_height == '300' ) {
       			$height = 300;
        	} else if ( $select_height == '350' ) {
        		$height = 350;
        	} else if ( $select_height == '400' ) {
       			$height = 400;
        	} else if ( $select_height == '450' ) {
        		$height = 450;
        	} else if ( $select_height == '500' ) {
       			$height = 500;
        	} else if ( $select_height == '550' ) {
        		$height = 550;
        	} else if ( $select_height == '600' ) {
       			$height = 600;
        	} else if ( $select_height == '650' ) {
       			$height = 650;
        	} else if ( $select_height == '700' ) {
       			$height = 700;
        	} else if ( $select_height == '750' ) {
       			$height = 750;
        	} else if ( $select_height == '800' ) {
       			$height = 800;
        	} 

	   	?>

	<?php if ($google) {
		$new_calc = round(12 - ($height / 100));
		$new_margin = round($height - ( $new_calc * 4));

	?>
	<div style="width:<?php echo $select_width; ?>px; height:<?php echo $height; ?>px;">
	<div <?php if ( $select_width >= 200 && !$remove_border ) { echo 'style="margin-right:20px; padding:10px 0 0 10px; border:1px solid #ccc;"'; }?>>
	<div class="g-plus" data-action="followers" data-height="<?php echo $height; ?>" data-href="https://plus.google.com/<?php echo $google; ?>" data-source="blogger:blog:followers" data-width="<?php echo $select_width; ?>"></div>
	</div>
	<?php if (!$remove_plus_one) {
	?>
	<div <?php if ( $select_width == 200 ) { echo 'style="margin-left:100px; margin-top:-' .($new_margin+10).'px;"' ;} else if ( $select_width >= 250 ) { echo 'style="margin-left:105px; margin-top:-'.$new_margin.'px;"' ;}?>><div class="g-plusone" data-size="standard" data-annotation="bubble" data-href="https://plus.google.com/<?php echo $google; ?>"></div></div>
	<?php
		}
	?>
	</div>
	<script type="text/javascript">
  		(function() {
    		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    		po.src = 'https://apis.google.com/js/plusone.js';
    		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  		})();
    	</script>
	<?php
		}

		/* After widget */
		echo $after_widget;
	}
}

/* Register widget */
add_action('widgets_init', create_function('', 'return register_widget("Google_Plus_Like_FB_Like");'));
?>
