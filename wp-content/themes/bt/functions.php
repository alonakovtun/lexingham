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