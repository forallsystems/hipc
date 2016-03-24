<?php get_header(); ?>
<a href="<?php echo home_url('index.php/feed/?post_type=events') ?>"><img src="<?php echo plugins_url( 'images/feed-icon-28x28.png', dirname(__FILE__) ); ?>"></a>
<p></p>
<?php
$event_fetch_meta = get_post_meta( get_the_ID() ); ?>
  <a href="<?php echo home_url('index.php/events') ?>"> << All events </a>
  <h1 class="single-title"><?php the_title(); ?></h1>

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
  <div class="event-date-time-single">
  <?php if ( ! empty($event_start_date_value)): ?>
    <h2 class="event-date-time-single-h"><?php echo $event_start_date_value; ?>
    @
  <?php endif; ?>

  <?php if ( ! empty($event_start_time_value)): 
    echo $event_start_time_value; ?>
    -
  <?php endif; ?> 

  <?php if ( ! empty($event_end_time_value)): 
    echo $event_end_time_value; ?></h2>
  <?php endif; ?> 

  <?php if ( ! empty($event_cost_value)): ?>
    <span class="divider">|</span><span class="event-cost-single"><?php echo $event_cost_value; ?></span>
  <?php endif; ?>
  </div>

<div class="event-image-single">
  <?php if (has_post_thumbnail($post->ID)): ?>
    <?php the_post_thumbnail('medium'); ?>
  <?php endif; ?>
  </div>
  
<div class="event-description-single">
  <?php if ( ! empty($event_description_value)): 
    echo $event_description_value; ?>
  <?php endif; ?>
</div>


    <?php if ( ! empty($event_notes_value)): 
    echo $event_notes_value; ?>
    <br />
  <?php endif; ?>



  <?php if ( ! empty($event_organizer_value)): 
    echo $event_organizer_value; ?>
    <br />
  <?php endif; ?>

   <?php if ( ! empty($venue_name_value)): 
    echo $venue_name_value; ?>,
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

  <?php if ( ! empty($event_twitter_value)): ?>
  <a href="<?php if (!stristr($event_twitter_value, "http://") && !stristr($event_website_value, "https://") ) {echo "http://";} echo $event_twitter_value; ?>"><?php echo ($event_twitter_value) ; ?></a>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_website_value)): ?>
  <a href="<?php if (!stristr($event_website_value, "http://") && !stristr($event_website_value, "https://") ) {echo "http://";} echo $event_website_value; ?>"><?php echo ($event_website_value) ; ?></a>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value)): 
    echo $event_categories_value; ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value1)): 
    echo $event_categories_value1; ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value2)): 
    echo $event_categories_value2; ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value3)): 
    echo $event_categories_value3; ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value4)): 
    echo $event_categories_value4; ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value5)): 
    echo $event_categories_value5; ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value6)): 
    echo $event_categories_value6; ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($event_categories_value7)): 
    echo $event_categories_value7; ?>
    <br />
  <?php endif; ?>

<?php get_footer(); ?>