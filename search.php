<?php
/*---------------------------------
	Search Page Template
------------------------------------*/

get_header(); 

?>

	<section id="page">

		<header id="pageHeader">
			<h1><?php get_option_tree('rb_search2_tagline', '', true); ?></h1>
			<a href="#" class="actionButton minimize" data-content="#page" data-speed="600">minimize</a>
		</header>

		<div class="contentHolder clearfix">

			<?php 

				$allsearch = &new WP_Query("s=$s&showposts=-1"); 
				$key = esc_html($s, 1); 
				$count = $allsearch->post_count;
				wp_reset_query(); 

			?>
		
			<?php if ( have_posts() ) : ?>

				<h4 class="searchResults">
					<?php echo __('Your search for ', 'wowway') . '<strong>'.get_search_query().'</strong>' . __(' returned ', 'wowway') . $count . __(' results', 'wowway'); ?>
				</h4>

				<?php get_template_part( 'loop', 'search' ); ?>
			
				<?php rb_pagination($allsearch->max_num_pages, 3) ?>

			<?php else : ?>

				<div class="full_width">
					<h4><?php _e( 'Nothing Found', 'wowway' ); ?></h4>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'wowway' ); ?></p>
			</div>

			<?php endif; ?>

		</div>

	</section>
	
<?php get_footer(); ?>