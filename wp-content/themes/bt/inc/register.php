<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** Add a new location for a navigation menu **/
function register_theme_menus () {
	register_nav_menus( ['main-site-menu-left' => __( 'Main site menu (left)' )] );
	register_nav_menus( ['main-site-menu-right' => __( 'Main site menu (right)' )] );
	register_nav_menus( ['search-quick-links' => __( 'Search quick links' )] );
}
add_action( 'init', 'register_theme_menus' );

/** add this to the html to display the menu **/

/*
<?php

 $defaults = [
 'container' => false,
 'theme_location' => 'main-site-menu',
 'menu_class' => 'main-site-navigation'
 ];

 wp_nav_menu( $defaults );

?>
*/

/** add this to use widgets **/

/*
function footer_links_widgets () {

  register_sidebar( [
    'name'          => 'פוטר קישורים 1', // name of the widget that is displayed in the cms
    'id'            => 'footer_links_1',
    'before_widget' => '<div class="site-links">', // wrapper for the widget
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="font09em font600 no-margin">', // wrapper for the widget title
    'after_title'   => '</h3>',
  ] );

}
add_action( 'widgets_init', 'footer_links_widgets' );
*/

/** add this to the html to display the registered widget **/
// dynamic_sidebar( 'footer_links_1' );