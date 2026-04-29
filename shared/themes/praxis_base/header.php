<?php
/**
 * Site header.
 *
 * @package PraxisBase
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'min-h-screen flex flex-col bg-white text-stone-900 antialiased' ); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header border-b border-stone-200">
        <div class="mx-auto max-w-6xl px-6 py-6 flex items-center justify-between">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-lg font-medium tracking-tight">
                <?php bloginfo( 'name' ); ?>
            </a>
            <nav aria-label="<?php esc_attr_e( 'Hauptmenü', 'praxis-base' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex gap-6 text-sm',
                    'fallback_cb'    => '__return_empty_string',
                ) );
                ?>
            </nav>
        </div>
    </header>