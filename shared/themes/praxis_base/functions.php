<?php
/**
 * Praxis Base — parent theme bootstrap.
 *
 * Keep this file thin. Concrete features live in /inc/ and are loaded below.
 *
 * @package PraxisBase
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // No direct file access.
}

define( 'PRAXIS_BASE_VERSION', '0.1.0' );
define( 'PRAXIS_BASE_DIR', get_template_directory() );
define( 'PRAXIS_BASE_URI', get_template_directory_uri() );

/**
 * Theme supports and head cleanup.
 */
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( array(
        'primary' => __( 'Hauptmenü', 'praxis-base' ),
        'footer'  => __( 'Footer-Menü', 'praxis-base' ),
    ) );
} );

/**
 * Enqueue the compiled Tailwind stylesheet.
 *
 * The source lives in /tailwind.css; the compiled output is /build/theme.css.
 * We don't enqueue style.css — it exists only for WordPress's theme detection.
 */
add_action( 'wp_enqueue_scripts', function () {
    $css_path = PRAXIS_BASE_DIR . '/build/theme.css';
    $css_uri  = PRAXIS_BASE_URI . '/build/theme.css';

    if ( file_exists( $css_path ) ) {
        wp_enqueue_style(
            'praxis-base',
            $css_uri,
            array(),
            (string) filemtime( $css_path ) // Cache-bust on every rebuild.
        );
    }
} );

/**
 * Remove WordPress noise we don't need on a Praxis website.
 */
add_action( 'init', function () {
    remove_action( 'wp_head', 'wp_generator' );          // Hide WP version.
    remove_action( 'wp_head', 'wlwmanifest_link' );      // Windows Live Writer.
    remove_action( 'wp_head', 'rsd_link' );              // Really Simple Discovery.
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
});

/**
 * Use the classic editor for the Startseite (homepage).
 *
 * The homepage's content is managed entirely via ACF fields. The empty
 * Gutenberg canvas adds visual noise to the edit screen without serving
 * any purpose. Disabling the block editor for this one page lets ACF
 * Pro's "Hide Content Editor" presentation setting do its job.
 *
 * @param bool   $use_block_editor  Whether to use the block editor.
 * @param object $post              The post being edited.
 * @return bool
 */
add_filter( 'use_block_editor_for_post', function ( $use_block_editor, $post ) {
    if ( isset( $post->post_name ) && $post->post_name === 'startseite' ) {
        return false;
    }
    return $use_block_editor;
}, 10, 2 );