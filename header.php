<?php

$theme_options = get_option('option_tree');

$sidebar_cookie_2_css = '';
if(isset($_COOKIE['sidebar_cookie_2']) && $_COOKIE['sidebar_cookie_2']!='' && get_option_tree('rb_sidebar_autoclose2', $theme_options) != 'Stick')
	$sidebar_cookie_2_css = $_COOKIE['sidebar_cookie_2'] . 'Skie';

/*---------------------------------
	The header of the theme
------------------------------------*/
?><!DOCTYPE html>
<!--[if lt IE 8]>    <html <?php language_attributes(); ?> class="ie7" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="ie8" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 9]>    <html <?php language_attributes(); ?> class="ie9" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="author" content="rubenbristian.com" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

    <meta name="format-detection" content="telephone=no">
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="description" content="<?php rb_excerpt('rb_excerptlength_widget', 'rb_excerptmore'); ?>">

	<!-- portfolio & gallery redirect script, before anything else -->
	<?php if(!is_search()) : ?>

	<script><?php
	
	echo 'if("'. get_post_type() . '"=="portfolio")
		document.location.href = "' . get_page_link(get_option_tree( 'rb_portfolio_page', '', false)) . '#/' . $post->post_name . '";';
	
	echo 'if("'. get_post_type() . '"=="gallery")
		document.location.href = "' . get_page_link(get_option_tree( 'rb_gallery_page', '', false)) . '#/' . $post->post_name . '";';

	?></script>

	<?php endif; ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php 
		if(get_option_tree('rb_favicon', $theme_options) != '') {
			get_option_tree('rb_favicon', $theme_options, true);
		} else {
			get_template_directory_uri();
			echo '/favicon.ico';
		}	?>" />


     <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	
	<?php

	//Add comments script
	if(is_page() || is_home() || get_post_type() == 'portfolio' || get_post_type() == 'gallery'){
		wp_deregister_script('comment-reply');
	}

	wp_head();
	
    if ( is_user_logged_in() ) : ?>
        <style type="text/css">
        	html {
        		margin:0 !important;
        	}
        </style>
    <?php endif; ?>
		
</head>

<?php

	global $responsive;

	//Backgrounds check
	$values = get_post_custom( $post->ID ); 
	$meta_back = isset($values['rb_post_backgrounda']) ? esc_attr($values['rb_post_backgrounda'][0]) : 'None';

	$def_post = '';
	$def_page = '';
	$background_style = '';

	$backgrounds = get_option_tree( 'rb_backgrounds', $theme_options, false, true);
	if(isset($backgrounds)) {
		foreach($backgrounds as $background) {
			if(isset($background['default_posts'])){
				$def_post = $background['image'];
			} else if(isset($background['default_pages'])){
				$def_page = $background['image'];
			}
			if($meta_back == $background['title'] && $background['title'] != 'None')
				$meta_back = $background['image'];
		}
	}

	if($meta_back != 'None')
		$background_style = ' style="background-image:url(' . $meta_back . ')"';

	if($meta_back == 'None' && (is_single() || is_search() || is_archive() || is_page_template('template-blog.php')) && $def_post != '')
		$background_style = ' style="background-image:url(' . $def_post . ')"';
	if($meta_back == 'None' && $def_page != '') 
		$background_style = ' style="background-image:url(' . $def_page . ')"';

?>

<body id="body" <?php body_class(array('closedSidebars', $sidebar_cookie_2_css, get_option_tree('rb_site_style', $theme_options), get_option_tree('rb_sidebar_autoclose2', $theme_options), get_option_tree('rb_layout_center', $theme_options), get_option_tree('rb_images_fit', $theme_options), get_option_tree('rb_blog_layout', $theme_options))); ?><?php echo $background_style; ?>>
	
	<div id="sidebar">
	
		<header id="header">
			<div id="logo">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php get_option_tree('rb_logo_path', $theme_options, true); ?>" alt="<?php bloginfo('name'); ?>" />
				</a>
			</div>
			<p id="tagline"><?php bloginfo('description'); ?></p>
		</header>

		<nav id="menu">
			<?php wp_nav_menu( array(
				 'container' =>false,
				 'menu_class' => 'main-menu',
				 'echo' => true,
				 'before' => '',
				 'after' => '',
				 'link_before' => '',
				 'link_after' => '',
				 'depth' => 2,
				 'walker' => new menu_default_walker())
			 );
			?>
		</nav>

		<?php $responsive = 'global true'; ?>
		<form id="responsiveMenu">
			<select>
				<option selected data-href="#">Site Navigation</option>
				<?php wp_nav_menu( array(
					 'container' =>false,
					 'menu_class' => 'responsive-menu',
					 'echo' => true,
					 'before' => '',
					 'after' => '',
					 'link_before' => '',
					 'link_after' => '',
					 'depth' => 1,
					 'walker' => new menu_responsive_walker())
				 );
				?>
			</select>
		</form>
		<?php $responsive = 'global false'; ?>

		<footer id="copy">
			<p><?php get_option_tree('rb_footer_text', $theme_options, true); ?></p>
		</footer>

		<a href="#" id="close">close sidebar</a>

	</div>
		
	<div id="content" class="clearfix">

		<div>