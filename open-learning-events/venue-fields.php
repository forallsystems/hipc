<?php
function ole_venue_add_custom_metabox() {

	add_meta_box(
		'venue_meta',
		__( 'Venue Listing' ),
		'ole_venue_meta_callback',
		'venues',
		'normal',
		'core'
		);
}

add_action(  'add_meta_boxes', 'ole_venue_add_custom_metabox' );

function ole_change_title_text_venue ( $title ) {
	$screen = get_current_screen();

	if ( 'venues' == $screen->post_type ) {
		$title = 'Enter Venue Name';
	}

	return $title;
}

add_filter ('enter_title_here', 'ole_change_title_text_venue');

function ole_venue_meta_callback( $post ) {
	//number used once - validate data actually came from the form you made

	wp_nonce_field( basename(__FILE__), 'venues_nonce');
	$venue_stored_meta = get_post_meta( $post->ID ); ?>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="venue-street-address" class="venue-row-title"><?php _e( 'Venue Street Address', 'ole-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="venue_street_address" id="venue-street-address" 
				value="<?php if ( ! empty ($venue_stored_meta['venue_street_address'] ) ) {
					echo esc_attr( $venue_stored_meta['venue_street_address'][0] ); 
				} ?>"/>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="venue-address-2" class="venue-row-title"><?php _e( 'Venue Address 2', 'ole-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="venue_address_2" id="venue-address-2" 
				value="<?php if ( ! empty ($venue_stored_meta['venue_address_2'] ) ) {
					echo esc_attr( $venue_stored_meta['venue_address_2'][0] ); 
				} ?>"/>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="venue-city" class="venue-row-title"><?php _e( 'Venue City', 'ole-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="venue_city" id="venue-city" 
				value="<?php if ( ! empty ($venue_stored_meta['venue_city'] ) ) {
					echo esc_attr( $venue_stored_meta['venue_city'][0] ); 
				} ?>"/>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="venue-state" class="venue-row-title"><?php _e( 'Venue State', 'ole-events' ); ?></label>
			</div>
			<div class="meta-td">
				<?php 
				$selected = isset( $venue_stored_meta['venue_state'] ) ? esc_attr( $venue_stored_meta['venue_state'][0] ) : '';?>
				<select id="venue-state" name="venue_state">
					<option selected disabled>Choose a state</option>
					<option value="AL"<?php selected( $selected, "AL" );?>>Alabama</option>
					<option value="AK"<?php selected( $selected, "AK" );?>>Alaska</option>
					<option value="AZ"<?php selected( $selected, "AZ" );?>>Arizona</option>
					<option value="AR"<?php selected( $selected, "AR" );?>>Arkansas</option>
					<option value="CA"<?php selected( $selected, "CA" );?>>California</option>
					<option value="CO"<?php selected( $selected, "CO" );?>>Colorado</option>
					<option value="CT"<?php selected( $selected, "CT" );?>>Connecticut</option>
					<option value="DE"<?php selected( $selected, "DE" );?>>Delaware</option>
					<option value="DC"<?php selected( $selected, "DC" );?>>District Of Columbia</option>
					<option value="FL"<?php selected( $selected, "FL" );?>>Florida</option>
					<option value="GA"<?php selected( $selected, "GA" );?>>Georgia</option>
					<option value="HI"<?php selected( $selected, "HI" );?>>Hawaii</option>
					<option value="ID"<?php selected( $selected, "ID" );?>>Idaho</option>
					<option value="IL"<?php selected( $selected, "IL" );?>>Illinois</option>
					<option value="IN"<?php selected( $selected, "IN" );?>>Indiana</option>
					<option value="IA"<?php selected( $selected, "IA" );?>>Iowa</option>
					<option value="KS"<?php selected( $selected, "KS" );?>>Kansas</option>
					<option value="KY"<?php selected( $selected, "KY" );?>>Kentucky</option>
					<option value="LA"<?php selected( $selected, "LA" );?>>Louisiana</option>
					<option value="ME"<?php selected( $selected, "ME" );?>>Maine</option>
					<option value="MD"<?php selected( $selected, "MD" );?>>Maryland</option>
					<option value="MA"<?php selected( $selected, "MA" );?>>Massachusetts</option>
					<option value="MI"<?php selected( $selected, "MI" );?>>Michigan</option>
					<option value="MN"<?php selected( $selected, "MN" );?>>Minnesota</option>
					<option value="MS"<?php selected( $selected, "MS" );?>>Mississippi</option>
					<option value="MO"<?php selected( $selected, "MO" );?>>Missouri</option>
					<option value="MT"<?php selected( $selected, "MT" );?>>Montana</option>
					<option value="NE"<?php selected( $selected, "NE" );?>>Nebraska</option>
					<option value="NV"<?php selected( $selected, "NV" );?>>Nevada</option>
					<option value="NH"<?php selected( $selected, "NH" );?>>New Hampshire</option>
					<option value="NJ"<?php selected( $selected, "NJ" );?>>New Jersey</option>
					<option value="NM"<?php selected( $selected, "NM" );?>>New Mexico</option>
					<option value="NY"<?php selected( $selected, "NY" );?>>New York</option>
					<option value="NC"<?php selected( $selected, "NC" );?>>North Carolina</option>
					<option value="ND"<?php selected( $selected, "ND" );?>>North Dakota</option>
					<option value="OH"<?php selected( $selected, "OH" );?>>Ohio</option>
					<option value="OK"<?php selected( $selected, "OK" );?>>Oklahoma</option>
					<option value="OR"<?php selected( $selected, "OR" );?>>Oregon</option>
					<option value="PA"<?php selected( $selected, "PA" );?>>Pennsylvania</option>
					<option value="RI"<?php selected( $selected, "RI" );?>>Rhode Island</option>
					<option value="SC"<?php selected( $selected, "SC" );?>>South Carolina</option>
					<option value="SD"<?php selected( $selected, "SD" );?>>South Dakota</option>
					<option value="TN"<?php selected( $selected, "TN" );?>>Tennessee</option>
					<option value="TX"<?php selected( $selected, "TX" );?>>Texas</option>
					<option value="UT"<?php selected( $selected, "UT" );?>>Utah</option>
					<option value="VT"<?php selected( $selected, "VT" );?>>Vermont</option>
					<option value="VA"<?php selected( $selected, "VA" );?>>Virginia</option>
					<option value="WA"<?php selected( $selected, "WA" );?>>Washington</option>
					<option value="WV"<?php selected( $selected, "WV" );?>>West Virginia</option>
					<option value="WI"<?php selected( $selected, "WI" );?>>Wisconsin</option>
					<option value="WY"<?php selected( $selected, "WY" );?>>Wyoming</option>
				</select>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="venue-zipcode" class="venue-row-title"><?php _e( 'Venue Zipcode', 'ole-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="venue_zipcode" id="venue-zipcode" 
				value="<?php if ( ! empty ($venue_stored_meta['venue_zipcode'] ) ) {
					echo esc_attr( $venue_stored_meta['venue_zipcode'][0] ); 
				} ?>"/>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="venue-phone" class="venue-row-title"><?php _e( 'Venue Phone Number', 'ole-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="venue_phone" id="venue-phone" 
				value="<?php if ( ! empty ($venue_stored_meta['venue_phone'] ) ) {
					echo esc_attr( $venue_stored_meta['venue_phone'][0] ); 
				} ?>"/>
			</div>
		</div>
	</div>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="venue-website" class="venue-row-title"><?php _e( 'Venue Website', 'ole-events' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" name="venue_website" id="venue-website" 
				value="<?php if ( ! empty ($venue_stored_meta['venue_website'] ) ) {
					echo esc_attr( $venue_stored_meta['venue_website'][0] ); 
				} ?>"/>
			</div>
		</div>
	</div>



	<?php	
}

