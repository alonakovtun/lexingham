<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** Call for all the styles for the project **/
function bt_enqueue_styles () {
	//wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	//wp_enqueue_style( 'bootstrap-rtl', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css' );

	// uncomment this if you want to use the lightbox library ( dont forget to uncomment the lightbox.js )
	//wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/assets/css/lightbox.css' );

	//wp_enqueue_style( 'fontawsome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,600&display=swap' );
	wp_enqueue_style( 'site-fonts', get_template_directory_uri() . '/assets/fonts/MyFontsWebfontsKit.css' );
	wp_enqueue_style( 'aos', 'https://unpkg.com/aos@next/dist/aos.css' );
	wp_enqueue_style( 'bt-main', get_template_directory_uri() . '/assets/css/style.css?v=000006' );

	if ( is_front_page() ) {
		wp_enqueue_style( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css' );
		wp_enqueue_style( 'front-page', get_template_directory_uri() . '/assets/css/pages/front-page.css?v=000005' );
	} elseif ( is_page_template( 'pages/page-about-us.php' ) ) {
		wp_enqueue_style( 'about-us', get_template_directory_uri() . '/assets/css/pages/about.css?v=000005' );
	} elseif ( is_page_template( 'pages/page-contact-us.php' ) ) {
		wp_enqueue_style( 'contact-us', get_template_directory_uri() . '/assets/css/pages/contact.css?v=000005' );
	} elseif ( is_page_template( 'pages/page-basic.php' ) ) {
		wp_enqueue_style( 'basic-page', get_template_directory_uri() . '/assets/css/pages/basic.css?v=000005' );
		wp_enqueue_style( 'single', get_template_directory_uri() . '/assets/css/single/single.css?v=000006' );
		
	} elseif ( is_page_template( 'pages/page-magazine.php' ) || is_category() || is_tag()) {
		wp_enqueue_style( 'magazine-page', get_template_directory_uri() . '/assets/css/pages/magazine.css?v=000005' );
	} elseif ( is_category() ) {
		wp_enqueue_style( 'category', get_template_directory_uri() . '/assets/css/category/category.css?v=000005' );
	} elseif ( is_single() && !is_product() ) {
		wp_enqueue_style( 'single', get_template_directory_uri() . '/assets/css/single/single.css?v=000006' );
	}
	
	if ( is_product_category() || is_shop() || is_search()) {
		wp_enqueue_style( 'catalog-products', get_template_directory_uri() . '/assets/woocommerce/css/catalog-products.css?v=000005' );
	} else if ( is_product() ) {
		wp_enqueue_style( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css' );
		wp_enqueue_style( 'product', get_template_directory_uri() . '/assets/woocommerce/css/product.css?v=000007' );
	}
	


}
add_action( 'wp_enqueue_scripts', 'bt_enqueue_styles' );

/** Call for all the scripts for the project **/
function bt_enqueue_scripts () {
	//wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', ['jquery'], '', true );

	// uncomment this if you want to use the lightbox library ( dont forget to uncomment the lightbox.css )
	//wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', ['jquery'], '', true );

	// uncomment this if you want to use the touch punch library
	//wp_enqueue_script( 'touch-punch', get_template_directory_uri() . '/assets/js/touch-punch.js', ['jquery'], '', true );

	wp_enqueue_script( 'aos', 'https://unpkg.com/aos@next/dist/aos.js', ['jquery'], '', true );
	wp_enqueue_script( 'bt-main', get_template_directory_uri() . '/assets/js/script.js?v=000005', ['jquery'], '', true );
	$params = [
		'ajax_nonce' => wp_create_nonce( 'bt_site_ajax_nonce' ),
		'ajaxurl'    => BPATH . '/wp-admin/admin-ajax.php'
	];
	wp_localize_script( 'bt-main', 'bt_site_ajax_nonce', $params );

	if ( is_front_page() ) {
		wp_enqueue_script( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js', ['jquery'], '', true );
		wp_enqueue_script( 'front-page', get_template_directory_uri() . '/assets/js/pages/front-page.js?v=000005', ['jquery', 'swiper'], '', true );
	} elseif ( is_page_template( 'pages/page-about-us.php' ) ) {
		wp_enqueue_script( 'about-us', get_template_directory_uri() . '/assets/js/pages/about.js?v=000005', ['jquery'], '', true  );
	} elseif ( is_page_template( 'pages/page-contact-us.php' ) ) {
		wp_enqueue_script( 'contact-us', get_template_directory_uri() . '/assets/js/pages/contact.js?v=000005', ['jquery'], '', true  );
	} elseif ( is_page_template( 'pages/page-basic.php' ) ) {
		wp_enqueue_script( 'basic-page', get_template_directory_uri() . '/assets/js/pages/basic.js?v=000005', ['jquery'], '', true  );
	} elseif ( is_page_template( 'pages/page-magazine.php' ) ) {
		wp_enqueue_script( 'magazine-page', get_template_directory_uri() . '/assets/js/pages/magazine.js?v=000005', ['jquery'], '', true  );
	} elseif ( is_category() ) {
		wp_enqueue_script( 'category', get_template_directory_uri() . '/assets/js/category/category.js?v=000005', ['jquery'], '', true  );
	} elseif ( is_single() && !is_product() ) {
		wp_enqueue_script( 'single', get_template_directory_uri() . '/assets/js/single/single.js?v=000005', ['jquery'], '', true  );
	}

	if ( is_product_category() || is_shop() ) {
		
		wp_enqueue_script( 'catalog-products', get_template_directory_uri() . '/assets/woocommerce/js/catalog-products.js?v=000005', ['jquery'], '', true  );
		
		$sound_colors = get_terms([
			'taxonomy' 	 => 'sound_color',
			'hide_empty' => false
		]);
		
		$sound_colors_data = [];
		
		foreach ( $sound_colors as $color ) {
			$sound_colors_data[$color->name] = get_field( 'sound-color', $color );
		}
		
		wp_localize_script( 'catalog-products', 'bt_sound_colors_data', $sound_colors_data );
		
	} else if ( is_product() ) {
		wp_enqueue_script( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js', ['jquery'], '', true );
		wp_enqueue_script( 'product', get_template_directory_uri() . '/assets/woocommerce/js/product.js?v=000005', ['jquery', 'swiper'], '', true  );
	}

}
add_action( 'wp_enqueue_scripts', 'bt_enqueue_scripts' );

/** add defer to scripts **/
function add_defer_attribute($tag, $handle) {
	// add script handles to the array below
	$scripts_to_defer = array();

	foreach($scripts_to_defer as $defer_script) {
		if ($defer_script === $handle) {
			return str_replace(' src', ' defer="defer" src', $tag);
		}
	}
	return $tag;
}
//add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);