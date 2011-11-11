jQuery(document).ready(function() {

	jQuery('#mi_upload_video_button').click(function() {
		window.send_to_editor = function(html) {
			vidurl = jQuery(html).attr('href');
			vidname = jQuery(html).html();
			
			if(jQuery('#upload_video').val() == ''){
				jQuery('#upload_video').val(vidurl + '=' + vidname);
			}else{
				jQuery('#upload_video').val(jQuery('#upload_video').val() + '~' + vidurl + '=' + vidname);
			}
			
			jQuery('#mi_videos .single_row:first').parent().append('<div class="single_row"><div class="mi_uploaded_vid" >' + vidname + '</div><img style="cursor:pointer;" onClick="deleteVideo(\'' +vidurl + '\', \'' + vidname + '\');" src="' + MI.MI_url + '/img/delete.png" class="delete_document" /></div>');
 			jQuery('.single_row:first').remove();
			tb_remove(); 
		}


			tb_show('', MI.WPURL + 'media-upload.php?type=image&member_info_type=image&file_types=flv&TB_iframe=true');

		return false;
	});
 
	//tb_position();

});

function deleteVideo(doc, name){

	alert(doc + ' ' + name);

	jQuery('#upload_video').val(jQuery('#upload_video').val().replace(doc + '=' + name + '~', '').replace( '~' + doc + '=' + name, '').replace( doc + '=' + name, ''));

	jQuery('div[title="' + doc + '"]').html('<img class="mi_video" src="' + MIUF_settings.MIUF_url + '/img/video.png" />').attr('title', '');

}