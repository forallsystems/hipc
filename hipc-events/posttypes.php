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
        'supports'           => array( 'title', 'thumbnail' )
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
    /*Connected Learning Taxonomy*/
    $labels = array(
        'name'                       => 'Connected Learning',
        'singular_name'              => 'Connected Learning',
        'search_items'               => 'Search connected learning',
        'all_items'                  => 'All',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'separate_items_with_commas' => 'Separate connected learning with commas',
        'not_found'                  => 'No connected learning found.',
        'menu_name'                  => 'Connected Learning'
    );
    $args = array(
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
         ),
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'connected-learning' ),
    );

    register_taxonomy( 'connected_learning', 'events', $args );

    wp_insert_term( 'Academically Oriented', 'connected_learning' );
    wp_insert_term( 'Interest Powered', 'connected_learning' );
    wp_insert_term( 'Openly Networked', 'connected_learning' );
    wp_insert_term( 'Peer-Supported', 'connected_learning' );
    wp_insert_term( 'Production-Centered', 'connected_learning' );
    wp_insert_term( 'Shared Purpose', 'connected_learning' );

    /*Credentialling Taxonomy*/
    $labels = array(
        'name'                       => 'Credentialing',
        'singular_name'              => 'Credentialing',
        'search_items'               => 'Search credentialing',
        'all_items'                  => 'All',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'separate_items_with_commas' => 'Separate credentialing with commas',
        'not_found'                  => 'No Credentialing found.',
        'menu_name'                  => 'Credentialing'
    );
    $args = array(
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
         ),
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'credentialing' ),
    );

    register_taxonomy( 'credentialing', 'events', $args );
    
    wp_insert_term( 'CPDUs', 'credentialing' );
    wp_insert_term( 'Credit Hours', 'credentialing' );
    wp_insert_term( 'Digital Badges', 'credentialing' );

    /*Event Type Taxonomy*/
    $labels = array(
        'name'                       => 'Event Type',
        'singular_name'              => 'Event Type',
        'search_items'               => 'Search event type',
        'all_items'                  => 'All',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'separate_items_with_commas' => 'Separate event type with commas',
        'not_found'                  => 'No event type found.',
        'menu_name'                  => 'Event Type'
    );
    $args = array(
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
         ),
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'event-type' ),
    );

    register_taxonomy( 'event_type', 'events', $args );
    
    wp_insert_term( 'Institute', 'event_type' );
    wp_insert_term( 'On-Going', 'event_type' );
    wp_insert_term( 'Online', 'event_type' );
    wp_insert_term( 'Open House', 'event_type' );
    wp_insert_term( 'Series', 'event_type' );
    wp_insert_term( 'Workshop', 'event_type' );

    /*Grade Levels Taxonomy*/
    $labels = array(
        'name'                       => 'Grade Level',
        'singular_name'              => 'Grade Level',
        'search_items'               => 'Search grade levels',
        'all_items'                  => 'All',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'separate_items_with_commas' => 'Separate grade level with commas',
        'not_found'                  => 'No grade levels found.',
        'menu_name'                  => 'Grade Levels'
    );
    $args = array(
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
         ),
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'grade-level' ),
    );

    register_taxonomy( 'grade_level', 'events', $args );
    
    wp_insert_term( 'Elementary', 'grade_level' );
    wp_insert_term( 'Middle School', 'grade_level' );
    wp_insert_term( 'High School', 'grade_level' );
    wp_insert_term( 'Higher Education', 'grade_level' );

    /*Hive Membership Status Taxonomy*/
    $labels = array(
        'name'                       => 'Hive Membership Status',
        'singular_name'              => 'Hive Membership Status',
        'search_items'               => 'Search Hive membership status',
        'all_items'                  => 'All',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'separate_items_with_commas' => 'Separate Hive membership status with commas',
        'not_found'                  => 'No Hive membership status found.',
        'menu_name'                  => 'Hive Membership Status'
    );
    $args = array(
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
         ),
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'hive-membership-status' ),
    );

    register_taxonomy( 'hive_membership_status', 'events', $args );
    
    wp_insert_term( 'Affiliate Organization', 'hive_membership_status' );
    wp_insert_term( 'Ally Organization', 'hive_membership_status' );
    wp_insert_term( 'Parent Organization', 'hive_membership_status' );
    wp_insert_term( 'Partner Organization', 'hive_membership_status' );

    /*Payment Taxonomy*/
    $labels = array(
        'name'                       => 'Payment',
        'singular_name'              => 'Payment',
        'search_items'               => 'Search payment',
        'all_items'                  => 'All',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'separate_items_with_commas' => 'Separate payment with commas',
        'not_found'                  => 'No payment found.',
        'menu_name'                  => 'Payment'
    );
    $args = array(
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
         ),
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'payment' ),
    );

    register_taxonomy( 'payment', 'events', $args );
    
    wp_insert_term( 'Free', 'payment' );
    wp_insert_term( 'Scholarship for Fees', 'payment' );
    wp_insert_term( 'Fee', 'payment' );

    /*Subject Taxonomy*/
    $labels = array(
        'name'                       => 'Subject',
        'singular_name'              => 'Subject',
        'search_items'               => 'Search subject',
        'all_items'                  => 'All',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'separate_items_with_commas' => 'Separate subject with commas',
        'not_found'                  => 'No subject found.',
        'menu_name'                  => 'Subject'
    );
    $args = array(
        'capabilities' => array(
            'manage_terms' => '',
            'edit_terms' => '',
            'delete_terms' => '',
            'assign_terms' => 'edit_posts'
         ),
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'subject' ),
    );

    register_taxonomy( 'subject', 'events', $args );
    
    wp_insert_term( 'Literacy', 'subject' );
    wp_insert_term( 'Math', 'subject' );
    wp_insert_term( 'Media/Technology', 'subject' );
    wp_insert_term( 'Science', 'subject' );
    wp_insert_term( 'Social Emotional Learning', 'subject' );
    wp_insert_term( 'Social Justice', 'subject' );
    wp_insert_term( 'Social Studies', 'subject' );
    wp_insert_term( 'STEM/STEAM', 'subject' );
    wp_insert_term( 'Web Literacy', 'subject' );
}

add_action( 'init', 'my_custom_taxonomies');

/*function event_load_templates( $original_template ) {
       if ( get_query_var( 'post_type' ) !== 'events' ) {
               return;
       }
       if ( is_archive() || is_search() ) {
               if ( file_exists( get_stylesheet_directory(). '/archive-event.php' ) ) {
                     return get_stylesheet_directory() . '/archive-event.php';
               } else {
                       return plugin_dir_path( __FILE__ ) . 'templates/archive-event.php';
               }
       } elseif(is_singular('event')) {
               if (  file_exists( get_stylesheet_directory(). '/single-event.php' ) ) {
                       return get_stylesheet_directory() . '/single-event.php';
               } else {
                       return plugin_dir_path( __FILE__ ) . 'templates/single-event.php';
               }
       }else{
        return get_page_template();
       }
        return $original_template;
}
add_action( 'template_include', 'event_load_templates' );
*/