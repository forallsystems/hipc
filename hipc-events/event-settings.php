<?php
function event_add_submenu_page() {
	add_submenu_page(
		'edit.php?post_type=events',
		'Reorder Events',
		'Reorder Events',
		'manage_options',
		'reorder_events',
		'reorder_admin_events_calback'
	);

}

add_action('admin_menu', 'event_add_submenu_page');

function reorder_admin_events_calback() {

	$args = array(
		'post_type' 				=> 'events',
		'orderby' 					=> 'menu_order',
		'order'						=> 'ASC',
		'post_status'				=> 'publish',
		'no_found_rows' 			=> true,
		'update_post_term_cache' 	=> false,
		'post_per_page'				=> 50
	);

	$event_listing = new WP_Query( $args );

	?>

	<div id="event-sort" class="wrap">
		<div id="icon-event-admin" class="icon32"><br /></div>
		<h2><?php _e( 'Sort Event Positions', 'hipc-events' ); ?><img src="<?php echo esc_url ( admin_url() . '/images/loading.gif'); ?>" id="loading-animation"></h2>
			<?php if ( $event_listing -> have_posts() ) : ?>
			<p><?php _e('<strong>Note:</strong> this only affects the events listed using the shortcode functions', 'hipc-events'); ?></p>
			<ul id="custom-type-list">
				<?php while ( $event_listing->have_posts() ) : $event_listing-> the_post(); ?>
					<li id="<?php esc_attr( the_id() ); ?>"><?php esc_html( the_title() );?></li>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<p><?php _e( 'You have no events to sort', 'hipc-events' ); ?></p>
		<?php endif; ?>
	</div>

	<?php
}

function event_save_reorder() {

	if ( !check_ajax_referer( 'hipc-event-order', 'security' ) ) {
		return wp_send_json_error( 'Invalid Nonce' );
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		return wp_send_json_error( 'You are not allowed to do this.' );
	}

	$order = $_POST['order'];
	$counter = 0;

	foreach( $order as $item_id ) {

		$post = array(
			'ID' => (int)$item_id,
			'menu_order' => $counter,
		);
		wp_update_post( $post );

		$counter++;
	}

	wp_send_json_success('Post Saved');

}

add_action( 'wp_ajax_save_sort', 'event_save_reorder' );