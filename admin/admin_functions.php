<?php
/* Gets plugin information which is used throughout the files */
function get_name_core_updates(){
	global $coreupdateloc;
	$theme_data = implode('', file(ABSPATH."/wp-content/plugins/".$coreupdateloc."/wpc-disable-core-update.php"));
	if (preg_match("|Plugin Name:(.*)|i", $theme_data, $name_core_updates)) {
		$name_core_updates = $name_core_updates[1];
	}
	return $name_core_updates;
} 
function get_version_core_updates(){
	global $coreupdateloc;
	$theme_data = implode('', file(ABSPATH."/wp-content/plugins/".$coreupdateloc."/wpc-disable-core-update.php"));
	if (preg_match("|Version:(.*)|i", $theme_data, $version_core_updates)) {
		$version_core_updates = $version_core_updates[1];
	}
	return $version_core_updates;
} 
function get_build_core_updates(){
	global $coreupdateloc;
	$theme_data = implode('', file(ABSPATH."/wp-content/plugins/".$coreupdateloc."/wpc-disable-core-update.php"));
	if (preg_match("|Build:(.*)|i", $theme_data, $build_core_updates)) {
		$build_core_updates = $build_core_updates[1];
	}
	return $build_core_updates;
} 

/* Starts the plugins admin menu */
add_action('admin_menu', 'wpc_core_update_info_page'); 
function wpc_core_update_info_page(){
 global $totalcommentslogo;
 global $coreupdatelogo;
 add_menu_page('WP Version', 'WP Version', 8, 'disable_version', 'disable_version_info', $coreupdatelogo);
 $mypage = add_submenu_page('disable_version', 'Options', 'Options', 8, 'plugin_options', disable_version_options);
 add_submenu_page('disable_version', 'Update', 'Update', 8, 'plugin_update', disable_version_update);
 /* add_submenu_page('disable_version', 'WP Choice', 'WP Choice', 8, 'wp_choice', wpchoice); */
 add_submenu_page('disable_version', 'Eric Hamby', 'Eric Hamby', 8, 'eric_hamby', erichamby);
 add_action( "admin_print_scripts-$mypage", 'wpc_core_update_admin_head' );
}

/* Gets the JS files used for the plugin */
function wpc_core_update_admin_head() {
	global $coreupdatedir;
	wp_enqueue_script('loadjs', $coreupdatedir . '/admin/js/jquery.js');
	wp_enqueue_script('loadjsone', $coreupdatedir . '/admin/js/jquery.checkbox.min.js');
	wp_enqueue_script('loadjstwo', $coreupdatedir . '/admin/js/jsslideone.js');

/* Chooses the CSS sheet based on browser being used */	
	if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
	require_once('admin_head_css_ie.php'); } else { require_once('admin_head_css.php');
}}

/* Function for the Eric Hamby page */
function erichamby() {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://wpchoice.com/theme_files/backend_erichamby.php');
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);	
}

/* Function for the WP Choice page */
function wpchoice() {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://wpchoice.com/theme_files/backend_wpchoice.php');
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);	
}

/* Function for the updater */
session_start();
$_SESSION['disable_version_updates_version'] = '1.0' ;
function disable_version_updates()
 {
$site_url = 'http://wpchoice.com/updates/disable_version_updates_update.php';
$ch = curl_init();
$timeout = 5; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, $site_url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
 
ob_start();
curl_exec($ch);
curl_close($ch);
$file_contents = ob_get_contents();
ob_end_clean();

   if (preg_match ("@\<span\>(.*)\</span\>@i", $file_contents, $out)) {
   return $out[1];
   
  }
 } 
 
 /* Starts the theme options tables */
function wpc_core_update_table_start($name, $field) {
	echo '<p><table class="widefat">
    <thead>
      <tr>
        <th width="300px;">'.$name.'</th>
		<th><span style="float:right"><small>'.get_version_core_updates().'</small></span></th>
      </tr>
    </thead>';
	echo '<form method="post" action="options.php">';
	settings_fields($field);
}

/* Ends the theme options tables */
function wpc_core_update_table_stop() {
	echo '
	<tr class="alternate">
			<td colspan="2">
			<span style="float:left"><input type="submit" class="button" value="Save Options" /></span>
			<span class="button" style="float:right"><a href="http://wpchoice.com" target="_blank">Wp Choice</a></span>
			</td></tr>
			</form>
	</table></p>';
}
?>