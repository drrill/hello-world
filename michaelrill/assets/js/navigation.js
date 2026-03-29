/**
 * Mobile navigation toggle.
 *
 * @package MichaelRill
 */
( function() {
	const nav = document.getElementById( 'site-navigation' );
	if ( ! nav ) {
		return;
	}

	const button = nav.querySelector( '.menu-toggle' );
	if ( ! button ) {
		return;
	}

	const menu = nav.querySelector( 'ul' );
	if ( ! menu ) {
		button.style.display = 'none';
		return;
	}

	button.addEventListener( 'click', function() {
		nav.classList.toggle( 'toggled' );
		const expanded = nav.classList.contains( 'toggled' );
		button.setAttribute( 'aria-expanded', expanded );
	} );

	// Close menu when clicking outside.
	document.addEventListener( 'click', function( event ) {
		if ( ! nav.contains( event.target ) && nav.classList.contains( 'toggled' ) ) {
			nav.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );
} )();
