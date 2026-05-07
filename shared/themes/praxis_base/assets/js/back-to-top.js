/**
 * Back-to-top button.
 *
 * Hidden by default. Becomes visible once the user has scrolled
 * past 300px. Clicking smoothly scrolls the window back to the top.
 *
 * Markup contract:
 *   <button data-back-to-top aria-label="Zum Seitenanfang">...</button>
 *
 * Loaded on every page via wp_enqueue_scripts in functions.php.
 */
( function () {
    'use strict';
    
    const button = document.querySelector( '[data-back-to-top]' );
    if ( ! button ) {
        return;
    }
    
    const showAfter = 300; // pixels scrolled before button appears
    
    const updateVisibility = function () {
        if ( window.scrollY > showAfter ) {
            button.classList.add( 'is-visible' );
        } else {
            button.classList.remove( 'is-visible' );
        }
    };
    
    // Throttle scroll handler with requestAnimationFrame for smoothness
    let ticking = false;
    window.addEventListener( 'scroll', function () {
        if ( ! ticking ) {
            window.requestAnimationFrame( function () {
                updateVisibility();
                ticking = false;
            } );
            ticking = true;
        }
    } );
    
    button.addEventListener( 'click', function () {
        window.scrollTo( {
            top: 0,
            behavior: 'smooth',
        } );
    } );
    
    // Set initial state in case page loads pre-scrolled (e.g. via anchor)
    updateVisibility();
} )();