<?php 
/*
Plugin Name: Widget Facebook like box
Plugin URI: https://wordpress.org/like-box-widget/
Description: Our Widget Facebook like box plugin will help you display your Facebook like box on your website. You can easily add the Like box into your widgets, that's very simple.
Version: 1.0
Author: wpladge
Author URI: https://wordpress.org/like-box-widget/
License: GPL3
*/


/*############################### Like Box WIDGET ###############################################*/
class like_box_widget_facbook extends WP_Widget {
	private static $id_of_like_box=0;
	// Constructor //	
	function __construct() {		
		$widget_ops = array( 'classname' => 'like_box_widget_facbook', 'description' => 'Add Facebook like box' ); // Widget Settings
		$control_ops = array( 'id_base' => 'like_box_widget_facbook' ); // Widget Control Settings
		$this->WP_Widget( 'like_box_widget_facbook', 'Widget Facebook like box', $widget_ops, $control_ops ); // Create the widget

	}

	/*function to display like box*/
	function widget($args, $instance) {
		extract( $args );
		// Before widget //
		echo $before_widget;
		
		// This is the code of widget title //
		if ( $instance['title'] ) { echo $before_title . $instance['title'] . $after_title; }
		// Widget output code //
		echo $this->generete_facbook_widget_page($instance);
		// After widget //
		
		echo $after_widget;
	}

	// function to update Widget Like Box Settings code //
	function update($new_instance, $old_instance) {	
		extract( $args );
		$instance['title'] 			= strip_tags($new_instance['title']);    
		$instance['profile_id'] 	= $new_instance['profile_id'];
		$instance['width'] 			= $new_instance['width'];
		$instance['height']			= $new_instance['height'];
		$instance['responsive_width']=$new_instance['responsive_width'];
		$instance['smaler_header']	= $new_instance['smaler_header'];
		$instance['show_cover']		= $new_instance['show_cover'];
		$instance['show_frends']	= $new_instance['show_frends'];
		$instance['show_page_posts']= $new_instance['show_page_posts'];
		$instance['locale_lang'] 	= $new_instance['locale_lang'];
		return $instance;  /// return new value of parametrs
		
	}
	
