# User Requirements Specification — Birgit Kretzschmar's Practice Website 

**Document version:** Retrospective draft, 14 May 2026  
**Author:** Dr. Henry Macartney (Beriott GmbH)  
**Project:** Praxis Kretzschmar website build  
**Scope:** Public-facing practice website for Birgit Kretzschmar's
psychotherapy practice in Wiesbaden  
**Status:** Retrospective. Built first, documented after. To be reviewed with
Frau Kretzschmar before sign-off.

---

## Table of Contents

- [1. Purpose of this document](#1-purpose-of-this-document)
- [2. Background](#2-background)
- [3. Document structure](#3-document-structure)
  - [Design choices worth noting](#design-choices-worth-noting)
- [4. Build specification](#4-build-specification)
  - [4.1 Theme architecture](#41-theme-architecture)
  - [4.2 Pages](#42-pages)
  - [4.3 Front-page template (`front-page.php`)](#43-front-page-template-front-pagephp)
  - [4.4 Individual therapy template (`template-leistung.php`)](#44-individual-therapy-template-template-leistungphp)
  - [4.5 Other templates](#45-other-templates)
  - [4.6 Data model (ACF field groups)](#46-data-model-acf-field-groups)
  - [4.7 Design system](#47-design-system)
  - [4.8 Forms](#48-forms)
  - [4.9 Build pipeline](#49-build-pipeline)
- [5. Constraints we already know](#5-constraints-we-already-know)
- [6. Out of scope (deliberately)](#6-out-of-scope-deliberately)
- [7. Acceptance criteria (the test of "done")](#7-acceptance-criteria-the-test-of-done)
- [8. Timeline expectations](#8-timeline-expectations)
- [9. Sign-off](#9-sign-off)
- [10. Version history](#10-version-history)
- [11. What was inferred vs documented](#11-what-was-inferred-vs-documented)
  - [Documented (captured during the project)](#documented-captured-during-the-project)
  - [Inferred (Beriott's design choice; needs confirmation)](#inferred-beriotts-design-choice-needs-confirmation)
- [Appendix A — Notes for the Beriott team (not for Frau Kretzschmar)](#appendix-a-notes-for-the-beriott-team-not-for-frau-kretzschmar)
  - [Architectural notes](#architectural-notes)
  - [Known structural notes](#known-structural-notes)
  - [Outstanding work flagged in the project handoff](#outstanding-work-flagged-in-the-project-handoff)
  - [Follow-up URS documents](#follow-up-urs-documents)
  - [Inferred-requirements integrity check](#inferred-requirements-integrity-check)

---

## 1. Purpose of this document

This is a User Requirements Specification (URS). Its purpose is to capture
what Frau Kretzschmar needs her public practice website to do for her
patients and her practice.

A URS reviewed and signed off by the client is the contract for what
"done" means.

**This URS is retrospective.** The website was built by Beriott during
Q1–Q2 2026, with requirements established informally through conversation
and design iteration rather than a written document. This URS reconstructs
those requirements from the delivered build so they can be reviewed,
challenged, and signed off as a formal record.

Because it is retrospective, parts of this document are necessarily inferred
from the finished work rather than captured from Frau Kretzschmar in advance.
Section 11 lists exactly which requirements are inferred and which are
documented, so Frau Kretzschmar can correct anything that does not match
what she actually wanted.

**This URS covers only the public-facing website.** Self-service editing of
the Termine (events) page is the subject of its own dedicated URS — the
Birgit-Termine editor URS — because Frau Kretzschmar updates her event
calendar regularly enough that the editing workflow warranted separate
requirements. Any further self-service editing (other pages, other content)
remains out of scope here and would be specified in additional URS documents
if and when agreed.

This document also incorporates the full technical build specification of
the delivered website (§4), so that it serves both as the client's
requirements record and as the maintenance reference for whoever works on
the site after delivery.


[↑ Back to top](#table-of-contents)

---

## 2. Background

Birgit Kretzschmar runs a psychotherapy practice at Nussbaumstraße 5,
65187 Wiesbaden. She is a Heilpraktikerin für Psychotherapie; her practice
centres on body-oriented and dance-based work — Körperzentrierte
Psychotherapie, Tanztherapie, Paartherapie, Weiterbildungen, and
Psychotraumatherapie — run as a Privatpraxis. Her existing website was
technically dated and visually inconsistent with how she wanted her
practice represented.

Beriott was engaged to deliver a new website alongside the parallel rebuild
of her brother-in-law Dr. Alexander Kretzschmar's site. Both sites share a
common design system (the `praxis_base` parent theme) so they read as
sibling practices, on separate domains.

Unlike Dr. Kretzschmar's site — which uses a child theme (`alex_child`) to
apply a practice-specific warm-red brand palette and a bespoke five-band
landing page — Frau Kretzschmar's site runs **directly on the `praxis_base`
parent theme**, with no child theme. Her site therefore uses the parent's
default design system unchanged: the deep-navy + warm-cream + stone palette,
the parent's homepage layout, and the parent's two-column footer. Her site
is effectively the "base" expression of the shared design system, with Dr.
Kretzschmar's as the branded variant. This asymmetry is intentional: no
practice-specific overrides have been required for her site to date.

The practice's old domain — `birgit-kretzschmar.de` — is preserved for SEO
continuity and patient memory, and is the intended production domain.


[↑ Back to top](#table-of-contents)

---

## 3. Document structure

The document is split into three audiences:

§1–§3 — Framing for Frau Kretzschmar: what a URS is, why we're doing one,
and how the document is organised
§4 — The technical build specification: architecture, pages, templates,
data model, design system, build pipeline. This is the detailed
engineering record of what was built, and doubles as the maintenance
reference.
§5–§10 — The contract bits: constraints, out-of-scope, acceptance criteria,
timeline, sign-off
§11 — Explicit list of what was inferred (so Frau Kretzschmar can correct it)
Appendix A — Internal Beriott notes that Frau Kretzschmar doesn't need to
read but Henry and future maintainers will

### Design choices worth noting

- The build specification in §4 is taken directly from the live templates,
  theme files, and ACF field groups. Anchoring the document in the actual
  build keeps the conversation concrete.
- The questions for Frau Kretzschmar focus on whether the decisions already
  implemented and visible were the correct ones, not on what they should be
  — because the site is built and reviewable.
- §5 reaffirms DSGVO compliance and the "no patient data on the website"
  rule explicitly. Reaffirmed in every URS so it never gets accidentally
  relaxed.
- §7 acceptance criteria are testable, observable, and Kretzschmar-centric.
- §11 (the "what we inferred" section) is the integrity check that makes a
  retrospective URS honest rather than self-congratulatory.


[↑ Back to top](#table-of-contents)

---

## 4. Build specification

This section documents the website **as built**: architecture, pages,
templates, data model, design system, and build pipeline of the delivered
website. It is the detailed technical record and the maintenance reference.

### 4.1 Theme architecture

The website is a WordPress site running a single theme:

| Theme         | Role             | Location                                  |
|---------------|------------------|-------------------------------------------|
| `praxis_base` | Active theme     | Shared design system, all templates, ACF field groups |

`praxis_base` is the shared parent theme for both Kretzschmar practices.
**Frau Kretzschmar's site runs on it directly — there is no child theme.**
Where Dr. Kretzschmar's site uses an `alex_child` child theme to override
branding and the homepage layout, Frau Kretzschmar's site has required no
such overrides, so it uses `praxis_base` unmodified.

Practical consequence: any change to `praxis_base` affects Frau
Kretzschmar's site directly and immediately. There is no child-theme layer
to absorb practice-specific tweaks. If a future change is needed that should
apply to *only* her site, a `birgit_child` child theme would need to be
scaffolded first (see Appendix A).

**Theme files (`praxis_base`):**

- `style.css` — theme header for WordPress detection only (not used for
  styling)
- `functions.php` — theme bootstrap: theme supports (title-tag, post-
  thumbnails, html5, custom-logo), menu registration (primary + footer),
  head cleanup, the compiled-CSS + JS enqueue, and a filter that disables
  the block editor for ACF-driven pages
- `header.php` — document chrome (`<html>`, `<head>`, `<body>`,
  `wp_head()`), Google Fonts preconnect + stylesheet link
- `footer.php` — closing chrome (`wp_footer()`), plus the back-to-top button
- `front-page.php` — the homepage template
- `index.php` — catch-all fallback template
- `page.php` — default template for standalone pages
- `page-ueber-mich.php` — slug-triggered template for the "Über mich" page
- `template-leistung.php` — template for individual therapy pages
- `template-leistungen-overview.php` — auto-listing overview of child pages
- `template-kontakt.php` — Kontakt page template
- `template-legal.php` — shared template for Impressum / Datenschutz
- `template-termine.php` — Termine (events) page template
- `template-parts/site-header.php` — sticky header, logo, primary nav,
  mobile hamburger menu and panel
- `template-parts/site-footer.php` — two-column footer (copyright + footer
  nav menu)
- `tailwind.css` — Tailwind 4 source: palette, typography, dropdown sub-menu
  styling, Contact Form 7 styling, back-to-top button styling
- `build/theme.css` — compiled Tailwind output (generated, enqueued)
- `assets/js/` — `mobile-nav.js`, `past-termine-toggle.js`, `back-to-top.js`

### 4.2 Pages

| Page                    | Slug                                  | Template               | Body content source       |
|-------------------------|---------------------------------------|------------------------|---------------------------|
| Startseite              | `/` (front page)                      | `front-page.php`       | ACF (Homepage group)      |
| Über mich               | `/ueber-mich/`                        | `page-ueber-mich.php`  | ACF (Über mich group)     |
| Leistungen (overview)   | `/leistungen/`                        | Leistungen Übersicht   | Auto-listed children + editor intro |
| Tanztherapie            | `/leistungen/tanztherapie/`           | Leistung               | ACF (Leistung group)      |
| Paartherapie            | `/leistungen/paartherapie/`           | Leistung               | ACF (Leistung group)      |
| Weiterbildungen         | `/leistungen/weiterbildungen/`        | Leistung               | ACF (Leistung group)      |
| Psychotraumatherapie    | `/leistungen/psychotraumatherapie/`   | Leistung               | ACF (Leistung group)      |
| Termine                 | `/termine/`                           | Termine                | ACF (Termine group)       |
| Kontakt                 | `/kontakt/`                           | Kontakt                | ACF (Kontakt group)       |
| Impressum               | `/impressum/`                         | Legal Page             | WordPress editor (HTML)   |
| Datenschutzerklärung    | `/datenschutzerklaerung/` (or similar) | Legal Page            | WordPress editor (HTML)   |

Frau Kretzschmar's seven primary pages (confirmed by her) are: Über mich,
Tanztherapie, Paartherapie, Weiterbildungen, Psychotraumatherapie, Termine,
Kontakt — plus the Leistungen overview page and the two legally-required
pages. A "Praxis" page that appeared in early scaffolding is not needed and
exists only as an unpublished draft pending deletion.

### 4.3 Front-page template (`front-page.php`)

The homepage is a straightforward, content-driven layout — not a multi-band
landing page. It reads ACF fields from the Homepage field group and renders,
in order:

**Hero.** Centred section on a cream background: a large display-serif
headline (`hero_headline`) and a subtitle line (`hero_subtitle`). No
background image — this is a clean, typographic hero.

**Galerie.** An optional three-column image grid (single column on mobile),
driven by the `home_galerie` repeater. Each entry is an image with an
optional caption shown beneath it. Three images are currently populated
(Therapieraum, Wartezimmer, and a further practice room).

**CTA strip.** An optional full-width navy strip with a single text link
(`cta_label`) pointing to the Kontakt page.

**Welcome text.** An optional intro-prose section (`welcome_text`) on a
cream panel, rendered as body copy.

Every section guards on its ACF field being present, so the template
degrades gracefully if a field is empty.

### 4.4 Individual therapy template (`template-leistung.php`)

Common template for all four Leistung pages (Tanztherapie, Paartherapie,
Weiterbildungen, Psychotraumatherapie). Renders, in order: a hero section
(title + tagline), an optional lead image, an intro (WYSIWYG), a repeating
set of content sections (heading + body, with optional images that alternate
left/right between rows), an optional pull-quote, and a CTA band at the
bottom linking to the Kontakt page.

### 4.5 Other templates

**`page-ueber-mich.php`** — the Über mich page. Renders a title + tagline
hero, a two-column portrait-plus-bio band, an optional Qualifikationen list
(from a repeater of Bezeichnung + Detail rows), an optional Werdegang prose
section, and a closing CTA band linking to Kontakt.

**`template-leistungen-overview.php`** ("Leistungen Übersicht") — the
Leistungen overview page. Renders the page title and the editor content as
an intro, then auto-lists all published child pages as cards, pulling each
child's title, `leistung_tagline`, and `leistung_lead_image` from its ACF
fields. Self-updating: adding a new child page adds it to the grid.

**`template-kontakt.php`** — the Kontakt page. Renders a title + tagline
hero, an optional lead image, an optional intro, a two-column
Adresse/Anfahrt block, and an optional Contact Form 7 form. The form
shortcode is held in an ACF field rather than hardcoded, so the form can be
changed or removed without editing the template.

**`template-termine.php`** — the Termine (events) page. Renders a title +
tagline hero, optional lead image, optional intro, then the events list.
Events come from the `termine_eintraege` repeater and are split
automatically into "Anstehende Termine" (upcoming) and a collapsible
"Vergangene Termine" disclosure (past), based on each entry's date. Each
event card shows group type, a German-formatted date, title, time,
location, and description. This page is the subject of its own dedicated
editing URS (the Birgit-Termine editor URS).

**`template-legal.php`** — shared template for Impressum and
Datenschutzerklärung. Prose-only: page title plus a single column of body
content rendered from the standard WordPress editor (`the_content()`), so
these pages can be edited without theme changes.

### 4.6 Data model (ACF field groups)

All field groups are defined as JSON in `praxis_base/acf-json/`.

| Group       | Bound to                          | Key fields                                              |
|-------------|-----------------------------------|---------------------------------------------------------|
| Homepage    | Front page                        | hero headline, hero subtitle, CTA label, welcome text, Galerie repeater (image + caption) |
| Über mich   | Über mich page                    | tagline, portrait, bio (WYSIWYG), Qualifikationen repeater (Bezeichnung + Detail), Werdegang (WYSIWYG) |
| Leistung    | `template-leistung.php` pages     | tagline, lead image, intro, Sections repeater (heading + body), image, quote, CTA text/link |
| Termine     | Termine page                      | tagline, lead image, intro, Einträge repeater (Datum, Titel, Uhrzeit, Ort, Beschreibung, Gruppentyp) |
| Kontakt     | Kontakt page                      | tagline, lead image, intro, Adresse, Anfahrt, Form Shortcode |

The Termine group's Einträge repeater is the data model that the
Birgit-Termine editor URS builds its editing tool around — the same
postmeta the public template renders from.

### 4.7 Design system

**Typography.** Cormorant Garamond (display serif, weights 400/500/600) for
headlines; Inter (sans-serif, weights 400/500) for body. Loaded from Google
Fonts via a stylesheet link in `header.php`.

**Colour.** The `praxis_base` palette, used unmodified: deep navy
(`navy-800` `#1B3A5C` as the primary brand colour), warm cream backgrounds
(`cream-50`/`cream-100`), and warm-neutral stone for body text. The theme
defines `--color-accent-*` tokens as aliases of the navy scale; on Frau
Kretzschmar's site these are left at their navy defaults (a child theme
would be where they'd be overridden, and she has none).

**Header.** Sticky at the top of the viewport, `cream-100` background with
a bottom border for contrast against the hero below. Circular logo (48px
tall) plus the uppercase wordmark "BIRGIT KRETZSCHMAR · PRAXIS FÜR
PSYCHOTHERAPIE" in Inter, with navy-800/navy-600 hierarchy. Logo and
wordmark together link to the homepage. Primary navigation is right-aligned
and horizontal on desktop, with dropdown sub-menus on hover; on mobile
(≤767px) the nav collapses to a hamburger button toggling a panel, with
sub-menu items shown inline and indented.

**Footer.** The parent theme's two-column footer: a copyright line with the
current year and site name on one side, the footer navigation menu on the
other. (This is the simpler parent footer — not the four-column ACF-driven
footer used on Dr. Kretzschmar's site.)

**Components.** A fixed back-to-top button appears bottom-right on scroll
(navy circle, repositioned closer to the edge on small screens). Contact
Form 7 fields are styled to match the design system (cream field
backgrounds, navy focus ring, uppercase navy submit button).

### 4.8 Forms

The Kontakt page renders a Contact Form 7 form (via a shortcode stored in
the Kontakt ACF group's "Form Shortcode" field) with name, email, message,
and a DSGVO consent checkbox linking to the Datenschutzerklärung. No other
forms exist on the site. No patient-facing forms exist beyond initial
contact — no booking, no payment, no intake.

### 4.9 Build pipeline

Tailwind 4 compiles `praxis_base/tailwind.css` → `praxis_base/build/theme.css`.
The compiled stylesheet is enqueued by `praxis_base/functions.php` on
`wp_enqueue_scripts`, with cache-busting via `filemtime()` on every rebuild.
Three small JavaScript files are enqueued in the footer: `mobile-nav.js`
(hamburger toggle, every page), `back-to-top.js` (every page), and
`past-termine-toggle.js` (Termine page only). During development the
Tailwind watcher must be running for source edits to propagate; note that
Tailwind 4 can silently fail to generate newly-introduced utility classes
until the watcher is restarted.

`style.css` carries only the WordPress theme header — it is not used for
styling.


[↑ Back to top](#table-of-contents)

---

## 5. Constraints we already know

Some things are decided by external factors and are not negotiable in this
URS:

- **No patient data on the website, ever.** The website is marketing and
  first contact, not a patient portal. Patient communication continues
  through your existing channels (phone, paper, in-person). This URS does
  not create any patient-data pathway.
- **DSGVO compliance.** All forms, fonts, analytics, and embedded resources
  must be documentable in the Datenschutzerklärung. Pre-launch tasks
  include self-hosting Google Fonts (currently loaded from Google's CDN)
  and removing any Google Maps embed reference from the Datenschutz text.
- **§ 5 TMG compliance.** The Impressum must contain the legally-required
  professional information for a Heilpraktikerin für Psychotherapie
  (Berufsbezeichnung, zuständige Aufsichtsbehörde, berufsrechtliche
  Regelungen, verantwortlich für den Inhalt). The current Impressum and
  Datenschutz pages hold demo placeholder content and require lawyer review
  before launch.
- **Mobile-first responsive design.** Increasing share of patient discovery
  happens on phones; the site must work on iPhone-size screens and tablet
  screens without compromise.
- **Sibling parity with Dr. Kretzschmar's site.** Both sites share design
  DNA via the `praxis_base` parent theme. Because Frau Kretzschmar's site
  *is* the parent theme directly, any change to `praxis_base` affects her
  site immediately — and must be considered against Dr. Kretzschmar's site
  too.


[↑ Back to top](#table-of-contents)

---

## 6. Out of scope (deliberately)

To keep this URS focused, the following are explicitly **out of scope**:

- **Self-service editing of the Termine page.** Covered by its own document,
  the Birgit-Termine editor URS.
- **Self-service editing of other pages.** If Frau Kretzschmar wants to edit
  other content herself without using WordPress's backend, that requires a
  separate URS specifying which content, on which device, with which auth
  flow. Question §11's editing assumption will determine whether such a URS
  is needed.
- **Patient booking, payment, or intake systems.** Out of scope per §5
  (DSGVO and patient-data constraints).
- **Multilingual content.** Site is German-only.
- **SEO optimisation as a service.** Basic on-page SEO (titles, meta
  descriptions, mobile-friendly, fast-loading, HTTPS) is included. Ongoing
  SEO work (link-building, content marketing) is not. The pre-launch
  redirect map for old URLs (see Appendix A) *is* in scope as a launch task.
- **Email marketing / newsletter system.** Not built.
- **Analytics tracking** beyond what Hostinger's hosting panel provides
  by default. No Google Analytics, no Facebook Pixel, no third-party
  tracking — partly DSGVO, partly the practice's stated preference for a
  non-cluttered presentation.
- **A `birgit_child` child theme.** Not built; not currently needed. Would
  only be scaffolded if a change is required that should apply to Frau
  Kretzschmar's site alone (see Appendix A).


[↑ Back to top](#table-of-contents)

---

## 7. Acceptance criteria (the test of "done")

The website will be accepted as delivered when, on the production domain
(`birgit-kretzschmar.de`):

1. All eleven pages listed in §4.2 render correctly on desktop, tablet, and
   mobile viewports
2. The primary navigation works on all viewport classes (hamburger menu and
   inline sub-menus functional on mobile, horizontal nav with hover
   dropdowns functional on desktop)
3. The homepage hero, Galerie grid, CTA strip, and welcome text all render
   from their ACF fields and degrade gracefully when a field is empty
4. The Termine page correctly splits events into upcoming and past, with the
   past-events disclosure collapsible
5. The Kontakt form sends a real email to Frau Kretzschmar's preferred email
   address, with the DSGVO consent checkbox required to submit
6. All footer links resolve to a valid page (no 404s)
7. Impressum content is legally complete per § 5 TMG (subject to lawyer
   review)
8. Datenschutzerklärung content reflects the actual technical reality of
   the site (cookies used, fonts loaded, forms processed) and has been
   lawyer-reviewed
9. The site loads over HTTPS with a valid certificate
10. The site does not appear in Google search results until Frau
    Kretzschmar explicitly approves go-live (protected by HTTP basic auth
    plus "discourage search engines" setting during the demo period)
11. Page load time on a residential broadband connection is under three
    seconds for the homepage
12. The unpublished "Praxis" draft page has been deleted

These criteria will be tested with Frau Kretzschmar before final go-live.


[↑ Back to top](#table-of-contents)

---

## 8. Timeline expectations

| Milestone                                       | Status                | Date / Target          |
|-------------------------------------------------|-----------------------|------------------------|
| Site build (Local development)                  | Complete              | Q1–Q2 2026             |
| Content population (demo/placeholder content)   | Complete              | 12 May 2026            |
| Reworked content + new photos from Frau Kretzschmar | Pending           | Before end May 2026    |
| URS retrospective drafted (this document)       | Complete              | 14 May 2026            |
| URS reviewed by Frau Kretzschmar                | Pending               | Before end May 2026    |
| URS finalised and signed off                    | Pending               | Within 1 week of review |
| Real Impressum + Datenschutz (lawyer-reviewed)  | Not started           | Before launch          |
| Strato → Hostinger migration                    | Not started           | June 2026              |
| Production domain provisioning + DNS            | Not started           | June 2026              |
| Go-live on `birgit-kretzschmar.de`              | Not started           | Before Kretzschmars return from vacation |


[↑ Back to top](#table-of-contents)

---

## 9. Sign-off

By signing below, both parties agree this URS accurately captures Frau
Kretzschmar's requirements for her practice website, and accurately
describes the website as built, as understood at the date of signature.
Any corrections to inferred requirements (§11) must be made in writing
before signature.

| Role                              | Name                                | Signature | Date |
|-----------------------------------|-------------------------------------|-----------|------|
| Client                            | Frau Birgit Kretzschmar             |           |      |
| Beriott GmbH (project owner)      | Dr. Henry Macartney                 |           |      |


[↑ Back to top](#table-of-contents)

---

## 10. Version history

| Version | Date         | Author | Notes                                            |
|---------|--------------|--------|--------------------------------------------------|
| Draft 1 | 14 May 2026  | Henry  | Retrospective URS reconstructed from delivered build; technical build specification integrated as §4 |


[↑ Back to top](#table-of-contents)

---

## 11. What was inferred vs documented

Because this URS is retrospective, the requirements below are split by
how confidently they reflect what Frau Kretzschmar actually asked for vs
what was inferred by Beriott from finished work. Frau Kretzschmar is asked
to confirm or correct each item before sign-off.

### Documented (captured during the project)

- The seven primary pages — Über mich, Tanztherapie, Paartherapie,
  Weiterbildungen, Psychotraumatherapie, Termine, Kontakt — confirmed by
  Frau Kretzschmar
- "Weiterbildungen" as the plural form of that page's title — explicitly
  confirmed by Frau Kretzschmar
- The four therapy areas as the practice's service portfolio —
  Tanztherapie, Paartherapie, Weiterbildungen, Psychotraumatherapie
- The sticky header and the `cream-100` header background for contrast —
  both specifically requested by Frau Kretzschmar, reviewed and approved
- The header logo (`logo3-1.jpg`) and the wordmark "BIRGIT KRETZSCHMAR ·
  PRAXIS FÜR PSYCHOTHERAPIE" — uploaded and approved
- Site Title "Birgit Kretzschmar" and tagline "Praxis für Psychotherapie" —
  set in WordPress settings
- The "non-cluttered" visual approach across all pages — Frau Kretzschmar
  specifically appreciated this
- That the "Praxis" page is not needed and should be deleted
- That Frau Kretzschmar will supply reworked text content and new
  photographs (from a recent trip) for the therapy pages

### Inferred (Beriott's design choice; needs confirmation)

- Running the site directly on `praxis_base` with no child theme — an
  architectural decision by Beriott on the grounds that no practice-
  specific overrides were needed. Verify this is acceptable to Frau
  Kretzschmar as a long-term arrangement.
- The homepage layout (typographic hero → Galerie grid → CTA strip →
  welcome text) — the parent theme's default structure, not a layout Frau
  Kretzschmar specified.
- The three homepage Galerie images currently shown (Therapieraum,
  Wartezimmer, further room) — placeholder selection; Frau Kretzschmar's
  reworked content may change these.
- The grouping of the four therapy pages under a `/leistungen/` overview
  page — a structural decision; the old site had them at top-level slugs.
- The CTA wording and the decision to point all CTAs at the Kontakt page
  (rather than, say, the Termine page) — Beriott's choice.
- The decision *not* to include an online booking system, newsletter, or
  language switcher — partly DSGVO-driven (§5), partly inferred from the
  practice's preference for a non-cluttered presentation.
- The contact-form field set (name, email, message) — minimal by design.
  Could be expanded if Frau Kretzschmar wants more triage information at
  first contact.
- The assumption that Frau Kretzschmar does not want to edit content other
  than Termine herself post-launch. The Termine editing need is already
  documented in its own URS; this assumption concerns *everything else*.
  If wrong, it triggers a further self-service-editing URS.


[↑ Back to top](#table-of-contents)

---

## Appendix A — Notes for the Beriott team (not for Frau Kretzschmar)

This appendix is for internal Beriott use; it does not need to be reviewed
by Frau Kretzschmar.

### Architectural notes

- **No child theme.** Frau Kretzschmar's site runs on `praxis_base`
  directly. This is the intentional asymmetry with Dr. Kretzschmar's site
  (`alex_child`). It is harmless as long as no Birgit-only overrides are
  needed. The moment one is — a different homepage layout, a different
  accent colour, a Birgit-specific template — a `birgit_child` child theme
  must be scaffolded first, and the relevant files moved into it. The
  `birgit_child` retrofit is a known, deferred, low-priority task.
- **Site location.** Birgit's Local by Flywheel site lives *inside* the
  repo at `sites/birgit/` (a real directory, not a symlink). This is the
  intentional asymmetry with Alex's setup. Both sites work; the asymmetry
  is harmless.
- **ACF JSON groups** live in `praxis_base/acf-json/`. Because there is no
  child theme, there is no second `acf-json/` path to load — the parent's
  is the only one.
- **Build pipeline.** Tailwind 4 source at `praxis_base/tailwind.css`,
  compiled to `praxis_base/build/theme.css`, enqueued via
  `wp_enqueue_scripts` in `praxis_base/functions.php`. Note the `@source`
  globs in `tailwind.css` scan both the theme directory and three levels up
  — relevant if the directory layout changes.

### Known structural notes

- The Leistungen overview page uses `template-leistungen-overview.php`,
  which auto-lists published child pages. Adding or removing a therapy page
  updates the grid automatically.
- Birgit's old site slugs were inconsistent; slugs were corrected when the
  new pages were created. The therapy pages moved from old top-level slugs
  (`/tanztherapie/` etc.) to `/leistungen/tanztherapie/` etc. The pre-launch
  redirect map must handle the old → new slug changes, plus the old
  `?page_id=X` URLs.
- During the sticky-header work, Tailwind 4 silently failed to generate the
  `sticky` and `top-0` utilities until the watcher was restarted. Lesson:
  restart `npm run dev` whenever new utility classes are introduced in the
  source.

### Outstanding work flagged in the project handoff

- **Real Impressum and Datenschutz** — current pages hold demo placeholder
  content. The old-site versions can be reused (minus any Google Maps embed
  paragraph) but require lawyer review before launch.
- **Delete the "Praxis" draft page** — exists as an unpublished draft, not
  in any menu, no longer needed.
- **Self-host Google Fonts** (Cormorant Garamond, Inter) for DSGVO
  compliance — currently loaded from `fonts.googleapis.com` via `header.php`.
- **Tailwind `md:hidden` scan-path issue** — the hamburger button's
  desktop-hide relies on explicit CSS rather than a generated Tailwind
  utility. Root cause (likely an `@source` scan-path config issue) not yet
  investigated.
- **SEO redirect map** — not yet created; old `?page_id=X` and old
  top-level therapy slugs need to redirect to the new clean URLs.
- **Strato → Hostinger migration** — included as unbilled goodwill; not yet
  executed. Production hosting is Hostinger Premium.
- **Receive Frau Kretzschmar's reworked content and new photographs** —
  required before final content population.

### Follow-up URS documents

The Birgit-Termine editor URS already exists and specifies self-service
editing of the Termine page.

If Frau Kretzschmar later asks to edit other content herself (see the
editing assumption in §11), a further URS would be required, specifying
what, how, on which device, with which auth. The Birgit-Termine URS is the
template for that.

### Inferred-requirements integrity check

§11 is the most important section of this document. A retrospective URS
that does not honestly distinguish documented from inferred requirements is
worse than no URS at all — it manufactures a fictitious paper trail. The
content of §11 has been kept conservative: where any doubt existed about
whether something was Frau Kretzschmar's stated preference or Beriott's
design judgement, the item was filed as inferred.

---

*End of URS retrospective draft v1.*

[↑ Back to top](#table-of-contents)