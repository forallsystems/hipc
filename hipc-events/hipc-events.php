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

require_once ( plugin_dir_path(__FILE__) . 'hipc-custom-post-types.php' );
require_once ( plugin_dir_path(__FILE__) . 'event-fields.php' );
require_once ( plugin_dir_path(__FILE__) . 'venue-fields.php' );
require_once ( plugin_dir_path(__FILE__) . 'hipc-custom-rss.php' );
require_once ( plugin_dir_path(__FILE__) . 'event-template-load.php' );
require_once ( plugin_dir_path(__FILE__) . 'hipc-menus.php' );

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
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
	}

}
add_action( 'admin_enqueue_scripts', 'event_admin_enqueue_scripts' );

function hipc_enqueue_style() {
    wp_enqueue_style( 'hipc-style-css', plugins_url( 'css/hipc-style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'hipc_enqueue_style', 9999 );