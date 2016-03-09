<?php
/**
 * Template Name: Page of Events
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>

<?php get_header(); ?>

        <div id="container">
            <div id="content">

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

   <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><h1><?php the_title(); ?></h1></a></p>
  <?php echo get_post_meta($post->ID, 'event_description', true); ?></br>
  <?php the_post_thumbnail('medium');?>
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
    <?php

  endwhile;

}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
            </div><!-- #content -->
        </div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>