<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

define( 'THEME_DIR', WP_CONTENT_DIR . '/themes/bt/' );

/** theme constants **/
require THEME_DIR . 'inc/constants.php';

/** general theme helper functions **/
require THEME_DIR . 'inc/helper.php';

/** theme category related hooks **/
require THEME_DIR . 'inc/category.php';

/** php headers **/
require THEME_DIR . 'inc/headers.php';

/** theme menu and widgets register **/
require THEME_DIR . 'inc/register.php';

/** remove theme and core wordpress features ( removing hooks that can cause security risks ) **/
require THEME_DIR . 'inc/remove-features.php';

/** loading theme styles and scripts **/
require THEME_DIR . 'inc/enqueue.php';

/** adding support to core wordpress features **/
require THEME_DIR . 'inc/support.php';

/** disabling theme and plugin updates **/
require THEME_DIR . 'inc/updates.php';

/** adding noFollow and title to links in wysiwyg **/
require THEME_DIR . 'inc/wysiwyg.php';

/** adding schema to page **/
require THEME_DIR . 'inc/schema.php';

/** adding ajax support **/
require THEME_DIR . 'inc/ajax.php';

/** adding curl ( REST ) support **/
require THEME_DIR . 'inc/curl.php';

/** adding session support **/
require THEME_DIR . 'inc/session.php';

/** woocommerce related hooks, filters and functions **/
require THEME_DIR . 'inc/woocommerce.php';


if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

function bt_scripts()
{
    wp_enqueue_style('bt-style', get_stylesheet_uri(), array(), _S_VERSION);

    wp_enqueue_style('bt-main-style', get_template_directory_uri() . '/assets/css/main.min.css', array(), _S_VERSION);

    wp_register_script('bt-scripts', get_template_directory_uri() . '/assets/js/main.min.js', array(), _S_VERSION, true);
   
    wp_enqueue_script('bt-scripts');
}
add_action('wp_enqueue_scripts', 'bt_scripts');