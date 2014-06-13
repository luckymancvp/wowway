<?php

require TEMPLATEPATH . '/option-tree/index.php';
//require TEMPLATEPATH . '/includes/update-notifier.php';
load_theme_textdomain( 'wowway', TEMPLATEPATH.'/lang' );


/*********************************************************************

	This file contains the most important functions of the theme. Edit carefully! :)

*********************************************************************/

/*---------------------------------
	Make some adjustments on theme setup
------------------------------------*/

if ( ! function_exists( 'wowway_setup' ) ):
	function wowway_setup() {
	
		//Define content width
		if(!isset($content_width)) $content_width = 940;

		//This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		
		//This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		
		//Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		//Make theme available for translation
		load_theme_textdomain( 'wowway', TEMPLATEPATH . '/languages' );
		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
			
		//This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'wowway' ),
		) );

		//Define custom thumbnails
		set_post_thumbnail_size( 120, 88, true );
		add_image_size( 'portfolio-thumb',  360, 270, true );
		
	}
endif;
add_action( 'after_setup_theme', 'wowway_setup' );
include'includes/rb_columns/rb_columns_post.php';
/*---------------------------------
	Make some changes to the wp_title() function
------------------------------------*/

function wowway_filter_wp_title( $title, $separator ) {

	if ( is_feed() ) return $title;
		
	global $paged, $page;

	if ( is_search() ) {
	
		//If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'wowway' ), '"' . get_search_query() . '"' );
		//Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'wowway' ), $paged );
		//Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		//We're done. Let's send the new title back to wp_title():
		return $title;
	}

	//Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	//If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	//Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'wowway' ), max( $paged, $page ) );

	//Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'wowway_filter_wp_title', 10, 2 );

/*---------------------------------
	Create a wp_nav_menu() fallback, to show a home link
------------------------------------*/

function wowway_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wowway_page_menu_args' );

/*---------------------------------
	Comments template
------------------------------------*/

if ( ! function_exists( 'wowway_comment' ) ) :
	function wowway_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li id="li-comment-<?php comment_ID(); ?>" class="comment clearfix">
			
			<?php echo get_avatar( $comment, 50 ); ?>

			<div>

				<p class="commentAuthor">
					<?php 
						if(get_comment_author_url() != 'http://Yourwebsite...')
							echo comment_author_link();
						else
							comment_author();
					?>
				</p>

				<p class="commentTime"><?php echo comment_date('F j, Y'); ?></p>

				<?php comment_text(); ?>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="await"><?php _e( 'Your comment is awaiting moderation.', 'wowway' ); ?></em>
				<?php endif; ?>

			</div>

		</li>

		<?php
			break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'wowway' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'wowway'), ' ' ); ?></p></li>
		<?php
				break;
		endswitch;
	}
endif;

/*---------------------------------
	Register widget areas
------------------------------------*/

function rb_widgets_init() {

	register_sidebar( array(
		'name' => __('Top footer left side', 'wowway'),
		'id' => 'rb_top_footer_widget_left',
		'description' => __('The top footer\'s left side widget area', 'wowway'),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
	) );

	register_sidebar( array(
		'name' => __('Top footer right side', 'wowway'),
		'id' => 'rb_top_footer_widget_right',
		'description' => __('The top footer\'s right side widget area', 'wowway'),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
	) );

	register_sidebar( array(
		'name' => __('Bottom footer left side', 'wowway'),
		'id' => 'rb_bottom_footer_widget_left',
		'description' => __('The bottom footer\'s left side widget area', 'wowway'),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
	) );
	
}  
add_action( 'widgets_init', 'rb_widgets_init' );

/*---------------------------------
	Remove "Recent Comments Widget" Styling
------------------------------------*/

function wowway_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'wowway_remove_recent_comments_style' );


/*---------------------------------
	Function that replaces the default the_excerpt() function
------------------------------------*/
 
function rb_excerptlength_folio($length) {
    return 20;
}
function rb_excerptlength_widget($length) {
    return 18;
}
function rb_excerptlength_post($length) {
    return 35;
}
function rb_excerptmore($more) {
    return ' ...';
}
	
function rb_excerpt($length_callback='', $more_callback='') {

    global $post;
	
    if(function_exists($length_callback)){
		add_filter('excerpt_length', $length_callback);
    }
	
    if(function_exists($more_callback)){
		add_filter('excerpt_more', $more_callback);
    }
	
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = $output;
	
    echo $output;
	
}   

/*---------------------------------
	Function that replaces the default get_the_excerpt() function(only for shortcodes)
------------------------------------*/

