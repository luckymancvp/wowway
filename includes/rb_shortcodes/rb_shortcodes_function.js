(function($){
	$(function() {
	
		//shortcodes handling
		var $selectedShortcode = $('#rbShortcodePanels').find('div.selected');
		$('#rbShortcodeType').change(function(){
			$selectedShortcode.slideUp(250, function(){
				$selectedShortcode.delay(100).slideDown(350);
			});
			$selectedShortcode = $('#rbShortcodePanels').find($(this).find(':selected').data('id'));
		});
		
		function clonePanel($button, $holder, imgPath, imgButton){
			$button.click(function(){
				var $clone = $holder.children('div.boxes').children('div.first').clone(false);
				$clone.removeClass('first').append('<a class="removePanel" href="#">Remove</a>');
				$clone.find('input, textarea').val('');
				$clone.appendTo($holder.children('div.boxes'));
				if(imgPath != ''){
					enableUpload($clone.find(imgButton), $clone.find(imgPath));
				}
				$('.removePanel').click(function(){
					$(this).parent().remove();
				});
			});
		}
		
		clonePanel($('#rbPricingTableAdd'), $('#rbPricingTable'), '', '');
		clonePanel($('#rbTabsAdd'), $('#rbTabs'), '', '');
		clonePanel($('#rbTestimonialsAdd'), $('#rbTestimonials'), '', '');
		clonePanel($('#rbTogglesAdd'), $('#rbToggles'), '', '');
		clonePanel($('#rbTeamAdd'), $('#rbTeam'), '.rbTeamImagePath', '.rbTeamImagePathButton');
		
		$('#rbImageLightbox').click(function(){
			if($('#rbImageLightbox').attr('checked') == 'checked'){
				$('#rbImageField1').removeClass('hidden');
				$('#rbImageField2').removeClass('hidden');
				$('#rbImageField3').addClass('hidden');
				$('#rbImageField4').addClass('hidden');
			} else {
				$('#rbImageField1').addClass('hidden');
				$('#rbImageField2').addClass('hidden');
				$('#rbImageField3').removeClass('hidden');
				$('#rbImageField4').removeClass('hidden');
			}
		});
		
		var $uploadImgPath, uploadImgType;
		function enableUpload($button, $path, type){
			$button.click(function() {
				$uploadImgPath = $path;
				uploadImgType = type;
				formfield = $path.attr('name');
				tb_show('', '../../../../../wp-admin/media-upload.php?type=image&amp;TB_iframe=true');
				return false;
			});
		}
		window.send_to_editor = function(html) {
			imgurl = $('img',html).attr('src');
			if(uploadImgType){
				$uploadImgPath.empty().html('<img src="' + imgurl + '" />');
			}else{
				$uploadImgPath.val(imgurl);
			}
			tb_remove();
		}
		
		enableUpload($('#rbImagePathButton'), $('#rbImagePath'), false);
		enableUpload($('#rbImagePathLargeButton'), $('#rbImagePathLarge'), false);
		enableUpload($('.rbTeamImageButton'), $('.rbTeamImagePath'), false);
		enableUpload($('#rbIconBlockCustomIconButton'), $('#rbIconBlockCustomIcon'), true); 
		enableUpload($('#rbIconButtonCustomIconButton'), $('#rbIconButtonCustomIcon'), true); 
		
		function nl2br (str) {   
			var breakTag = '<br>';    
			return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag);
		}
		
		var $selIcon = $();
		function enableIconSelection($holder, selector){
			$holder.find(selector).click(function(){
				$selIcon.removeClass('selected');
				$selIcon = $(this);
				$selIcon.addClass('selected');
			});
		}
		
		enableIconSelection($('#rbIconButtonIcon'), 'li');
		enableIconSelection($('#rbIconBlockIcon'), 'li');
		
		//shortcode preview
		$('#previewCode').click(function(){
			if($selectedShortcode.data('type') != 'none') {
			
				var inst = tinyMCE.getInstanceById('content');
				var html = inst.selection.getContent();
				
				var shortcodeData = '';
				
				switch($selectedShortcode.data('type')){
					case 'button':
						shortcodeData = insertButton(html);
						break;
					case 'contrast':
						shortcodeData = insertContrast(html);
						break;
					case 'divider':
						shortcodeData = insertDivider(html);
						break;
					case 'dropcap':
						shortcodeData = insertDropcap(html);
						break;
					case 'iconButton':
						shortcodeData = insertIconButton(html);
						break;
					case 'iconBlock':
						shortcodeData = insertIconBlock(html);
						break;
					case 'image':
						shortcodeData = insertImage(html);
						break;
					case 'list':
						shortcodeData = insertList(html);
						break;
					case 'mark':
						shortcodeData = insertMark(html);
						break;
					case 'maps':
						shortcodeData = insertMaps(html);
						break;
					case 'numericBlock':
						shortcodeData = insertNumericBlock(html);
						break;
					case 'pricingTable':
						shortcodeData = insertPricingTable(html);
						break;
					case 'postBox':
						shortcodeData = insertPostBox(html);
						break;
					case 'quote':
						shortcodeData = insertQuote(html);
						break;
					case 'tabs':
						shortcodeData = insertTabs(html);
						break;
					case 'table':
						shortcodeData = insertTable(html);
						break;
					case 'team':
						shortcodeData = insertTeam(html);
						break;
					case 'textBox':
						shortcodeData = insertTextBox(html);
						break;
					case 'testimonials':
						shortcodeData = insertTestimonials(html);
						break;
					case 'toggles':
						shortcodeData = insertToggles(html);
						break;
				}
			}
			
			window.open('rb_shortcodes_preview.php?shortcode='+escape(shortcodeData) , 'Shortcode Previewer', 'width=640,height=500');
			return false;
		});
		
		//shortcode insertion process
		$('#insertCode').click(function (){
			if($selectedShortcode.data('type') != 'none') {
			
				var inst = tinyMCE.getInstanceById('content');
				var html = inst.selection.getContent();
				
				var shortcodeData = '';
				
				switch($selectedShortcode.data('type')){
					case 'alertBox':
						shortcodeData = insertAlertBox(html);
						break;
					case 'button':
						shortcodeData = insertButton(html);
						break;
					case 'contrast':
						shortcodeData = insertContrast(html);
						break;
					case 'divider':
						shortcodeData = insertDivider(html);
						break;
					case 'dropcap':
						shortcodeData = insertDropcap(html);
						break;
					case 'iconButton':
						shortcodeData = insertIconButton(html);
						break;
					case 'iconBlock':
						shortcodeData = insertIconBlock(html);
						break;
					case 'image':
						shortcodeData = insertImage(html);
						break;
					case 'list':
						shortcodeData = insertList(html);
						break;
					case 'mark':
						shortcodeData = insertMark(html);
						break;
					case 'maps':
						shortcodeData = insertMaps(html);
						break;
					case 'numericBlock':
						shortcodeData = insertNumericBlock(html);
						break;
					case 'pricingTable':
						shortcodeData = insertPricingTable(html);
						break;
					case 'postBox':
						shortcodeData = insertPostBox(html);
						break;
					case 'quote':
						shortcodeData = insertQuote(html);
						break;
					case 'tabs':
						shortcodeData = insertTabs(html);
						break;
					case 'table':
						shortcodeData = insertTable(html);
						break;
					case 'team':
						shortcodeData = insertTeam(html);
						break;
					case 'textBox':
						shortcodeData = insertTextBox(html);
						break;
					case 'testimonials':
						shortcodeData = insertTestimonials(html);
						break;
					case 'toggles':
						shortcodeData = insertToggles(html);
						break;
				}
					
				window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeData);
				tinyMCEPopup.editor.execCommand('mceRepaint');
				tinyMCEPopup.close();
				
			}else{
				tinyMCEPopup.close();
			}
			return false;
			
		});
		
		//shortcode insertion functions
		
		function insertAlertBox(){
			var data = '[rb_alert_box style="' + $('#rbAlertBoxStyle').val() + '"]' + $('#rbAlertBoxContent').val() + '[/rb_alert_box]';
			return data;
		}

		function insertButton(){
			var data = '[rb_button style="' + $('#rbButtonsStyle').val() + '" decoration="' + $('#rbButtonsDeco').val() + '" color="' + $('#rbButtonsColor').val() + '" link="' + $('#rbButtonsLink').val() + '" target="' + $('#rbButtonsTarget').val() + '" label="' + $('#rbButtonsLabel').val()+ '"] [/rb_button]';
			return data;
		}
		
		function insertContrast(html){
			var data;
			if(html)
				data = '[rb_contrast id="' + $('#rbContrastId').val() + '"] ' + html + ' [/rb_contrast]';
			else
				data = '[rb_contrast id="' + $('#rbContrastId').val() + '"] Your content here [/rb_contrast]';
			return data;
		}
		
		function insertDivider(){
			var data = '[rb_divider] [/rb_divider]';
			return data;
		}
		
		function insertDropcap(){
			var data = '[rb_dropcap style="' + $('#rbDropcapStyle').val() + '"]' + $('#rbDropcapLetter').val() + '[/rb_dropcap]';
			return data;
		}
		
		function insertIconButton(){
			var data = '[rb_icon_button label="' + $('#rbIconButtonLabel').val() + '" link="' + $('#rbIconButtonLink').val() + '" target="' + $('#rbIconButtonTarget').val() + '" icon="';
			if($('#rbIconButtonCustomIconButton').hasClass('selected')){
				data += $('#rbIconButtonCustomIcon').find('img').attr('src') + '" icon_title="Icon" icon_type="custom"]';
			} else {
				data += $('#rbIconButtonIcon').find('li.selected').data('icon') + '" icon_title="' + $('#rbIconButtonIcon').find('li.selected').find('span').text() + '"]';
			}
			data += ' [/rb_icon_button]';
			return data;
		}
		
		function insertIconBlock(){
			var data = '[rb_icon_block title="' + $('#rbIconBlockTitle').val() + '" icon="';
			if($('#rbIconBlockCustomIconButton').hasClass('selected')){
				data += $('#rbIconBlockCustomIcon').find('img').attr('src') + '" icon_title="Icon" icon_type="custom"]';
			} else {
				data += $('#rbIconBlockIcon').find('li.selected').data('icon') + '" icon_title="' + $('#rbIconBlockIcon').find('li.selected').find('span').text() + '"]';
			}

			data += $('#rbIconBlockText').val() + '[/rb_icon_block]';
			return data;
		}
		
		function insertImage(){
			var data = '[rb_image path="' + $('#rbImagePath').val() + '" caption="' + $('#rbImageCaption').val() + '" show_caption="';
			
			if($('#rbImageCaptionShow').attr('checked') == 'checked')
				data += 'true" align="' + $('#rbImageAlign').val() + '" lightbox="';
			else 
				data += 'false" align="' + $('#rbImageAlign').val() + '" lightbox="';
				
			if($('#rbImageLightbox').attr('checked') == 'checked'){
				data += 'true" link="' + $('#rbImagePathLarge').val() + '" gallery="' +$('#rbImageGallery').val() + '"]';
			} else {
				data += 'false" link="' + $('#rbImageLink').val() + '" target="' +$('#rbImageTarget').val() + '"]';
			}
			
			data += '[/rb_image]';
			return data;
		}
		
		function insertList(){
			var data = '[rb_list type="' + $('#rbListStyle').val() + '"]';
			$.each(nl2br($('#rbListContent').val()).split('<br>'), function(index, value){
				data += '[rb_list_item]' + value + '[/rb_list_item]';
			});
			data += '[/rb_list]';
			return data;
		}
		
		function insertMark(html){
			var data;
			if(html)
				data = '[rb_highlight]' + html + '[/rb_highlight]';
			else
				data = '[rb_highlight]Your content here[/rb_highlight]';
			return data;
		}
		
		function insertMaps(html){
			var data = '[rb_google_maps lat1="' + $('#rbMapsLatitude1').val() + '" long1="' + $('#rbMapsLongitude1').val() + '" lat2="' + $('#rbMapsLatitude2').val() + '" long2="' + $('#rbMapsLongitude2').val() + '" zoom="' + $('#rbMapsZoom').val() + '" title="' + $('#rbMapsTitle').val() + '" address1="' + $('#rbMapsAddress1').val() + '" address2="' + $('#rbMapsAddress2').val() + '" width="' + $('#rbMapsSize1').val() + '" height="' + $('#rbMapsSize2').val() + '"][/rb_google_maps]';
			return data;
		}
		
		function insertNumericBlock(html){
			var data = '[rb_numeric_block number="' + $('#rbNumericBlockNumber').val() + '" title="' + $('#rbNumericBlockTitle').val() + '"]' + $('#rbNumericBlockContent').val() + '[/rb_numeric_block]';
			return data;
		}
		
		function insertPricingTable(){
			var data = '[rb_pricing_table]'
			$('#rbPricingTable').children('div.boxes').children('div').each(function(){
				data += '[rb_table_column]'
				data += '[rb_table_price title="' + $(this).find('.rbPricingTableTitle').val() + '"]' + $(this).find('.rbPricingTablePrice').val() + '[/rb_table_price]';
				data += '[rb_table_content]' + $(this).find('.rbPricingTableContent').val() + '[/rb_table_content]';
				data += '[rb_table_footer]' + $(this).find('.rbPricingTableFooter').val() + '[/rb_table_footer]';
				data += '[/rb_table_column]';
			});
			data += '[/rb_pricing_table]';
			return data;
		}
		
		function insertPostBox(){
			var data = '[rb_posts_box title="' + $('#rbPostsTitle').val() + '" category="' + $('#rbPostsTag').val() + '" no="' + $('#rbPostsNo').val() + '"] [/rb_posts_box]';
			return data;
		}
		
		function insertQuote(){
			var data = '[rb_quote]' + $('#rbQuoteContent').val() + '[/rb_quote]';
			return data;
		}
		
		function insertTabs(){
			var data = '[rb_tabs]'
			$('#rbTabs').children('div.boxes').children('div').each(function(){
				data += '[rb_tab title="' + $(this).find('.rbTabsTitle').val() + '"]' + $(this).find('.rbTabsContent').val() + '[/rb_tab]';
			});
			data += '[/rb_tabs]';
			return data;
		}
		
		function insertTeam(){
			var data = '[rb_team]';
			$('#rbTeam').children('div.boxes').children('div').each(function(){
				data += '[rb_team_member name="' + $(this).find('.rbTeamTitle').val() + '" position="' + $(this).find('.rbTeamSubtitle').val() + '" image="' + $(this).find('.rbTeamImagePath').val() + '"]' + $(this).find('.rbTeamContent').val() + '[/rb_team_member]';
			});
			data += '[/rb_team]';
			return data;
		}
		
		function insertTable(){
			var data = '[rb_table]' + $('#rbTableContent').val() + '[/rb_table]';
			return data;
		}
		
		function insertTextBox(){
			var data = '[rb_text_box style="' + $('#rbTextBoxStyle').val() + '"]' + $('#rbTextBoxContent').val() + '[/rb_text_box]';
			return data;
		}
		
		function insertTestimonials(){
			var data = '[rb_testimonials]'
			$('#rbTestimonials').children('div.boxes').children('div').each(function(){
				data += '[rb_testimonial title="' + $(this).find('.rbTestimonialsTitle').val() + '" source="' + $('.rbTestimonialsSource').val() + '"]' + $(this).find('.rbTestimonialsContent').val() + '[/rb_testimonial]';
			});
			data += '[/rb_testimonials]';
			return data;
		}
		
		function insertToggles(){
			var data = '[rb_toggles]'
			$('#rbToggles').children('div.boxes').children('div').each(function(){
				data += '[rb_toggle title="' + $(this).find('.rbTogglesTitle').val() + '"]' + $(this).find('.rbTogglesContent').val() + '[/rb_toggle]';
			});
			data += '[/rb_toggles]';
			return data;
		}
		
	});
})(jQuery);