(function($){
	$(function() {
	
		var $gridMargins = $('.margin');
		
		$('#marginsCheck').click(function(){
			if($(this).attr('checked')=='checked'){
				$gridMargins.fadeIn();
			}else{
				$gridMargins.fadeOut();
			}
		});
		
		var $selectedColumn = $('');
		$('.holder').click(function(){
			$selectedColumn.removeClass('selectedCol');
			$selectedColumn = $(this);
			$selectedColumn.addClass('selectedCol');
			return false;
		});
		
		$('#insertCode').click(function (){
			if($selectedColumn.length > 0) {
				var tagtext;
				var ctag;
				var inst = tinyMCE.getInstanceById('content');
				var html = inst.selection.getContent();
				var prefix='';
				var omega='';
				var alpha='';
				
				if($('#marginsCheck').attr('checked')=='checked')
					prefix = ' margin';
					
				if($('#firstCheck').attr('checked')=='checked')
					prefix = ' first';
					
				if($('#lastCheck').attr('checked')=='checked')
					prefix = ' last';
				
				tagtext	= "[" + $selectedColumn.data('grid');
	
				if ($selectedColumn.data('grid') != 'clear'){
					if ( html )
						ctag = "[/" + $selectedColumn.data('grid') + "]";
					else
						ctag = " Your content here [/" + $selectedColumn.data('grid') + "]";
				}else{
					ctag = "[/clear]";
				}
					
				window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext+prefix+']'+html+ctag);
				tinyMCEPopup.editor.execCommand('mceRepaint');
				tinyMCEPopup.close();
			}else{
				tinyMCEPopup.close();
			}
			return false;
			
		});
		
	});
})(jQuery);