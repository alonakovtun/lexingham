<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

/** if category has only one post redirect to post on category click **/
function stf_redirect_to_post () {
	global $wp_query;
	if ( is_archive() && $wp_query->post_count == 1 ) {
		the_post();
		$post_url = get_permalink();
		wp_redirect( $post_url );
	}
}
//add_action('template_redirect', 'stf_redirect_to_post');