function rb_get_excerpt($excerpt, $charlength) {

	$charlength++;
	$content = '';

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$content .= mb_substr( $subex, 0, $excut );
		} else {
			$content .= $subex;
		}
		$content .= ' ...';
	} else {
		$content .= $excerpt;
	}

	return $content;
	
}

/*---------------------------------
	Function that refilters the get_the_excerpt() function
------------------------------------*/

function rb_refilter_excerpt( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output = preg_replace('/<a[^>]+>Continue reading.*?<\/a>/i','',$output);
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'rb_refilter_excerpt' );

/*---------------------------------
	Enable excerpts for pages
------------------------------------*/

add_post_type_support( 'page', 'excerpt' );

/*---------------------------------
	Add a custom class to the user's gravatar
------------------------------------*/

function change_avatar_css($class) {
	$class = str_replace("class='avatar", "class='commentAvatar", $class) ;
	return $class;
}
add_filter('get_avatar','change_avatar_css');

/*---------------------------------
	Redefine the search form structure
------------------------------------*/

function rb_search_form( $form ) {

    $form = '
	<form role="search" method="get" id="searchform" class="searchBox" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text hidden" for="s">' . __('Search for:', 'wowway') . '</label>
		<input type="text" data-value="Type and hit Enter" value="Type and hit Enter" name="s" id="s" />
		<!--<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />-->
    </form>';
    return $form;
	
}
add_filter( 'get_search_form', 'rb_search_form' );

/*---------------------------------
	A custom pagination function
------------------------------------*/

function rb_pagination($pages = '', $range = 2) {  

     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) {
             $pages = 1;
         }
     }   

     if(1 != $pages) {
         echo "<div class='pagination'><div class='hr clearfix'><hr /></div><ul class='clearfix'>";

		echo "<li><a class='" . (($paged > 1) ? "btnPrev'" : "btnPrev inactive'") . " href='".get_pagenum_link($paged - 1)."'>Previous</a></li>";

         for ($i=1; $i <= $pages; $i++) {
		 
			if($i==1 || $i==$pages || $i==$paged || ($i>=$paged-$range && $i<=$paged+$range)){
				echo ($paged == $i)? "<li><a class='active'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
			} else if(($i!=1 && $i==$paged-$range-1) || ($i!=$paged && $i==$paged+$range+1)) {
				echo '<li>...</li>';
			}
			
         }

		echo "<li><a class='" . (($paged < $pages) ? "btnNext'" : "btnNext inactive'") . " href='".get_pagenum_link($paged + 1)."'>Next</a></li>"; 
			
         echo "</ul></div>";
     }
	 
}

/*---------------------------------
	Deal with WP empty paragraphcs
------------------------------------*/

function rb_formatter($content) {
	
	$bad_content = array('<p></div></p>', '<p><div class="full', '_width"></p>', '</div></p>', '<p><ul', '</ul></p>', '<p><div', '<p><block', 'quote></p>', '<p><hr /></p>', '<p><table>', '<td></p>', '<p></td>', '</table></p>', '<p></div>', 'nosidebar"></p>', '<p><p>', '<p><a', '</a></p>', '_half"></p>', '_third"></p>', '_fourth"></p>', '<p><p', '</p></p>', 'child"></p>', '<p></p>');
	$good_content = array('</div>', '<div class="full', '_width">', '</div>', '<ul', '</ul>', '<div', '<block', 'quote>', '<hr />', '<table>', '<td>', '</td>', '</table>', '</div>', 'nosidebar">', '<p>', '<a', '</a>', '_half">', '_third">', '_fourth">', '<p', '</p>', 'child">', '');
	
	$new_content = str_replace($bad_content, $good_content, $content);
	return $new_content;
	
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 10);
add_filter('the_content', 'rb_formatter', 11);

/*---------------------------------
	Save css code(mainly colors)
------------------------------------*/
  
function rb_save_ot(){
	
	//open and read contact-form file
	$contactform_path = '../wp-content/themes/wowway/contact-form.php';
	$contactform = fopen($contactform_path, 'r');
	$data = fread($contactform, filesize($contactform_path));
	fclose($contactform);
	
	//make changes inside the contact-form file
	$data = replace_mark('/*rb_form_your_email*/', $data, '"' . get_option_tree( 'rb_form_your_email', '', false) . '"');
	
	//save and close contact-form file
	$contactform = fopen($contactform_path, 'w');
	fwrite($contactform, $data);
	fclose($contactform);
		
}

