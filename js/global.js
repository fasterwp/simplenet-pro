jQuery( function ( $ ) {

	// Add header class to body after 10px
	$(window).bind( 'load scroll', function() {

		if ( $(window).scrollTop() > 10 ) {

			$( 'body' ).addClass( 'header-scroll' );

		} else {

			$( 'body' ).removeClass( 'header-scroll' );

		}

	});

});
