<?php
/**
 * Template Name: Page of Events
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>


<?php get_header(); ?>
<h2 class="events-page-title">Upcoming Events</h2>
<a href="<?php echo home_url('index.php/feed/?post_type=events') ?>"><img src="<?php echo plugins_url( 'images/feed-icon-28x28.png', dirname(__FILE__) ); ?>"></a>
<?php
$type = 'events';
$args=array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'caller_get_posts'=> 1,
  'meta_key'        => 'event_start_date',
  'orderby'         => 'meta_value',
  'order'           => 'DSC'
);

$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  while ($my_query->have_posts()) : $my_query->the_post(); ?>
<?php 
    $event_start_date_value = get_post_meta($post->ID, 'event_start_date', true);
    $event_start_time_value = get_post_meta($post->ID, 'event_start_time', true);
    $event_end_time_value = get_post_meta($post->ID, 'event_end_time', true);
    $venue_name_value = get_post_meta($post->ID, 'venue_name', true);
    $venue_street_address_value = get_post_meta($post->ID, 'venue_street_address', true);
    $venue_address_2_value = get_post_meta($post->ID, 'venue_address_2', true);
    $venue_city_value = get_post_meta($post->ID, 'venue_city', true);
    $venue_state_value = get_post_meta($post->ID, 'venue_state', true);
    $venue_zipcode_value = get_post_meta($post->ID, 'venue_zipcode', true);
    $event_description_value = get_post_meta($post->ID, 'event_description', true);
    $event_notes_value = get_post_meta($post->ID, 'event_notes', true);
    $event_cost_value = get_post_meta($post->ID, 'event_cost', true);
    $event_organizer_value = get_post_meta($post->ID, 'event_organizer', true);
    $event_twitter_value = get_post_meta($post->ID, 'event_twitter', true); 
    $event_website_value = get_post_meta($post->ID, 'event_website', true);
    $event_categories_value = get_post_meta($post->ID, 'event_categories', true);

    $event_categories_value1 = get_the_term_list( $post->ID, 'connected_learning', '', ', ' );
    $event_categories_value2 = get_the_term_list( $post->ID, 'credentialing', '', ', ' ); 
    $event_categories_value3 = get_the_term_list( $post->ID, 'event_type', '', ', ' ); 
    $event_categories_value4 = get_the_term_list( $post->ID, 'grade_level', '', ', ' ); 
    $event_categories_value5 = get_the_term_list( $post->ID, 'hive_membership_status', '', ', ' );
    $event_categories_value6 = get_the_term_list( $post->ID, 'payment', '', ', ' ); 
    $event_categories_value7 = get_the_term_list( $post->ID, 'subject', '', ', ' ); 
  ?>
<div class="event-post">

  <div class="event-title">
     <p><a class="hipc-event-url" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><h1><?php the_title(); ?></a>
      <?php if ( ! empty($event_cost_value)): ?>
      <span class="event-cost"><?php echo $event_cost_value; ?>
      <br />
    <?php endif; ?></span></h1></p>
  </div>

  <div class="event-date-time">
    <?php if ( ! empty($event_start_date_value)): ?>
      <?php echo $event_start_date_value; ?>
      @
    <?php endif; ?>

    <?php if ( ! empty($event_start_time_value)): 
      echo $event_start_time_value; ?>
      -
    <?php endif; ?> 

    <?php if ( ! empty($event_end_time_value)): 
      echo $event_end_time_value; ?>
      <br />
    <?php endif; ?> 
  </div>

  <div class="venue-address">
    <?php if ( ! empty($venue_name_value)): ?>
      <span class="venue-name"><?php echo $venue_name_value; ?></span>,
    <?php endif; ?>

    <?php if ( ! empty($venue_street_address_value)) {
      echo $venue_street_address_value; 

      if (! empty($venue_address_2_value)) {
        echo ' '; 
        echo $venue_address_2_value;
        echo '<br />';
      }
      else {
        echo '<br />';
      }
    } ?>
  </div>
  <div class="venue-city">
    <?php if ( ! empty($venue_city_value)): 
      echo $venue_city_value; ?>,
    <?php endif; ?>

    <?php if ( ! empty($venue_state_value)): 
      echo $venue_state_value; ?>
    <?php endif; ?>

    <?php if ( ! empty($venue_zipcode_value)): 
      echo $venue_zipcode_value; ?>
      <br />
    <?php endif; ?>
  </div>

    <?php if (has_post_thumbnail($post->ID)): ?>
      <div class="event-image">
      <?php the_post_thumbnail('medium'); ?></div>
    <?php endif; ?>

    <?php if ( ! empty($event_description_value)): ?>
      <div class="event-description"><?php echo $event_description_value; ?>
        <div class="link-to-single-event">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Find out more >></a>
        </div>
      </div>
    <?php endif; ?>

      <div class="clear"></div>

     

</div>

<?php
  endwhile;

}
wp_reset_query();  // Restore global post data stomped by the_post().
?>

<?php get_footer(); ?>