<?php
add_filter('single_template','ole_events_single');
add_filter('archive_template','ole_events_archive');
add_filter('taxonomy_template', 'ole_taxonomy_archive');

//route single- template
function ole_events_single($single_template){
  global $post;
  $found = locate_template('single-events.php');
  if($post->post_type == 'events' && $found == ''){
    $single_template = dirname(__FILE__).'/templates/single-events.php';
  }

  $foundVenue = locate_template('single-venues.php');
  if($post->post_type == 'venues' && $foundVenue == ''){
    $single_template = dirname(__FILE__).'/templates/single-venues.php';
  }

  return $single_template;
}

//route archive- template
function ole_events_archive($template){
  if(is_post_type_archive('events')){
    $theme_files = array('archive-events.php');
    $exists_in_theme = locate_template($theme_files, false);
    if($exists_in_theme == ''){
      return plugin_dir_path(__FILE__) . '/templates/archive-events.php';
    }
  }
  
  if(is_post_type_archive('venues')){
    $theme_files = array('archive-venues.php');
    $exists_in_theme = locate_template($theme_files, false);
    if($exists_in_theme == ''){
      return plugin_dir_path(__FILE__) . '/templates/archive-venues.php';
    }
  }
  return $template;
}

function ole_taxonomy_archive($template){
  if(is_tax('subject') || is_tax('connected_learning') || is_tax('credentialing') || is_tax('event_type') || is_tax('hive_membership_status') || is_tax('grade_level') || is_tax('payment')){
    $theme_files = array('taxonomy.php');
    $exists_in_theme = locate_template($theme_files, false);
    if($exists_in_theme == ''){
      return plugin_dir_path(__FILE__) . '/templates/taxonomy.php';
    }
  }
  return $template;
}