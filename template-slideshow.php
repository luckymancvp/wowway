<?php
/*---------------------------------
	Template Name: Fullscreen Slideshow
------------------------------------*/
 
	get_header(); 
	$slider_images = get_post_meta($post->ID, 'rb_post_sliderc2', true);
	
?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<section id="projectSlides" class="clearfix fullscreenGallery">

			<?php

				if($slider_images)
					foreach ($slider_images as $key => $value) {
						if(is_numeric($value))
			        		echo wp_get_attachment_image($value, 'large', 0);
			        	else 
			        		echo '<img src="' . $value . '" />';
			        }

			?>

			</section>

			<?php if($post->post_content != "") : ?>

			<section class="galleryContent">

				<header class="clearfix">

					<h4><?php the_title(); ?></h4>
					<a class="actionButton close" href="#">Close</a>
					<a class="actionButton minimize" data-content=".galleryContent" data-speed="300" href="#">Minimize</a>

				</header>

				<div class="shortContent clearfix">

					<?php the_content(); ?>

					<div id="shareLinks" class="shareLinks">
						<!-- links / scripts are in the footer -->
						<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
						<div class="fb-like" data-send="false" data-layout="button_count" data-width="110" data-show-faces="false"></div>
					</div>

				</div>

			</section>

			<?php endif; ?>

			<ul id="slideList">
				<li id="playPause">
					<a href="#" class="hoverBack">Play/Pause</a>
					<div id="progressBar"></div>
				</li>
			</ul>

		<?php endwhile; ?>
	
	<?php get_footer(); ?>