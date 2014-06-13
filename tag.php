<?php
/*---------------------------------
	Tags Page Template
------------------------------------*/

get_header(); 

?>

	<section id="page">
		
		<header id="pageHeader">
			<h1><?php _e('Tags Archives', 'wowway'); ?></h1>
			<a href="#" class="actionButton minimize" data-content="#page" data-speed="600">minimize</a>
		</header>

		<div class="contentHolder clearfix">

			<h4 class="searchResults"><?php _e('Posts in:', 'wowway'); ?> <strong><?php echo single_tag_title('', false); ?></strong></h4>

			<?php get_template_part( 'loop', 'tag' ); ?>
				
			<?php rb_pagination('', 3) ?>

		</div>

	</section>
	
<?php get_footer(); ?>