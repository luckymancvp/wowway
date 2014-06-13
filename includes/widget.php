<?php

//Add an action that will load all widgets
add_action( 'widgets_init', 'rb_load_widgets' );

//Function that registers the widgets
function rb_load_widgets() {
	register_widget('rb_social_widget');
	register_widget('rb_phone_widget');
	register_widget('rb_separator_widget');
	register_widget('rb_twitter_widget');
}

/*-----------------------------------------------------------------------------------

	Plugin Name: RB Twitter Widget
	Plugin URI: http://www.rubenbristian.com
	Description: A widget that displays your latest tweets
	Version: 1.0
	Author: Ruben Bristian
	Author URI: http://www.rubenbristian.com

-----------------------------------------------------------------------------------*/

class rb_twitter_widget extends WP_Widget {
	
	function rb_twitter_widget (){
		
		$widget_ops = array( 'classname' => 'twitter', 'description' => 'A widget that displays your latest tweets' );
		$control_ops = array( 'width' => 250, 'height' => 120, 'id_base' => 'twitter-widget' );
		$this->WP_Widget( 'twitter-widget', 'RB Twitter Widget', $widget_ops, $control_ops );
		
	}
		
	function widget($args, $instance){
			
		extract($args);
			
		$title = apply_filters('widget_title', $instance['title']);
		$username = $instance['username'];
		$intro = $instance['intro'];
			
		echo $before_widget;
			
		echo $before_title.$title.$after_title;

		echo '<p class="twitterIntro">', $intro, '</p>';
			
		echo '<p class="hidden twitterUser">'.$username.'</p>';

		echo '<p class="twitterList"></p>';

		echo $after_widget;
			
	}
			
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;
			
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['intro'] = strip_tags($new_instance['intro']);
			
		return $instance;
			
	}
		
	function form($instance){
		
		$defaults = array( 'title' => 'Twitter', 'username' => '', 'intro' => 'Latest tweet:' );
			
		$instance = wp_parse_args((array) $instance, $defaults);
			
		?>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'corvius'); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Username:', 'corvius'); ?></label>
				<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'intro' ); ?>"><?php _e('Label:', 'corvius'); ?></label>
				<input id="<?php echo $this->get_field_id( 'intro' ); ?>" name="<?php echo $this->get_field_name( 'intro' ); ?>" value="<?php echo $instance['intro']; ?>" style="width:100%;" />
			</p>
			
		<?php
			
	}
		
}

/*-----------------------------------------------------------------------------------

	Plugin Name: RB Phone Widget
	Plugin URI: http://www.rubenbristian.com
	Description: A widget that displays your phone number
	Version: 1.0
	Author: Ruben Bristian
	Author URI: http://www.rubenbristian.com

-----------------------------------------------------------------------------------*/

class rb_phone_widget extends WP_Widget {
	
	function rb_phone_widget (){
		
		$widget_ops = array( 'classname' => 'phone', 'description' => 'A widget that displays your phone number' );
		$control_ops = array( 'width' => 250, 'height' => 120, 'id_base' => 'phone-widget' );
		$this->WP_Widget( 'phone-widget', 'RB Phone Widget', $widget_ops, $control_ops );
		
	}
	
	function widget($args, $instance){
			
		extract($args);
			
		$title = apply_filters('widget_title', $instance['title']);
		$phone = $instance['number'];
		$text = $instance['text'];
			
		echo $before_widget;
			
		echo $before_title.$title.$after_title;

		echo '<p class="phoneNumber">' . $text . ' <strong>' . $phone . '</strong></p>';
			
		echo $after_widget;
			
	}
			
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;
			
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['number'] = strip_tags($new_instance['number']);
			
		return $instance;
			
	}
		
	function form($instance){
		
		$defaults = array( 'title' => 'Phone Number', 'text' => 'Call Us', 'number' => '' );
			
		$instance = wp_parse_args((array) $instance, $defaults);
			
		?>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e('Text:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo $instance['text']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Phone number:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
			</p>
			
		<?php
			
	}
		
}
		
