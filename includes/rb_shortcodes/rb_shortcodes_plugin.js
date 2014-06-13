// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('rb_button_shortcodes');
	 
	tinymce.create('tinymce.plugins.rb_button_shortcodes', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('rb_button_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/rb_shortcodes_panel.php',
					width : jQuery(window).width()-100,
					height : jQuery(window).height()-100,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('rb_button_shortcodes', {
				title : 'Insert a Shortcode',
				cmd : 'rb_button_shortcodes',
				image : url + '/ico-shortcodes.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('rb_button_shortcodes', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'rb_button_shortcodes',
					author 	  : 'rubenbristian',
					authorurl : 'http://www.rubenbristian.com',
					infourl   : 'http://www.rubenbristian.com',
					version   : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('rb_button_shortcodes', tinymce.plugins.rb_button_shortcodes);
})();


