<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function archive_filters_template () {
	wc_get_template_part( 'archive', 'filter' );
}
add_action( 'woocommerce_after_main_content', 'archive_filters_template', 9 );

function product_details_template () {
	wc_get_template_part( 'single-product/product', 'details' );
}
add_action( 'woocommerce_after_single_product', 'product_details_template', 9 );