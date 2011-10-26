<?php

$member_info_upload_flv = new member_info_upload_flv;

class member_info_upload_flv {

	function member_info_upload_flv(){
	
		$this->__construct();
		
	} // function
	
	function __construct(){
	
		add_action("admin_init", array( &$this, 'js_libs' ));
	
		add_action("wp_enqueue_scripts", array( &$this, 'js_libs' ));
	
		add_action( 'extra_fields_options', array( &$this, 'add_url_option' ), 10, 1 ); 
	
		add_action( 'extra_fields_options_js', array( &$this, 'add_url_option_js' ), 10, 1 ); 
		
		add_action( 'front_end_display_fields', array( &$this, 'front_end_display_fields' ), 10, 5 );
	
	} // function	
	
	function js_libs(){
	
		global $pagenow;
	
  		if (is_admin()) {
  		
    		if ($pagenow=='profile.php' || $pagenow == 'user-edit.php') { 
    		
    			wp_enqueue_script('miuf_upload', MIUF_url . '/js/upload.js', array('thickbox'));
    			
				$data = array( 'MIUF_url' => MIUF_url, 'WPURL' => get_bloginfo('url') . '/wp-admin/');
				wp_localize_script( 'miuf_upload', 'MIUF_settings', $data );
    		
    		}
    	
    	}else{
    	
    		if(is_page(get_option('profile_page_id')) || is_page(get_option('register_page_id'))){
    		
    			wp_enqueue_script('miuf_upload', MIUF_url . '/js/upload.js', array('thickbox'));
    			
				$data = array( 'MIUF_url' => MIUF_url, 'WPURL' => get_bloginfo('url') . '/wp-admin/');
				wp_localize_script( 'miuf_upload', 'MIUF_settings', $data );
    		
    		}
    	
    	}
	
	}
	
	function add_url_option($field){
	
		echo '<option ';
		if($field == 'video'){
			echo "selected";
		}
		echo ' value="video">Video</option>';
	
	} // function
	
	function add_url_option_js(){
	
		echo '<option value="video">Video</option>';
	
	} // function	
	
	function front_end_display_fields($type, $field, $sanitized_field, $fields_desc, $user_id){		

		if($type == 'video'){
		
			$user_info = get_userdata($user_id);
		
			echo '<tr>
					<th><label for="' .$field. '">' .$field. '</label</th>
					<a name="custom_field_' . $sanitized_field . '"></a>
					<td>
						<input class="button" type="button" id="mi_upload_video_button" name="' . $sanitized_field . '" value="Upload a video"/>
						<input type="text" id="upload_video" name="' . $sanitized_field . '" value="' . $user_info->$sanitized_field . '"  class="custom_field_' . $sanitized_field . '"/>
						<div id="mi_videos">';
						
						$documents = explode( '~', $user_info->$sanitized_field );
						
						$i = 0;
						foreach($documents as $doc){
						
							if($doc != ''){
								$document = explode( '=', $doc );
								echo '<div class="single_row" title="' . $document[0] . '"><div class="mi_uploaded_doc" >' . $document[1] . '</div><img style="cursor:pointer;" onClick="deleteVideo(\'' . $document[0] . '\', \'' . $document[1] . '\');" src="' . MI_url . '/img/delete.png" class="delete_document" /></div>';
							}else{
								echo '<div class="single_row"><img class="mi_document" src="' . MIUF_url . '/img/video.png" /></div>';
							}	
							
						}				
						
						echo '</div>
						<span class="description">
							' . $fields_desc . '
						</span>
					</td>
				</tr>';
		
		}
	
	} // function
	
	function generate_video(){
	
		
	
	} // function
	
}

?>