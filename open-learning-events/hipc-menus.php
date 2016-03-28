<?php // Create Custom Event Menu to display calendar of events
register_nav_menus( array(
    'primary' => 'Primary',
) );

add_action('load-nav-menus.php', 'auto_nav_creation_primary');
function auto_nav_creation_primary(){
    $name = 'Navigation';
    $menu_exists = wp_get_nav_menu_object($name);
    if( !$menu_exists){
        $menu_id = wp_create_nav_menu($name);
        $menu = get_term_by( 'name', $name, 'nav_menu' );

        wp_update_nav_menu_item($menu->term_id, 0, array(
                'menu-item-title' =>  __('Home'),
                'menu-item-classes' => 'home',
                'menu-item-url' => home_url( '/' ), 
                'menu-item-status' => 'publish'
            ));

        wp_update_nav_menu_item($menu->term_id, 0, array(
                'menu-item-title' =>  __('Calendar'),
                'menu-item-url' => home_url('index.php/events/'),
                'menu-item-type' => 'custom',
                'menu-item-status' => 'publish'
            ));

    //then you set the wanted theme  location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu->term_id;
    set_theme_mod( 'nav_menu_locations', $locations );
    }
}