function ole_venue_meta_save( $post_id ) {
	// checks save status

	$is_autosave = wp_is_post_autosave( $post_id);
	$is_revision = wp_is_post_revision( $post_id);
	$is_valid_nonce = (isset( $_POST['venues_nonce']) && wp_verify_nonce ( $_POST[ 'venues_nonce'], basename(__FILE__))) ? 'true' : 'false';

	if ( $is_autosave || $is_revision || !$is_valid_nonce) {
		return;
	}

	if ( isset( $_POST['post_title'] ) ) {
		update_post_meta( $post_id, 'venue_name', sanitize_text_field($_POST[ 'post_title' ] ) );
	}

	if ( isset( $_POST['venue_street_address'] ) ) {
	update_post_meta( $post_id, 'venue_street_address', sanitize_text_field($_POST[ 'venue_street_address' ] ) );
	}

	if ( isset( $_POST['venue_address_2'] ) ) {
	update_post_meta( $post_id, 'venue_address_2', sanitize_text_field($_POST[ 'venue_address_2' ] ) );
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

	if ( isset( $_POST['venue_phone'] ) ) {
	update_post_meta( $post_id, 'venue_phone', sanitize_text_field($_POST[ 'venue_phone' ] ) );
	}

	if ( isset( $_POST['venue_website'] ) ) {
	update_post_meta( $post_id, 'venue_website', sanitize_text_field($_POST[ 'venue_website' ] ) );
	}

}
add_action ('save_post', 'ole_venue_meta_save');