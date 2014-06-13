<?php
/*---------------------------------
	Author Page Template
----------------------------------*/

get_header(); 

?>

	<section id="page">
		
		<header id="pageHeader">
			<h1><?php _e('Author Archives', 'wowway'); ?></h1>
			<a href="#" class="actionButton minimize" data-content="#page" data-speed="600">minimize</a>
		</header>

		<div class="contentHolder clearfix">

			<?php if (have_posts()) the_post(); ?>

				<h4 class="searchResults"><?php _e('Posts by:', 'wowway'); ?> <strong><?php echo get_the_author(); ?></strong></h4>

				<?php get_template_part('loop', 'author'); ?>
				
				<?php rb_pagination('', 3) ?>

		</div>

	</section>
	
<?php get_footer(); ?>