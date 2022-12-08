<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function custom_woocommerce_before_shop_loop_item_title () {
	echo woocommerce_get_product_thumbnail( 'full' );
}
add_action( 'woocommerce_before_shop_loop_item_title', 'custom_woocommerce_before_shop_loop_item_title' );

function new_loop_product_title () {
	echo '<div class="text-center padding-top-30 coresans-300">' . get_the_title() . '</div>';
	if ( !empty( $product_sub_title = get_field( 'sub-title' ) ) ) {
		echo '<div class="text-center coresans-300">' . $product_sub_title . '</div>';
	}
}
add_action( 'woocommerce_shop_loop_item_title', 'new_loop_product_title' );

add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products' );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display' );

function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 5; // 4 related products
	$args['columns'] = 5; // arranged in 2 columns
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );


/**
 * Change number of upsells output
 */
add_filter( 'woocommerce_upsell_display_args', 'wc_change_number_related_products', 20 );

function wc_change_number_related_products( $args ) {
 
 $args['posts_per_page'] = 5;
 $args['columns'] = 5; //change number of upsells here
 return $args;
}