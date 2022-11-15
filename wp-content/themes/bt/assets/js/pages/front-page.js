jQuery( '.catalog-wrapper a' ).hover(function(){

	var ce 							 = jQuery( this ),
		ce_height 					 = ce.height(),
		category_desc_wrapper 		 = ce.find( '.category-desc-wrapper' ),
		category_desc_wrapper_height = category_desc_wrapper.height();

	category_desc_wrapper.css( 'top', ce_height - category_desc_wrapper_height );

},function(){

	var ce 					  = jQuery( this ),
		ce_height 			  = ce.height(),
		category_desc_wrapper = ce.find( '.category-desc-wrapper' ),
		visible_screen_height = jQuery(window.top).height();

	if ( visible_screen_height > 670 ) {
		category_desc_wrapper.css( 'top', ce_height - 130 );
	} else if ( visible_screen_height <= 670 ) {
		category_desc_wrapper.css( 'top', ce_height - 60 );
	}

});

if ( screen.width <= 1000 ) {

	new Swiper( '.catalog-wrapper-mobile .swiper-container', {
		speed: 300,
		loop: true,
		navigation: {
			nextEl: '.catalog-wrapper-mobile .cwmn-btn-right',
			prevEl: '.catalog-wrapper-mobile .cwmn-btn-left',
		},
	});

}