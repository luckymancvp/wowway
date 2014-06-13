<?php
/*---------------------------------
	VIDEO TEMPLATE - UNDER CONSTRUCTION
------------------------------------*/
 
	get_header(); 
	
?>

	<div id="fullScreenVideoMeta" class="hidden">
		<p id="mp4"><?php echo get_post_meta($post->ID, 'rb_video_1', true); ?></p>
		<p id="ogv"><?php echo get_post_meta($post->ID, 'rb_video_2', true); ?></p>
		<p id="webm"><?php echo get_post_meta($post->ID, 'rb_video_3', true); ?></p>
		<p id="poster"><?php echo TEMPLATEPATH . 'images/blank.png' ; ?></p>
	</div>

	<?php get_footer(); ?>