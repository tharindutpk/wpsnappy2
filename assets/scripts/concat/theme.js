/**
 * Add any custom theme JavaScript to this file.
 */

( function ( document, $ ) {
	
	'use strict';

	/**
	 * Add shrink class to header on scroll.
	 */
	$( window ).scroll( function() {
		var scroll = $( window ).scrollTop();
		var height = $( '.page-header' ).outerHeight();
		var header = $( '.site-header' ).outerHeight();
		if ( scroll >= header) {
			$( '.site-header' ).addClass( 'shrink' );
		} else {
			$( '.site-header' ).removeClass( 'shrink' );
		}
	} );

	/**
	 * Smooth scrolling.
	 */
	// Select all links with hashes
	$( 'a[href*="#"]' )

	// Remove links that don't actually link to anything
	.not( '[href="#"]' ).not( '[href="#0"]' )

	// Remove WooCommerce tabs
	.not( '[href*="#tab-"]' ).click( function ( event ) {

		// On-page links
		if ( location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) && location.hostname == this.hostname ) {

			// Figure out element to scroll to
			var target = $( this.hash );
			target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );

			// Does a scroll target exist?
			if ( target.length ) {

				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				$( 'html, body' ).animate( {
					scrollTop: target.offset().top
				}, 1000, function () {

					// Callback after animation, must change focus!
					var $target = $( target );
					$target.focus();

					// Checking if the target was focused
					if ( $target.is( ":focus" ) ) {

						return false;
					} else {

						// Adding tabindex for elements not focusable
						$target.attr( 'tabindex', '-1' );

						// Set focus again
						$target.focus();
					};
				} );
			}
		}
	} );

} )( document, jQuery );

/* Thanks to CSS Tricks for pointing out this bit of jQuery
https://css-tricks.com/equal-height-blocks-in-rows/
It's been modified into a function called at page load and then each time the page is resized. One large modification was to remove the set height before each new calculation. */

jQuery(document).ready(function($){
	//you can now use $ as your jQuery object.
	equalheight = function(container){

		var currentTallest = 0,
			currentRowStart = 0,
			rowDivs = new Array(),
			$el,
			topPosition = 0;

		$(container).each(function() {
			$el = $(this);
			$($el).height('auto')
			topPostion = $el.position().top;

			if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest);
				}
				rowDivs.length = 0; // empty the array
				currentRowStart = topPostion;
				currentTallest = $el.height();
				rowDivs.push($el);
			} else {
				rowDivs.push($el);
				currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
			}
			console.log(rowDivs + " Hello");
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
		});
	}

	$(window).load(function() {
		equalheight('.featured-row .one-third');
	});

	$(window).resize(function(){
		equalheight('.featured-row .one-third');
	});

});
