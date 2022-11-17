<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

/** Add a new support for menus in themes **/
add_theme_support( 'menus' );
/** Add a new support for post thumbnails **/
add_theme_support( 'post-thumbnails' );

/** add an options page from the ACF plugin **/
if( function_exists( 'acf_add_options_page' ) ) {
	
	$parent = acf_add_options_page( [
		'page_title' 	=> 'General template options',
		'menu_title'	=> 'General template options',
		'menu_slug' 	=> 'general',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-admin-settings',
		'redirect'		=> false
	] );
	
	acf_add_options_sub_page( [
		'page_title' 	=> 'Template header options',
		'menu_title'	=> 'Template header options',
		'menu_slug' 	=> 'header',
		'parent_slug' 	=> $parent['menu_slug']
	] );
	
	acf_add_options_sub_page( [
		'page_title' 	=> 'Template footer options',
		'menu_title'	=> 'Template footer options',
		'menu_slug' 	=> 'footer',
		'parent_slug' 	=> $parent['menu_slug']
	] );
	
	acf_add_options_sub_page( [
		'page_title' 	=> 'Template contact options',
		'menu_title'	=> 'Template contact options',
		'menu_slug' 	=> 'contact',
		'parent_slug' 	=> $parent['menu_slug']
	] );
	
	acf_add_options_sub_page( [
		'page_title' 	=> 'Template social media options',
		'menu_title'	=> 'Template social media options',
		'menu_slug' 	=> 'social',
		'parent_slug' 	=> $parent['menu_slug']
	] );
	
	acf_add_options_sub_page( [
		'page_title' 	=> 'Template catalog options',
		'menu_title'	=> 'Template catalog options',
		'menu_slug' 	=> 'catalog',
		'parent_slug' 	=> $parent['menu_slug']
	] );
	
	acf_add_options_sub_page( [
		'page_title' 	=> 'Template product options',
		'menu_title'	=> 'Template product options',
		'menu_slug' 	=> 'product',
		'parent_slug' 	=> $parent['menu_slug']
	] );
	
}

/** add post menu order **/
function posts_order_wpse_91866 () {
    add_post_type_support( 'post', 'page-attributes' );
}
add_action( 'admin_init', 'posts_order_wpse_91866' );

function bt_add_woocommerce_support () {
	add_theme_support( 'woocommerce' );
}
// add woocommerce theme support
add_action( 'after_setup_theme', 'bt_add_woocommerce_support' );



function change_wp_search_size($query) {
	if ( $query->is_search ) // Make sure it is a search page
		$query->query_vars['posts_per_page'] = 100; // Change 10 to the number of posts you would like to show

	return $query; // Return our modified query variables
}
add_filter('pre_get_posts', 'change_wp_search_size'); // Hook our custom function onto the request filter