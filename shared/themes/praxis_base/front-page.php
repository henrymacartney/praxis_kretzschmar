<?php
/**
 * Front page (homepage).
 *
 * WordPress uses this template automatically when viewing the site root,
 * regardless of what page is set as "Static front page". For now it just
 * shows a placeholder — we'll wire it to ACF fields in the next step.
 *
 * @package PraxisBase
 */

get_header();
?>

    <main id="main" class="site-main flex-1">
        <section class="hero py-24">
            <div class="mx-auto max-w-3xl px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-medium tracking-tight mb-6">
                    Praxis für Körperzentrierte Psychotherapie
                </h1>
                <p class="text-lg text-stone-600 leading-relaxed">
                    Birgit Kretzschmar &middot; Tanz- und Lehrtherapeutin BTD
                </p>
            </div>
        </section>

        <section class="intro py-16 bg-stone-50 border-y border-stone-200">
            <div class="mx-auto max-w-2xl px-6">
                <p class="text-lg leading-relaxed text-stone-700">
                    Herzlich Willkommen auf der Internetseite meiner Praxis.
                    Diese Seite gibt Ihnen einen Überblick über meine Arbeit und mein
                    Leistungsangebot und beantwortet Fragen zu Therapieverfahren und Ablauf.
                </p>
            </div>
        </section>
    </main>

<?php
get_footer();