<?php get_header(); ?>
<a href="<?php echo home_url('index.php/feed/?post_type=venues') ?>"><img src="<?php echo plugins_url( 'images/feed-icon-28x28.png', dirname(__FILE__) ); ?>"></a>
<p></p>
<?php
$venue_fetch_meta = get_post_meta( get_the_ID() ); ?>

  <h1><?php the_title(); ?></h1>

  <?php 
    $venue_name_value = get_post_meta($post->ID, 'venue_name', true);
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

  <?php if ( ! empty($venue_phone_value)): 
    echo $venue_phone_value; ?>
    <br />
  <?php endif; ?>

<?php if ( ! empty($venue_website_value)): ?>
      <a href="<?php if (!stristr($venue_website_value, "http://") && !stristr($venue_website_value, "https://") ) {echo "http://";} echo $venue_website_value; ?>"><?php echo ($venue_website_value) ; ?></a>
        <br />
      <?php endif; ?>
<?php get_footer(); ?>