<?php
/*---------------------------------
	Single Post Template
------------------------------------*/

get_header(); 


$slider_images = get_post_meta($post->ID, 'rb_post_sliderc2', true);

?>

<!--///////////////////////////////
	Single Project Page Template
////////////////////////////////////////-->

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<h1 id="title" class="hidden"><?php wp_title( '|', true, 'right' ); ?></h1>
	
		<article id="post-<?php echo the_ID(); ?>" <?php post_class('project clearfix'); ?>>

			<section class="galleryContent">

				<header class="clearfix">

					<h4><?php the_title(); ?></h4>
					<a class="actionButton close" href="#">Close</a>
					<a class="actionButton minimize" data-content=".galleryContent" data-speed="300" href="#">Minimize</a>

				</header>

				<div class="shortContent clearfix">

					<?php the_content(); ?>

					<span class="category">
						<?php $category = wp_get_object_terms($post->ID, 'gallery_category'); 
						echo $category[0]->name; ?>
					</span>

					<div id="shareLinks" class="shareLinks">
						<!-- links / scripts are in the footer -->
						<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
						<div class="fb-like" data-send="false" data-layout="button_count" data-width="110" data-show-faces="false"></div>
					</div>

				</div>

			</section>

			<section id="projectSlides" class="clearfix">

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
			
			<div id="nextProject" class="hidden"><?php echo next_post_link('%link', get_next_post()->post_name, false); ?></div>
			<div id="previousProject" class="hidden"><?php echo previous_post_link('%link', get_previous_post()->post_name, false); ?></div>
		
		</article>

	<?php endwhile; ?>

<?php get_footer(); ?>