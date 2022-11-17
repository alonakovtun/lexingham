<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

remove_action('wp_head', 'wp_generator');

/** Remove the posts tab from the admin menu panel **/
function remove_admin_tabs () {
	//remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
	//remove_menu_page( 'tools.php' );
}
add_action( 'admin_menu', 'remove_admin_tabs' );

/** remove wp-embed.min.js file **/
function my_deregister_scripts () {
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

/** remove wp-emoji-release.min.js file **/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/** remove versions from links and scripts **/
function wpbeginner_remove_version() {
	return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

function sdt_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

/** remove rss feed **/
function itsme_disable_feed() {
	wp_redirect( '/' );
	exit();
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

/** disable xml-rpc **/
add_filter('xmlrpc_enabled', '__return_false');

/** remove type=text/javascript from scripts **/
function codeless_remove_type_attr($tag, $handle) {
	return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);

// remove WP_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
// disable embeds nonsense; not even sure what it does
// Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');
// Turn off oEmbed auto discovery.
// Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
// Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');
// remove OneAll Social script from regular page
remove_action ('wp_head', 'oa_social_login_add_javascripts');

// remove gutenberg wp-block-library css
add_action( 'wp_print_styles', 'remove_wp_block_library_deregister_styles', 100 );
function remove_wp_block_library_deregister_styles() {
	wp_deregister_style( 'wp-block-library' );
}

// remove default jquery and jquery migrate and loaad jquery 3.3.1
function include_custom_jquery() {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), null, true);
}
//add_action('wp_enqueue_scripts', 'include_custom_jquery');

/** Remove welcome panel from wordpress dashboard **/
remove_action('welcome_panel', 'wp_welcome_panel');

/** Remove links from the top admin bar in the dashboard **/
function bt_remove_wp_nodes () {
	global $wp_admin_bar;
	$wp_admin_bar->remove_node( 'new-content' );
	$wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'bt_remove_wp_nodes', 999 );