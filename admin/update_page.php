<?php function disable_version_update() {
 echo '<div class="wrap">';
 echo '<div id="icon-index" class="icon32"><br /></div><h2>Update Information</h2>'; 
 if (disable_version_updates() > $_SESSION['disable_version_updates_version']) {
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://wpchoice.com/updates/disable_version_updates_update.php');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
	} else { 
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://wpchoice.com/updates/disable_version_updates_no_update.php');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
	} 
  	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://wpchoice.com/updates/disable_version_updates_version_history.php');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
echo '</div>';
}
?>