<?php
function event_taxonomy_list( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'title' => 'Current events in...',
		), $atts
	);

	$locations = get_terms( 'location' );

	if( ! empty( $locations) && ! is_wp_error( $locations ) ) {

	$displayList = '<div id="event-location-list">';
	$displayList .= '<h4>' . esc_html__($atts[ 'title' ] ). '</h4>';
	$displayList .= '<ul>';

		foreach( $locations as $location ) {

			$displayList .= '<li class="event-location">';
			$displayList .= '<a href="' . esc_url(get_term_link( $location )) . '">';
			$displayList .= esc_html__($location->name ). '</a></li>';
		}

	$displayList .= '</ul></div>';

	}

	return $displayList;
}

add_shortcode( 'event_location_list', 'event_taxonomy_list' );

function list_event_by_location( $atts, $content = null) {

	if ( ! isset( $atts['location'] )) {
		return '<p class="event-error">You must provide a location for this shortcode to work.</p>';
	}
	$att = shortcode_atts( array (
			'title' => 'Current events in',
			'count' => 5,
			'location' => '',
			'pagination' => 'off'
		), $atts );

	$pagination = $atts [ 'pagination' ] == 'on' ? false : true;

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$args = array(
			'post_type'		=> 'events',
			'post_status'	=> 'publish',
			'no_found_rows'	=>	$pagination,
			'posts_per_page' =>	$atts[ 'count' ],
			'paged'			=> $paged,
			'tax_query'		=> array(
				array(
						'taxonomy' => 'location',
						'field'		=> 'slug',
						'terms'		=> $atts[ 'location' ],
				),
			)
		);

	$events_by_location = new WP_Query( $args );

	if ( $events_by_location-> have_posts()) :
		$location = str_replace('-', ' ', $atts['location']);

		$display_by_location = '<div id="events-by-location">';
		$display_by_location .= '<h4>' . esc_html__( $atts['title']) . '&nbsp' . esc_html__( ucwords( $location )) . '</h4>';
		$display_by_location .= '<ul>';

		while ($events_by_location->have_posts()) : $events_by_location->the_post();

		global $post;
		$eventDate = get_post_meta( get_the_ID(), 'hipc_end_date', true);
		$title = get_the_title();
		$slug = get_permalink();

		$display_by_location .= '<li class="event-listing">';
		$display_by_location .= sprintf('<a href="%s">%s</a>&nbsp&nbsp', esc_url( $slug ), esc_html__( $title ));
		$display_by_location .= '<span>' . esc_html__( $eventDate) . '</span>';
		$display_by_location .= '</li>';
	endwhile;

	$display_by_location .= '</ul>';
	$display_by_location .= '</div>';

	else:
		$display_by_location = sprintf( __( '<p class="event-error">Sorry, no events listed in %s where found.</p>' ), esc_html__( ucwords( str_replace( '-', ' ', $atts[ 'location' ] ) ) ) );
	
	endif;

	wp_reset_postdata();

	if ($events_by_location->max_num_pages > 1 && is_page() ) {
		$display_by_location .= '<nav class="prev-next-posts">';
		$display_by_location .= '<div call ="nav-previous">';
		$display_by_location .= get_next_posts_link(__( '<span class="meta-nav">&larr;</span> Previous'), $events_by_location->max_num_pages);
		$display_by_location .= '</div>';
		$display_by_location .= '<div class="next-posts-link">';
		$display_by_location .= get_previous_posts_link(__('<span class="meta-nav">&rarr;</span> Next') );
		$display_by_location .= '</div>';
		$display_by_location .= '</nav>';
	}

	return $display_by_location;

}

add_shortcode( 'events_by_location', 'list_event_by_location' );