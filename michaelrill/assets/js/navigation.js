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

/* Dark mode: auto (time-based), manual toggle, localStorage persistence */
( function() {
	var root = document.documentElement;
	var STORAGE_KEY = 'michaelrill-theme';

	function isDaytime() {
		var h = new Date().getHours();
		return h >= 7 && h < 20;
	}

	function getAutoTheme() {
		if ( window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ) {
			return 'dark';
		}
		return isDaytime() ? 'light' : 'dark';
	}

	function applyTheme( theme ) {
		root.setAttribute( 'data-theme', theme );
	}

	// On load: check stored preference, otherwise auto-detect.
	var stored = localStorage.getItem( STORAGE_KEY );
	if ( stored ) {
		applyTheme( stored );
	} else {
		applyTheme( getAutoTheme() );
	}

	// Toggle button.
	var btn = document.querySelector( '.theme-toggle' );
	if ( btn ) {
		btn.addEventListener( 'click', function() {
			var current = root.getAttribute( 'data-theme' ) || 'light';
			var next = current === 'dark' ? 'light' : 'dark';
			applyTheme( next );
			localStorage.setItem( STORAGE_KEY, next );
		} );
	}

	// Respect OS-level preference changes.
	if ( window.matchMedia ) {
		window.matchMedia('(prefers-color-scheme: dark)').addEventListener( 'change', function( e ) {
			if ( ! localStorage.getItem( STORAGE_KEY ) ) {
				applyTheme( e.matches ? 'dark' : 'light' );
			}
		} );
	}
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
