<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/** redirect the user to checkout instead of cart **/
function bt_redirect_add_to_cart() {
  global $woocommerce;
  $cw_redirect_url_checkout = $woocommerce->cart->get_checkout_url();
  return $cw_redirect_url_checkout;
}
//add_filter('add_to_cart_redirect', 'bt_redirect_add_to_cart');

/** helper function for reordering the checkout fields **/
function bt_reorder_fields ( &$fields, $type, $field_names ) {

  $count = 0;
  $priority = 10;

  foreach( $field_names as $field_name ){
    $count++;
    $fields[$type][$field_name]['priority'] = $count * $priority;
  }

}

/** example for checkout fields reorder **/
function bt_reorder_checkout_fields ( $fields ) {
 
	$billing_order = [
		'billing_first_name',
		'billing_last_name',
		'billing_email',
		'billing_address_1',
		'billing_address_2',
		'billing_city',
		'billing_phone'
	];

	bt_reorder_fields( $fields, 'billing', $billing_order );

  return $fields;
  
}
//add_filter( 'woocommerce_checkout_fields', 'bt_reorder_checkout_fields', 15 );