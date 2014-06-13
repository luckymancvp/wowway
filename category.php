<?php
/*---------------------------------
	Category Page Template
------------------------------------*/

get_header(); 
$theme_options = get_option('option_tree');
?>

	<section id="page">

		<header id="pageHeader">
			<h1><?php get_option_tree('rb_search_tagline', '', true); ?></h1>
			<a href="#" class="actionButton minimize" data-content="#page" data-speed="600">minimize</a>
		</header>

		<div class="contentHolder clearfix">

			<?php get_template_part( 'loop', 'category' ); ?>
				
			<?php rb_pagination('', 3) ?>

		</div>

	</section>
	
<?php get_footer(); ?>