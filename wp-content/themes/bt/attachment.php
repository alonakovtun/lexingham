<?php

if ( !defined( 'ABSPATH' ) ) {
  exit;
}

if( $post->post_parent != 0 ) {
  
	wp_redirect( get_permalink( $post->post_parent ) );
  
} else {
  
	wp_redirect( wp_get_attachment_url(), 302 );
  
}