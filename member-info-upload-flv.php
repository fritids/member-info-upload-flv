<?php 

/*
Plugin Name: Member Info Upload FLV
Plugin URI: http://jealousdesigns.com
Description: An extension to the Member Info plugin which users to upload flv's and have them displayed in a customisable player. This will also install and use the Hana FLV player which can be found here http://wordpress.org/extend/plugins/hana-flv-player/ If you have Hana FLV player installed already we will use that, if not, it will use the plugin bundled with this plugin.
Version: 0.1
Author: Jealous Designs
*/

if (!defined("MIUF_url")) { define("MIUF_url", WP_PLUGIN_URL.'/member-info-upload-flv'); } //NO TRAILING SLASH

if (!defined("MIUF_dir")) { define("MIUF_dir", WP_PLUGIN_DIR.'/member-info-upload-flv'); } //NO TRAILING SLASH

add_action('admin_notices', 'check_plugin_status_upload_flv' );

function check_plugin_status_upload_flv(){

	if ( get_option('member-info-installed') != 'yup' ) {

		echo '<div id="message" class="error"><p><strong>You do not have Member Info installed. The Upload FLV extension will not work without it.</strong></p></div>';

	}

}

if( get_option('member-info-installed') == 'yup'){

	$plugins = get_option('active_plugins');

	$required_plugin = 'hana-flv-player/hana-flv-player.php';

	if(!in_array( $required_plugin , $plugins )){

		include_once('hana-flv-player/hana-flv-player.php'); //Set up upload flv
	
	}

	include_once('includes/class-member-info-upload-flv.php'); //Set up upload flv
		
	register_activation_hook( __FILE__, 'add_installed_option_upload_flv' );
	
	function add_installed_option_upload_flv(){
	
		update_option('member-info-upload-flv-installed', 'yup');
	
	} // function
	
	register_deactivation_hook(__FILE__, 'remove_installed_option_upload_flv');
	
	function remove_installed_option_upload_flv(){
	
		delete_option('member-info-upload-flv-installed');
	
	}	
	
	function show_video(){
		$member_info_upload_flv->generate_video();
	}

}

?>