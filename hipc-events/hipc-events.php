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
require_once ( plugin_dir_path(__FILE__) . 'event-render-admin.php' );
require_once ( plugin_dir_path(__FILE__) . 'event-fields.php' );