jQuery( window ).load(function(){
	var product_images_wrapper = jQuery( '.woocommerce div.product div.images .product-images-wrapper' );
	jQuery( '.woocommerce div.product div.images .product-images-wrapper img' ).css({
		'max-width': product_images_wrapper.width(),
		'max-height': product_images_wrapper.height()
	});
	setTimeout(function(){
		new Swiper( '.product-images-wrapper.swiper-container', {
			effect: 'fade',
			loop: true,
			speed: 1000,
			navigation: {
				nextEl: '.woocommerce div.product div.images .custom-swiper-nav .swiper-nav-right',
				prevEl: '.woocommerce div.product div.images .custom-swiper-nav .swiper-nav-left',
			},
		});
		jQuery( '.woocommerce div.product div.images' ).addClass( 'show' );
	}, 500);
});

jQuery( '.woocommerce div.product div.summary .more-info-btn a' ).click(function(e){
	e.preventDefault();
	jQuery('html,body').animate({
		scrollTop: jQuery( '#product-details' ).offset().top
	}, 1000);
});

if ( screen.width <= 850 ) {
	var product_gallery_element = jQuery( '.woocommerce div.product div.images.woocommerce-product-gallery' );
	product_gallery_element.height( product_gallery_element.width() );
	
	new Swiper( '.mobile-related-products.swiper-container', {
		speed: 300,
		loop: true,
		navigation: {
			nextEl: '.mobile-related-products .rpnb-btn-right',
			prevEl: '.mobile-related-products .rpnb-btn-left',
		},
	});

}