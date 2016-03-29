<?php
function add_custom_fields_to_rss() {
	if (get_post_type()=='events') {

		$fields = array( 'event_start_time', 'event_end_time', 'event_description', 'event_notes', 'event_cost', 'event_organizer', 'event_twitter', 'event_website', 'venue_name', 'venue_street_address', 'venue_address_2', 'venue_city', 'venue_state', 'venue_zipcode', 'venue_phone', 'venue_website');
		$post_id = get_the_ID();
		$eventName = get_the_title();
		echo "<event_name>{$eventName}</event_name>\n";

		if ($value = get_post_meta($post_id, 'event_start_date', true)) {
			$startDate = date('F d, Y', $value);
			echo"<event_start_date>{$startDate}</event_start_date>\n";
		}

		if ($value = get_post_meta($post_id, 'event_end_date', true)) {
			$endDate = date('F d, Y', $value);
			echo"<event_end_date>{$endDate}</event_end_date>\n";
		}
		foreach($fields as $field)
			if ($value = get_post_meta($post_id,$field,true))
				echo "<{$field}>{$value}</{$field}>\n";

			$taxonomies = array ( 'connected_learning', 'credentialing', 'event_type', 'grade_level', 'hive_membership_status', 'payment', 'subject' );
			
			foreach($taxonomies as $taxonomy) {
				$terms = get_the_terms($post_id,$taxonomy);
				if (is_array($terms)) {
					foreach ($terms as $term) {
						echo "<event_categories>{$term->name}</event_categories>\n";
					}
				} 
			}

		if ($value = get_post_meta($post_id, 'event_image', true)) {
			echo"<event_image>{$value}</event_image>\n";
		} else {
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id,'large', true);
			echo "<event_image>{$image_url[0]}</event_images>\n";
		}
			
		}
	if (get_post_type()=='venues') {
		$fields = array( 'venue_name', 'venue_street_address', 'venue_address_2', 'venue_city', 'venue_state', 'venue_zipcode', 'venue_phone', 'venue_website' );
		$post_id = get_the_ID();
		foreach($fields as $field)
			if ($value = get_post_meta($post_id,$field,true))
				echo "<{$field}>{$value}</{$field}>\n";
		}
	}
	add_action('rss2_item', 'add_custom_fields_to_rss');