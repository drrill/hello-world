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

/* Konami code Easter egg: ↑↑↓↓←→←→BA */
( function() {
	var seq = [38,38,40,40,37,39,37,39,66,65], pos = 0;
	document.addEventListener( 'keydown', function( e ) {
		pos = e.keyCode === seq[pos] ? pos + 1 : 0;
		if ( pos !== seq.length ) return;
		pos = 0;
		var hue = 0, root = document.documentElement;
		var orig = getComputedStyle(root).getPropertyValue('--color-accent').trim();
		var id = setInterval( function() {
			hue = ( hue + 8 ) % 360;
			root.style.setProperty('--color-accent', 'hsl(' + hue + ',80%,50%)');
			root.style.setProperty('--color-accent-hover', 'hsl(' + ((hue+20)%360) + ',80%,50%)');
		}, 50 );
		setTimeout( function() {
			clearInterval(id);
			root.style.removeProperty('--color-accent');
			root.style.removeProperty('--color-accent-hover');
		}, 4000 );
	} );
} )();
