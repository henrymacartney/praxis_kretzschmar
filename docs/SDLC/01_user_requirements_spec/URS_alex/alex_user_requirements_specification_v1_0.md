# User Requirements Specification — Dr. Alexander Kretzschmar's Practice Website 

**Document version:** Retrospective draft, 13 May 2026  
**Author:** Dr. Henry Macartney (Beriott GmbH)  
**Project:** Praxis Kretzschmar website build  
**Scope:** Public-facing practice website for Dr. Alexander Kretzschmar's
psychotherapy practice in Wiesbaden  
**Status:** Retrospective. Built first, documented after. To be reviewed with
Herr Dr. Kretzschmar before sign-off.

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
  - [4.4 Individual therapy template (`template-leistung.php`, inherited)](#44-individual-therapy-template-template-leistungphp-inherited)
  - [4.5 Data model (ACF field groups)](#45-data-model-acf-field-groups)
  - [4.6 Design system](#46-design-system)
  - [4.7 Forms](#47-forms)
  - [4.8 Build pipeline](#48-build-pipeline)
- [5. Constraints we already know](#5-constraints-we-already-know)
- [6. Out of scope (deliberately)](#6-out-of-scope-deliberately)
- [7. Acceptance criteria (the test of "done")](#7-acceptance-criteria-the-test-of-done)
- [8. Timeline expectations](#8-timeline-expectations)
- [9. Sign-off](#9-sign-off)
- [10. Version history](#10-version-history)
- [11. What was inferred vs documented](#11-what-was-inferred-vs-documented)
  - [Documented (captured during the project)](#documented-captured-during-the-project)
  - [Inferred (Beriott's design choice; needs confirmation)](#inferred-beriotts-design-choice-needs-confirmation)
- [Appendix A — Notes for the Beriott team (not for Dr. Kretzschmar)](#appendix-a-notes-for-the-beriott-team-not-for-dr-kretzschmar)
  - [Architectural notes](#architectural-notes)
  - [Known structural notes](#known-structural-notes)
  - [Outstanding work flagged in the project handoff](#outstanding-work-flagged-in-the-project-handoff)
  - [Likely follow-up URS documents](#likely-follow-up-urs-documents)
  - [Inferred-requirements integrity check](#inferred-requirements-integrity-check)

---

## 1. Purpose of this document

This is a User Requirements Specification (URS). Its purpose is to capture
what Dr. Kretzschmar needs his public practice website to do for his patients
and his practice.

A URS reviewed and signed off by the client is the contract for what
"done" means.

**This URS is retrospective.** The website was built by Beriott during
Q1–Q2 2026, with requirements established informally through conversation
and design iteration rather than a written document. This URS reconstructs
those requirements from the delivered build so they can be reviewed,
challenged, and signed off as a formal record.

Because it is retrospective, parts of this document are necessarily inferred
from the finished work rather than captured from Dr. Kretzschmar in advance.
Section 11 lists exactly which requirements are inferred and which are
documented, so Dr. Kretzschmar can correct anything that does not match what
he actually wanted.

**This URS covers only the public-facing website.** Self-service editing
tools (e.g. an admin panel for Dr. Kretzschmar to update content himself
without using WordPress's backend) are out of scope here and will be
specified in separate URS documents if and when they are agreed.

This document also incorporates the full technical build specification of
the delivered `alex_child` WordPress theme (§4), so that it serves both as
the client's requirements record and as the maintenance reference for
whoever works on the site after delivery.


[↑ Back to top](#table-of-contents)

---

## 2. Background

Dr. Alexander Kretzschmar runs a psychotherapy practice at Nußbaumstraße 5,
65187 Wiesbaden, offering Kassen- and Privatpraxis services. His existing
website was technically dated and visually inconsistent with how he wanted
his practice represented.

Beriott was engaged to deliver a new website alongside the parallel rebuild
of his sister-in-law Frau Birgit Kretzschmar's site. Both sites share a
common design system (the `praxis_base` parent theme) so they read as
sibling practices, with practice-specific branding applied per site through
WordPress child themes.

Dr. Kretzschmar's practice-specific identity is anchored by:

- A circular wordmark logo using a warm-red outer ring (`#AB2815`) and warm-
  orange inner core (`#FB944B`)
- A consultation-room photograph (two figures, mid-century chairs) used as
  the full-bleed hero motif

These elements drove the warm-red accent palette and the full-width
landing-page hero treatment that distinguish his site from Birgit's.
Dr. Kretzschmar's site is produced by the `alex_child` child theme, which
applies these while inheriting body typography, base colours, and most
templates from `praxis_base`.


[↑ Back to top](#table-of-contents)

---

## 3. Document structure

The document is split into three audiences:

§1–§3 — Framing for Dr. Kretzschmar: what a URS is, why we're doing one,
and how the document is organised
§4 — The technical build specification: architecture, pages, templates,
data model, design system, build pipeline. This is the detailed
engineering record of what was built, and doubles as the maintenance
reference.
§5–§10 — The contract bits: constraints, out-of-scope, acceptance criteria,
timeline, sign-off
§11 — Explicit list of what was inferred (so Dr. Kretzschmar can correct it)
Appendix A — Internal Beriott notes that Dr. Kretzschmar doesn't need to
read but Henry and future maintainers will

### Design choices worth noting

- The build specification in §4 is taken directly from the live templates,
  theme files, and ACF field groups. Anchoring the document in the actual
  build keeps the conversation concrete.
- The questionnaire in §4's companion role — the questions for Dr.
  Kretzschmar — is shorter than the Birgit-Termine URS questionnaire because
  most decisions are already implemented and visible; the questions focus on
  whether those decisions were correct, not what they should be.
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
`alex_child` WordPress theme. It is the detailed technical record and the
maintenance reference.

### 4.1 Theme architecture

The website is a WordPress site running two themes in a parent/child
relationship:

| Theme         | Role   | Location                                  |
|---------------|--------|-------------------------------------------|
| `praxis_base` | Parent | Shared design system, base templates, ACF field groups |
| `alex_child`  | Child  | Practice-specific branding + bespoke front page |

`alex_child` is the active theme. WordPress's `get_template_part()` and
template-loading hierarchy resolve child files first, falling back to the
parent. This means `alex_child` only needs to ship the files it changes;
everything else is inherited.

**What `alex_child` overrides or adds:**

- `style.css` — theme header for WordPress detection only (not used for
  styling; declares `Template: praxis_base`)
- `functions.php` — child bootstrap: enqueues compiled CSS, registers the
  Footer ACF Options Page, adds the parent's `acf-json/` to ACF's load paths
- `front-page.php` — the bespoke five-band homepage layout
- `template-parts/site-footer.php` — four-column footer (overrides the
  parent's simpler footer)
- `tailwind.css` — Tailwind 4 source: warm-red accent token overrides,
  warm-orange secondary scale, hero-background responsive rules, hamburger
  visibility rules
- `build/theme.css` — compiled Tailwind output (generated, enqueued)
- `assets/images/` — hero image variants, logo
- `assets/icons/` — inline-SVG icons for the Leistungen grid cards
- `screenshot.png` — theme thumbnail for the WordPress Themes panel

**What `alex_child` inherits from `praxis_base`:**

- `header.php` — document chrome (`<html>`, `<head>`, `<body>`,
  `wp_head()`), Google Fonts preconnect + stylesheet link
- `template-parts/site-header.php` — sticky header, logo, primary nav,
  mobile hamburger menu and panel
- `footer.php`, `index.php`, `page.php`, and other base templates
- `template-leistung.php` — the individual therapy-page template
- `template-leistungen-overview.php` — the Leistungen overview template
- `template-legal.php` — the Impressum / Datenschutz template
- All ACF JSON field groups in `praxis_base/acf-json/`
- Theme support, menu registration, head cleanup, the Gutenberg-on-
  Startseite filter, and the parent CSS/JS enqueue

### 4.2 Pages

| Page                  | Slug                              | Template               | Body content source       |
|-----------------------|-----------------------------------|------------------------|---------------------------|
| Startseite            | `/` (front page)                  | `front-page.php`       | ACF (Homepage group)      |
| Über mich             | `/ueber-mich/`                    | default               | ACF (Über mich group)     |
| Leistungen (overview) | `/leistungen/`                    | Leistungen Overview    | Auto-listed children      |
| Tiefenpsychologie     | `/leistungen/tiefenpsychologie/`  | Leistung               | ACF (Leistung group)      |
| Gestalttherapie       | `/leistungen/gestalttherapie/`    | Leistung               | ACF (Leistung group)      |
| Psychoonkologie       | `/leistungen/psychoonkologie/`    | Leistung               | ACF (Leistung group)      |
| Hypnotherapie         | `/leistungen/hypnotherapie/`      | Leistung               | ACF (Leistung group)      |
| Coaching              | `/leistungen/coaching/`           | Leistung               | ACF (Leistung group)      |
| Praxis                | `/leistungen/praxis/`             | Leistung               | ACF (Leistung group)      |
| Kontakt               | `/kontakt/`                       | default                | ACF (Kontakt group)       |
| Impressum             | `/impressum/`                     | Legal Page             | WordPress editor (HTML)   |
| Datenschutz           | `/datenschutz/` (or similar slug) | Legal Page             | WordPress editor (HTML)   |

### 4.3 Front-page template (`front-page.php`)

A five-band landing page, content-driven entirely by ACF fields read from
the Homepage field group. Every band guards on ACF field presence, so the
template degrades gracefully if a field is empty.

**Band 1 — Hero.** Full-bleed section, navy background. A grayscale
background photograph (consultation room, two seated figures) is set as an
inline-style `background-image` on an absolutely-positioned div, with
`filter: grayscale(100%) brightness(0.55)` and a navy gradient veil over it
for text legibility. Centred headline, subheadline, two CTA buttons (primary
warm-red, secondary outlined).

**Band 2 — Leistungen grid.** Six-card grid. Each card: an inline-SVG icon
(resolved by name from `assets/icons/`, whitelisted against path traversal),
title, two-line summary, "Mehr erfahren →" link to the corresponding
therapy page. Cards have a warm-red top border.

**Band 3 — Über mich.** Two-column text-plus-portrait band. The portrait
has decorative corner accents — a warm-red square top-left, a navy square
bottom-right (both hidden on mobile).

**Band 4 — Kontakt CTA.** Full-width warm-red accent panel. Heading,
sub-text, two CTAs (cream-coloured primary, outlined secondary).

**Footer** is rendered separately via `get_footer()`.

### 4.4 Individual therapy template (`template-leistung.php`, inherited)

Common template for all six Leistung pages. Renders, in order: a hero
section (title + tagline), an optional lead image, an intro (WYSIWYG), a
repeating set of content sections (heading + body, with optional images
that alternate left/right), an optional pull-quote, and a CTA band.

### 4.5 Data model (ACF field groups)

All field groups are defined as JSON in `praxis_base/acf-json/` and loaded
by both themes (`alex_child/functions.php` adds the parent path to ACF's
load paths).

| Group       | Bound to                          | Key fields                                              |
|-------------|-----------------------------------|---------------------------------------------------------|
| Homepage    | Front page                        | hero headline/subtitle, CTA labels, welcome text, gallery repeater; plus the front-page band fields |
| Über mich   | Über mich page                    | tagline, portrait, bio (WYSIWYG), Qualifikationen repeater, Werdegang (WYSIWYG) |
| Leistung    | `template-leistung.php` pages     | tagline, lead image, intro, Sections repeater, image, quote, CTA text/link |
| Termine     | Termine page (Birgit's site)      | tagline, lead image, intro, Einträge repeater (Datum, Titel, Uhrzeit, Ort, Beschreibung, Gruppentyp) |
| Kontakt     | Kontakt page                      | tagline, lead image, intro, Adresse, Anfahrt, Form Shortcode |

The Footer content is managed separately via an ACF Options Page
("Footer-Einstellungen"), registered in `alex_child/functions.php`. The
footer template-part reads `footer_about`, `footer_schnelllinks`,
`footer_leistungen`, `footer_kontakt_*`, and `footer_socials` from the
`'option'` store.

### 4.6 Design system

**Typography.** Cormorant Garamond (display serif, weights 400/500/600) for
headlines; Inter (sans-serif, weights 400/500) for body. Loaded from Google
Fonts via a stylesheet link in the inherited `header.php`.

**Colour.** Navy + cream + stone scales inherited from `praxis_base`. The
child theme overrides the four `--color-accent-*` tokens with a warm-red
scale (base `#AB2815`, the logo's outer ring) and adds a separate
`--color-warm-*` scale (base `#FB944B`, the logo's inner core) used for
icon-square backgrounds and soft highlights.

**Header.** Sticky, cream background, bottom border. Circular logo plus
wordmark "DR. ALEXANDER KRETZSCHMAR · PRAXIS FÜR PSYCHOTHERAPIE". Primary
navigation right-aligned, horizontal on desktop. On mobile (≤768px), the
nav collapses to a hamburger button toggling an absolutely-positioned panel.

**Hero responsive behaviour.** Three background-image variants:
- Desktop (≥1025px): landscape image, set inline from ACF, with
  `background-attachment: fixed` parallax
- Tablet (769–1024px): portrait variant (`consultation_tablet_bw_web.jpg`),
  swapped in via a `tailwind.css` media query
- Mobile (≤768px): portrait single-figure variant
  (`consultation_mobile_bw_web.jpg`), swapped in via a `tailwind.css`
  media query; parallax disabled (`background-attachment: scroll`)

Parallax is also disabled for users with `prefers-reduced-motion: reduce`.

### 4.7 Forms

The Kontakt page renders a Contact Form 7 form (via a shortcode stored in
the Kontakt ACF group's "Form Shortcode" field) with name, email, message,
and a DSGVO consent checkbox linking to the Datenschutzerklärung. No other
forms exist on the site. No patient-facing forms exist beyond initial
contact — no booking, no payment, no intake.

### 4.8 Build pipeline

Tailwind 4 compiles `alex_child/tailwind.css` → `alex_child/build/theme.css`.
The compiled stylesheet is enqueued by `alex_child/functions.php` on
`wp_enqueue_scripts` at priority 20 (after the parent's enqueue at default
priority 10), so child token overrides win where they clash. Cache-busting
is via `filemtime()` on every rebuild. During development the Tailwind
watcher (`tailwindcss -i ./tailwind.css -o ./build/theme.css --watch`) must
be running for source edits to propagate.

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
  and removing the Google Maps embed reference from the Datenschutz text.
- **§ 5 TMG compliance.** The Impressum must contain the legally-required
  professional information for a Psychologischer Psychotherapeut
  (Berufsbezeichnung, zuständige Kammer, berufsrechtliche Regelungen, USt-
  IdNr. or befreiungs-clause, verantwortlich für den Inhalt).
- **Mobile-first responsive design.** Increasing share of patient discovery
  happens on phones; the site must work on iPhone-size screens and tablet
  screens without compromise.
- **Sibling parity with Birgit's site.** Both sites share design DNA via
  the `praxis_base` parent theme. Major design changes to one require
  consideration of the other.


[↑ Back to top](#table-of-contents)

---

## 6. Out of scope (deliberately)

To keep this URS focused, the following are explicitly **out of scope**:

- **Self-service content editing tools.** If Dr. Kretzschmar wants to edit
  the website himself without using WordPress's backend (analogous to the
  Birgit-Termine editor URS), this requires a separate URS specifying which
  content, on which device, with which auth flow. Question §4.6 will
  determine whether such a URS is needed.
- **Patient booking, payment, or intake systems.** Out of scope per §5
  (DSGVO and patient-data constraints).
- **Multilingual content.** Site is German-only. Question §4.7 may
  re-open this.
- **SEO optimisation as a service.** Basic on-page SEO (titles, meta
  descriptions, mobile-friendly, fast-loading, HTTPS) is included. Ongoing
  SEO work (link-building, content marketing) is not.
- **Email marketing / newsletter system.** Not built. Question §4.7 may
  re-open this.
- **Analytics tracking** beyond what Hostinger's hosting panel provides
  by default. No Google Analytics, no Facebook Pixel, no third-party
  tracking — partly DSGVO, partly Dr. Kretzschmar's stated preference for
  understatement.


[↑ Back to top](#table-of-contents)

---

## 7. Acceptance criteria (the test of "done")

The website will be accepted as delivered when, on the production domain
(`kretzschmar-wiesbaden.de` or the agreed final domain):

1. All twelve pages listed in §4.2 render correctly on desktop (≥1025px),
   tablet (769–1024px), and mobile (≤768px) viewports
2. The primary navigation works on all three viewport classes (hamburger
   menu functional on mobile, horizontal nav functional on desktop)
3. The three hero-image variants each load at their correct breakpoint
4. The Kontakt form sends a real email to Dr. Kretzschmar's preferred
   email address, with the DSGVO consent checkbox required to submit
5. All footer links resolve to a valid page (no 404s)
6. Impressum content is legally complete per § 5 TMG (subject to Dr.
   Kretzschmar's review of Berufsbezeichnung, zuständige Behörde, USt-IdNr.
   status)
7. Datenschutzerklärung content reflects the actual technical reality of
   the site (cookies used, fonts loaded, forms processed)
8. The site loads over HTTPS with a valid certificate
9. The site does not appear in Google search results until Dr. Kretzschmar
   explicitly approves go-live (currently protected by HTTP basic auth
   plus "discourage search engines" setting during demo period)
10. Page load time on a residential broadband connection is under three
    seconds for the homepage
11. The Tailwind build produces a `build/theme.css` that contains the
    expected accent tokens and hero media queries

These criteria will be tested with Dr. Kretzschmar before final go-live.


[↑ Back to top](#table-of-contents)

---

## 8. Timeline expectations

| Milestone                                       | Status                | Date / Target          |
|-------------------------------------------------|-----------------------|------------------------|
| Site build (Local development)                  | Complete              | Q1–Q2 2026             |
| Content population (German copy, images)        | Complete              | 12 May 2026            |
| Migration to Hostinger temp domain (demo)       | Complete              | 13 May 2026            |
| URS retrospective drafted (this document)       | Complete              | 13 May 2026            |
| URS reviewed by Dr. Kretzschmar                 | Pending               | Before end May 2026    |
| URS finalised and signed off                    | Pending               | Within 1 week of review |
| Production domain provisioning + DNS            | Not started           | June 2026              |
| Go-live on `kretzschmar-wiesbaden.de`           | Not started           | Before Kretzschmars return from vacation |


[↑ Back to top](#table-of-contents)

---

## 9. Sign-off

By signing below, both parties agree this URS accurately captures Dr.
Kretzschmar's requirements for his practice website, and accurately
describes the website as built, as understood at the date of signature.
Any corrections to inferred requirements (§11) must be made in writing
before signature.

| Role                              | Name                                | Signature | Date |
|-----------------------------------|-------------------------------------|-----------|------|
| Client                            | Dr. Alexander Kretzschmar      |           |      |
| Beriott GmbH (project owner)      | Dr. Henry Macartney                 |           |      |


[↑ Back to top](#table-of-contents)

---

## 10. Version history

| Version | Date         | Author | Notes                                            |
|---------|--------------|--------|--------------------------------------------------|
| Draft 1 | 13 May 2026  | Henry  | Retrospective URS reconstructed from delivered build; technical build specification integrated as §4 |


[↑ Back to top](#table-of-contents)

---

## 11. What was inferred vs documented

Because this URS is retrospective, the requirements below are split by
how confidently they reflect what Dr. Kretzschmar actually asked for vs
what was inferred by Beriott from finished work. Dr. Kretzschmar is asked
to confirm or correct each item before sign-off.

### Documented (captured during the project)

- Use of warm-red + warm-orange logo colours as the brand accent palette
  — derived directly from the logo Dr. Kretzschmar supplied
- The six therapy areas as the practice's service portfolio —
  Tiefenpsychologie, Gestalttherapie, Psychoonkologie, Hypnotherapie,
  Coaching, Praxis
- Practice address (Nußbaumstraße 5, 65187 Wiesbaden), phone (0611 846840),
  email (`dr.kretzschmar-wiesbaden@t-online.de`)
- The footer copy "Praxis für Psychotherapie. Tiefenpsychologisch fundierte
  Verfahren, Hypnotherapie, Psychoonkologie und Coaching. Wiesbaden,
  Nußbaumstraße 5."
- Bio text and Werdegang content on Über mich — supplied or approved by Dr.
  Kretzschmar
- Re-use of his existing site's Datenschutzerklärung text (minus the Google
  Maps paragraph)

### Inferred (Beriott's design choice; needs confirmation)

- The full-bleed grayscale consultation photo as the homepage hero —
  Beriott's choice, not specified by Dr. Kretzschmar.
- The five-band homepage structure (Hero → Leistungen grid → Über mich →
  Kontakt CTA → Footer) — design choice.
- The wording of CTAs ("Kontakt aufnehmen", "Mehr über mich", "Anfahrt") —
  Beriott's choice.
- The decision to have a full Leistungen overview page in addition to the
  six individual therapy pages — added 13 May 2026 to fix an empty page
  bug; structure is "auto-list the six children", not bespoke content.
- The decision *not* to include an online booking system, newsletter, or
  language switcher — partly DSGVO-driven (§5), partly inferred from Dr.
  Kretzschmar's preference for understatement.
- The contact-form field set (name, email, message) — minimal by design.
  Could be expanded if Dr. Kretzschmar wants more triage information at
  first contact.
- Three responsive hero-image variants (desktop landscape, tablet portrait,
  mobile portrait single-figure) — Beriott engineering decision to keep
  the hero motif legible across viewports; not specified by Dr.
  Kretzschmar.
- The assumption that Dr. Kretzschmar does not want to edit content
  himself post-launch. This is the single most important assumption to
  validate, because if wrong it triggers a separate URS for a self-
  service editor.


[↑ Back to top](#table-of-contents)

---

## Appendix A — Notes for the Beriott team (not for Dr. Kretzschmar)

This appendix is for internal Beriott use; it does not need to be reviewed
by Dr. Kretzschmar.

### Architectural notes

- **Parent + child theme split.** `praxis_base` is the shared parent; both
  Kretzschmar sites inherit from it. `alex_child` adds: warm-red accent
  token override, warm-orange secondary accent scale, custom `front-page.php`
  five-band layout, four-column `template-parts/site-footer.php` override,
  and a Footer Options Page registration. Everything else is inherited.
  (Full detail in §4.1.)
- **ACF JSON groups** live in `praxis_base/acf-json/` and are loaded by the
  child via an `acf/settings/load_json` filter in `alex_child/functions.php`.
  No child-specific field groups exist as of 13 May 2026.
- **Build pipeline.** Tailwind 4 source at `alex_child/tailwind.css`,
  compiled to `alex_child/build/theme.css`, enqueued via `wp_enqueue_scripts`
  in `alex_child/functions.php` at priority 20 (after the parent).

### Known structural notes

- The Leistungen overview page uses `template-leistungen-overview.php`,
  which auto-lists the six child Leistung pages. It has no bespoke ACF
  content of its own. It was assigned to the page on 13 May 2026 to fix an
  empty-page bug.
- Both themes are symlinked into the Local site's `wp-content/themes/` from
  the shared repo at `shared/themes/`. AIO WP Migration was used to deploy;
  the migration resolved the symlinks into real files on Hostinger, so each
  production site now carries its own independent copy of `praxis_base`.
  Future parent-theme changes must be deployed to both sites separately.
- The hero `background-image` is set as an inline style from PHP, so the
  responsive variant swaps in `tailwind.css` require `!important` to
  override it. The URLs use a `../` prefix to resolve correctly from
  `build/theme.css`.

### Outstanding work flagged in the project handoff

- **Self-host Google Fonts** (Cormorant Garamond, Inter) for DSGVO
  compliance — currently loaded from `fonts.googleapis.com` via the
  inherited `header.php`. The Google Webfonts paragraph in the
  Datenschutzerklärung cannot be removed until this is done.
- **Tailwind `md:hidden` scan-path issue** — the hamburger button's
  desktop-hide is handled by an explicit media query in `tailwind.css`
  rather than via a Tailwind utility class, because the utility wasn't
  being generated. Root cause (likely an `@source` scan-path issue) not
  yet investigated.
- **Image audit** — hero variants are well-optimised (~180–250 KB each);
  other media-library uploads not yet audited.
- **No caching plugin, no security plugin.** Hostinger's built-in
  protections plus HTTP basic auth cover the demo period. Production needs
  a decision.
- **SEO redirect map** for old `?page_id=X` URLs if the previous site was
  indexed.

### Likely follow-up URS documents

If Dr. Kretzschmar answers §4.6 with "yes, I want to edit content myself",
a separate URS is required to specify what, how, on which device, with
which auth. The Birgit-Termine URS is the template.

If Dr. Kretzschmar answers §4.7 with "yes, I want online booking",
that is a major scope expansion that needs its own URS and a separate
discussion of DSGVO implications (booking systems necessarily handle
identifiable patient data, even if minimal).

### Inferred-requirements integrity check

§11 is the most important section of this document. A retrospective URS
that does not honestly distinguish documented from inferred requirements is
worse than no URS at all — it manufactures a fictitious paper trail. The
content of §11 has been kept conservative: where any doubt existed about
whether something was Dr. Kretzschmar's stated preference or Beriott's
design judgement, the item was filed as inferred.

---

*End of URS retrospective draft v1.*

[↑ Back to top](#table-of-contents)