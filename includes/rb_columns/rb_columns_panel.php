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
	<title><?php _e("Insert Columns", 'wowway'); ?></title>
<!-- <meta http-equiv="Content-Type" content="<?php// bloginfo('html_type'); ?>; charset=<?php //echo get_option('blog_charset'); ?>" /> -->
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<?php
		wp_admin_css( 'global', true );
		wp_admin_css( 'wp-admin', true );
	?>
	<link rel="stylesheet" id="shortcode-style"  href="<?php echo get_template_directory_uri().'/includes/rb_columns/rb_columns_style.css'; ?>" type="text/css" media="all" />
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri().'/includes/rb_columns/rb_columns_function.js'; ?>"></script>
	<base target="_self" />
</head>
	<body id="link" style="overflow:hidden" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->

	<div id="gridExamples" class="container_16">
		<p class="grid_16 margin1">Select a <strong>size</strong> for the column that you want to insert in the page.</p>

		<div class="grid_16 holder" data-grid="one_fourth"><div class="grid_1 margin">&nbsp;</div><div class="grid_4">1/4</div></div>
		<div class="grid_16 holder" data-grid="one_third"><div class="grid_1 margin">&nbsp;</div><div class="grid_6">1/3</div></div>
		<div class="grid_16 holder" data-grid="one_half"><div class="grid_1 margin">&nbsp;</div><div class="grid_8">1/2</div></div>
		<div class="grid_16 holder" data-grid="full_width"><div class="grid_16">1/1</div></div>
		<div class="holder clearing" data-grid="clear"><div class="grid_16">Empty div, for clearing floats(use this after each row, if it looks messed up)</div></div>
		
		<div class="grid_16 clean">
			<div class="mceActionPanel" style="overflow: hidden; margin-top: 20px;">
				<div style="float: left">
					<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'wowway'); ?>" onclick="tinyMCEPopup.close();" />
				</div>
				<div style="float: right">
					<button id="insertCode" value="<?php _e("Insert", 'wowway'); ?>" class="button" type="button"><?php _e("Insert", 'wowway'); ?></button>
				</div>
			</div>
		</div>
		
	</div>
	
</body>
</html>