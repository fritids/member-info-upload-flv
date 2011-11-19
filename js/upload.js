jQuery(document).ready(function() {

	jQuery('.mi_upload_video_button').each(function(e){

		jQuery(this).click(function() {
		
			var append = jQuery(this).parent().find('#mi_videos');
			
			var value = jQuery(this).parent().find('#upload_video');
			
			var remove = jQuery(this).parent().find('#mi_videos div:first');
			
			//var video_limit_val = jQuery(this).parent().find('#video_limit');
		
			window.send_to_editor = function(html) {
				vidurl = jQuery(html).attr('href');
				vidname = jQuery(html).html();
				
				if(value.val() == ''){
					value.val(vidurl + '=' + vidname);
				}else{
					value.val(value.val() + '~' + vidurl + '=' + vidname);
				}
				
				append.append('<div class="single_row"><div class="mi_uploaded_vid" >' + vidname + '</div><img style="cursor:pointer;" onClick="deleteVideo(\'' +vidurl + '\', \'' + vidname + '\');" src="' + MI.MI_url + '/img/delete.png" class="delete_document" /></div>');
	 			remove.remove();
				tb_remove(); 
			}
	
	
				tb_show('', MI.WPURL + 'media-upload.php?type=image&member_info_type=image&file_types=flv&height=500&width=700&TB_iframe=true');
	
			return false;
		});
		
	});
 
});

function deleteVideo(doc, name){

	var value = jQuery('div[title="' + doc + '"]').parent().parent().parent().find('#upload_video');

	value.val(value.val().replace(doc + '=' + name + '~', '').replace( '~' + doc + '=' + name, '').replace( doc + '=' + name, ''));

	jQuery('div[title="' + doc + '"]').html('<img class="mi_video" src="' + MIUF_settings.MIUF_url + '/img/video.png" />').attr('title', '');

}