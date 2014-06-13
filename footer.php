<?php
/*---------------------------------
	The footer of the theme
------------------------------------*/

$theme_options = get_option('option_tree');
$is_contact = is_page_template('template-contact.php');
$is_single = is_single();
$is_project = is_singular('portfolio');
$is_gallery = is_singular('gallery') || is_page_template('template-gallery.php') || is_page_template('template-slideshow.php');

?>

</div>

	<!-- top footer -->
	<footer class="footer" id="topFooter">
		<?php if(is_active_sidebar('rb_top_footer_widget_left')) : ?>
			<div class="left">
				<?php dynamic_sidebar('rb_top_footer_widget_left'); ?>
			</div>
		<?php endif; ?>
		<?php if(is_active_sidebar('rb_top_footer_widget_right')) : ?>
			<div class="right">
				<?php dynamic_sidebar('rb_top_footer_widget_right'); ?>
			</div>
		<?php endif; ?>
	</footer>

	<!-- bottom footer -->
	<footer class="footer" id="bottomFooter">
		<?php if(is_active_sidebar('rb_bottom_footer_widget_left')) : ?>
			<div class="left">
				<?php dynamic_sidebar('rb_bottom_footer_widget_left'); ?>
			</div>
		<?php endif; ?>
		<a href="#" id="top">Go to Top <span>&uarr;</span></a>
	</footer>

</div>

<?php if($is_contact) : ?>
	<!-- contact map holder -->
	<div id="contactMapHolder"><div id="contactMap"></div></div>
<?php endif; ?>

<div id="scripts">

	<?php if($is_single || $is_gallery) : ?>

		<!-- social sharing scripts -->
		<div id="fb-root"></div>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		</script>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=138053569594474";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<script>
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>

	<?php endif; ?>

	<?php

		wp_register_script('theme_plugins', get_template_directory_uri().'/js/plugins.min.js', array('jquery'), NULL, true);
		wp_register_script('theme_scripts', get_template_directory_uri().'/js/scripts.js', array('theme_plugins'), NULL, true);
		
		wp_enqueue_script('theme_plugins');
		wp_enqueue_script('theme_scripts');

	?>

	<?php if(($is_contact) && get_option_tree('rb_map_display', $theme_options) == 'Yes') { ?>

		<?php wp_enqueue_script('google_maps', 'http://maps.googleapis.com/maps/api/js?sensor=false', NULL, true); ?>

	    <script type="text/javascript">

	    	function addMap(){
		    	var map;

				var stylez = [
				    {
				      featureType: "all",
				      elementType: "all",
				      stylers: [
				        { saturation: -100 }
				      ]
				    }
				];

				var mapOptions = {
				    zoom: 16,
				    center: new google.maps.LatLng(<?php get_option_tree('rb_map_lat1', $theme_options, true); ?>,<?php get_option_tree('rb_map_long1', $theme_options, true); ?>),
	  				streetViewControl: false,
	  				scrollwheel: false,
	  				panControl: false,
	  				zoomControl: false,
	  				mapTypeControl: false,
	  				overviewMapControl: false,
				    mapTypeControlOptions: {
				         mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'wowMap']
				    }
				};

				map = new google.maps.Map(document.getElementById("contactMap"), mapOptions);

				var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });    
				map.mapTypes.set('wowMap', mapType);
				map.setMapTypeId('wowMap');
	
				var image = '<?php get_option_tree('rb_map_pin', $theme_options, true); ?>';

				var myLatLng = new google.maps.LatLng(<?php get_option_tree('rb_map_lat2', $theme_options, true); ?>,<?php get_option_tree('rb_map_long2', $theme_options, true); ?>);
				var beachMarker = new google.maps.Marker({
				    position: myLatLng,
				    map: map,
				    icon: image
				});
			}

			if (!window.addEventListener) 
				window.attachEvent('load', addMap);
			else 
				window.addEventListener('load', addMap, false);


	    </script>

	<?php } else { ?>

		<style type="text/css">
			#contactMapHolder {
				background:none;
			}
		</style>

	<?php } ?>

	<div id="mobileCheck"></div>

	<?php wp_footer(); ?>

	<?php if($is_contact) : ?>
		<script type="text/javascript">
	 		jQuery.d280sw = '<?php echo base64_encode(get_template_directory_uri()); ?>';
			jQuery.cn932fh = '<?php echo base64_encode(get_option_tree('rb_form_success', $theme_options)); ?>';
		</script>
	<?php endif; ?>

	<?php get_option_tree('rb_tracking_code', $theme_options, true); ?>

	<p id="oldie"><?php get_option_tree('rb_ie7', $theme_options, true); ?></p>

</div>

</body>
</html>