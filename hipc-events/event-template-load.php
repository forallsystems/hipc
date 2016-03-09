<?php
add_filter('single_template','events_single');
add_filter('archive_template','events_archive');

//route single- template
function events_single($single_template){
  global $post;
  $found = locate_template('single-events.php');
  if($post->post_type == 'events' && $found != ''){
    $single_template = dirname(__FILE__).'/templates/single-events.php';
  }
  return $single_template;
}

//route archive- template
function events_archive($template){
  if(is_post_type_archive('events')){
    $theme_files = array('archive-events.php');
    $exists_in_theme = locate_template($theme_files, false);
    if($exists_in_theme == ''){
      return plugin_dir_path(__FILE__) . '/templates/archive-events.php';
    }
  }
  return $template;
}