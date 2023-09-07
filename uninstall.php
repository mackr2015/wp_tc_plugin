<?php 

/*
* Triggered on TC Posts Plugin Uninstall
*
* @package TC_Posts
*/

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Clear Database stored data