/*-----------------------------------------------------------------------------------

	Plugin Name: RB Social Icons Widget
	Plugin URI: http://www.rubenbristian.com
	Description: A widget that displays your social links
	Version: 1.0
	Author: Ruben Bristian
	Author URI: http://www.rubenbristian.com

-----------------------------------------------------------------------------------*/

class rb_social_widget extends WP_Widget {
	
	function rb_social_widget (){
		
		$widget_ops = array( 'classname' => 'social', 'description' => 'A widget that displays your social links' );
		$control_ops = array( 'width' => 250, 'height' => 120, 'id_base' => 'social-widget' );
		$this->WP_Widget( 'social-widget', 'RB Social Widget', $widget_ops, $control_ops );
		
	}
	
	function widget($args, $instance){
			
		extract($args);
			
		$title = apply_filters('widget_title', $instance['title']);
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$google = $instance['google'];
		$flickr = $instance['flickr'];
		$linkedin = $instance['linkedin'];
		$skype = $instance['skype'];
			
		echo $before_widget;
			
		echo $before_title.$title.$after_title;
			
		echo '<ul class="socialList clearfix">';

		if($twitter)
			echo '<li><a target="_blank" class="twitter" href="' . $twitter . '">twitter icon</a></li>';
		if($facebook)
			echo '<li><a target="_blank" class="facebook" href="' . $facebook . '">facebook icon</a></li>';
		if($google)
			echo '<li><a target="_blank" class="google" href="' . $google . '">google icon</a></li>';
		if($linkedin)
			echo '<li><a target="_blank" class="linkedin" href="' . $linkedin . '">linkedin icon</a></li>';
		if($flickr)
			echo '<li><a target="_blank" class="flickr" href="' . $flickr . '">flickr icon</a></li>';
		if($skype)
			echo '<li><a target="_blank" class="skype" href="' . $skype . '">skype icon</a></li>';

		echo '</ul>';
			
		echo $after_widget;
			
	}
			
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;
			
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr'] = strip_tags($new_instance['flickr']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['google'] = strip_tags($new_instance['google']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['skype'] = strip_tags($new_instance['skype']);
			
		return $instance;
			
	}
		
	function form($instance){
		
		$defaults = array( 'title' => 'Social Links', 'flickr' => '', 'facebook' => '', 'google' => '', 'linkedin' => '', 'twitter' => '', 'skype' => '' );
			
		$instance = wp_parse_args((array) $instance, $defaults);
			
		?>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter link:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook link:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'google' ); ?>"><?php _e('Google link:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" value="<?php echo $instance['google']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('Linkedin link:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr link:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" style="width:100%;" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('Skype link:', 'wowway'); ?></label>
				<input id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" style="width:100%;" />
			</p>
			
		<?php
			
	}
		
}

/*-----------------------------------------------------------------------------------

	Plugin Name: RB Separator Widget
	Plugin URI: http://www.rubenbristian.com
	Description: A widget that simply adds a separator to the page(to be used in the sidebar)
	Version: 1.0
	Author: Ruben Bristian
	Author URI: http://www.rubenbristian.com

-----------------------------------------------------------------------------------*/

class rb_separator_widget extends WP_Widget {
	
	function rb_separator_widget (){
		
		$widget_ops = array( 'classname' => 'separator', 'description' => 'A widget that simply adds a separator to the sidebar' );
		$control_ops = array( 'width' => 250, 'height' => 120, 'id_base' => 'separator-widget' );
		$this->WP_Widget( 'separator-widget', 'RB Separator Widget', $widget_ops, $control_ops );
		
	}
		
	function widget($args, $instance){
			
		echo '<hr class="widget_separator" />';
		
	}
			
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;
			
		return $instance;
			
	}
		
	function form($instance){
			
	}
		
}

?>