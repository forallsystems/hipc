<?php 
/* 
	* Plugin Name: HIPC Events
	* Description: A simple plugin that adds custom post types and taxonomies, custom meta boxes for events
	* Version: 0.1
	* Author: Megan Stetz
	* License: GPL2

{HIPC Events} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{HIPC Events} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {HIPC Custom Post Types and Taxonmies}. If not, see {License URI}.
*/

//Exit if accessed directly
if ( ! defined( 'ABSPATH')) {
	exit;
}

require_once ( plugin_dir_path(__FILE__) . 'posttypes.php' );
//require_once ( plugin_dir_path(__FILE__) . 'event-settings.php' );
require_once ( plugin_dir_path(__FILE__) . 'event-fields.php' );
require_once ( plugin_dir_path(__FILE__) . 'venue-fields.php' );
//require_once ( plugin_dir_path(__FILE__) . 'event-shortcode.php' );
require_once ( plugin_dir_path(__FILE__) . 'hipc-custom-rss.php' );

function event_admin_enqueue_scripts() {
	global $pagenow, $typenow;

	if ( $typenow == 'events' ) {
		wp_enqueue_style( 'event-admin-css', plugins_url( 'css/admin-events.css', __FILE__ ) );
	}

	if ( $typenow == 'venues' ) {
		wp_enqueue_style( 'event-admin-css', plugins_url( 'css/admin-venues.css', __FILE__ ) );
	}

	if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'events' ) {
		
		wp_enqueue_script( 'event-admin-js', plugins_url( 'js/admin-events.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker' ), '20160212', true);
		wp_enqueue_script( 'event-admin-js', plugins_url( 'js/admin-events.js', __FILE__ ), array( 'jquery', 'jquery-ui-timepicker' ), '20160214', true);
		wp_enqueue_script( 'event-custom-quicktags', plugins_url( 'js/event-quicktags.js', __FILE__ ), array( 'quicktags' ), '20160208', true );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
	}

	if (  $pagenow == 'edit.php' && $typenow == 'events') {
		wp_enqueue_script( 'reorder-js', plugins_url( 'js/reorder.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), '20160216', true);
		wp_localize_script( 'reorder-js', 'HIPC_EVENT_LISTING', array(
			'security' 	=> wp_create_nonce( 'hipc-event-order' ),
			'sucess'	=> 'Events sort order has been saved.',
			'failure'	=> 'There was an error saving the sort order, or you do not have the proper permissions.'
			) );
	}

}
add_action( 'admin_enqueue_scripts', 'event_admin_enqueue_scripts' );