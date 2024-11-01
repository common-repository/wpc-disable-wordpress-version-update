<?php
/*
Plugin Name: Disable WordPress Version Updates
Plugin URI: http://wpchoice.com
Description: Disables the annoying WordPress update checking and notification system. Dont forget to activate the disable option in the plugins option menu to get it to work. Visit "<a href="http://wpchoice.com">WP Choice</a>" to get information on this plugin and many others.
Version: 1.0
Build: 10.01.29
Author: Eric Hamby
Author URI: http://erichamby.com/
*/

/* Sets the locations for the plugin */
$coreupdateloc = basename(dirname(__FILE__));
$coreupdatedir = get_settings('home').'/wp-content/plugins/'.$coreupdateloc;
$coreupdatefile = $coreupdatedir.'/wpc-disable-core-update.php';
$coreupdatelogo = $coreupdatedir.'/admin/images/admin_logo.png';

/* Gets all the files needed for the plugin to work */
require_once('admin/admin_functions.php');
require_once('admin/info_page.php');
require_once('admin/update_page.php');
require_once('admin/options_page.php');
require_once('admin/register_page.php');


if ( get_option('wpc_core_update_active') ) :
# 2.3 to 2.7:
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

# 2.8:
remove_action( 'wp_version_check', 'wp_version_check' );
remove_action( 'admin_init', '_maybe_update_core' );
add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );
endif;
      
?>