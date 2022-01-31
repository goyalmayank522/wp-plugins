<?php
/*
Plugin Name: Active Plugins
Description: All active plugins showing plugin
Version: 1.0.0 
*/

add_action('wp_dashboard_setup', 'dashboard_setup');

function dashboard_setup() {
    wp_add_dashboard_widget( 'active_inactive_feature_plugin', 'Installed Plugins', 'active_inactive_feature' );
}

function active_inactive_feature() {
    $all_plugins = get_plugins();
    $active_plugins = get_option('active_plugins');
    $active_plugins_array = array();
    foreach ( $active_plugins as $index => $ap ) {
	    if ( array_key_exists( $ap, $all_plugins ) ) {
		    array_push( $active_plugins_array, $all_plugins[$ap]['Name'] );
	    }
    }
    echo '<ul>';
    foreach ( $all_plugins as $plugin ) {
	    if ( in_array( $plugin['Name'], $active_plugins_array ) ) {
		    echo '<h4 style="margin-bottom:15px; font-weight:400; font-size:12px">', $plugin[ 'Name' ], ' ('. $plugin[ 'Version' ] .')', ' Status: Active</h4>';
	    }
	    else{
		    echo '<h4 style="margin-bottom:15px; font-weight:400; font-size:12px">', $plugin[ 'Name' ], ' ('. $plugin[ 'Version' ] .')', ' Status: Inactive</h4>';
	    }
   }
   echo '</ul>';
}
?>
