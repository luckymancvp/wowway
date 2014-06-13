<?php

/*---------------------------------
	Custom meta boxes setup
------------------------------------*/

//Define sidebars array
$backgrounds_array = array('None');
$backgrounds = get_option_tree( 'rb_backgrounds', '', false, true);
if(isset($backgrounds))
	foreach($backgrounds as $background) {
		array_push($backgrounds_array, $background['title']);
	}
	
		
//Define default meta boxes array
$meta_boxes = array(
	array(
		'id' => 'rb_post_meta',
		'title' => __('Post Options', 'wowway'),
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => '',
		'exclude' => array(),
		'fields' => array(
			array(
				'name' => __('1. Choose a thumbnail', 'wowway'),
				'desc' => __('Don\' forget to set a featured image for this post, if you want to enhance your blog. You can do this from the right side panel.', 'wowway'),
				'id' => 'rb_post_featured',
				'type' => 'none'
			),
			array(
				'name' => __('2. Choose a background', 'wowway'),
				'desc' => __('If you want a special background for this post, just select one from the list below. If you have a default background set for all posts, just leave this at none and that background will be used.', 'wowway'),
				'id' => 'rb_post_backgrounda',
				'type' => 'select',
				'options' => $backgrounds_array
			),
			array(
				'name' => __('3. Set up a slider', 'wowway'),
				'desc' => __('If you want a slider or a single image/video to display in this post, you can add it through here. Both videos and images should have a maximum width of 650px and the same height.', 'wowway'),
				'id' => 'rb_post_sliderc2',
				'type' => 'slider'
			)
		)
	),
	array(
		'id' => 'rb_page_meta',
		'title' => __('Page Options', 'wowway'),
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => '',
		'exclude' => array('template-blog.php', 'template-contact.php', 'template-portfolio.php', 'template-gallery.php', 'template-slideshow.php', 'template-video.php'),
		'fields' => array(
			array(
				'name' => __('1. Choose a background', 'wowway'),
				'desc' => __('If you want a special background for this page, just select one from the list below. If you have a default background set for all pages, just leave this at none and that background will be used.', 'wowway'),
				'id' => 'rb_post_backgrounda',
				'type' => 'select',
				'options' => $backgrounds_array
			),
			array(
				'name' => __('2. Set up a slider', 'wowway'),
				'desc' => __('If you want a slider or a single image/video to display in this page, you can add it through here. Both videos and images should have a maximum width of 650px and the same height.', 'wowway'),
				'id' => 'rb_post_sliderc2',
				'type' => 'slider'
			)
		)
	),
	array(
		'id' => 'rb_contact_meta',
		'title' => __('Page Options', 'wowway'),
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => 'template-contact.php',
		'exclude' => array('template-blog.php'),
		'fields' => array(
			array(
				'name' => __('1. Choose a background', 'wowway'),
				'desc' => __('If you want a special background for this page, just select one from the list below. If you have a default background set for all pages or if you want to display the map instead of a background, just leave this at none and that background will be used.', 'wowway'),
				'id' => 'rb_post_backgrounda',
				'type' => 'select',
				'options' => $backgrounds_array
			)
		)
	),
	array(
		'id' => 'rb_blog_meta',
		'title' => __('Blog Options', 'wowway'),
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => 'template-blog.php',
		'exclude' => array(),
		'fields' => array(
			array(
				'name' => __('1. Choose a background', 'wowway'),
				'desc' => __('If you want a special background for this page, just select one from the list below. If you have a default background set for all posts, just leave this at none and that background will be used.', 'wowway'),
				'id' => 'rb_post_backgrounda',
				'type' => 'select',
				'options' => $backgrounds_array
			)
		)
	),
	array(
		'id' => 'rb_folio_meta',
		'title' => __('Project Options', 'wowway'),
		'pages' => array('portfolio'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => '',
		'exclude' => array(),
		'fields' => array(
			array(
				'name' => __('1. Choose a thumbnail', 'wowway'),
				'desc' => __('Don\' forget to set a featured image for this project. It will show in the portfolio grid. The image should have a 4:3 aspect ratio(best size is 360x270).', 'wowway'),
				'id' => 'rb_post_featured',
				'type' => 'none'
			),
			array(
				'name' => __('2. Set up a slider', 'wowway'),
				'desc' => __('If you want a slider or a single image/video to display in this project, you can add it through here.', 'wowway'),
				'id' => 'rb_post_sliderc2',
				'type' => 'slider'
			)
		)
	),
	array(
		'id' => 'rb_folio_meta',
		'title' => __('Gallery Options', 'wowway'),
		'pages' => array('gallery'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => '',
		'exclude' => array(),
		'fields' => array(
			array(
				'name' => __('1. Choose a thumbnail', 'wowway'),
				'desc' => __('Don\' forget to set a featured image for this project. It will show in the gallery grid. The image should have a 4:3 aspect ratio(best size is 240x180).', 'wowway'),
				'id' => 'rb_post_featured',
				'type' => 'none'
			),
			array(
				'name' => __('2. Set up a slider', 'wowway'),
				'desc' => __('Add images to this project. Your images should be at least 1200 x 800 and have a good quality.', 'wowway'),
				'id' => 'rb_post_sliderc2',
				'type' => 'sliderbasic'
			)
		)
	),
	array(
		'id' => 'rb_folio_meta',
		'title' => __('Slideshow Options', 'wowway'),
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => 'template-slideshow.php',
		'exclude' => array(),
		'fields' => array(
			array(
				'name' => __('1. Set up a slider', 'wowway'),
				'desc' => __('Add images to this project. Your images should be at least 1200 x 800 and have a good quality.', 'wowway'),
				'id' => 'rb_post_sliderc2',
				'type' => 'sliderbasic'
			)
		)
	),
	array(
		'id' => 'rb_folio_meta',
		'title' => __('Video Options', 'wowway'),
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'template' => 'template-video.php',
		'exclude' => array(),
		'fields' => array(
			array(
				'name' => __('1. Choose a background', 'wowway'),
				'desc' => __('You need to do this because this is what users will see before and after the video loads.', 'wowway'),
				'id' => 'rb_post_backgrounda',
				'type' => 'select',
				'options' => $backgrounds_array
			),
			array(
				'name' => __('2. MP4 Path', 'wowway'),
				'desc' => __('The path to the mp4 video file.', 'wowway'),
				'id' => 'rb_video_1',
				'type' => 'text'
			),
			array(
				'name' => __('3. OGV Path', 'wowway'),
				'desc' => __('The path to the ogv video file.', 'wowway'),
				'id' => 'rb_video_2',
				'type' => 'text'
			),
			array(
				'name' => __('4. WEBM Path', 'wowway'),
				'desc' => __('The path to the webm video file.', 'wowway'),
				'id' => 'rb_video_3',
				'type' => 'text'
			)
		)
	)
);

foreach ($meta_boxes as $meta_box) {
    $rb_meta_box = new rb_meta_box($meta_box);
}
	
class rb_meta_box {

    protected $_meta_box;

    //Create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));
        add_action('save_post', array(&$this, 'save'));
    }

    //Add meta box for multiple post types & page templates
    function add() {
		
		$post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : 'no');
		$template_file = $post_id != 'no' ? get_post_meta($post_id,'_wp_page_template',TRUE) : 'no';
	
        foreach ($this->_meta_box['pages'] as $page) {
		
			if(!$this->_meta_box['template'] && !in_array($template_file, $this->_meta_box['exclude']) && $this->_meta_box['template'] != 'no')
		
				add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
				
			else if($this->_meta_box['template'] == $template_file)
				
				add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
			
        }
    }

    //Callback function to show fields in meta box
    function show() {
        global $post;

        //Use nonce for verification
        echo '<input type="hidden" name="rb_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo (isset($this->_meta_box['desc']) ? '<p class="metaDescription">'.$this->_meta_box['desc'].'</p>' : '');
		
        echo '<div class="metaTable">';

        foreach ($this->_meta_box['fields'] as $field) {
            //Get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);
			
			check_isset($field['name']);
			check_isset($field['desc']);
			check_isset($field['options']);
			check_isset($field['std']);

            echo '<div class="clearfix"><div class="leftSide labelField">',
                    '<h4 class="customTitle"><label for="', $field['id'], '">', $field['name'], '</label></h4><span class="customDesc">', $field['desc'], '</span></div>',
                    '<div class="rightSide ' . $field['type'] . '">';
            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />';
                    break;
                case 'textarea':
                    echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:100%">', $meta ? $meta : $field['std'], '</textarea>';
                    break;
                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                    echo '</select>';
                    break;
                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    break;
				case 'image':  
					$image = get_template_directory_uri().'/images/image.png';  
					echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';  
					if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }  
					echo    '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image hidden" value="'.$meta.'" /> 
								<img src="'.$image.'" class="custom_preview_image" alt="" />
									<div><input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
									<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small></div>
									';  
					break;  
				case 'slider': 
				    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable clearfix">';  
				     $i = 0;  
				    if ($meta) {  
				        foreach($meta as $row) { 
				        	if (strpos($row, '.jpg') > 0 || strpos($row, '.jpeg') > 0 || strpos($row, '.JPG') > 0 || strpos($row, '.JPEG') > 0 || strpos($row, '.png') > 0 || strpos($row, '.PNG') > 0 || is_numeric($row)) {

				        		$image = $row;

				        		if(is_numeric($row)) {
				        			$image = wp_get_attachment_image_src($row, 'portfolio-thumb');
				        			$image = $image[0];
				        		}

				      			echo '<li><input name="'.$field['id'].'['.$i.']" type="hidden" class="custom_upload_image" value="'.$row.'" /> 
									<img src="'.$image.'" class="custom_preview_image" alt="" />
									<div><input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
									<small> <a href="#" class="repeatable-remove">Remove Slide</a></small></div></li>';   

				            	$i++;  

				        	} else {

				        		echo '<li><textarea name="'.$field['id'].'['.$i.']">'.$row.'</textarea><div><small><a href="#" class="repeatable-remove">Remove Slide</a></small><img src="../wp-content/themes/wowway/images/defMove.png" class="moveimg" /></div></li>';

				        		$i++;

					 	   	}

				 	   	}
				    } 

				    echo '</ul>';
				    echo '<p class="slider-index hidden">' . $i . '</p>';
				    echo '<p class="slider-id hidden">' . $field['id'] . '</p>';
				    echo '<a class="repeatable-add button button-primary add-image" href="#">Add image</a>';
				    echo '&nbsp;';
				    echo '<a class="repeatable-add button button-primary add-video" href="#">Add video</a>';
					break;  

				case 'sliderbasic':
				    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable clearfix">';  
				     $i = 0;  
				    if ($meta) {  
				        foreach($meta as $row) { 

				        	if (strpos($row, '.jpg') > 0 || strpos($row, '.jpeg') > 0 || strpos($row, '.JPG') > 0 || strpos($row, '.JPEG') > 0 || strpos($row, '.png') > 0 || strpos($row, '.PNG') > 0 || is_numeric($row)) {

				        		$image = $row;

				        		if(is_numeric($row)) {
				        			$image = wp_get_attachment_image_src($row, 'portfolio-thumb');
				        			$image = $image[0];
				        		}

				      			  echo '<li><input name="'.$field['id'].'['.$i.']" type="hidden" class="custom_upload_image" value="'.$row.'" /> 
									<img src="'.$image.'" class="custom_preview_image" alt="" />
									<div><input class="custom_upload_image_button button" type="button" value="Choose Image" /> 
									<small> <a href="#" class="repeatable-remove">Remove Slide</a></small></div></li>';   

				            	$i++;  

				        	} else {

				        		echo '<li><textarea name="'.$field['id'].'['.$i.']">'.$row.'</textarea><div><small><a href="#" class="repeatable-remove">Remove Slide</a></small><img src="../wp-content/themes/wowway/images/defMove.png" class="moveimg" /></div></li>';

				        		$i++;

					 	   	}

				 	   	}
				    } 

				    echo '</ul>';
				    echo '<p class="slider-index hidden">' . $i . '</p>';
				    echo '<p class="slider-id hidden">' . $field['id'] . '</p>';
				    echo '<a class="repeatable-add button button-primary add-image" href="#">Add image</a>';
					break;  
					
            }
            echo     '</div>',
                '</div>';
        }

        echo '</div>';
    }

    //Save data from meta box
    function save($post_id) {
	
		if(isset($_POST['rb_meta_box_nonce'])){
			if (!wp_verify_nonce($_POST['rb_meta_box_nonce'], basename(__FILE__))) {
				return $post_id;
			}
		}else {
			return $post_id;
		}
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        foreach ($this->_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : '';

            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
}

function check_isset(&$item){
	$return;
	isset($item) ? $return = $item : $return = '';
	return $return;
}

?>