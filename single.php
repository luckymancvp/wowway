<?php
/*---------------------------------
	Single Post Template
------------------------------------*/

get_header(); 


$slider_images = get_post_meta($post->ID, 'rb_post_sliderc2', true);

?>

<?php if (get_post_type() != 'portfolio' && get_post_type() != 'gallery'){ ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<section id="page" class="fullPost">

			<header id="pageHeader">
				<h1><?php get_option_tree('rb_search_tagline', '', true); ?></h1>
				<a href="#" class="actionButton minimize" data-content="#page" data-speed="600">minimize</a>
			</header>

			<article id="post-<?php the_ID(); ?>" <?php post_class('contentHolder clearfix'); ?>>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<ul class="postLinks">
					<li class="category"><strong><?php the_category(','); ?></strong></li>
					<li class="date"><?php the_time('M j, Y'); ?></li>
					<li class="comments"><?php comments_number('0 Comments'); ?></li>
				</ul>

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

			<div class="shareLinks">
				<!-- links / scripts are in the footer -->
				<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
				<div class="g-plusone" data-size="medium"></div>
				<div class="fb-like" data-send="false" data-layout="button_count" data-width="110" data-show-faces="false"></div>
			</div>
			
			<?php comments_template( '', true ); ?>

			</article>

			<div class="hasButtonsPost">
				<div class="btnNext2 hoverBack"><?php echo previous_post_link('%link'); ?></div>
				<div class="btnClose2 hoverBack"><a href="<?php echo get_page_link(get_option_tree( 'rb_blog_link', '', false)); ?>">Close</a></div>
				<div href="#" class="btnPrev2 hoverBack"><?php echo next_post_link('%link'); ?></div>
			</div>

		</section>

	<?php endwhile; // end of the loop. ?>

<?php } else if(get_post_type() == 'portfolio') { 
		include('single-project.php');
	} 
	
?>

<?php get_footer(); ?>