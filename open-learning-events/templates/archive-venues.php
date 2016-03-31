<?php
/**
 * Template Name: Page of Venues
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>


<?php get_header(); ?>
<a href="<?php echo home_url('index.php/feed/?post_type=venues') ?>"><img src="<?php echo plugins_url( 'images/feed-icon-28x28.png', dirname(__FILE__) ); ?>"></a>
<?php
$type = 'venues';
$args=array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'ignore_sticky_posts' => '1'
);

$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  while ($my_query->have_posts()) : $my_query->the_post(); ?>


   <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><h1><?php the_title(); ?></h1></a></p>
<?php 
    $venue_street_address_value = get_post_meta($post->ID, 'venue_street_address', true);
    $venue_address_2_value = get_post_meta($post->ID, 'venue_address_2', true);
    $venue_city_value = get_post_meta($post->ID, 'venue_city', true);
    $venue_state_value = get_post_meta($post->ID, 'venue_state', true);
    $venue_zipcode_value = get_post_meta($post->ID, 'venue_zipcode', true);
    $venue_phone_value = get_post_meta($post->ID, 'venue_phone', true);
    $venue_website_value = get_post_meta($post->ID, 'venue_website', true);

  ?>

  <?php if ( ! empty($venue_name_value)): 
    echo $venue_name_value; ?>,
  <?php endif; ?> 

  <?php if ( ! empty($venue_street_address_value)) {
    echo esc_attr($venue_street_address_value); 

    if (! empty($venue_address_2_value)) {
      echo ' '; 
      echo esc_attr($venue_address_2_value);
      echo '<br />';
    }
    else {
      echo '<br />';
    }
  } ?>

  <?php if ( ! empty($venue_city_value)): 
    echo esc_attr($venue_city_value); ?>,
  <?php endif; ?>

  <?php if ( ! empty($venue_state_value)): 
    echo $venue_state_value; ?>
  <?php endif; ?>

  <?php if ( ! empty($venue_zipcode_value)): 
    echo esc_attr($venue_zipcode_value); ?>
    <br />
  <?php endif; ?>

  <?php if ( ! empty($venue_phone_value)): 
    echo esc_attr($venue_phone_value); ?>
    <br />
  <?php endif; ?>

<?php if ( ! empty($venue_website_value)): ?>
      <a href="<?php if (!stristr($venue_website_value, "http://") && !stristr($venue_website_value, "https://") ) {echo "http://";} echo esc_url($venue_website_value); ?>"><?php echo esc_url($venue_website_value) ; ?></a>
        <br />
<?php endif; ?>

<?php
  endwhile;

}
wp_reset_query();  // Restore global post data stomped by the_post().
?>

<?php get_footer(); ?>