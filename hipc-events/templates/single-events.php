<?php get_header(); ?>

        <div id="container">
            <div id="content">
<?php
$event_fetch_meta = get_post_meta( get_the_ID() ); ?>

  <h1><?php the_title(); ?></h1>
  <?php the_post_thumbnail('medium');?>

  <?php echo get_post_meta($post->ID, 'event_description', true); ?></br>
  <?php echo get_post_meta($post->ID, 'event_start_date', true); ?></br>
  <?php echo get_post_meta($post->ID, 'event_end_date', true); ?> </br>
  <?php echo get_post_meta($post->ID, 'event_start_time', true); ?> </br>
  <?php echo get_post_meta($post->ID, 'event_end_time', true); ?> </br>
  <?php echo get_post_meta($post->ID, 'event_notes', true); ?>  </br>
  <?php echo get_post_meta($post->ID, 'event_cost', true); ?> </br>
  <?php echo get_post_meta($post->ID, 'event_organizer', true); ?>  </br>
  <?php echo get_post_meta($post->ID, 'event_twitter', true); ?>  </br>
  <?php echo get_post_meta($post->ID, 'event_website', true); ?>  </br>
  <?php echo get_post_meta($post->ID, 'venue_name', true); ?> </br>
  <?php echo get_post_meta($post->ID, 'venue_street_address', true); ?> </br>
  <?php echo get_post_meta($post->ID, 'venue_address_2', true); ?>  </br>
  <?php echo get_post_meta($post->ID, 'venue_city', true); ?> </br>
  <?php echo get_post_meta($post->ID, 'venue_state', true); ?></br>
  <?php echo get_post_meta($post->ID, 'venue_zipcode', true); ?>  </br>

<?php get_sidebar(); ?>
<?php get_footer(); ?>