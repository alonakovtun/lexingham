if ( screen.width <= 750 ) {
	jQuery( '.right-content-wrapper .image-one' ).addClass( 'padding-top-40' );
	jQuery( '.right-content-wrapper .paragraph-one' ).addClass( 'from-right' );
	jQuery( '.left-content-wrapper .paragraph-one' ).after( jQuery( '.right-content-wrapper .paragraph-one' ) );
	jQuery( '.left-content-wrapper .image-one' ).after( jQuery( '.right-content-wrapper .image-one' ) );
}