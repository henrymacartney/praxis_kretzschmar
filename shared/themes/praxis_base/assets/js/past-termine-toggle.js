/**
 * Past-events disclosure label toggle.
 *
 * Swaps the <summary> text between "...anzeigen" and "...ausblenden"
 * when the user opens or closes the past-events <details> element.
 *
 * Markup contract:
 *   <details data-past-events>
 *     <summary data-past-summary>Vergangene Termine anzeigen</summary>
 *     ...
 *   </details>
 *
 * Loaded only on the Termine page via wp_enqueue_scripts in functions.php.
 */
( function () {
    'use strict';
    
    const details = document.querySelector( '[data-past-events]' );
    if ( ! details ) {
        return;
    }
    
    const summary = details.querySelector( '[data-past-summary]' );
    if ( ! summary ) {
        return;
    }
    
    const labelOpen   = 'Vergangene Termine anzeigen';
    const labelClosed = 'Vergangene Termine ausblenden';
    
    details.addEventListener( 'toggle', function () {
        summary.textContent = details.open ? labelClosed : labelOpen;
    } );
} )();