function replace_mark($mark, $text, $replacement){
	$position = strpos($text, $mark);
	return str_replace(substr($text, $position, strpos($text, '/*e', $position)-$position), $mark.$replacement, $text);
}

/*---------------------------------
	Redefine menu structure with a walker class
------------------------------------*/

class menu_default_walker extends Walker_Nav_Menu
{

	function start_lvl(&$output, $depth){
		$output .= '<div><ul class="sub-menu">';
	}

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }


    function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		global $rb_submenus;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$new_output = '';
		$open_class = '';
		$depth_class = ($args->has_children ? 'parent ' : '');

		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;

		$current_indicators = array('current-menu-item','current-menu-parent','current_page_item','current_page_parent');

		$newClasses = array();
		foreach($classes as $el)
			if(in_array($el,$current_indicators))
				array_push($newClasses,$el);

		$class_names = join(' ',apply_filters('nav_menu_css_class',array_filter($newClasses),$item));

		if(strpos($class_names, 'current-menu-parent') > 0 || strpos($class_names, 'current_page_parent') > 0) {
			$class_names = ' class="' . $depth_class . $open_class . 'opened"';
		} else if($class_names != '') { 
			$class_names = ' class="' . $depth_class . $open_class . 'selected"';
		} else if($class_names == '') {
			$class_names = ' class="' . $depth_class . $open_class . 'menu-item"';
		}

		if ( !get_post_meta( $item->object_id , '_members_only' , true ) || is_user_logged_in() ) {
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $class_names . '>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		if($item->object != 'portfolio_category' && $item->object != 'gallery_category')
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		else
			$attributes .= ' href="#"';

		$portfolio_count;
		$gallery_count;

		if($item->object == 'portfolio_category'){
			$terms = get_terms('portfolio_category', array('include' => $item->object_id));
			$portfolio_count = $terms[0]->count;
			$attributes .= ' data-filter="' . $terms[0]->slug .'"';
		}

		if($item->object == 'gallery_category'){
			$terms = get_terms('gallery_category', array('include' => $item->object_id));
			$gallery_count = $terms[0]->count;
			$attributes .= ' data-filter="' . $terms[0]->slug .'"';
		}

		if($item->attr_title == 'allportfolio' || $item->attr_title == 'allgallery'){
			$attributes .= ' data-filter="*"';
		}

		$item_output = $args->before;
		$item_output .= '<p><a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($item->object == 'category' ? ' ('. get_category($item->object_id)->count . ')' : '');
		$item_output .= ($item->object == 'portfolio_category' ? ' ('. $portfolio_count . ')' : '');
		$item_output .= ($item->object == 'gallery_category' ? ' ('. $gallery_count . ')' : '');
		$item_output .= ($item->attr_title == 'allblog' ? ' ('. wp_count_posts()->publish . ')' : '');
		$item_output .= ($item->attr_title == 'allportfolio' ? ' ('. wp_count_posts('portfolio')->publish . ')' : '');
		$item_output .= ($item->attr_title == 'allgallery' ? ' ('. wp_count_posts('gallery')->publish . ')' : '');
		$item_output .= '</a></p>';
		$item_output .= $args->after;


		if ( !get_post_meta( $item->object_id, '_members_only' , true ) || is_user_logged_in() ) {
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		$output .= $new_output;

	}

	function end_el(&$output, $item, $depth) {
		if ( !get_post_meta( $item->object_id, '_members_only' , true ) || is_user_logged_in() ) {
			$output .= "</li>\n";
		}
	}
	
	 function end_lvl(&$output, $depth) {

		  $output .= "</ul></div>\n";
		  
	}
	
}

/*---------------------------------
	Redefine respnsoive menu structure with a walker class
------------------------------------*/

