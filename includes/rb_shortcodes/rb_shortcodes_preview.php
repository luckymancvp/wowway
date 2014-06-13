<html>
<head>
	<link rel="stylesheet" href="../../css/styles.css"></link>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/plugins.min.js"></script>
	<script type="text/javascript" src="../../js/scripts.min.js"></script>
	<style>
		#previewer {
			width:480px;
			margin:auto;
		}
		body {
			min-width:480px;
			width:100%;
		}
	</style>
</head>
<body>
<div style="width:480px; height:30px"></div>
<div id="previewer">
	<h1>Shortcode Previewer</h1>
	<p>This is a simple shortcode previewer. Note that some shortcodes(boxes, tabs, toggles, tables, etc.) take the entire space of their parent column, so in this case, these shortcode will have a width of <strong>480px</strong>, value which may differ in your post/page.</p>
	<br />
	<div>
	<?php 

		require('../../../../../wp-load.php');
		echo do_shortcode(stripslashes(urldecode($_GET['shortcode'])));
		
	?>
	</div>
</div>
</body>