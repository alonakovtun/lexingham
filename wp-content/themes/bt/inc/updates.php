<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );