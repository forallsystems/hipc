<?php

function event_add_custom_metabox() {

	add_meta_box(
			'event_meta',
			__( 'Event Details' ),
			'event_meta_callback',
			'events',
			'normal',
			'core'
		);
}

add_action(  'add_meta_boxes', 'event_add_custom_metabox');

add_action('do_meta_boxes', 'change_image_box');
function change_image_box()
{
    remove_meta_box( 'postimagediv', 'custom_post_type', 'side' );
    add_meta_box('postimagediv', __('Event Image'), 'post_thumbnail_meta_box', 'events', 'side', 'high');
}

function change_featured_image_text( $content ) {
    return $content = str_replace( __( 'Set featured image' ), __( 'Set Event Image' ), $content);
}

add_filter( 'admin_post_thumbnail_html', 'change_featured_image_text' );

function change_title_text ( $title ) {
	$screen = get_current_screen();

	if ( 'events' == $screen->post_type ) {
		$title = 'Enter Event Name';
	}

	return $title;
}

add_filter ('enter_title_here', 'change_title_text');

function event_meta_callback( $post ) {
	//number used once - validate data actually came from the form you made

	wp_nonce_field( basename(__FILE__), 'events_nonce');
	$event_stored_meta = get_post_meta( $post->ID ); ?>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-venue" class="event-row-title"><?php _e( 'Venue', 'hipc-events' ); ?></label>
			</div>
			<div class="meta-td">
				<?php
				$dropdown_value = get_post_meta( get_the_ID(), '', true );
				$selected = isset( $event_stored_meta['event_venue'] ) ? esc_attr( $event_stored_meta['event_venue'][0] ) : ”;
				$args = array(
						'post_type'=> 'venues',
						'meta_key' => 'venue_name'

					);
				$venues = get_posts( $args );
				$selectedVenueID = '';

				if($venues) : ?>				
					<select id="event-venue" name="event_venue">
						<option selected disabled>Choose from your saved venues</option>
						<?php foreach ( $venues as $venue ) : ?>

						<option value="<?php echo $venue->ID; ?>"<?php selected ($selected, $venue->ID); ?>><?php echo $venue->venue_name; ?></option>
						<?php if (selected($selected, $venue->ID) !== '' ) {
								$selectedVenueID = $venue->ID;
							}
								?>
					<?php endforeach; ?>
					<?php endif ?>
				</select>
				<!-- Grab the data from the stored venue selected from drop down -->
				<?php   
					$event_venue_name = get_post_meta( $selectedVenueID, 'venue_name', true); 
					$event_street_address = get_post_meta( $selectedVenueID, 'venue_street_address', true);
					$event_address_2 = get_post_meta( $selectedVenueID, 'venue_street_address_2', true);  
					$event_zipcode = get_post_meta( $selectedVenueID, 'venue_zipcode', true); 
					$event_city = get_post_meta( $selectedVenueID, 'venue_city', true); 
					$event_state = get_post_meta( $selectedVenueID, 'venue_state', true);

					if ( ! empty ( $event_stored_meta['event_venue'] ) ) {
						update_post_meta( get_the_ID(), 'venue_name', $event_venue_name);	
						update_post_meta( get_the_ID(), 'venue_street_address', $event_street_address);
						update_post_meta( get_the_ID(), 'venue_address_2', $event_address_2);
						update_post_meta( get_the_ID(), 'venue_city', $event_city);
						update_post_meta( get_the_ID(), 'venue_state', $event_state);
						update_post_meta( get_the_ID(), 'venue_zipcode', $event_zipcode);
					} ?>
			</div>
		</div>
	</div>


	<div class="meta-row">
		<div class="meta-th">
			<label for="event-start-date" class="event-row-title"><?php _e( 'Event Start Date', 'hipc-events' ); ?></label>
		</div>
		<div class="meta-td">
			<input type="text" size=10 class="event-row-content datepicker" name="event_start_date" id="event-start-date" value="<?php if ( ! empty ( $event_stored_meta['event_start_date'] ) ) echo esc_attr( $event_stored_meta['event_start_date'][0] ); ?>"/>
		</div>
	</div>

	<div class="meta-row">
			<div class="meta-th">
				<label for="event_end_date" class="event-row-title"><?php _e( 'Event End Date', 'hipc-events' ) ?></label>
			</div>
			<div class="meta-td">
				<input type="text" size=10 class="event-row-content datepicker" name="event_end_date" id="event_end_date" value="<?php if ( ! empty ( $event_stored_meta['event_end_date'] ) ) echo esc_attr( $event_stored_meta['event_end_date'][0] ); ?>"/>
			</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-start-time" class="event-row-title"><?php _e( 'Event Start Time', 'hipc-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="event_start_time" id="event-start-time" value="<?php if ( ! empty ($event_stored_meta['event_start_time'] ) ) {
					echo esc_attr( $event_stored_meta['event_start_time'][0] ); 
				} ?> "/>
			</div>
		</div>
	</div>

	<div>
	<div class="meta-row">
			<div class="meta-th">
				<label for="event-end-time" class="event-row-title"><?php _e( 'Event End Time', 'hipc-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="event_end_time" id="event-end-time" value="<?php if ( ! empty ($event_stored_meta['event_end_time'] ) ) {
					echo esc_attr( $event_stored_meta['event_end_time'][0] ); 
				} ?> "/>
			</div>
		</div>
	</div>

		<div>
		<div class="meta-row">
	        <div class="meta-th">
	          <label for="event-description" class="event-row-title"><?php _e( 'Event Description', 'hipc-events' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="event_description" class="event-textarea" id="event-description"><?php
	          if ( ! empty ( $event_stored_meta['event_description'] ) ) {
		          echo esc_attr( $event_stored_meta['event_description'][0] );
	          } ?></textarea>
	        </div>
	    </div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-cost" class="event-row-title"><?php _e( 'Event Cost', 'hipc-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="event_cost" id="event-cost" 
				value="<?php if ( ! empty ($event_stored_meta['event_cost'] ) ) {
					echo esc_attr( $event_stored_meta['event_cost'][0] ); 
				} ?> "/>
			</div>
		</div>
	</div>
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-website" class="event-row-title"><?php _e( 'Event Website', 'hipc-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="event_website" id="event-website" 
				value="<?php if ( ! empty ($event_stored_meta['event_website'] ) ) {
					echo esc_attr( $event_stored_meta['event_website'][0] ); 
				} ?> "/>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-organizer" class="event-row-title"><?php _e( 'Event Organizer', 'hipc-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="event_organizer" id="event-organizer" 
				value="<?php if ( ! empty ($event_stored_meta['event_organizer'] ) ) {
					echo esc_attr( $event_stored_meta['event_organizer'][0] ); 
				} ?> "/>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-twitter" class="event-row-title"><?php _e( 'Event Twitter', 'hipc-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="event_twitter" id="event-twitter" 
				value="<?php if ( ! empty ($event_stored_meta['event_twitter'] ) ) {
					echo esc_attr( $event_stored_meta['event_twitter'][0] ); 
				} ?> "/>
			</div>
		</div>
	</div>
	
	<div>
		<div class="meta-row">
	        <div class="meta-th">
	          <label for="event-notes" class="event-row-title"><?php _e( 'Event Notes', 'hipc-events' ) ?></label>
	        </div>
	        <div class="meta-td">
	          <textarea name="event_notes" class="event-textarea" id="event-notes"><?php
	          if ( ! empty ( $event_stored_meta['event_notes'] ) ) {
		          echo esc_attr( $event_stored_meta['event_notes'][0] );
	          } ?></textarea>
	        </div>
	    </div>
	</div>


	<?php	
}

