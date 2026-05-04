<?php
/**
 * Visible site header (logo + primary navigation).
 *
 * Loaded by header.php via get_template_part(). The document chrome
 * (<html>, <head>, <body>) lives in header.php; this file is concerned
 * only with the visible header UI that sits at the top of every page.
 *
 * @package PraxisBase
 */
?>
<header class="site-header bg-cream-50 border-b border-cream-200">
    <div class="mx-auto max-w-6xl px-6 py-6 flex items-center justify-between">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-display text-xl font-medium tracking-tight text-navy-800">
            <?php bloginfo( 'name' ); ?>
        </a>
        <nav aria-label="<?php esc_attr_e( 'Hauptmenü', 'praxis-base' ); ?>" class="hidden md:block">
            <?php
            wp_nav_menu( array(
                'theme_location'  => 'primary',
                'container'       => false,
                'menu_class'      => 'flex items-center gap-8 font-sans text-sm',
                'fallback_cb'     => '__return_empty_string',
                'link_before'     => '<span class="text-navy-600 hover:text-navy-900 transition-colors border-b border-transparent hover:border-navy-400 pb-1">',
                'link_after'      => '</span>',
            ) );
            ?>
        </nav>
    </div>
</header>