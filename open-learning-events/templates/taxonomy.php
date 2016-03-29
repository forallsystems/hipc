<?php get_header(); ?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
<div id="container">
  <div id="content" role="main">

    <h1 class="page-title"><?php echo $term->name; ?> Archives</h1>

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <div class="post type-post hentry">
      <h2 class="entry-title">
        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
        </a>
      </h2>
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
      $event_image_value = get_post_meta($post->ID, 'event_image', true);

      $event_categories_value1 = get_the_term_list( $post->ID, 'connected_learning', '', ', ' );
      $event_categories_value2 = get_the_term_list( $post->ID, 'credentialing', '', ', ' ); 
      $event_categories_value3 = get_the_term_list( $post->ID, 'event_type', '', ', ' ); 
      $event_categories_value4 = get_the_term_list( $post->ID, 'grade_level', '', ', ' ); 
      $event_categories_value5 = get_the_term_list( $post->ID, 'hive_membership_status', '', ', ' );
      $event_categories_value6 = get_the_term_list( $post->ID, 'payment', '', ', ' ); 
      $event_categories_value7 = get_the_term_list( $post->ID, 'subject', '', ', ' ); 
      ?>
      <?php if ( ! empty($event_start_date_value)): 
      echo date_i18n( 'F j, Y', $event_start_date_value ); ?>
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

      <?php if (has_post_thumbnail($post->ID)): ?>
        <p>
          <?php the_post_thumbnail('medium'); ?>
        </p>
      <?php endif; ?>

      <?php if ( ! empty($event_description_value)): 
      echo $event_description_value; ?>
      <br />
      <?php endif; ?>

      <?php if ( ! empty($event_notes_value)): 
      echo $event_notes_value; ?>
      <br />
      <?php endif; ?>

      <?php if ( ! empty($event_cost_value)): 
      echo $event_cost_value; ?>
      <br />
      <?php endif; ?>

      <?php if ( ! empty($event_organizer_value)): 
      echo $event_organizer_value; ?>
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
      <p></p>

    </div><!-- .entry-summary -->
</div>

<?php endwhile; ?>
<?php endif; ?>

    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>