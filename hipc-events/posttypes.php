<?php 
function my_custom_posttypes() {
	//Events Post Type
	 $labels = array(
        'name'               => 'Events',
        'singular_name'      => 'Event',
        'menu_name'          => 'Events',
        'name_admin_bar'     => 'Event',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Event',
        'new_item'           => 'New Event',
        'edit_item'          => 'Edit Event',
        'view_item'          => 'View Event',
        'all_items'          => 'All Events',
        'search_items'       => 'Search Events',
        'parent_item_colon'  => 'Parent Events:',
        'not_found'          => 'No events found.',
        'not_found_in_trash' => 'No events found in Trash.',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-calendar-alt',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title' ),
        'taxonomies'		 => array ( 'category', 'post_tag')
    );
	register_post_type( 'events', $args );

	//Venues Post Type
	 $labels = array(
        'name'               => 'Venues',
        'singular_name'      => 'Venue',
        'menu_name'          => 'Venues',
        'name_admin_bar'     => 'Venue',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Venue',
        'new_item'           => 'New Venue',
        'edit_item'          => 'Edit Venue',
        'view_item'          => 'View Venue',
        'all_items'          => 'All Venues',
        'search_items'       => 'Search Venues',
        'parent_item_colon'  => 'Parent Venues:',
        'not_found'          => 'No venues found.',
        'not_found_in_trash' => 'No venues found in Trash.',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-store',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'venues' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title' )
    );
	register_post_type( 'venues', $args );
}

add_action( 'init', 'my_custom_posttypes');

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    my_custom_posttypes();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

/* Custom Taxonmies */

function my_custom_taxonomies() {
	/* Type of Event ~custom category */	
	$labels = array(
        'name'              => 'Type of Events',
        'singular_name'     => 'Type of Event',
        'search_items'      => 'Search Types of Events',
        'all_items'         => 'All Types of Events',
        'parent_item'       => 'Parent Type of Event',
        'parent_item_colon' => 'Parent Type of Event:',
        'edit_item'         => 'Edit Type of Event',
        'update_item'       => 'Update Type of Event',
        'add_new_item'      => 'Add New Type of Event',
        'new_item_name'     => 'New Type of Event Name',
        'menu_name'         => 'Type of Event',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-types' ),
    );

    register_taxonomy( 'event-type', array( 'events' ), $args );

	/* Organizations ~custom tag*/
    $labels = array(
        'name'                       => 'Organizations',
        'singular_name'              => 'Organization',
        'search_items'               => 'Search Organizations',
        'popular_items'              => 'Popular Organizations',
        'all_items'                  => 'All Organizations',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit Oganization',
        'update_item'                => 'Update Organization',
        'add_new_item'               => 'Add New Organization',
        'new_item_name'              => 'New Organization Name',
        'separate_items_with_commas' => 'Separate Organizations with commas',
        'add_or_remove_items'        => 'Add or remove Organizations',
        'choose_from_most_used'      => 'Choose from the most used Organizations',
        'not_found'                  => 'No Organizations found.',
        'menu_name'                  => 'Organizations',
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'organizations' ),
    );

    register_taxonomy( 'organization', array( 'events', 'post' ), $args );
}

add_action( 'init', 'my_custom_taxonomies');