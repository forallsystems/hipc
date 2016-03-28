<?php get_header(); ?>
<?php
$event_fetch_meta = get_post_meta( get_the_ID() ); ?>
  <a href="<?php echo home_url('index.php/events') ?>"> << All Events </a>
  <h1 class="single-title"><?php the_title(); ?></h1>

  <?php 
    $event_start_date_value = get_post_meta($post->ID, 'event_start_date', true);
    $event_end_date_value = get_post_meta($post->ID, 'event_end_date', true);
    $event_start_time_value = get_post_meta($post->ID, 'event_start_time', true);
    $event_end_time_value = get_post_meta($post->ID, 'event_end_time', true);
    $venue_name_value = get_post_meta($post->ID, 'venue_name', true);
    $venue_street_address_value = get_post_meta($post->ID, 'venue_street_address', true);
    $venue_address_2_value = get_post_meta($post->ID, 'venue_address_2', true);
    $venue_city_value = get_post_meta($post->ID, 'venue_city', true);
    $venue_state_value = get_post_meta($post->ID, 'venue_state', true);
    $venue_zipcode_value = get_post_meta($post->ID, 'venue_zipcode', true);
    $venue_phone_value = get_post_meta($post->ID, 'venue_phone', true);
    $venue_website_value = get_post_meta($post->ID, 'venue_website', true);
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
  <div class="event-date-time-single">

<!--Display header with event date and time if available -->

  <?php if ( ! empty($event_start_date_value) && ! empty($event_start_time_value)) { ?>
    <h2 class="event-date-time-single-h"><?php echo date_i18n( 'F j, Y', $event_start_date_value ); ?>
    @ <?php echo $event_start_time_value; ?>

    <?php } elseif ( ! empty($event_start_date_value) && empty($event_start_time_value) ) { ?>
     <h2 class="event-date-time-single-h"><?php echo date_i18n( 'F j, Y', $event_start_date_value ); ?>
    <?php } else { ?>
    <h2 class="event-date-time-single-h"><?php echo $event_start_time_value; } ?>

    <?php if ( ! empty($event_end_time_value)): ?>
       - 
      <?php echo $event_end_time_value; ?></h2>
    <?php endif; ?> 

<!--Display cost with dividing line if available -->
  <?php if ( ! empty($event_cost_value)): ?>
    <span class="divider">|</span><span class="event-cost-single"><?php echo $event_cost_value; ?></span>
  <?php endif; ?>
  </div>


<!--Display event image if available -->
<div class="event-image-single">
  <?php if (has_post_thumbnail($post->ID)): ?>
    <?php the_post_thumbnail('medium'); ?>
  <?php endif; ?>
  </div>

<!--Display event description if available -->
<div class="event-description-single">
  <?php if ( ! empty($event_description_value)): 
    echo $event_description_value; ?>
  <?php endif; ?>
</div>

<!-- Three column event detail box -->
<div class="event-details-box-single">

  <div class="details-column">
      <h3 class="event-detail-box-label" id="details-header">Details</h3>
      
      <?php if ( ! empty($event_start_date_value)): ?>
      <h5 class="event-detail-labels">Date:</h5>
      <?php echo date_i18n( 'F j, Y', $event_start_date_value ); ?>
      <?php endif; ?>
      <?php if ( ! empty($event_end_date_value)): ?> -
      <?php echo date_i18n( 'F j, Y', $event_end_date_value ); ?>
      <?php endif; ?>

      <?php if ( ! empty($event_start_time_value)): ?>
      <h5 class="event-detail-labels" id="second-header">Time:</h5>
      <?php echo $event_start_time_value; ?>
      <?php endif; ?> 
      <?php if ( ! empty($event_end_time_value)): ?> - 
      <?php echo $event_end_time_value; ?></h2>
      <?php endif; ?> 

