<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

function bt_add_headers () {
  header( 'x-Powered-By: bt' );
  header( 'server: bt' );
  header( 'X-XSS-Protection: 1; mode=block' );
  header( 'X-Frame-Options: DENY' );
  header( 'X-Content-Type-Options: nosniff' );
}
add_action( 'send_headers', 'bt_add_headers' );