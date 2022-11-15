/** on page scroll **/
/*
jQuery( window ).scroll(function(){
  if( jQuery( this ).scrollTop() > 0 ){
    // scrolled action
  } else {
    // at top of page action
  }
});
*/

/** custom modal actions **/
/*
jQuery( '.modal-btn' ).click(function(e){
  e.preventDefault();

  var target_class = '.modal-box.' + jQuery( this ).data( 'modal' );

  jQuery( 'body' ).addClass( 'modal-open' );
  jQuery( '.modal-background' ).fadeIn( 300 );

  setTimeout(function(){
    jQuery( target_class ).before( '<div class="modal-back" style="position:absolute;top:0;right:0;bottom:0;left:0;z-index:1;"></div>' );
    jQuery( target_class ).addClass( 'modal-open' );
  }, 200);

});

jQuery( '.modal-box' ).click(function(e){
  e.stopPropagation();
});

jQuery( '.modal-background, .modal-box .close' ).click(function(){

  jQuery( '.modal-back' ).remove();
  jQuery( '.modal-box' ).removeClass( 'modal-open' );

  setTimeout(function(){
    jQuery( '.modal-background' ).fadeOut( 300 );
  }, 200);

  setTimeout(function(){
    jQuery( 'body' ).removeClass( 'modal-open' );
  }, 500)

});
*/

/** site header **/

jQuery( '.main-site-header .search-btn a, .main-site-header .close-search-btn, .mobile-search-btn' ).click(function(){

	if ( screen.width > 1000 ) {
		var search_form_visible_top = '109px',
			search_form_hidden_top  = '139px',
			search_quick_links_visible_top = '169px',
			search_quick_links_hidden_top = '199px';
	} else {
		var search_form_visible_top = '79px',
			search_form_hidden_top  = '109px',
			search_quick_links_visible_top = '139px',
			search_quick_links_hidden_top = '169px';
	}

	var search_form_class = '.main-site-header .search-form',
		search_quick_links_class = '.main-site-header .search-quick-links';
	
	if ( jQuery( search_form_class ).css( 'display' ) == 'none' ) {
		jQuery( search_form_class ).css( 'display', 'block' );
		setTimeout(function(){
			jQuery( search_form_class ).animate({top: search_form_visible_top,opacity: 1}, 300);
		}, 1);
		setTimeout(function(){
			jQuery( '#sf-search' ).focus();
		}, 301);
	} else {
		setTimeout(function(){
			jQuery( search_form_class ).animate({top: search_form_hidden_top,opacity: 0}, 300);
			setTimeout(function(){
				jQuery( search_form_class ).css( 'display', 'none' );
			}, 301);
		}, 150);
	}

	if ( jQuery( search_quick_links_class ).css( 'display' ) == 'none' ) {
		setTimeout(function(){
			jQuery( search_quick_links_class ).css( 'display', 'block' );
			setTimeout(function(){
				jQuery( search_quick_links_class ).animate({top: search_quick_links_visible_top,opacity: 1}, 300);
			}, 1);
		}, 150);
	} else {
		jQuery( search_quick_links_class ).animate({top: search_quick_links_hidden_top,opacity: 0}, 300);
		setTimeout(function(){
			jQuery( search_quick_links_class ).css( 'display', 'none' );
		}, 301);
	}

});

/** site header - end **/

AOS.init();

/** site footer **/

jQuery( window ).on( 'load', function(){

	if ( screen.width > 1000 ) {
		var inner_col_height = 0;

		jQuery( '.main-site-footer .inner-col' ).each( function(){
			var ce 		  = jQuery( this ),
				ce_height = ce.height();

			if ( ce_height > inner_col_height ) {
				inner_col_height = ce_height;
			}
		});

		if ( inner_col_height !== 0 ) {
			jQuery( '.main-site-footer .inner-col' ).height( inner_col_height );
		}
	}
	
});	


jQuery( '.main-site-header .mobile-nav-btn' ).click(function(){
	jQuery( this ).toggleClass( 'open' );
	jQuery( 'body' ).toggleClass( 'mobile-nav-open' );
	jQuery( '.main-site-header .mobile-nav' ).toggleClass( 'open' );
});

jQuery( '.main-site-header .mobile-nav > ul > li.menu-item-has-children > a' ).click(function(e){
	e.preventDefault();

	jQuery( '.main-site-header .mobile-close-sub-menu' ).fadeIn( 300 );

	var ce = jQuery( this );
	ce.next().addClass( 'open' );

});

jQuery( '.main-site-header .mobile-close-sub-menu, .main-site-header .mobile-nav-btn' ).click(function(){
	jQuery( '.main-site-header .mobile-close-sub-menu' ).fadeOut( 300 );
	jQuery( '.sub-menu' ).removeClass( 'open' );
});

/** site footer - end **/


		jQuery('.search-tgl').click(function(e){
			e.preventDefault();
			jQuery('.search-section-wrap').toggleClass('active');
			setTimeout(function(){
            	jQuery(".search-section-wrap .input-text").focus();
        	}, 600);
		});



