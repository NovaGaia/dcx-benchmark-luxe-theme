( function () {
	function closeNav( nav, toggle ) {
		toggle.setAttribute( 'aria-expanded', 'false' );
		nav.classList.remove( 'is-open' );
		toggle.focus();
	}

	function initNavInternal() {
		// Cibler uniquement les éléments <nav>, pas le <ul> qui hérite des mêmes classes
		document.querySelectorAll( 'nav.wp-block-navigation.is-style-nav-internal' ).forEach( function ( nav ) {
			if ( nav.dataset.navInternalInit ) return;
			nav.dataset.navInternalInit = '1';

			var toggle = document.createElement( 'button' );
			toggle.className = 'nav-internal-toggle';
			toggle.setAttribute( 'aria-expanded', 'false' );
			toggle.setAttribute( 'aria-haspopup', 'true' );

			// Chercher l'item actif : current-page-item, current-menu-item, ou aria-current="page"
			var activeLink =
				nav.querySelector( '.current-page-item .wp-block-navigation-item__content' ) ||
				nav.querySelector( '.current-menu-item .wp-block-navigation-item__content' ) ||
				nav.querySelector( '.wp-block-navigation-item__content[aria-current="page"]' );

			var firstLink = nav.querySelector( '.wp-block-navigation-item__content' );
			toggle.textContent = ( activeLink || firstLink ) ? ( activeLink || firstLink ).textContent.trim() : 'Navigation';

			nav.insertBefore( toggle, nav.firstChild );

			// Ouvrir / fermer au clic sur le toggle
			toggle.addEventListener( 'click', function ( e ) {
				e.stopPropagation();
				var expanded = this.getAttribute( 'aria-expanded' ) === 'true';
				this.setAttribute( 'aria-expanded', String( ! expanded ) );
				nav.classList.toggle( 'is-open', ! expanded );
			} );

			// Mettre à jour le toggle au clic sur un item
			nav.querySelectorAll( '.wp-block-navigation-item__content' ).forEach( function ( link ) {
				link.addEventListener( 'click', function () {
					toggle.textContent = this.textContent.trim();
					closeNav( nav, toggle );
				} );
			} );

			// Fermer sur Échap
			document.addEventListener( 'keydown', function ( e ) {
				if ( ( e.key === 'Escape' || e.key === 'Esc' ) && nav.classList.contains( 'is-open' ) ) {
					closeNav( nav, toggle );
				}
			} );

			// Fermer au clic/tap en dehors — vérifie contre le <ul> pour exclure le toggle
			var container = nav.querySelector( '.wp-block-navigation__container' );
			document.addEventListener( 'pointerdown', function ( e ) {
				if ( ! container.contains( e.target ) && e.target !== toggle && nav.classList.contains( 'is-open' ) ) {
					closeNav( nav, toggle );
				}
			}, true );
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initNavInternal );
	} else {
		initNavInternal();
	}
} )();
