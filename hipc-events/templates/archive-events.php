<?php
/**
 * Template Name: Page of Events
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>

<?php get_header(); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

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
  <?php echo get_post_meta($post->ID, 'event_start_date', true); ?> @ 
  <?php echo get_post_meta($post->ID, 'event_start_time', true); ?> - 
  <?php echo get_post_meta($post->ID, 'event_end_time', true); ?><br />
  <?php echo get_post_meta($post->ID, 'venue_name', true); ?>,
  <?php echo get_post_meta($post->ID, 'venue_street_address', true); ?> 
  <?php echo get_post_meta($post->ID, 'venue_address_2', true); ?><br />
  <?php echo get_post_meta($post->ID, 'venue_city', true); ?>, 
  <?php echo get_post_meta($post->ID, 'venue_state', true); ?>
  <?php echo get_post_meta($post->ID, 'venue_zipcode', true); ?><br /><p></p>
 <?php the_post_thumbnail('medium');?>
<?php echo get_post_meta($post->ID, 'event_description', true); ?><br />


  <?php echo get_post_meta($post->ID, 'event_notes', true); ?><br />
  <?php echo get_post_meta($post->ID, 'event_cost', true); ?><br />
  <?php echo get_post_meta($post->ID, 'event_organizer', true); ?><br />
  <?php echo get_post_meta($post->ID, 'event_twitter', true); ?><br />
  <?php echo get_post_meta($post->ID, 'event_website', true); ?><br />
  
  <?php echo get_the_term_list( $post->ID, 'connected_learning', '', ', ' ); ?><br />
  <?php echo get_the_term_list( $post->ID, 'credentialing', '', ', ' ); ?><br />
  <?php echo get_the_term_list( $post->ID, 'event_type', '', ', ' ); ?><br />
  <?php echo get_the_term_list( $post->ID, 'grade_level', '', ', ' ); ?><br />
  <?php echo get_the_term_list( $post->ID, 'hive_membership_status', '', ', ' ); ?><br />
  <?php echo get_the_term_list( $post->ID, 'payment', '', ', ' ); ?><br />
  <?php echo get_the_term_list( $post->ID, 'subject', '', ', ' ); ?><br />



<?php
  endwhile;

}
wp_reset_query();  // Restore global post data stomped by the_post().
?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>