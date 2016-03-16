<?php get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
<?php
$event_fetch_meta = get_post_meta( get_the_ID() ); ?>

  <h1><?php the_title(); ?></h1>
  <?php echo get_post_meta($post->ID, 'event_start_date', true); ?> @ 
  <?php echo get_post_meta($post->ID, 'event_start_time', true); ?> - 
  <?php echo get_post_meta($post->ID, 'event_end_time', true); ?><br />
  <?php echo get_post_meta($post->ID, 'venue_name', true); ?>,
  <?php echo get_post_meta($post->ID, 'venue_street_address', true); ?> 
  <?php echo get_post_meta($post->ID, 'venue_address_2', true); ?><br />
  <?php echo get_post_meta($post->ID, 'venue_city', true); ?>, 
  <?php echo get_post_meta($post->ID, 'venue_state', true); ?>
  <?php echo get_post_meta($post->ID, 'venue_zipcode', true); ?><br /><p></p>
 <p><?php the_post_thumbnail('medium');?></p>
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

      </main><!-- #main -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>