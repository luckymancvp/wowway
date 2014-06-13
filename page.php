<?php
/*---------------------------------
	Single Page Templte
------------------------------------*/

$slider_images = get_post_meta($post->ID, 'rb_post_sliderc2', true);

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<section id="page">

			<header id="pageHeader">
				<h1><?php the_title(); ?></h1>
				<a href="#" class="actionButton minimize" data-content="#page" data-speed="600">minimize</a>
			</header>

			<article id="page-<?php the_ID(); ?>" class="contentHolder clearfix">

				<?php 
					if($slider_images) {
					echo '<div id="postSlider"><div class="slides_container">';
					foreach ($slider_images as $key => $value) 
						if (strpos($value, '.jpg') > 0 || strpos($value, '.jpeg') > 0 || strpos($value, '.JPG') > 0 || strpos($value, '.JPEG') > 0 || strpos($value, '.png') > 0 || strpos($value, '.PNG') > 0 || is_numeric($value)) {
								if(is_numeric($value))
			        				echo '<div>' . wp_get_attachment_image($value, 'large', 0) . '</div>';
			        			else
			        				echo '<div><img src="' . $value . '" /></div>';
			        	} else {
				        	echo '<div>' . $value . '</div>';

						} 
					echo '</div>';
					if(sizeof($slider_images) > 1) {
						echo '<div class="sliderControls">
							<a href="#" class="sliderBtnPrev">Previous</a>
							<a href="#" class="sliderBtnNext">Next</a>
							<span class="sliderPagination">1 of 3</span>
						</div>';
					}
					echo '</div>';
				}
				?>

				<?php the_content(); ?>
				<?php /* comments_template( '', true ); */ ?>

			</article>

		</section>
		
	<?php endwhile; ?>

<?php get_footer(); ?>