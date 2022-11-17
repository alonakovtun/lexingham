var archive_catalog_main = jQuery( 'main' ),
	archive_catalog_position_from_top = archive_catalog_main.offset().top,
	archive_catalog_position_from_bottom = archive_catalog_position_from_top + archive_catalog_main.outerHeight(),
	visible_screen_height = jQuery(window.top).height();

jQuery( window ).scroll(function(){

	var current_page_position_from_top = jQuery( this ).scrollTop() + visible_screen_height;

	if ( screen.width > 850  ) {
		if( current_page_position_from_top >= archive_catalog_position_from_bottom ){
			jQuery( '.filters-wrapper' ).css( 'bottom', 0 );
		} else {
			var filter_wrapper_position_from_bottom = archive_catalog_position_from_bottom - current_page_position_from_top;
			jQuery( '.filters-wrapper' ).css( 'bottom', filter_wrapper_position_from_bottom );
		}
	} else {
		if( current_page_position_from_top < archive_catalog_position_from_bottom ){
			jQuery( '.filters-wrapper' ).css( 'bottom', 0 );
		} else {
			var filter_wrapper_position_from_bottom = archive_catalog_position_from_bottom - current_page_position_from_top;
			jQuery( '.filters-wrapper' ).css( 'bottom', Math.abs(filter_wrapper_position_from_bottom) );
		}
	}

});

jQuery( window ).load(function(){

	var current_page_position_from_top = jQuery( this ).scrollTop() + visible_screen_height,
		filter_wrapper_position_from_bottom = archive_catalog_position_from_bottom - current_page_position_from_top;

	if ( screen.width > 850  ) {
		if( current_page_position_from_top < archive_catalog_position_from_bottom ){
			jQuery( '.filters-wrapper' ).css( 'bottom', filter_wrapper_position_from_bottom );
		}
	}

	jQuery( '.filters-wrapper .filters-content div.woof_container:not(.woof_container_sound_color) .woof_list li .woof_radio_label' ).wrapInner( '<span></span>' );
	jQuery( '.filters-wrapper .filters-content div.woof_container:not(.woof_container_sound_color) .woof_list li:not(:last-child) .woof_radio_label' ).append( '<span>,&nbsp;</span>' );
	jQuery( '.filters-wrapper .filters-content .woof_container_sound_color .woof_list li .woof_radio_label' ).each(function(){

		var ce 		 = jQuery( this ),
			ce_value = ce.text().trim();

		jQuery.each( bt_sound_colors_data, function( key, value ){
			if ( key === ce_value ) {
				ce.html( '<span class="color-circle" title="' + key + '" style="background-color: ' + value + ';"></span>' );
			}
		});

	});

});

jQuery( '.filters-wrapper .filters-wrapper-btn' ).click(function(){
	jQuery( this ).toggleClass( 'open' );
	jQuery( '.filters-wrapper .filters-content' ).slideToggle();
});