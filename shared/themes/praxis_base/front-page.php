<?php
/**
 * Front page (homepage).
 *
 * Static placeholder content for now — will be wired to ACF fields next.
 *
 * @package PraxisBase
 */

get_header();
?>
	
	<main id="main" class="site-main flex-1">
		
		<section class="hero py-28 md:py-36 bg-cream-50">
			<div class="mx-auto max-w-3xl px-6 text-center">
				<h1 class="font-display text-5xl md:text-6xl font-medium tracking-tight text-navy-800 mb-6 leading-tight">
					Praxis für Körperzentrierte Psychotherapie
				</h1>
				<p class="font-sans text-lg md:text-xl text-navy-600 leading-relaxed">
					Birgit Kretzschmar &middot; Tanz- und Lehrtherapeutin BTD
				</p>
			</div>
		</section>
		
		<section class="cta py-10 bg-navy-800">
			<div class="mx-auto max-w-3xl px-6 text-center">
				<a href="#kontakt" class="inline-block font-sans text-cream-50 text-sm tracking-wide uppercase border-b border-cream-200 pb-1 hover:border-cream-50 transition-colors">
					Termin vereinbaren
				</a>
			</div>
		</section>
		
		<section class="intro py-20 bg-cream-100 border-y border-cream-200">
			<div class="mx-auto max-w-2xl px-6">
				<p class="font-sans text-lg leading-relaxed text-stone-800">
					Herzlich Willkommen auf der Internetseite meiner Praxis.
					Diese Seite gibt Ihnen einen Überblick über meine Arbeit und mein
					Leistungsangebot und beantwortet Fragen zu Therapieverfahren und Ablauf.
				</p>
			</div>
		</section>
	
	</main>

<?php
get_footer();