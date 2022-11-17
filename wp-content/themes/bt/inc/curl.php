<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( !function_exists( 'bt_curl' ) ) {

  function bt_curl ( $url, $method = 'get', $fields = [], $headers = [], $options = [] ) {

    $method = strtolower( $method );

    $ch = curl_init();

    $curl_config = [
      CURLOPT_URL            => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER     => $headers
    ];

    if ( $method === 'put' ) {
      $curl_config[CURLOPT_CUSTOMREQUEST] = 'PUT';

      if ( $options['json_encode_fields'] ) {
        $fields = json_encode( $fields );
      }

      $curl_config[CURLOPT_POSTFIELDS] = $fields;
    }

    curl_setopt_array( $ch, $curl_config );
    $result = curl_exec( $ch );

    if ( $options['return_transfer_info'] ) {
      $result = curl_getinfo( $ch );
    }

    if ( $options['json_decode_result'] ) {
      $result = json_decode( $result );
    }

    if ( $options['return_result'] ) {
      return $result;
    }

    curl_close( $ch );

  }

}

/** cur example **/
/*
$options = [
  'json_encode_fields'   => false,
  'return_transfer_info' => false,
  'json_decode_result'   => true,
  'return_result' 		 => true
];

bt_curl( $url, $method, $fileds, $headers, $options );
*/