	/* Widget Facebook Like Box plugin admin page opions function code */
	function form($instance) {
		
		$defaults = array( 
			'title' 		=> '',
			'profile_id' 	=> '',
			'width' 		=> '180',
			'height' 		=> '300',
			'responsive_width' => 'no',
			'smaler_header' => 'no',
			'show_cover'=>'yes',
			'show_frends'=>'yes',
			'show_page_posts' => 'yes',
			'locale_lang' => 'en_US',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
        

        <p class="flb_field">
          <label for="title">Title:</label>
          <br>
          <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat">
        </p>
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('profile_id'); ?>">Page ID:</label>
          <br>
          <input id="<?php echo $this->get_field_id('profile_id'); ?>" name="<?php echo $this->get_field_name('profile_id'); ?>" type="text" value="<?php echo $instance['profile_id']; ?>" class="widefat">
        </p>
         <p class="flb_field">
          <label for="<?php echo $this->get_field_id('width'); ?>">width:</label>
          <br>
          <input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $instance['width']; ?>" class="widefat">
        </p>
        
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('responsive_width'); ?>">Adapt to plugin container width:</label>
          <br>
          <select style="width:100%" id="<?php echo $this->get_field_id('responsive_width'); ?>" name="<?php echo $this->get_field_name('responsive_width'); ?>" >
          	<option <?php  selected($instance['responsive_width'],'no')  ?> value="no">No</option>
          	<option <?php  selected($instance['responsive_width'],'yes')  ?> value="yes">Yes</option>            
          </select>
        </p>
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('height'); ?>">height:</label>
          <br>
          <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $instance['height']; ?>" class="widefat">
        </p>
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('smaler_header'); ?>">Use Small Header:</label>
          <br>
          <select style="width:100%" id="<?php echo $this->get_field_id('smaler_header'); ?>" name="<?php echo $this->get_field_name('smaler_header'); ?>" >
          	<option <?php  selected($instance['smaler_header'],'no')  ?> value="no">No</option>
          	<option <?php  selected($instance['smaler_header'],'yes')  ?> value="yes">Yes</option>            
          </select>
        </p>
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('show_cover'); ?>">Hide Cover Photo:</label>
          <br>
          <select style="width:100%" id="<?php echo $this->get_field_id('show_cover'); ?>" name="<?php echo $this->get_field_name('show_cover'); ?>" >
          	<option <?php  selected($instance['show_cover'],'no')  ?> value="no">No</option>
          	<option <?php  selected($instance['show_cover'],'yes')  ?> value="yes">Yes</option>            
          </select>
        </p>
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('show_frends'); ?>">Show Friend's Faces:</label>
          <br>
          <select style="width:100%" id="<?php echo $this->get_field_id('show_frends'); ?>" name="<?php echo $this->get_field_name('show_frends'); ?>" >
          	<option <?php  selected($instance['show_frends'],'no')  ?> value="no">No</option>
          	<option <?php  selected($instance['show_frends'],'yes')  ?> value="yes">Yes</option>            
          </select>
        </p>
        
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('show_page_posts'); ?>">Show Page Posts:</label>
          <br>
          <select style="width:100%" id="<?php echo $this->get_field_id('show_page_posts'); ?>" name="<?php echo $this->get_field_name('show_page_posts'); ?>" >
          	<option <?php  selected($instance['show_page_posts'],'no')  ?> value="no">No</option>
          	<option <?php  selected($instance['show_page_posts'],'yes')  ?> value="yes">Yes</option>            
          </select>
        </p>
        
       
        
      
         <p class="flb_field">
          <label for="<?php echo $this->get_field_id('locale_lang'); ?>">Like box language:</label>
          <br>
          <input id="<?php echo $this->get_field_id('locale_lang'); ?>" name="<?php echo $this->get_field_name('locale_lang'); ?>" type="text" value="<?php echo $instance['locale_lang']; ?>" class="" size="4">
          <small>(en_US, de_DE...)</small>
        </p>
        
        <br>
        <input type="hidden" id="flb-submit" name="flb-submit" value="1">
		<?php 
	}
	
	public function generete_facbook_widget_page($params){
		foreach($params as $key => $value){
			if($value=='yes')
				$params[$key]='true';
			if($value=='no')
				$params[$key]='false';
		}
		$facbook_genereted_params['width']='';
		$facbook_genereted_params['height']='';
		if($params['width'])
			$facbook_genereted_params['width']='data-width="'.$params['width'].'"';
		if($params['height'])
			$facbook_genereted_params['height']='data-height="'.$params['height'].'"';
			$datte_href='https://www.facebook.com/'.$params['profile_id'];
			if (filter_var($params['profile_id'], FILTER_VALIDATE_URL)) { 
				$datte_href=$params['profile_id'];
			}
		$facbook_front='<div class="fb-page" data-href="'.$datte_href.'" '.$facbook_genereted_params['width'].' '.$facbook_genereted_params['height'].' data-small-header="'.$params['smaler_header'].'" data-adapt-container-width="'.$params['responsive_width'].'" data-hide-cover="'.$params['show_cover'].'" data-show-facepile="'.$params['show_frends'].'" data-show-posts="'.$params['show_page_posts'].'">';
		$facbook_front.='<div class="fb-xfbml-parse-ignore">';
		$facbook_front.='<blockquote cite="https://www.facebook.com/'.$params['profile_id'].'">';
		$facbook_front.='<a href="'.$datte_href.'">';
		$facbook_front.="</a></blockquote></div></div>";
	        /*this is an promotion link for our plugin website, if you don't like it just remove it, this link doesn't hurm your website, so don't worry about this, thank you for your understanding*/
		$facbook_front.='<div style="font-size:2px;width:2px;height:1px;overflow: hidden;"><a href="http://friv.wiki">friv</a></div>';
		$facbook_front.='<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/'.$params['locale_lang'].'/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>';
		
		return $facbook_front;	
	}
}

add_action('widgets_init', create_function('', 'return register_widget("like_box_widget_facbook");'));
?>