function event_meta_save( $post_id ) {
	// checks save status


	$is_autosave = wp_is_post_autosave( $post_id);
	$is_revision = wp_is_post_revision( $post_id);
	$is_valid_nonce = (isset( $_POST['events_nonce']) && wp_verify_nonce ( $_POST[ 'events_nonce'], basename(__FILE__))) ? 'true' : 'false';

	if ( $is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}

	if ( isset( $_POST['event_start_date'] ) ) {
		update_post_meta( $post_id, 'event_start_date', sanitize_text_field($_POST[ 'event_start_date' ] ) );
	}

	if ( isset( $_POST['event_end_date'] ) ) {
		update_post_meta( $post_id, 'event_end_date', sanitize_text_field($_POST[ 'event_end_date' ] ) );
	}

	if ( isset( $_POST['event_end_time'] ) ) {
	update_post_meta( $post_id, 'event_end_time', sanitize_text_field($_POST[ 'event_end_time' ] ) );
	}

	if ( isset( $_POST['event_start_time'] ) ) {
	update_post_meta( $post_id, 'event_start_time', sanitize_text_field($_POST[ 'event_start_time' ] ) );
	}

	if ( isset( $_POST['event_description'] ) ) {
	update_post_meta( $post_id, 'event_description', sanitize_text_field($_POST[ 'event_description' ] ) );
	}


	if ( isset( $_POST['event_notes'] ) ) {
	update_post_meta( $post_id, 'event_notes', sanitize_text_field($_POST[ 'event_notes' ] ) );
	}

	if ( isset( $_POST['event_cost'] ) ) {
	update_post_meta( $post_id, 'event_cost', sanitize_text_field($_POST[ 'event_cost' ] ) );
	}

	if ( isset( $_POST['event_organizer'] ) ) {
	update_post_meta( $post_id, 'event_organizer', sanitize_text_field($_POST[ 'event_organizer' ] ) );
	}

	if ( isset( $_POST['event_twitter'] ) ) {
	update_post_meta( $post_id, 'event_twitter', sanitize_text_field($_POST[ 'event_twitter' ] ) );
	}

	if ( isset( $_POST['event_website'] ) ) {
	update_post_meta( $post_id, 'event_website', sanitize_text_field($_POST[ 'event_website' ] ) );
	}

	if ( isset( $_POST['event_venue'] ) ) {
	update_post_meta( $post_id, 'event_venue', sanitize_text_field($_POST[ 'event_venue' ] ) );
	}

	if ( isset( $_POST['venue_name'] ) ) {
	update_post_meta( $post_id, 'venue_name', sanitize_text_field($_POST[ 'venue_name' ] ) );
	}

	if ( isset( $_POST['venue_street_address'] ) ) {
	update_post_meta( $post_id, 'venue_street_address', sanitize_text_field($_POST[ 'venue_street_address' ] ) );
	}

	if ( isset( $_POST['venue_street_address_2'] ) ) {
	update_post_meta( $post_id, 'venue_street_address_2', sanitize_text_field($_POST[ 'venue_street_address_2' ] ) );
	}

	if ( isset( $_POST['venue_city'] ) ) {
	update_post_meta( $post_id, 'venue_city', sanitize_text_field($_POST[ 'venue_city' ] ) );
	}

	if ( isset( $_POST['venue_state'] ) ) {
	update_post_meta( $post_id, 'venue_state', sanitize_text_field($_POST[ 'venue_state' ] ) );
	}

	if ( isset( $_POST['venue_zipcode'] ) ) {
	update_post_meta( $post_id, 'venue_zipcode', sanitize_text_field($_POST[ 'venue_zipcode' ] ) );
	}

}
add_action ('save_post', 'event_meta_save');