/**
 * Mobile navigation toggle.
 *
 * Wires the hamburger button (data-mobile-nav-toggle) to the menu panel
 * (data-mobile-nav-panel). Keeps the aria-expanded state in sync with
 * the panel's visibility so screen readers announce the current state.
 *
 * Loaded only when the markup is present (no error if elements are missing).
 */
( function () {
    'use strict';
    
    const toggle = document.querySelector( '[data-mobile-nav-toggle]' );
    const panel  = document.querySelector( '[data-mobile-nav-panel]' );
    
    if ( ! toggle || ! panel ) {
        return;
    }
    
    function openPanel() {
        panel.classList.remove( 'hidden' );
        toggle.setAttribute( 'aria-expanded', 'true' );
        toggle.setAttribute( 'aria-label', 'Menü schließen' );
    }
    
    function closePanel() {
        panel.classList.add( 'hidden' );
        toggle.setAttribute( 'aria-expanded', 'false' );
        toggle.setAttribute( 'aria-label', 'Menü öffnen' );
    }
    
    function isOpen() {
        return ! panel.classList.contains( 'hidden' );
    }
    
    toggle.addEventListener( 'click', function () {
        if ( isOpen() ) {
            closePanel();
        } else {
            openPanel();
        }
    } );
} )();