<!--Display event categories if available -->
    <?php  if ( ! empty ($event_categories_value) || ! empty ($event_categories_value2) ||
    ! empty ($event_categories_value3) || ! empty ($event_categories_value4) ||
    ! empty ($event_categories_value5) || ! empty ($event_categories_value6) ||
    ! empty ($event_categories_value7) ) { ?>

      <h5 class="event-detail-labels" id="second-header">Event Categories:</h5>
      <?php if ( ! empty($event_categories_value)): 
        echo $event_categories_value; ?>,
      <?php endif; ?>

      <?php if ( ! empty($event_categories_value1)): 
        echo $event_categories_value1; ?>,
      <?php endif; ?>

      <?php if ( ! empty($event_categories_value2)): 
        echo $event_categories_value2; ?>,
      <?php endif; ?>

      <?php if ( ! empty($event_categories_value3)): 
        echo $event_categories_value3; ?>,
      <?php endif; ?>

      <?php if ( ! empty($event_categories_value4)): 
        echo $event_categories_value4; ?>,
      <?php endif; ?>

      <?php if ( ! empty($event_categories_value5)): 
        echo $event_categories_value5; ?>,
      <?php endif; ?>

      <?php if ( ! empty($event_categories_value6)): 
        echo $event_categories_value6; ?>,
      <?php endif; ?>

      <?php if ( ! empty($event_categories_value7)): 
        echo $event_categories_value7; ?>,
      <?php endif; ?>
      <?php } ?>

     <!--Display event website if available and open in a new tab -->
    <?php if ( ! empty($event_website_value)): ?>
    <h5 class="event-detail-labels" id="second-header">Website:</h5>
    <a href="<?php if (!stristr($event_website_value, "http://") && !stristr($event_website_value, "https://") ) {echo "http://";} echo $event_website_value; ?>" target="_blank">
    <?php echo ($event_website_value) ; ?></a>
    <?php endif; ?>
</div>

<div class="venue-column">
  <h3 class="event-detail-box-label" id="venue-header">Venue</h3>

  <!--Display venue details if available -->
  <span class="venue-name"><?php if ( ! empty($venue_name_value)): ?>
  <?php echo $venue_name_value; ?></span>, 
  <?php endif; ?> 

    <?php if ( ! empty($venue_street_address_value)) {
    echo $venue_street_address_value; 

      if (! empty($venue_address_2_value)) {
        echo ' '; 
        echo $venue_address_2_value;
        echo '<br />';
      } else {
        echo '<br />';
      }
    } ?>

    <?php if ( ! empty($venue_city_value)): 
      echo $venue_city_value; ?>,
    <?php endif; ?>

    <?php if ( ! empty($venue_state_value)): 
      echo $venue_state_value; ?>
    <?php endif; ?>

    <?php if ( ! empty($venue_zipcode_value)): 
      echo $venue_zipcode_value; ?>
    <?php endif; ?>

 <!--Display venue phone number if available -->
  <?php if ( ! empty($venue_phone_value)): ?>
  <h5 class="event-detail-labels" id="second-header">Phone:</h5>  
  <?php echo $venue_phone_value; ?>
  <?php endif; ?>

 <!--Display venue phone website if available -->
  <?php if ( ! empty($venue_website_value)): ?>
  <h5 class="event-detail-labels" id="second-header">Website:</h5>
    <a href="<?php if (!stristr($venue_website_value, "http://") && !stristr($venue_website_value, "https://") ) {echo "http://";} echo $venue_website_value; ?>" target="_blank">
      <?php echo ($venue_website_value) ; ?></a>
  <?php endif; ?>
</div>

<div class="other-column">
    <h3 class="event-detail-box-label" id="other-header">Other</h3>
    
     <!--Display organizer if available -->
    <?php if ( ! empty($event_organizer_value)): ?>
    <h5 class="event-detail-labels">Organizer:</h5>
    <?php echo $event_organizer_value; ?>
    <?php endif; ?>

     <!--Display event notes if available -->
    <?php if ( ! empty($event_notes_value)): ?>
    <h5 class="event-detail-labels" id="second-header">Notes:</h5>
    <?php echo $event_notes_value; ?>
    <?php endif; ?>

    <!--Display event twitter and open in new tab if available -->
    <?php if ( ! empty($event_twitter_value)): ?>
    <h5 class="event-detail-labels" id="second-header">Twitter:</h5>
    <a href="<?php if (!stristr($event_twitter_value, "http://") && !stristr($event_website_value, "https://") ) {echo "http://";} echo $event_twitter_value; ?>" target="_blank">
    <?php echo ($event_twitter_value) ; ?></a>
    <?php endif; ?>
  </div>

  <div class="clear"></div>

</div>

<?php get_footer(); ?>