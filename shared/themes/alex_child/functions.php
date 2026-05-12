<?php
/**
 * Alex Kretzschmar — child-theme bootstrap.
 *
 * Mirrors praxis_base's enqueue pattern (filemtime cache-busting,
 * compiled-CSS-only — style.css is for WP detection, not styling).
 *
 * The parent theme's functions.php handles theme support, menus,
 * head cleanup, the Gutenberg-on-Startseite filter, and enqueues
 * the parent's CSS + JS. We only add child-specific things here.
 *
 * @package AlexChild
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ALEX_CHILD_VERSION', '0.1.0' );
define( 'ALEX_CHILD_DIR', get_stylesheet_directory() );
define( 'ALEX_CHILD_URI', get_stylesheet_directory_uri() );

/**
 * Enqueue the compiled child Tailwind stylesheet.
 *
 * Priority 20 ensures we run AFTER the parent's enqueue (default 10),
 * so the child stylesheet loads later in <head> and overrides parent
 * tokens where they clash. Cache-bust on every rebuild via filemtime.
 */
add_action( 'wp_enqueue_scripts', function () {
    $css_path = ALEX_CHILD_DIR . '/build/theme.css';
    $css_uri  = ALEX_CHILD_URI . '/build/theme.css';

    if ( file_exists( $css_path ) ) {
        wp_enqueue_style(
            'alex-child',
            $css_uri,
            array( 'praxis-base' ), // declare parent stylesheet as dependency
            (string) filemtime( $css_path )
        );
    }
}, 20 );

/**
 * Register the ACF Options Page used by the footer field group.
 *
 * The footer template-part reads its fields with the `'option'` second
 * argument; that only works once an Options Page is registered. Guarded
 * on `acf_add_options_page` existing so the theme is safe to activate
 * before ACF Pro is installed.
 */
add_action( 'acf/init', function () {
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page( array(
            'page_title' => __( 'Footer-Einstellungen', 'alex-child' ),
            'menu_title' => __( 'Footer', 'alex-child' ),
            'menu_slug'  => 'alex-footer-options',
            'capability' => 'edit_theme_options',
            'redirect'   => false,
        ) );
    }
} );

/**
 * Tell ACF to also load Local JSON from the parent theme.
 *
 * By default ACF only scans the active theme's acf-json/ folder. Since
 * praxis_base ships shared field groups (Leistung, Über mich, Kontakt,
 * Termine, Homepage) that the child theme inherits, we need to add the
 * parent's acf-json/ to the load paths.
 */
add_filter( 'acf/settings/load_json', function ( $paths ) {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
} );
