<?php
/*---------------------------------
	Template Name: Blog
------------------------------------*/
	
	get_header(); 
	$k = 0;
	
?>
	
	<section id="page">

		<header id="pageHeader">
			<h1><?php the_title(); ?></h1>
			<a href="#" class="actionButton minimize" data-content="#page" data-speed="600">minimize</a>
		</header>

		<div class="contentHolder clearfix">

			<?php while (have_posts()) : the_post(); ?>
	
			<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$args = array('offset'=> 0, 'paged'=>$paged);
				$all_posts = new WP_Query($args);
				while($all_posts->have_posts()) : $all_posts->the_post();
			?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class('one_half clearfix'); ?>>

					<?php if(get_option_tree('rb_blog_layout') == 'Full') {
						echo '<a href="' . get_permalink() . '">';
						the_post_thumbnail('full');
						echo '</a>';
					} ?>

					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<ul class="postLinks">
						<li class="category"><strong><?php the_category(','); ?></strong></li>
						<li class="date"><?php the_time('M j, Y'); ?></li>
						<li class="comments"><?php comments_number('0 Comments'); ?></li>
					</ul>

					<p>
						<?php if(get_option_tree('rb_blog_layout') == 'Default') the_post_thumbnail(); ?>
						<?php rb_excerpt('rb_excerptlength_post', 'rb_excerptmore'); ?>
					</p>

					<a class="read" href="<?php the_permalink(); ?>"><strong><?php _e('Keep Reading <span>&rarr;</span>', 'wowway'); ?></strong></a>

				</article>

				<?php
					if(++$k%2==0) 
						echo '<div class="clearfix xtram"></div>';
					?>
				
			<?php endwhile; ?>
			<?php endwhile; ?>

			<?php rb_pagination($all_posts->max_num_pages, 3) ?>


		</div>

	</section>
	
	<?php get_footer(); ?>