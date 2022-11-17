<?php

if ( !defined( 'ABSPATH' ) ) {
  exit;
}

// add itemprop=url only to footer menu
function add_specific_menu_location_atts( $atts, $item, $args ) {
  // check if the item is in the primary menu
  /*if( $args->theme_location == 'footer-links-menu-1' || $args->theme_location == 'footer-links-menu-2' ) {
    // add the desired attributes:
    $atts['itemprop'] = 'url';
  }*/
  $atts['itemprop'] = 'url';
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_specific_menu_location_atts', 10, 3 );