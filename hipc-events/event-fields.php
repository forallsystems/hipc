<?php

function event_add_custom_metabox() {

	add_meta_box(
			'event_meta',
			'Event Listing',
			'event_meta_callback',
			'events',
			'normal',
			'low'
		);
}

add_action(  'add_meta_boxes', 'event_add_custom_metabox');

function event_meta_callback( $post ) {
	//number used once - validate data actually came from the form you made

	wp_nonce_field( basename(__FILE__), 'events_nonce');
	$event_stored_meta = get_post_meta( $post->ID ); ?>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="event-name" class="event-row-title">Event Name</label>
			</div>
			<div class="meta-td">
				<input type="text" name="hipc_event_name" id="hipc-event-name" 
				value="<?php if ( ! empty ($event_stored_meta['hipc_event_name'] ) ) {
					echo esc_attr( $event_stored_meta['hipc_event_name'][0] ); 
				} ?> "/>
			</div>
		</div>
	</div>
	<div class="meta">
		<div class="meta-th">
			<span>Event Description</span>
		</div>
	</div>
	<div class="meta-editor"></div>
	<?php

	$content = get_post_meta( $post->ID, 'event_description', true);
	$editor = 'event_description';
	$settings = array(
		'textarea_rows' => 8,
		'media_buttons' => true,
	);

	wp_editor( $content, $editor, $settings);

	?>
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

	if ( isset( $_POST['hipc_event_name'] ) ) {
		update_post_meta( $post_id, 'hipc_event_name', sanitize_text_field($_POST[ 'hipc_event_name' ] ) );
	}
}
add_action ('save_post', 'event_meta_save');