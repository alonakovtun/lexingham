<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

function bt_site_ajax_requests () {

  check_ajax_referer( 'bt_site_ajax_nonce', 'security' );

  // to do

}
add_action( 'wp_ajax_bt_site_ajax_requests', 'bt_site_ajax_requests' );
add_action( 'wp_ajax_nopriv_bt_site_ajax_requests', 'bt_site_ajax_requests' );

/** ajax example **/
/*
jQuery.ajax({
  url: bt_site_ajax_nonce.ajaxurl,
  method: "POST",
  data: {
    action: 'bt_site_ajax_requests',
    security: bt_site_ajax_nonce.ajax_nonce,
  },
  success: function ( response ) {
    // to do
  }
});
*/