class menu_responsive_walker extends Walker_Nav_Menu
{

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }


    function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		global $rb_submenus;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$new_output = '';
		$open_class = '';
		$depth_class = ($args->has_children ? 'parent ' : '');

		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;

		$current_indicators = array('current-menu-item','current-menu-parent','current_page_item','current_page_parent');

		$newClasses = array();
		foreach($classes as $el)
			if(in_array($el,$current_indicators))
				array_push($newClasses,$el);

		$class_names = join(' ',apply_filters('nav_menu_css_class',array_filter($newClasses),$item));

		$attributes  = ! empty( $item->attr_title ) ? ' data-title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' data-target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' data-rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		if($item->object != 'portfolio_category' && $item->object != 'gallery_category')
			$attributes .= ! empty( $item->url )        ? ' data-href="'   . esc_attr( $item->url        ) .'"' : '';
		else
			$attributes .= ' data-href="#"';

		$portfolio_count;
		$gallery_count;

		if($item->object == 'portfolio_category'){
			$terms = get_terms('portfolio_category', array('include' => $item->object_id));
			$portfolio_count = $terms[0]->count;
			$attributes .= ' data-filter="' . $terms[0]->slug .'"';
		}

		if($item->object == 'gallery_category'){
			$terms = get_terms('gallery_category', array('include' => $item->object_id));
			$gallery_count = $terms[0]->count;
			$attributes .= ' data-filter="' . $terms[0]->slug .'"';
		}

		if($item->attr_title == 'allportfolio' || $item->attr_title == 'allgallery'){
			$attributes .= ' data-filter="*"';
		}

		$item_output = $args->before;
		$item_output .= '<option'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($item->object == 'category' ? ' ('. get_category($item->object_id)->count . ')' : '');
		$item_output .= ($item->object == 'portfolio_category' ? ' ('. $portfolio_count . ')' : '');
		$item_output .= ($item->object == 'gallery_category' ? ' ('. $gallery_count . ')' : '');
		$item_output .= ($item->attr_title == 'allblog' ? ' ('. wp_count_posts()->publish . ')' : '');
		$item_output .= ($item->attr_title == 'allportfolio' ? ' ('. wp_count_posts('portfolio')->publish . ')' : '');
		$item_output .= ($item->attr_title == 'allgallery' ? ' ('. wp_count_posts('gallery')->publish . ')' : '');
		$item_output .= '</option>';
		$item_output .= $args->after;


		if ( !get_post_meta( $item->object_id, '_members_only' , true ) || is_user_logged_in() ) {
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		$output .= $new_output;

	}

	function end_el(&$output, $item, $depth) {

	}
	
}

/*---------------------------------
	Fix responsive menu
------------------------------------*/

$responsive = 'global false';
function rb_remove_ul ($menu){
	global $responsive;
	if($responsive == 'global true')
   		return preg_replace(array('#^<ul[^>]*>#', '#</ul>$#'), '', $menu);
   	else
   		return $menu;
}
add_filter('wp_nav_menu', 'rb_remove_ul');

/*---------------------------------
	Setup backgrounds
------------------------------------*/

add_filter( 'image_slider_fields', 'new_slider_fields', 10, 2 );
function new_slider_fields( $image_slider_fields, $id ) {
  if ( $id == 'rb_backgrounds' ) {
    $image_slider_fields = array(
		array(
			'name'  => 'title',
			'type'  => 'text',
			'label' => 'Title',
		 	'class' => 'option-tree-slider-title'
		),
        array(
	        'name'  => 'image',
	        'type'  => 'text',
	        'label' => 'Post Image URL',
	        'class' => ''
        ),
		array(
			'name' => 'default_pages',
			'type' => 'checkbox',
			'label' => 'Check to select this as the default background for all pages',
			'class' => ''
		),
		array(
			'name' => 'default_posts',
			'type' => 'checkbox',
			'label' => 'Check to select this as the default background for all posts',
			'class' => '',
		)
	);
  }
  return $image_slider_fields;
}

/*---------------------------------
	Custom login logo
------------------------------------*/

function rb_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/customLoginLogo.png) !important; }
    </style>';
}
add_action('login_head', 'rb_custom_login_logo');

/*---------------------------------
	Custom gravatar
------------------------------------*/

function rb_gravatar ($avatar_defaults) {
	$myavatar = get_template_directory_uri() . '/images/customGravatar.png';
	$avatar_defaults[$myavatar] = 'WowWay Gravatar';
	return $avatar_defaults;
}
add_filter('avatar_defaults', 'rb_gravatar');

/*---------------------------------
	Fix empty search issue
------------------------------------*/

function rb_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
add_filter('request', 'rb_request_filter');

/*---------------------------------
	Enqueue custom admin scripts & styles
------------------------------------*/
  
function rb_add_admin_stuff(){
	wp_register_style('rb_custom_admin_styles', get_template_directory_uri(). '/css/admin_styles.css');
	wp_enqueue_style('rb_custom_admin_styles');
	wp_register_script('rb_admin_scripts', get_template_directory_uri(). '/js/admin_scripts.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'));
	wp_enqueue_script('rb_admin_scripts');
}
add_action( 'admin_init', 'rb_add_admin_stuff' );

/*---------------------------------
	Include other functions and classes
------------------------------------*/

include('includes/metaboxes.php');
include('includes/shortcodes.php');
include('includes/portfolio.php');
include('includes/gallery.php');
include('includes/widget.php');
  
?>