<?php
$wpconfig = realpath("../../../../../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
global $wpdb;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php _e("Insert Shortcode", 'wowway'); ?></title>
<!-- <meta http-equiv="Content-Type" content="<?php// bloginfo('html_type'); ?>; charset=<?php //echo get_option('blog_charset'); ?>" /> -->
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	
	<link rel="stylesheet" id="shortcode-style"  href="<?php echo get_template_directory_uri().'/includes/rb_shortcodes/rb_shortcodes_style.css'; ?>" type="text/css" media="all" />
	
	<?php
		wp_admin_css( 'global', true );
		wp_admin_css( 'wp-admin', true );
		wp_enqueue_script('media-upload'); 
		wp_enqueue_script('thickbox');
	?>
	
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri().'/../../../wp-admin/js/media-upload.js'; ?>"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri().'/includes/rb_shortcodes/rb_shortcodes_function.js'; ?>"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(). '/includes/rb_plugins/thickbox-compressed.js'; ?>"></script>
	<base target="_self" />
	
</head>
	<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->

	<div>
	
		<div class="clean">
			<p>Step 1: Select a <strong>shortcode type</strong>:</p>

			<select id="rbShortcodeType">
				<option data-id="#rbClean">Select...</option>
				<option data-id="#rbAlertBox">Alert Box</option>
				<option data-id="#rbButtons">Button</option>
				<option data-id="#rbDivider">Divider</option>
				<option data-id="#rbDropcap">Dropcap</option>
				<option data-id="#rbList">List</option>
				<option data-id="#rbQuote">Quote</option>
				<option data-id="#rbTabs">Tabs</option>
				<option data-id="#rbTextBox">Text Box</option>
				<option data-id="#rbToggles">Toggles</option>
			</select>
		</div>
		
		<div id="rbShortcodePanels" class="clean panels">
			<p>Step 2: Configure <strong>shortcode options</strong>:</p>
			
			<div data-type="none" id="rbClean" class="first selected">
				<div class="field large clearfix"><label>Select a shortcode first..</label></div>
			</div>

			<div data-type="alertBox" id="rbAlertBox">
				<p>Alert box</p>
				
				<div class="field">
					<label for="rbAlertBoxStyle">Type:</label>
					<select id="rbAlertBoxStyle">
						<option>info</option>
						<option>notice</option>
						<option>success</option>
						<option>error</option>
					</select>
				</div>
				
				<div class="field">
					<label for="rbAlertBoxContent">Content:</label>
					<textarea id="rbAlertBoxContent"></textarea>
				</div>
				
			</div>
			
			<div data-type="button" id="rbButtons">
				<p>Button</p>
				
				<div class="field">
					<label for="rbButtonsStyle">Style:</label>
					<select id="rbButtonsStyle">
						<option>headed</option>
						<option>classic</option>
					</select>
				</div>

				<div class="field">
					<label for="rbButtonsDeco">Decoration:</label>
					<select id="rbButtonsDeco">
						<option>arrow</option>
						<option>none</option>
					</select>
				</div>
				
				<div class="field">
					<label for="rbButtonsColor">Color:</label>
					<select id="rbButtonsColor">
						<option>light</option>
						<option>dark</option>
					</select>
				</div>
				
				<div class="field">
					<label for="rbButtonsLabel">Label:</label>
					<input id="rbButtonsLabel" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbButtonsLink">Link:</label>
					<input id="rbButtonsLink" type="text" value="" />
				</div>
					
				<div class="field">
					<label for="rbButtonsTarget">Target:</label>
					<select id="rbButtonsTarget">
						<option>_self</option>
						<option>_blank</option>
						<option>_parent</option>
						<option>_top</option>
					</select>
				</div>	
					
			</div>
			
			<div data-type="contrast" id="rbContrast">
				<p>Contrast Container</p>
				
				<div class="field">
					<label for="rbContrastId">Container ID:</label>
					<input id="rbContrastId" type="text" value="" />
				</div>
				
				<div class="field large clearfix"><label>This shortcode can be used only in pages without a sidebar!</label></div>
				
			</div>
			
			<div data-type="divider" id="rbDivider">
				<p>Divider</p>
				<div class="field large clearfix"><label>There are no options for this shortcode.</label></div>
			</div>
			
			<div data-type="dropcap" id="rbDropcap">
				<p>Dropcap</p>
				
				<div class="field">
					<label for="rbDropcapLetter">First letter:</label>
					<input id="rbDropcapLetter" type="text" value="" />
				</div>
					
				<div class="field">
					<label for="rbDropcapStyle">Style:</label>
					<select id="rbDropcapStyle">
						<option>circle</option>
						<option>square</option>
					</select>
				</div>	
			
			</div>
			
			<div data-type="maps" id="rbMaps">
				<p>Google Map</p>
				
				<div class="field">
					<label for="rbMapsSize1">Map width(px):</label>
					<input id="rbMapsSize1" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsSize2">Map height(px):</label>
					<input id="rbMapsSize2" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsLatitude1">Map position(lat):</label>
					<input id="rbMapsLatitude1" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsLongitude1">Map position(long):</label>
					<input id="rbMapsLongitude1" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsZoom">Map zoom level:</label>
					<input id="rbMapsZoom" type="text" value="14" />
				</div>
				
				<div class="field">
					<label for="rbMapsLatitude2">Marker position(lat):</label>
					<input id="rbMapsLatitude2" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsLongitude2">Marker position(long):</label>
					<input id="rbMapsLongitude2" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsTitle">Marker Title:</label>
					<input id="rbMapsTitle" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsAddress1">Marker Address(1):</label>
					<input id="rbMapsAddress1" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbMapsAddress2">Marker Address(2):</label>
					<input id="rbMapsAddress2" type="text" value="" />
				</div>
				
			</div>
			
			<div data-type="mark" id="rbMark">
				<p>Highlighted Text</p>
				<div class="field large clearfix"><label>There are no options for this shortcode.</label></div>
			</div>
			
			<div data-type="iconButton" id="rbIconButton">
				<p>Icon Button</p>
				
				<div class="field">
					<label>Icon:</label>
					<ul id="rbIconButtonIcon" class="iconList clearfix">
						<li data-icon="audio"><span class="icon audio">Audio</span></li>
						<li data-icon="mail"><span class="icon mail">Mail</span></li>
						<li data-icon="shirt"><span class="icon shirt">Shirt</span></li>
						<li data-icon="run"><span class="icon run">Run</span></li>
						<li data-icon="tag"><span class="icon tag">Tag</span></li>
						<li data-icon="cup"><span class="icon cup">Cup</span></li>
						<li data-icon="lab"><span class="icon lab">Lab</span></li>
						<li data-icon="cloud"><span class="icon cloud">Cloud</span></li>
						<li data-icon="loupe"><span class="icon loupe">Loupe</span></li>
						<li data-icon="info"><span class="icon info">Info</span></li>
						<li data-icon="brush"><span class="icon brush">Brush</span></li>
						<li data-icon="umbrella"><span class="icon umbrella">Umbrella</span></li>
						<li data-icon="flag"><span class="icon flag">Flag</span></li>
						<li data-icon="link"><span class="icon link">Link</span></li>
						<li data-icon="book"><span class="icon book">Book</span></li>
						<li data-icon="help"><span class="icon help">Help</span></li>
						<li data-icon="rss"><span class="icon rss">RSS</span></li>
						<li data-icon="folder"><span class="icon folder">Folder</span></li>
						<li data-icon="attention"><span class="icon attention">Attention</span></li>
						<li data-icon="bell"><span class="icon bell">Bell</span></li>
						<li data-icon="note"><span class="icon note">Note</span></li>
						<li data-icon="globe"><span class="icon globe">Globe</span></li>
						<li data-icon="clock"><span class="icon clock">Clock</span></li>
						<li data-icon="photo"><span class="icon photo">Photo</span></li>
						<li data-icon="eye"><span class="icon eye">Eye</span></li>
						<li data-icon="bulb"><span class="icon bulb">Bulb</span></li>
						<li data-icon="key"><span class="icon key">Key</span></li>
						<li data-icon="plane"><span class="icon plane">Plane</span></li>
						<li data-icon="car"><span class="icon car">Car</span></li>
						<li data-icon="settings"><span class="icon settings">Settings</span></li>
						<li data-icon="phone"><span class="icon phone">Phone</span></li>
						<li data-icon="map"><span class="icon map">Map</span></li>
						<li data-icon="bubble"><span class="icon bubble">Bubble</span></li>
						<li data-icon="people"><span class="icon people">People</span></li>
						<li data-icon="video"><span class="icon video">Video</span></li>
						<li data-icon="case"><span class="icon case">Case</span></li>
						<li id="rbIconButtonCustomIconButton">Add a custom icon <span style="font-size:11px">(37x32)</span><div id="rbIconButtonCustomIcon"></div></li>
					</ul>
				</div>
				
				<div class="field">
					<label for="rbIconButtonLabel">Label:</label>
					<input id="rbIconButtonLabel" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbIconButtonLink">Link:</label>
					<input id="rbIconButtonLink" type="text" value="" />
				</div>
					
				<div class="field">
					<label for="rbIconButtonTarget">Target:</label>
					<select id="rbIconButtonTarget">
						<option>_self</option>
						<option>_blank</option>
						<option>_parent</option>
						<option>_top</option>
					</select>
				</div>	
			
			</div>
				
			<div data-type="iconBlock" id="rbIconBlock">
				<p>Icon Text Block</p>
				
				<div class="field">
					<label>Icon:</label>
					<ul id="rbIconBlockIcon" class="iconList clearfix">
						<li data-icon="audio"><span class="icon audio">Audio</span></li>
						<li data-icon="mail"><span class="icon mail">Mail</span></li>
						<li data-icon="shirt"><span class="icon shirt">Shirt</span></li>
						<li data-icon="run"><span class="icon run">Run</span></li>
						<li data-icon="tag"><span class="icon tag">Tag</span></li>
						<li data-icon="cup"><span class="icon cup">Cup</span></li>
						<li data-icon="lab"><span class="icon lab">Lab</span></li>
						<li data-icon="cloud"><span class="icon cloud">Cloud</span></li>
						<li data-icon="loupe"><span class="icon loupe">Loupe</span></li>
						<li data-icon="info"><span class="icon info">Info</span></li>
						<li data-icon="brush"><span class="icon brush">Brush</span></li>
						<li data-icon="umbrella"><span class="icon umbrella">Umbrella</span></li>
						<li data-icon="flag"><span class="icon flag">Flag</span></li>
						<li data-icon="link"><span class="icon link">Link</span></li>
						<li data-icon="book"><span class="icon book">Book</span></li>
						<li data-icon="help"><span class="icon help">Help</span></li>
						<li data-icon="rss"><span class="icon rss">RSS</span></li>
						<li data-icon="folder"><span class="icon folder">Folder</span></li>
						<li data-icon="attention"><span class="icon attention">Attention</span></li>
						<li data-icon="bell"><span class="icon bell">Bell</span></li>
						<li data-icon="note"><span class="icon note">Note</span></li>
						<li data-icon="globe"><span class="icon globe">Globe</span></li>
						<li data-icon="clock"><span class="icon clock">Clock</span></li>
						<li data-icon="photo"><span class="icon photo">Photo</span></li>
						<li data-icon="eye"><span class="icon eye">Eye</span></li>
						<li data-icon="bulb"><span class="icon bulb">Bulb</span></li>
						<li data-icon="key"><span class="icon key">Key</span></li>
						<li data-icon="plane"><span class="icon plane">Plane</span></li>
						<li data-icon="car"><span class="icon car">Car</span></li>
						<li data-icon="settings"><span class="icon settings">Settings</span></li>
						<li data-icon="phone"><span class="icon phone">Phone</span></li>
						<li data-icon="map"><span class="icon map">Map</span></li>
						<li data-icon="bubble"><span class="icon bubble">Bubble</span></li>
						<li data-icon="people"><span class="icon people">People</span></li>
						<li data-icon="video"><span class="icon video">Video</span></li>
						<li data-icon="case"><span class="icon case">Case</span></li>
						<li id="rbIconBlockCustomIconButton">Add a custom icon <span style="font-size:11px">(37x32)</span><div id="rbIconBlockCustomIcon"></div></li>
					</ul>
				</div>
					
				<div class="field">
					<label for="rbIconBlockTitle">Title:</label>
					<input id="rbIconBlockTitle" type="text" value="" />
				</div>
					
				<div class="field">
					<label for="rbIconBlockText">Content:</label>
					<textarea id="rbIconBlockText"></textarea>
				</div>
				
			</div>
			
			<div data-type="image" id="rbImage">
				<p>Image (lightbox)</p>
				
				<div class="field">
					<label for="rbImagePath">Path:</label>
					<input id="rbImagePath" type="text" name="rbImagePath" value="" />
					<input id="rbImagePathButton" class="button" type="button" value="Upload" />
				</div>
				
				<div class="field">
					<label for="rbImageCaption">Caption:</label>
					<input id="rbImageCaption" type="text" value="" />
				</div>
				
				<div class="field clearfix">
					<label for="rbImageCaptionShow">Show caption:</label>
					<input id="rbImageCaptionShow" type="checkbox" value="" /> 
					<span class="description">Check this if you want to display the image's caption below it</span>
				</div>
				
				<div class="field">
					<label for="rbImageAlign">Align:</label>
					<select id="rbImageAlign">
						<option>left</option>
						<option>right</option>
						<option>none</option>
					</select>
					<span class="description indented"><br />Choose <strong>none</strong> if you want to reset the image's margin</span>
				</div>
				
				<div class="field clearfix">
					<label for="rbImageLightbox">Enable lightbox</label>
					<input id="rbImageLightbox" type="checkbox" value="" /> 
					<span class="description">Check this if you want to display a large image instead of a link</span>
				</div>
				
				<div class="field hidden" id="rbImageField1">
					<label for="rbImagePathLarge">Large image path:</label>
					<input id="rbImagePathLarge" type="text" value="" />
					<input id="rbImagePathLargeButton" class="button" type="button" value="Upload" />
				</div>
				
				<div class="field hidden" id="rbImageField2">
					<label for="rbImageGallery">Lightbox gallery:</label>
					<input id="rbImageGallery" type="text" value="" />
				</div>
				
				<div class="field" id="rbImageField3">
					<label for="rbImageLink">Link:</label>
					<input id="rbImageLink" type="text" value="" />
				</div>
					
				<div class="field" id="rbImageField4">
					<label for="rbImageTarget">Target:</label>
					<select id="rbImageTarget">
						<option>_self</option>
						<option>_blank</option>
						<option>_parent</option>
						<option>_top</option>
					</select>
				</div>	
				
			</div>
			
			<div data-type="list" id="rbList">
				<p>List</p>
			
				<div class="field">
					<label for="rbListStyle">Style:</label>
					<select id="rbListStyle">
						<option>arrow1</option>
						<option>arrow2</option>
						<option>circle</option>
						<option>check</option>
						<option>star</option>
						<option>plus</option>
						<option>dash</option>
						<option>special</option>
					</select>
				</div>
				
				<div class="field">
					<label for="rbListContent">Content:</label>
					<textarea id="rbListContent"></textarea>
					<span class="description indented"><br />Write each list item on a new line</span>
				</div>
				
			</div>
			
			<div data-type="numericBlock" id="rbNumericBlock">
				<p>Numeric Text Block</p>
				
					<div class="field">
						<label>Number:</label>
						<input id="rbNumericBlockNumber" type="text" value="" />
					</div>
				
					<div class="field">
						<label>Title:</label>
						<input id="rbNumericBlockTitle" type="text" value="" />
					</div>
				
				<div class="field">
					<label for="rbNumericBlockContent">Content:</label>
					<textarea id="rbNumericBlockContent"></textarea>
				</div>
				
			</div>
			
			<div data-type="pricingTable" id="rbPricingTable">
				<p>Pricing Table</p>
				
				<div class="boxes">
					
					<div class="enclosed first">
					
						<div class="field">
							<label>Title:</label>
							<input class="rbPricingTableTitle" type="text" value="" />
						</div>
						
						<div class="field">
							<label>Price:</label>
							<input class="rbPricingTablePrice" type="text" value="" />
							<span class="description indented"><br />You can use this model:<br /> <span class="mark">&lt;span class="super"&gt;$&lt;/span&gt;10&lt;span class="sub"&gt;/year&lt;/span&gt;</span></span>
						</div>
						
						<div class="field">
							<label>Content:</label>
							<textarea class="rbPricingTableContent"></textarea>
						</div>
						
						<div class="field">
							<label>Footer content:</label>
							<input class="rbPricingTableFooter" type="text" value="" />
							<span class="description indented"><br />You can add a <strong>Sign Up</strong> button here.</span>
						</div>
						
					</div>
				
				</div>

				<input id="rbPricingTableAdd" class="button" type="button" value="Add column" />
				
			</div>
			
			<div data-type="postBox" id="rbPostList">
				<p>Posts Box</p>
				
				<div class="field">
					<label for="rbPostsTitle">Box Title:</label>
					<input id="rbPostsTitle" type="text" value="" />
				</div>
				
				<div class="field">
					<label for="rbPostsTag">Posts category ID:</label>
					<input id="rbPostsTag" type="text" value="" />
					<span class="description indented"><br />If left empty, it will take the all latest posts</span>
				</div>
				
				<div class="field">
					<label for="rbPostsNo">Number of posts:</label>
					<input id="rbPostsNo" type="text" value="" />
				</div>
			
			</div>
			
			<div data-type="quote" id="rbQuote">
				<p>Quote</p>
				<div class="field">
					<label for="rbQuoteContent">Content:</label>
					<textarea id="rbQuoteContent"></textarea>
				</div>
			</div>
			
			<div data-type="tabs" id="rbTabs">
				<p>Tabs</p>
				
				<div class="boxes">
				
					<div class="enclosed first">
					
						<div class="field">
							<label>Title:</label>
							<input class="rbTabsTitle" type="text" value="" />
						</div>
						
						<div class="field">
							<label>Content:</label>
							<textarea class="rbTabsContent"></textarea>
						</div>
						
					</div>
				
				</div>

				<input id="rbTabsAdd" class="button" type="button" value="Add tab" />
				
			</div>
			
			<div data-type="table" id="rbTable">
				<p>Table</p>
				<div class="field">
					<label for="rbTableContent">Content:</label>
					<textarea id="rbTableContent"></textarea>
				</div>
			</div>
			
			<div data-type="team" id="rbTeam">
				<p>Team List</p>
				
				<div class="boxes">
				
					<div class="enclosed first">
					
						<div class="field">
							<label>Name(title):</label>
							<input class="rbTeamTitle" type="text" value="" />
						</div>
					
						<div class="field">
							<label>Position(subtitle):</label>
							<input class="rbTeamSubtitle" type="text" value="" />
						</div>
						
						<div class="field">
							<label>Content:</label>
							<textarea class="rbTeamContent" ></textarea>
						</div>
	
						<div class="field">
							<label>Path:</label>
							<input type="text" class="rbTeamImagePath" value="" />
							<input class="button rbTeamImageButton" type="button" value="Upload" />
						</div>
						
					</div>
				
				</div>

				<input id="rbTeamAdd" class="button" type="button" value="Add member" />
				
			</div>
			
			<div data-type="textBox" id="rbTextBox">
				<p>Text box</p>
				
				<div class="field">
					<label for="rbTextBoxContent">Content:</label>
					<textarea id="rbTextBoxContent"></textarea>
				</div>
				
			</div>
			
			<div data-type="testimonials" id="rbTestimonials">
				<p>Testimonials</p>
				
				<div class="boxes">
					<div class="enclosed first">
					
						<div class="field">
							<label>Title:</label>
							<input class="rbTestimonialsTitle" type="text" value="" />
						</div>
					
						<div class="field">
							<label>Source:</label>
							<input class="rbTestimonialsSource" type="text" value="" />
						</div>
						
						<div class="field">
							<label>Content:</label>
							<textarea class="rbTestimonialsContent"></textarea>
						</div>
						
					</div>
				</div>

				<input id="rbTestimonialsAdd" class="button" type="button" value="Add testimonial" />
				
			</div>
			
			<div data-type="toggles" id="rbToggles">
				<p>Toggles</p>
				
				<div class="boxes">
					<div class="enclosed first">
					
						<div class="field">
							<label for="rbTogglesTitle1">Title:</label>
							<input class="rbTogglesTitle" id="rbTogglesTitle1" type="text" value="" />
						</div>
						
						<div class="field">
							<label for="rbTogglesContent1">Content:</label>
							<textarea class="rbTogglesContent" id="rbTogglesContent1"></textarea>
						</div>
						
					</div>
				</div>

				<input id="rbTogglesAdd" class="button" type="button" value="Add toggle" />
				
			</div>
		
		</div>
		
		<div class="clean">
			<p>Step 3: <strong>Insert</strong> the shortcode</strong><p>
			<div class="mceActionPanel" style="overflow: hidden; margin-top: 20px;">
				<div style="float: left">
					<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'wowway'); ?>" onclick="tinyMCEPopup.close();" class="button" />
				</div>
				<div style="float: right">
					<button id="insertCode" value="<?php _e("Insert", 'wowway'); ?>" class="button" type="button"><?php _e("Insert", 'wowway'); ?></button>
				</div>
				<div style="float: right">
					&nbsp;
				</div>
				<div style="float: right">
					<button id="previewCode" value="<?php _e("Preview", 'wowway'); ?>" class="button" type="button"><?php _e("Preview", 'wowway'); ?></button>
				</div>
			</div>
		</div>
		
	</div>
	
</body>
</html>