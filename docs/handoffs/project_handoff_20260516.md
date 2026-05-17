# Praxis Kretzschmar — Project Handoff  

**Author:** Dr. Henry Macartney  
**Document version:** Thursday, 14 May 2026 (end of demo-migration + Birgit content-revision session)  
**Project:** Kretzschmar psychotherapy practice websites  
**Repository:** github.com/henrymacartney/praxis_kretzschmar  
**Local development:** birgit-kretzschmar.local (Local by Flywheel)

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Tech Stack](#2-tech-stack)
3. [Project Structure](#3-project-structure)
4. [What's Been Accomplished](#4-whats-been-accomplished)
5. [Key Decisions Made](#5-key-decisions-made)
6. [Credentials & Access Details](#6-credentials--access-details)
7. [Project Rules (CLAUDE.md)](#7-project-rules-claudemd)
8. [Current State (As of 14 May 2026, end of demo-migration + Birgit content-revision)](#8-current-state-as-of-14-may-2026-end-of-demo-migration--birgit-content-revision)
9. [Where Work Paused](#9-where-work-paused)
10. [What's Next (Priority Order)](#10-whats-next-priority-order)
11. [Open Questions / Decisions Pending](#11-open-questions--decisions-pending)
12. [Meeting with Kretzschmars — 6 May 2026](#12-meeting-with-kretzschmars--6-may-2026)
13. [How to Resume Work](#13-how-to-resume-work)
14. [Contact](#14-contact)

---

## 1. Project Overview

### What this project is

A WordPress build for two related psychotherapy practices in Wiesbaden:

- **Frau Birgit Kretzschmar** — Heilpraktikerin für Psychotherapie.
  Körperzentrierte Psychotherapie, Tanztherapie, Paartherapie, Weiterbildungen,
  Psychotraumatherapie. Privatpraxis.
- **Herr Dr. Alexander Kretzschmar** — Psychologischer Psychotherapeut mit
  Kassenzulassung. Tiefenpsychologisch fundierte Psychotherapie, Hypnotherapie,
  Psychoonkologie, Coaching, Gestalttherapie. Kassen- und Privatpraxis.

Both share physical premises in Wiesbaden but operate as separate practices with
separate websites and separate domains.

### Strategy

- **Two separate WordPress sites**, sharing a parent theme (`praxis_base`)
- **Each site has a child theme** for practice-specific overrides
  (Alex's child theme `alex_child` scaffolded 8 May 2026; Birgit's
  site currently runs on the parent theme directly — `birgit_child`
  to be retrofitted when needed)
- **Both old domains preserved** for SEO continuity and patient memory:
  - `birgit-kretzschmar.de` (Birgit)
  - `kretzschmar-wiesbaden.de` (Alex)
- **Email infrastructure separate from websites** — Outlook/365 +
  Kassenärztliches/KV-SafeNet for Alex's Kassenpraxis correspondence

### Commercial structure

Formal proposal sent and **accepted** (proposal document at
`docs/angebot_praxen_kretzschmar.docx`):

- **Total:** €1.500 fixed price (Kretzschmars described this as "very generous")
- **Duration:** 18 working days
- **Strato → Hostinger migration:** included as Goodwill (unbilled)
- **Methodology:** GAMP-5-inspired SDLC documentation (URS, RA, FRS, Test Plan,
  RTM)
- **Hosting:** Hostinger Premium (~€3-4/month each, paid by clients directly)
- **License:** ACF Pro Freelancer license (paid by Henry, charged through)
- **Post-URS hourly rate for changes:** €105/hour (agreed with Kretzschmars 6
  May 2026)

Seven work packages defined in the proposal. Currently executing through them.

### Engagement expansion (added 7 May 2026)

Following the demo on 6 May 2026, the Kretzschmars have asked Beriott GmbH to
take over **the whole of their IT support** going forward. This is a separate
engagement from the website project, will be handled by other Beriott employees,
and a proposal will be sent in the coming week. Mentioned here only for
project-record completeness; commercial details are out of scope for this
document.

[↑ Back to top](#table-of-contents)

---

## 2. Tech Stack

| Layer                           | Choice                                             | Notes                                                                                                   |
|---------------------------------|----------------------------------------------------|---------------------------------------------------------------------------------------------------------|
| CMS                             | WordPress 6.9.4                                    | Latest stable                                                                                           |
| PHP                             | 8.3.30                                             | Both Local sites verified 8 May 2026                                                                    |
| Database                        | MySQL 8.0.35, charset utf8mb4                      | Local default                                                                                           |
| CSS                             | Tailwind 4                                         | Custom design tokens via `@theme` block; build pipeline via npm                                         |
| Custom fields                   | ACF Pro 6.5+                                       | Note: UI changed significantly from older versions                                                      |
| ACF Local JSON                  | `acf-json/` folder in theme root                   | Auto-saves field group changes; auto-loads on activation                                                |
| Build tool                      | npm + Tailwind CLI                                 | `npm run dev` watches and rebuilds on save. Worth restarting if utility classes silently fail to apply. |
| Local dev                       | Local by Flywheel                                  | Birgit at `http://birgitkretzschmar.local/`, Alex at `http://alexkretzschmar.local/`                    |
| Version control                 | git + GitHub                                       | Linear history on `main` branch                                                                         |
| Contact form                    | Contact Form 7 (CF7)                               | German labels, DSGVO consent checkbox, basic styling matching design system                             |
| Production deployment (planned) | Hostinger Premium + All-in-One WP Migration plugin | Not yet executed                                                                                        |

[↑ Back to top](#table-of-contents)

---

## 3. Project Structure

```
praxis_kretzschmar/                                    ← project root
├── .git/                                               ← single repo
├── .gitignore                                          ← excludes build/, node_modules/, sites/, *.zip
├── CLAUDE.md                                           ← project rules (committed)
├── docs/
│   ├── angebot_praxen_kretzschmar.docx                ← formal proposal (accepted)
│   ├── content-inventory/                              ← content extracted from old sites
│   │   ├── birgit_text_content.md
│   │   ├── birgit_image_inventory.md
│   │   ├── birgit_content_map.md
│   │   ├── alex_text_content.md
│   │   ├── alex_image_inventory.md
│   │   └── alex_content_map.md
│   ├── handoffs/                                       ← project handoff artefacts
│   │   ├── project_handoff.md                          ← this document
│   │   └── previous_chat.md                            ← conversation log from Step 10 session
│   └── screenshots_birgit/                             ← demo screenshots sent to Birgit 6 May 2026
│       ├── 0_startseite.png
│       ├── 1_ueber_mich.png
│       ├── 2_0_leistungen.png
│       ├── 2_1_leistungen_tanztherapie.png
│       ├── 2_2_leistungen_paartherapie.png
│       ├── 2_3_leistungen_weiterbildung.png
│       ├── 2_4_leistungen_psychotraumatherapie.png
│       ├── 3_termine_ansicht_1.png
│       ├── 3_termine_ansicht_2.png
│       └── 4_kontakt.png
├── migration_strato_to_hostinger/                      ← Strato→Hostinger migration plan
├── resources/                                          ← OFF-LIMITS per CLAUDE.md
│   └── birgit-kretzschmar.de/                          ← raw old-site source files
├── shared/themes/
│   ├── praxis_base/                                    ← parent theme (committed)
│   │   ├── functions.php                               ← theme bootstrap; declares custom-logo support
│   │   ├── header.php / footer.php                     ← document chrome only
│   │   ├── front-page.php                              ← homepage (reads ACF fields, includes gallery)
│   │   ├── page.php / index.php                        ← fallback templates
│   │   ├── style.css                                   ← WP theme detection only
│   │   ├── tailwind.css                                ← source CSS, @theme tokens, dropdown CSS, CF7 styles
│   │   ├── package.json / package-lock.json
│   │   ├── page-ueber-mich.php                         ← Über mich page template (Step 9)
│   │   ├── template-leistung.php                       ← individual Leistung pages (Step 10)
│   │   ├── template-leistungen-overview.php            ← Leistungen overview with auto-listed children
│   │   ├── template-termine.php                        ← Termine page with past-events disclosure (Step 11)
│   │   ├── template-kontakt.php                        ← Kontakt page with form (Step 12)
│   │   ├── template-legal.php                          ← shared template for Impressum/Datenschutz (Step 12)
│   │   ├── acf-json/                                   ← ACF field group definitions (auto-managed)
│   │   │   ├── group_69f9d6b401bba.json                ← Über mich field group
│   │   │   ├── group_69f9f7c7c674f.json                ← Leistung field group
│   │   │   ├── group_69fb1caeb8462.json                ← Termine field group
│   │   │   ├── group_69fb3e588f366.json                ← Kontakt field group
│   │   │   └── group_69f1eb4c7058a.json                ← Homepage field group (incl. Galerie Repeater)
│   │   ├── template-parts/
│   │   │   ├── site-header.php                         ← logo, brand text, nav, mobile menu, sticky positioning;
│   │   │   │                                              reads wordmark via get_bloginfo() (8 May fix)
│   │   │   └── site-footer.php                         ← two-column footer (parent default; Alex overrides)
│   │   ├── assets/js/
│   │   │   ├── mobile-nav.js                           ← hamburger toggle (Step 8)
│   │   │   ├── past-termine-toggle.js                  ← past-events disclosure label toggle (Step 11)
│   │   │   └── back-to-top.js                          ← back-to-top button on every page
│   │   ├── build/
│   │   │   └── theme.css                               ← compiled Tailwind (gitignored)
│   │   └── node_modules/                               ← gitignored
│   │
│   └── alex_child/                                     ← Alex's child theme (committed 8 May 2026)
│       ├── style.css                                   ← Template: praxis_base; WP detection only
│       ├── functions.php                               ← enqueues child CSS at priority 20, dependency 'praxis-base'
│       ├── tailwind.css                                ← imports parent tokens; overrides --color-accent-* with logo warm-red
│       ├── package.json                                ← scripts: tw:build, tw:watch
│       ├── front-page.php                              ← five-band ACF-driven landing page (hero / Leistungen / Über mich / Kontakt CTA)
│       ├── acf-json/                                   ← per-site ACF field group exports
│       │   └── README.md                               ← documents the five field groups (to be created in wp-admin)
│       ├── assets/icons/                               ← inline-SVG icons for the 6 Leistung cards
│       │   ├── README.md                               ← Heroicons-compatible, currentcolor convention
│       │   └── _example.svg                            ← demonstrates contract; 6 per-service icons added later
│       ├── template-parts/
│       │   └── site-footer.php                         ← four-column footer override (KFZ-Kunz pattern)
│       ├── build/
│       │   └── theme.css                               ← compiled Tailwind (gitignored)
│       └── node_modules/                               ← gitignored
│
└── sites/                                              ← gitignored
    └── birgit/                                         ← Birgit's actual Local by Flywheel site (real directory, not symlink)
        ├── app/public/                                 ← her WordPress install (themes symlinked to ../../shared/themes/)
        ├── conf/, logs/                                ← Local-managed
        └── ...
```

**Note on Alex's Local site placement.** Alex's Local site is *not*
inside the repo. It lives at
`wordpress/praxis_kretzschmar_alex/app/public/` — a sibling folder to
the repo. His WordPress install reaches the canonical themes via
symlinks in `wp-content/themes/` pointing into
`shared/themes/praxis_base/` and `shared/themes/alex_child/`. This
asymmetry with Birgit's setup (which lives inside the repo at
`sites/birgit/`) is intentional and harmless — both sites work
identically end-to-end. The asymmetry exists because Alex's Local site
was created as a standalone Dropbox folder during the 8 May session
before the repo-internal pattern was understood; recreating it inside
`sites/alex/` would have been disproportionate work for no functional
gain.

### Files NOT in version control (gitignored)

- `shared/themes/*/build/` (compiled CSS rebuilt on each `npm run dev`
  in either parent or child theme — current `.gitignore` only excludes
  the parent's `build/`; should be updated to the wildcard pattern)
- `shared/themes/*/node_modules/`
- `sites/` (entire Local by Flywheel installation for Birgit)
- `resources/` (raw materials, off-limits)
- `*.zip` files anywhere in the repo (added 7 May 2026)
- `~$*` files (MS Word lock files; should be added if not present)

[↑ Back to top](#table-of-contents)

---

## 4. What's Been Accomplished

### Recent commits on GitHub (most recent first)

```
d67ffbe alex_child: load parent ACF JSON, hide hamburger on desktop, add logo asset, hero height; convert Leistung CTA Link to Text; Alex Kontakt Adresse <br> formatting
27a463c alex_child: add parallax effect and additional opacity fade to Startseite hero
0523393 alex_child: convert Hero/Leistungen/Über/Kontakt URL fields to Text; remove previous_chat.md
3bb39f2 committed sites images (hero JPGs + portrait + notes under alex_child/assets/images/)
f12a234 alex_child: change Footer Schnelllinks/Leistungen/Socials url subfields from URL to Text
ec3df9a alex_child: add six Leistungen SVG icons
698c420 Add Alex Über mich and Alex Kontakt field groups; extend Gutenberg-disable to ACF-driven pages
3765ac8 alex_child: register Footer Options Page and export five ACF field groups
cbc2207 gitignore: wildcard build/ across themes; ignore Word lock files
5fb357a docs: fold 8 May Alex scaffolding session into project_handoff
addc5a7 Ignore zip files
3767e50 Remove large zip file
a7bb459 commit modification to nav bar; colour change; nav bar made sticky
e637705 Commit updates to sources following meeting with Kretzschmars
be05bc2 Step 12: Kontakt page with contact form, Impressum, Datenschutz
ef7ef62 Step 11: Termine page template with past-events disclosure
6ee9ae6 docs: update handoff after Step 10 completion, add TOC
8dac51d Step 10: Leistung template, Leistungen overview, ACF JSON export, dropdown nav CSS
1ea58ac Step 9: Über mich page template with ACF field group
a041307 Step 8: Mobile navigation with hamburger toggle
685fea7 Add content inventory for Herr Dr. Kretzschmar's site
3352263 Add formal project proposal (Angebot) to docs/
cda7c17 Add content inventory for Frau Kretzschmar's site
66191bf Step 7.5: Disable Gutenberg on Startseite via use_block_editor_for_post filter
fe573a8 Step 7: Extract visible header/footer into template-parts
2bdd5c3 Repo hygiene: untrack build/theme.css, fix .gitignore path (praxis-base→praxis_base)
db8ddd6 Repo housekeeping: track CLAUDE.md, add Strato→Hostinger migration docs
429adcc Step 6: Wire primary and footer nav menus, add @source directives, fix hover
e68d108 Step 5: ACF Pro wired to homepage — fields editable in wp-admin
66fa223 Step 4: Apply navy + cream palette with Cormorant Garamond + Inter
3938c8d Step 3: Tailwind 4 build pipeline — npm scripts, @theme tokens, compiled output enqueued
4bc98fe First commit steps 1 & 2: Scaffold praxis_base theme — minimum viable WordPress theme, no styling yet
```

### Foundation work (Steps 1–7) — committed, complete

- Parent theme scaffolded with sensible defaults
- Tailwind 4 build pipeline working (`npm run dev` watches)
- Design system established: navy `#1B3A5C` + warm cream `#FDFBF5` + warm stone
  neutrals; Cormorant Garamond display + Inter sans
- Design tokens defined as CSS custom properties in `@theme` block
- Navigation menus registered (primary + footer)
- Header/footer extracted into `template-parts/` for reuse
- Gutenberg disabled on the Startseite (homepage uses ACF, not blocks)

### Step 8 — Mobile navigation (committed)

- Hamburger button visible only below `md` breakpoint (768px)
- Tappable hamburger toggles a dropdown panel with the menu
- Vanilla JS, ~25 lines, no library dependencies
- Verified working on iPhone 12 viewport

### Step 9 — Über mich page (committed)

- Page template `page-ueber-mich.php` (auto-applied to slug `ueber-mich`)
- ACF field group "Über mich" with 5 fields
- Page populated with real biographical content
- Field group exported to `acf-json/group_69f9d6b401bba.json`

### Step 10 — Leistung pages (committed as 8dac51d)

- `template-leistung.php` shared by all Leistung pages
- `template-leistungen-overview.php` auto-lists child Leistung pages as cards
- ACF field group "Leistung" exported as JSON
- ACF Local JSON folder `acf-json/` established
- Dropdown CSS (desktop hover + mobile inline)
- All four therapy pages populated with German voice-matched copy and Lead
  Images: Tanztherapie, Paartherapie, Weiterbildungen, Psychotraumatherapie

### Step 11 — Termine page (committed as ef7ef62)

- `template-termine.php` with hero, lead image, intro band, two-column events
  list, collapsible past-events disclosure, contact CTA
- ACF field group "Termine" with Repeater containing 6 subfields per event (
  Datum, Titel, Uhrzeit, Ort, Beschreibung, Gruppentyp)
- `past-termine-toggle.js` — 5-line vanilla JS that swaps the disclosure label
  between "Vergangene Termine anzeigen" and "Vergangene Termine ausblenden" on
  toggle
- Past-vs-upcoming split happens server-side via PHP date comparison
- German date formatting via PHP date() with translation arrays
- Termine page populated with one upcoming event and one past event for demo

### Step 12 — Kontakt page + legal pages (committed as be05bc2)

- `template-kontakt.php` with hero, lead image (height-capped), intro band,
  two-column Adresse/Anfahrt, optional contact form section
- `template-legal.php` shared prose-only template for Impressum/Datenschutz
- ACF field group "Kontakt" — 6 top-level fields including Form Shortcode (so
  the CF7 shortcode is held in ACF rather than hardcoded)
- Contact Form 7 installed and configured: German field labels, DSGVO consent
  checkbox linking to /datenschutz/, German validation messages
- CF7 styling in `tailwind.css` scoped under `.kontakt-form` to match design
  system
- Kontakt page populated with practice address, contact details, directions
- Impressum page populated with placeholder text (visible "DEMO-VERSION" notice
  for URS interviews — TO BE REMOVED for production)
- Datenschutz page populated verbatim from old site (Google Maps section omitted
  since we don't embed Maps)
- Footer menu updated: Impressum and Datenschutzerklärung added

### Step 13 — Homepage gallery, header rebrand, sticky nav (committed across e637705, a7bb459)

**Homepage gallery:**

- Three-image grid below the hero on the Startseite (chosen instead of carousel;
  carousels are an established UX anti-pattern)
- ACF Repeater added to Homepage field group: `home_galerie` with `bild` (image)
  and `caption` (text) subfields
- Three images populated: Therapieraum, Wartezimmer, Praxis (further room)
- Single-column on mobile, three-column on tablet+

**Header rebrand:**

- Site Title in WP Settings → General changed from `birgit_kretzschmar` to
  `Birgit Kretzschmar`
- Tagline set to `Praxis für Psychotherapie`
- Custom logo uploaded via Customiser → Site Identity (`logo3-1.jpg`)
- `add_theme_support( 'custom-logo' )` declared in `functions.php`
- Header now displays: logo (48px tall) + uppercase wordmark "BIRGIT
  KRETZSCHMAR · PRAXIS FÜR PSYCHOTHERAPIE" using Inter sans, navy-800/navy-600
  hierarchy
- Logo and wordmark together as one link to home
- Mobile-responsive: smaller logo and text on narrow screens

**Sticky nav:**

- Header is now `position: sticky` at viewport top, with `z-40` stacking
- Header background changed from `bg-cream-50` to `bg-cream-100` to provide
  visual contrast against the hero section below
- Birgit specifically requested both changes; she has reviewed and approved
- Note: during implementation, Tailwind 4 silently failed to generate the
  `sticky` and `top-0` utilities until the watcher was restarted; lesson:
  `npm run dev` should be restarted whenever new utility classes appear in the
  source

**CTA fixes (committed in same range):**

- All "Termin vereinbaren" links across the site changed to "Kontakt aufnehmen"
  pointing to `/kontakt/`
- Affects: Startseite, Über mich, Leistungen overview, all four therapy pages
- Termine page CTA was already "Kontakt aufnehmen"; unchanged
- Defaults updated in templates so future Leistung pages also get the new
  behaviour

### Documentation handoff (committed across multiple commits)

- `docs/handoffs/project_handoff.md` — this document
- `docs/handoffs/previous_chat.md` — full conversation log from the Step 10
  session
- `docs/screenshots_birgit/` — screenshots of all Birgit's pages, sent to her on
  6 May 2026 for review

### 8 May 2026 session — Alex site scaffolded (committed at end of session)

**Goal:** establish Alex's site from zero to a working demo skeleton,
ready for content population. Birgit's site untouched except for one
shared parent-theme bug fix.

**Local site provisioned:**

- `praxis_kretzschmar_alex/` Local by Flywheel site at
  `/Users/.../wordpress/praxis_kretzschmar_alex/`
- URL: `http://alexkretzschmar.local/` (custom domain set in Local
  advanced options)
- Same PHP / MySQL / web-server versions as Birgit's site
- Old sites renamed with `_old` suffix and removed from active workflow

**Child theme `alex_child/` scaffolded** (eight files, see Section 3):

- `style.css` declaring `Template: praxis_base`
- `functions.php` enqueuing compiled child CSS at priority 20 with
  `praxis-base` as dependency (cache-bust via filemtime)
- `tailwind.css` overriding only the parent's `--color-accent-*` tokens
  with logo-derived warm-red `#AB2815`, plus a new `--color-warm-*`
  scale for the orange `#FB944B` (logo sampled by hand:
  `rgb(171, 40, 21)` outer ring, `rgb(251, 148, 75)` inner core)
- `package.json` mirroring parent's `tw:build` / `tw:watch` scripts
- `front-page.php` implementing the approved five-band layout, all
  bands ACF-driven, every band guards on field presence (renders empty
  when fields are absent — useful pre-content)
- `template-parts/site-footer.php` overriding the parent's two-column
  footer with a four-column layout (Über uns / Schnelllinks / Unsere
  Leistungen / Kontaktinfo) modelled on the KFZ-Kunz reference
- `acf-json/README.md` documenting the five field groups to be created
  in wp-admin (field-name contract matches the `get_field()` calls in
  the templates)
- `assets/icons/README.md` + `_example.svg` documenting the inline-SVG
  icon convention for the Leistungen grid (Heroicons-compatible,
  currentcolor)

**Theme symlinks wired into Alex's WordPress install:**

- `wordpress/praxis_kretzschmar_alex/app/public/wp-content/themes/praxis_base`
  → `shared/themes/praxis_base/`
- `wordpress/praxis_kretzschmar_alex/app/public/wp-content/themes/alex_child`
  → `shared/themes/alex_child/`
- WordPress's child-theme template inheritance picks both up; child
  theme activated in wp-admin

**Parent-theme bug fix — `template-parts/site-header.php`:**

- The wordmark and tagline were previously hard-coded as the literals
  "Birgit Kretzschmar" and "Praxis für Psychotherapie", which would
  have made every site using `praxis_base` display Birgit's name in
  the header
- Replaced with `<?php echo get_bloginfo('name'); ?>` and
  `<?php echo get_bloginfo('description'); ?>` so each site reads its
  own database
- Birgit's site unaffected (her Settings → General values match the
  previous literals); Alex's site now correctly displays
  "DR. ALEXANDER KRETZSCHMAR · PRAXIS FÜR PSYCHOTHERAPIE"

**Settings → General configured for Alex:**

- Site Title: `Dr. Alexander Kretzschmar`
- Tagline: `Praxis für Psychotherapie`

**Verified working at session end:**

- `http://alexkretzschmar.local/` loads, styled (cream + navy +
  warm-red accents), correct wordmark in header, four-column footer
  with italic placeholders for unpopulated ACF fields, footer copyright
  reads "© 2026 Dr. Alexander Kretzschmar"
- Birgit's site at `http://birgitkretzschmar.local/` continues to work
  unchanged
- Both themes appear in Alex's wp-admin → Appearance → Themes; Alex
  Kretzschmar is the active theme

**What was deliberately not done in this session** (deferred to next):

- ACF Pro install on Alex's site
- Contact Form 7 install on Alex's site
- Page hierarchy creation (the nine pages: Startseite, Über mich,
  Tiefenpsychologie, Gestalttherapie, Psychoonkologie, Hypnotherapie,
  Coaching, Praxis, Kontakt)
- Static front page assignment in WP settings
- Building the five ACF field groups in wp-admin
- Hero background image
- Six per-service SVG icons
- Content population in any ACF field
- `birgit_child/` retrofit

---

### 12 May 2026 session — Alex site content-populated and demo-ready (committed across multiple commits)

**Goal:** populate Alex's site with real content end-to-end so Alex
can review the demo. Birgit's site untouched except where parent-theme
changes incidentally apply (Leistung CTA field type, Gutenberg disable
filter extension — both benign for her).

**ACF Pro and CF7 plugins installed on Alex's site.**

**Five Alex-specific child-theme ACF field groups created in wp-admin,
exported to `alex_child/acf-json/`:**

- Alex Hero (hero_background_image, hero_headline, hero_subheadline,
  two CTAs)
- Alex Leistungen Grid (heading, intro, six-card Repeater with icon /
  title / summary / link sub-fields)
- Alex Über mich Band (heading, lead, body, CTA, portrait)
- Alex Kontakt CTA Band (heading, sub, two CTAs)
- Alex Footer (Options Page; about blurb, address, phone, email,
  copyright, three Repeaters for Schnelllinks / Leistungen / Socials)

**ACF Options Page registered** in `alex_child/functions.php` via
`acf_add_options_page()` for the Alex Footer field group.

**Parent ACF JSON loaded from child theme.** Added an
`acf/settings/load_json` filter to `alex_child/functions.php` so ACF
on Alex's site reads field groups from both `alex_child/acf-json/` and
`praxis_base/acf-json/`. Without this, the parent's Leistung / Über mich
/ Kontakt / Termine / Homepage field groups weren't visible on Alex's
site, even though the JSON files existed on disk.

**URL → Text field-type conversions** across Alex's child theme field
groups and the parent's Leistung field group. ACF's URL field type
rejects relative paths like `/kontakt/`; converting affected fields
to Text removes that validation while preserving the field's purpose.
Footer Socials URL sub-field intentionally left as URL type (Alex has
no social channels; field stays empty).

**Six per-service SVG icons created** at
`alex_child/assets/icons/` (Heroicons-compatible outline style,
`viewBox="0 0 24 24"`, `stroke="currentColor"`):

- `tiefenpsychologie.svg` (iceberg)
- `gestalttherapie.svg` (two overlapping circles)
- `psychoonkologie.svg` (shield with heart)
- `hypnotherapie.svg` (brain with halo)
- `coaching.svg` (compass with needle)
- `praxis.svg` (building with door)

**Hero background image processed and uploaded:**

- Sourced `consultation_bw.jpg` from Pexels (free-licence, two-figure
  anonymous therapist + patient motif)
- Web-sized derivative `consultation_bw_web.jpg` at 2400×1600, 8-bit
  grayscale, 446 KB
- Both committed to `alex_child/assets/images/`
- Assigned to the Startseite Hero Background Image ACF field

**Portrait image re-encoded:** Alex's portrait
`Alexander-Kretzschmar-250409-013-web.jpg` re-encoded at the same
1063×709 dimensions, JPEG quality 85, progressive — from 416 KB to
80 KB (81% smaller, no visible quality loss). Stored as
`alex_kretzschmar_portrait.jpg` in the alex_child assets folder and
uploaded to the WP media library.

**Startseite ACF fields populated** (all five bands):

- Hero with headline / subheadline / image / two CTAs
- Leistungen Grid with intro paragraph and six Repeater rows (each
  with icon, title, ~2-sentence summary, and link to the corresponding
  Leistung page)
- Über mich Band with heading / lead / body / CTA / portrait
- Kontakt CTA Band with heading / sub / two CTAs

**Footer Options Page populated** with Über uns blurb, complete
Kontaktinfo (address / phone / email), copyright, four Schnelllinks
rows, six Leistungen rows. Socials Repeater left empty (deliberate).

**All eight interior pages populated:**

- Über mich — tagline, portrait, bio (3 paragraphs), six
  Qualifikationen Repeater rows, Werdegang (2 paragraphs)
- Tiefenpsychologie, Gestalttherapie, Psychoonkologie, Hypnotherapie,
  Coaching, Praxis — each with tagline, intro paragraph, three
  Repeater sections (heading + body), CTA. Six therapy pages all
  using the parent's `template-leistung.php`.
- Kontakt — tagline, intro paragraph, address block (with `<br>`
  formatting for line breaks), Contact Form 7 shortcode

**Contact Form 7 form created** ("Kontakt Standardformular") on Alex's
site, mirroring Birgit's form: Name, E-Mail, Betreff, Nachricht fields,
DSGVO consent checkbox linking to `/datenschutz/`, German labels and
button text. Mail tab configured to deliver to
`dr.kretzschmar-wiesbaden@t-online.de`. Shortcode pasted into the
Kontakt page's Form Shortcode ACF field.

**Gutenberg-disable filter extended** in `praxis_base/functions.php`
to cover Alex's ACF-driven pages (Über mich, Kontakt, six therapy
sub-pages on both sites). Prevents the Gutenberg "Meta boxes" drawer
from hiding ACF fields behind a collapsed UI element.

**Page Template assignments** on Alex's six Leistung sub-pages set to
"Leistung" via Page Attributes. The parent's Leistung field group
location rule (`page_template == template-leistung.php`) requires
this for the field group to appear on the edit screen.

**Logo and favicon added:**

- Logo source `logo3.jpg` (237×243, white background) converted to
  transparent-background PNG `logo_alex.png` and committed to
  `alex_child/assets/images/`
- Uploaded to media library and set as Custom Logo via
  Appearance → Customise → Site Identity
- Header now renders the logo to the left of the wordmark via the
  parent template's existing `has_custom_logo()` block
- Same PNG set as Site Icon (favicon) — appears in browser tabs

**Hamburger menu hidden on desktop.** Added a CSS media query block
to `alex_child/tailwind.css` targeting `[data-mobile-nav-toggle]`
and `[data-mobile-nav-panel]` to force `display: none` at ≥768px.
The template's existing `md:hidden` Tailwind class wasn't being
generated in the compiled CSS for reasons not fully diagnosed
(likely a Tailwind scan-path issue); explicit CSS bypasses that.

**Startseite hero band enhancements (item 12 — Alex-requested):**

- Hero band height increased so the consultation image displays in
  full (taller band via larger `py-*` values, edited by Henry directly)
- Parallax effect added via `background-attachment: fixed` on the
  hero background div, with `scroll` fallback for mobile (≤768px) and
  for `prefers-reduced-motion: reduce`
- Opacity fade added (`opacity: 0.6`) on top of the existing
  `filter: grayscale(100%) brightness(0.55)` so the image is softer
  and text contrast improves

**ACF field-type / location-rule fixes for Alex's pages:**

- Created Alex-specific duplicates of the parent's Über mich and
  Kontakt field groups in `alex_child/acf-json/` with Page (not Page
  ID) location rules pointing at Alex's specific pages. Parent's
  originals used Birgit's page IDs and didn't match Alex's
- Parent's Leistung field group CTA Link sub-field converted from
  URL → Text via the wp-admin Save → JSON write-back path. ACF
  initially wrote the modified file into `alex_child/acf-json/`
  rather than overwriting the parent's; resolved by `cp`'ing the
  child's copy back to the parent's path and removing the child's
  duplicate
- Footer Repeater URL sub-fields (Schnelllinks, Leistungen)
  converted URL → Text
- Various ACF Repeater Adresse field had its New Lines setting
  changed to `Automatically add <br>` so the multi-line address
  renders with visible line breaks

**WP_Post fatal-error fix:** the Startseite Leistungen Grid had a PHP
fatal when the link sub-field returned a WP_Post object that
`front-page.php` tried to cast to string. Fixed by changing the link
sub-field's ACF Return Format from "Post Object" to "Post ID" — no
template change needed.

**Verified at session end:**

- All 9 pages on Alex's site render with real content
- Front-page bands all populated and visually correct
- Contact form functional (sends test mail to Alex's address on submit)
- Logo and favicon visible
- Hamburger hidden on desktop, visible on mobile
- Parallax hero with opacity fade and full-image height

**Deferred from this session (intentional, low priority for demo):**

- Sample Page and Privacy Policy drafts still in Alex's wp-admin
  (cleanup before launch)
- Footer Socials URL sub-field left as URL type (no social channels
  needed)
- The desktop `md:hidden` hamburger fix was applied via explicit CSS
  rather than diagnosing why Tailwind isn't generating the class. The
  root cause should be investigated before launch (likely a config
  scan-path issue)
- Real Impressum and Datenschutz pages (Alex says his existing old-site
  versions are usable, minus the Google Maps embed paragraph)

[↑ Back to top](#table-of-contents)

---

### 14 May 2026 session — demo migration + Birgit content revision + SDLC docs (committed across multiple commits)

**Demo migration (completed, successful).** Both sites migrated via
All-in-One WP Migration to Hostinger temporary domains for client
review:

- Birgit: `lightpink-wolf-142779.hostingersite.com`
- Alex: `springgreen-viper-610216.hostingersite.com`

Hostinger Premium confirmed to allow 3 sites/plan — both fit one
plan. Production architecture decision recorded: AIO WP Migration
resolves the symlinked parent theme into real files, so each
production site carries its own independent copy of `praxis_base`;
future parent-theme changes must be deployed to both sites
separately. The Strato→Hostinger domain migration is **complete**;
nothing remains hosted at Strato. Demo domains protected via HTTP
basic auth plus "discourage search engines".

**SDLC documentation set produced** (Work Package 1 of the proposal,
previously not started — now substantially delivered):

- Two retrospective URSs (Birgit, Alex), v1.0 → v1.1 (v1.1 adds TOC
  + back-to-top), EN `.md` + DE `.pdf`
- Reconciled project plan covering both sites, EN `.md` + DE `.pdf`;
  supersedes the per-site §8 URS timelines
- Two risk analyses (Birgit 20 requirements, Alex 19), each with a
  requirement→risk traceability matrix, high/medium/low, mitigating
  action for every high risk reducing it to low; EN `.md` + DE `.pdf`
- Birgit-Termine front-end editor URS (drafted; prospective separate
  project)
- Internal Beriott project record (end-of-demo-phase)
- All filed under `docs/SDLC/` and `docs/beriott_reports/`

**Birgit content revision (Local, pending migration to demo).**
Applied the first batch of Birgit's reworked content and made the
structural changes it required:

- **Über mich → Bio:** split into two paragraphs (was rendering as
  one; the literal `<br>` issue was a Visual/Text-tab artefact —
  resolved by paragraph break in Visual tab)
- **Über mich → Qualifikationen:** replaced all four rows with
  Birgit's new qualifications (B.Sc. Gesundheitswissenschaften;
  Ausbildungsberechtigte Tanz- und Lehrtherapeutin BTD;
  Körperorientierte Psychotherapie nach Heilpraktikergesetz;
  Identitätsorientierte Psychotraumatherapie IoPT); Detail
  subtitles cleared
- **Über mich → Werdegang split (STRUCTURAL):** the single
  `ueber_mich_werdegang` WYSIWYG field replaced with two fields,
  `ueber_mich_fortbildungen` ("Fort- und Weiterbildungen") and
  `ueber_mich_berufserfahrung` ("Berufserfahrung");
  `page-ueber-mich.php` now renders two sections with alternating
  cream backgrounds. **Old Werdegang data is orphaned** under the
  old field name — the new fields start empty by design (content
  replaced anyway). ACF JSON `group_69f9d6b401bba.json` modified,
  `modified` timestamp bumped, Synced in wp-admin.
- **Termine → recurring events (STRUCTURAL):** added a second
  repeater `termine_wiederholend` ("Regelmäßige Termine") to the
  Termine field group for events with no fixed date (Titel,
  Wiederholung, Ort, Gruppentyp, Beschreibung, Kosten);
  `template-termine.php` renders a new "Regelmäßige Termine" section
  between upcoming and past, with a new
  `praxis_render_recurring_entry()` function. Used for Birgit's
  Saturday IoPT open group. ACF JSON `group_69fb1caeb8462.json`
  modified, timestamp bumped, Synced.
- **Tanztherapie + Paartherapie:** new long-form content mapped onto
  the existing Leistung field group (Intro + 3 Sections each); no
  field changes needed — empty Tagline/Quote/Image/CTA fields
  degrade gracefully via the template's presence guards
- **Termine internal link:** "Termine" reference in a Tanztherapie
  section linked to `/termine/` (relative URL for environment
  portability)

**Site-wide CSS fix (STRUCTURAL, affects both sites).** Discovered
that Tailwind 4 ships with no typography plugin loaded, so
`.prose ul/ol/li` had no bullets and `.prose a` had no link styling
in body content. Added explicit `.prose` list rules and `.prose a`
link styling (navy-600, underline, navy-900 hover) to
`praxis_base/tailwind.css`. Fixes bulleted lists and links in all
body content across both Birgit's and Alex's sites.

**Repo hygiene.** `__AIO_export_*/` folders gitignored (large
`.wpress` binaries, not for version control).

[↑ Back to top](#table-of-contents)

---

## 5. Key Decisions Made

### Architecture

| Decision                                     | Rationale                                                                                                                                                                                        |
|----------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Two separate WordPress sites (not multisite) | Simpler deployment, independent failure modes, separate hosting plans, no cross-contamination of plugins/themes                                                                                  |
| Shared parent theme + child themes           | DRY for design system; child themes give per-practice override capability                                                                                                                        |
| Both old domains kept                        | SEO continuity, patients have memorized URLs over years                                                                                                                                          |
| Email kept entirely separate from web        | Different security profiles (Kassenärztliches requires KV-SafeNet); no SMTP entanglement                                                                                                         |
| ACF Pro for content fields                   | Established WordPress pattern; less custom code than custom post types                                                                                                                           |
| ACF Local JSON for version control           | Field group definitions live in `acf-json/` and travel with the codebase                                                                                                                         |
| Tailwind 4 (not 3)                           | Modern `@theme` syntax cleaner; more performant build                                                                                                                                            |
| Self-host Google Fonts before launch         | DSGVO requirement (German practice cannot leak visitor IPs to Google) — TODO, not done yet                                                                                                       |
| Modernised voice for therapy page copy       | Plain register replacing academic source text; matches reference sites; subject to Birgit's complete rewrite (in flight)                                                                         |
| **No patient data on website**               | Confirmed in 6 May meeting — Alex raised the new German "Elektronische Patientenakte" laws; patient data lives only in their existing Kassenärztliche Vereinigung systems, never on the websites |
| Sticky header with cream-100 contrast        | Birgit's specific request, verified and approved by her                                                                                                                                          |
| Three-image grid over carousel on homepage   | Carousels are a well-documented UX anti-pattern (low click-through, accessibility issues, mobile performance); static grid achieves the same visual goal without those costs                     |

### Content & Pages

**Birgit's seven pages** (confirmed by Birgit, all built):

1. Über mich
2. Tanztherapie *(now under /leistungen/)*
3. Paartherapie *(now under /leistungen/)*
4. Weiterbildungen *(plural, confirmed by Birgit)*
5. Psychotraumatherapie *(now under /leistungen/)*
6. Termine
7. Kontakt

Plus:

- **Leistungen** overview page (parent of the four therapy pages, auto-lists
  them)
- **Impressum** and **Datenschutzerklärung** (linked from footer)

The Praxis page that originally appeared in scaffolding is no longer needed and
**should be deleted** — confirmed implicitly during the meeting (no mention of
it as required).

**Alex's nine pages** (per his old-site published structure):

1. Über mich
2. Psychotherapie *(general intro)*
3. Tiefenpsychologie
4. Gestalttherapie
5. Psychoonkologie
6. Hypnotherapie
7. Coaching
8. Praxis
9. Kontakt

Note differences from Birgit: Alex has Praxis, Birgit doesn't. Birgit has
Termine, Alex doesn't. Asymmetry intentional.

**Alex's site direction (refined 8 May 2026 — supersedes 7 May note):**

Alex's site is **multi-page** like Birgit's, mirroring her praxis_base
architecture. The 2024 one-pager that Alex liked
(`version_00_alex.zip`) is a **visual reference only**, narrowly
scoped: the "anonymous therapist + patient" hero motif used as a
full-bleed, faded black-and-white background on the **landing page
only**. The one-pager's IA, modal-based service details, single-scroll
layout, and any other structural element are explicitly out of scope.

Alex liked a second landing page (`kfz_service_kunz_local.
zip`). This is a second
visual reference Alex liked; it supplied the band structure used in
Alex's `front-page.php`: hero → services grid → about band →
testimonials *(omitted, see below)* → contact CTA → four-column
footer.

**Decisions made for Alex's site on 8 May:**

- **Multi-page architecture confirmed.** Closes earlier open question.
  Each of his nine pages gets its own URL, navigated via the primary
  nav, with template inheritance from `praxis_base`.
- **Five-band landing-page layout** approved for `front-page.php`:
  hero, Leistungen grid, Über mich band, Kontakt CTA band, footer (the
  footer is rendered by `template-parts/site-footer.php` via
  `get_footer()`).
- **No testimonials section.** Confidentiality-sensitive context; a
  testimonials band would be ethically and legally problematic for a
  German psychotherapy practice. Explicitly excluded — do not add one
  even if a future reference design includes it.
- **Six cards in the Leistungen grid, not seven.** "Psychotherapie"
  is treated as the section's intro paragraph rather than a 7th card.
  The six cards are Tiefenpsychologie, Gestalttherapie,
  Psychoonkologie, Hypnotherapie, Coaching, Praxis.
- **Colour scheme:** inherit Birgit's navy (`#1B3A5C`) for text and
  cream (`#FDFBF5`) for page background; use logo-derived warm-red
  (`#AB2815`) as the primary accent (CTAs, contact band, link hover,
  card top-borders) and warm-orange (`#FB944B`) sparingly as a
  secondary accent for icon-square backgrounds. Both sites read as
  siblings; logo-derived warm-red is Alex's distinguishing accent.
- **Settings → General values are now load-bearing** (8 May fix to
  `praxis_base/template-parts/site-header.php`). Each site's Site
  Title and Tagline drive the header wordmark and tagline. Birgit:
  `Birgit Kretzschmar` / `Praxis für Körperzentrierte Psychotherapie`. Alex:
  `Dr. Alexander Kretzschmar` / `Praxis für Psychotherapie`.

### Slug strategy

- **Birgit's old slugs were a mess.** Slugs corrected when creating new pages.
- **Alex's old slugs are clean** — they map directly to new slugs, no rewriting
  needed.
- **Four therapy pages now nested under `/leistungen/`** — URLs are
  `/leistungen/tanztherapie/` etc. Pre-launch redirect map will need to handle
  old `/tanztherapie/` → new `/leistungen/tanztherapie/`.

### Image strategy

- Birgit's portrait at 3648×5472 (high-quality DSLR) — already in Media Library
- Practice photos (Wartezimmer, Therapieraum, Haus) — same files appear in both
  Birgit's and Alex's old image libraries since they share premises
- Five Unsplash images (free commercial license) used as Lead Images for the
  Leistung pages and Termine
- Three practice-room images used in homepage gallery
- Logo image (`logo3-1.jpg`) used as both header logo and site icon (favicon)
- **All Lead Images on therapy pages will be replaced** by Birgit-supplied
  Canadian Rocky Mountains vacation photos (delivered before her end-of-May
  vacation)

[↑ Back to top](#table-of-contents)

---

## 6. Credentials & Access Details

### GitHub

- Repository: `github.com/henrymacartney/praxis_kretzschmar`
- Owner: Henry (henrymacartney)
- Branch: `main` (linear history)
- Commit author: Henry (macartneyhenry@gmail.com)

### Local WordPress (Birgit's site)

- URL: `http://birgitkretzschmar.local/` (no hyphen — Local by Flywheel stripped
  it)
- WP Admin: `http://birgitkretzschmar.local/wp-admin/`
- Admin user: `admin`
- Admin password: `admin`
- Database: managed by Local by Flywheel (Adminer accessible via Local's "
  Database" tab)
- Site path on disk: `praxis_kretzschmar/sites/birgit/app/public/`

### Local WordPress (Alex's site — provisioned 8 May 2026)

- URL: `http://alexkretzschmar.local/` (custom domain set in Local advanced
  options at site creation)
- WP Admin: `http://alexkretzschmar.local/wp-admin/`
- Admin user: `admin`
- Admin password: `admin`
- Database: managed by Local by Flywheel
- Site path on disk:
  `wordpress/praxis_kretzschmar_alex/app/public/` (sibling folder to the repo,
  not inside it — see Section 3 for the asymmetric layout)
- Active theme: **Alex Kretzschmar** (child of Praxis Base)
- Settings → General Site Title: `Dr. Alexander Kretzschmar`
- Settings → General Tagline: `Praxis für Psychotherapie`

### Anthropic (ACF Pro license)

- ACF Pro Freelancer license (paid by Henry)
- Activated on Birgit's local site

### Production (planned, not yet provisioned)

- Hostinger Premium for Birgit (planned)
- Hostinger Premium for Alex (planned)
- Domains stay with Strato (DNS pointing to Hostinger after cutover)

### Outlook/Microsoft 365 for email

- Birgit and Alex use existing email accounts (not part of this project)
- Critically: Alex's Kassenpraxis correspondence uses KV-SafeNet — must NOT be
  touched

[↑ Back to top](#table-of-contents)

---

## 7. Project Rules (CLAUDE.md)

The project has strict working rules in `CLAUDE.md`. Key points:

- Do nothing with the code in the
'/Users/henrymacartney/Dropbox/03_Uni_MI/900
-Harvard_University_Courses_in_Computer_Science/Udemy-Courses/wordpress
/praxis_kretzschmar/resources/' folder and its subfolders
without my express permisssion  
- Always show me your thoughts / plan about what you would like to do for my
approval  
- Always tell me in which folders / files you will work in and where exactly
the work you propose to do will be done  
- Always prepare a roll-back for cases in which I do not like what you have
done. After roll-back prompt me to do a Git backup.  
- Henry runs ALL Git/GitHub operations. Claude (or any AI assistant) should 
  never
run git commands.
- Never guess at answers - if you do not know something say so - in the past
you have guessed and that infuriates me!! Be evidence-driven, not speculative.
- Claude should not deliberate much when considering various solutions to
problems. This has been problematic in the past and results in endless repeated
rounds of suggestion!

[↑ Back to top](#table-of-contents)

---

## 8. Current State (As of 14 May 2026, end of demo-migration + Birgit content-revision)

### What's working

**Both sites are live on Hostinger temporary demo domains** (migrated
14 May): Birgit `lightpink-wolf-142779.hostingersite.com`, Alex
`springgreen-viper-610216.hostingersite.com`. Behind HTTP basic auth
+ "discourage search engines". Note: the Birgit content/structural
changes from the 14 May session were made on **Local** and need
migrating to the demo (the demo currently shows the pre-14-May
Birgit build).

**Birgit's site** (Local — updated 14 May):

- All seven of Birgit's pages render with content
- Plus Leistungen overview, Impressum, Datenschutzerklärung
- Homepage three-image gallery
- Branded header with logo and wordmark (reads from Settings → General)
- Sticky navigation with subtle cream contrast against page sections
- Desktop and mobile navigation (hamburger + dropdown)
- Hover dropdown for Leistungen with four therapy items
- Footer with Startseite, Kontakt, Impressum, Datenschutzerklärung links
- Contact Form 7 on Kontakt page with German labels and DSGVO consent
- All "Kontakt aufnehmen" CTAs pointing to /kontakt/
- **Über mich:** two-paragraph bio; new four-item Qualifikationen;
  Werdegang now split into "Fort- und Weiterbildungen" + 
  "Berufserfahrung" (two sections)
- **Termine:** new "Regelmäßige Termine" section (recurring events)
  alongside the existing dated upcoming/past lists
- **Tanztherapie + Paartherapie:** new long-form content (Intro +
  three Sections each)
- Bulleted lists and in-content links now render correctly
  site-wide (prose CSS fix)

**Alex's site** (content-populated end-to-end on 12 May, demo-ready
for Alex's review):

- Local site running at `http://alexkretzschmar.local/`
- Child theme `alex_child` activated, inheriting from `praxis_base`
- ACF Pro and Contact Form 7 plugins installed and active
- All nine pages exist, all populated with real German content
- Static front page assigned to Startseite (Settings → Reading)
- Header with Custom Logo (transparent-background PNG) to the left of
  the wordmark "DR. ALEXANDER KRETZSCHMAR · PRAXIS FÜR PSYCHOTHERAPIE"
- Favicon (same logo) in browser tab
- Hamburger menu hidden on desktop (≥768px), visible on mobile
- **Startseite** — five-band landing page:
  - Hero band with full-bleed `consultation_bw_web.jpg` background,
    parallax (`background-attachment: fixed`), opacity fade
    (`opacity: 0.6`), grayscale + brightness 0.55 filter, taller band
    so the image displays in full, two CTAs over a navy gradient veil
  - Leistungen Grid with intro paragraph and six cards (icon, title,
    summary, link), each linking to its sub-page
  - Über mich Band with portrait + lead + body + CTA, with
    decorative red+navy corner brackets on the portrait
  - Kontakt CTA Band (warm-red full-width) with heading, sub, two CTAs
- **Über mich** — tagline, portrait, bio (3 paragraphs), six
  Qualifikationen (Promotion, Approbation, Tiefenpsychologie,
  Gestalttherapie FPI, Hypnotherapie MEG, Psychoonkologie/DKG),
  Werdegang (2 paragraphs)
- **Six Leistung sub-pages** (Tiefenpsychologie, Gestalttherapie,
  Psychoonkologie, Hypnotherapie, Coaching, Praxis) — each with
  tagline, intro, three Repeater sections (heading + body), CTA back
  to Kontakt
- **Kontakt** — tagline, intro, formatted Adresse block (address,
  phone, email, Sprechzeiten, Anfahrt with line breaks), working
  Contact Form 7 form ("Kontakt Standardformular") with Name, E-Mail,
  Betreff, Nachricht, DSGVO consent checkbox, German labels and
  button text
- Four-column footer fully populated via Options Page (Über uns,
  Schnelllinks, Unsere Leistungen, Kontaktinfo)
- Footer copyright reads "© 2026 Dr. Alexander Kretzschmar"

### What's NOT working / NOT yet done

- **Birgit's 14-May changes not yet on the demo** — the Über mich
  split, Termine recurring section, Tanztherapie/Paartherapie content
  and prose CSS fix are on Local only; need migrating to the Hostinger
  demo (and the theme-file + ACF-JSON changes committed to Git first)
- **Self-hosting Google Fonts** — currently loaded from Google CDN (DSGVO
  problem, must fix before launch)
- **Image optimization** — partial (Alex's portrait re-encoded 416→80 KB,
  hero processed at 2400×1600); Birgit's 12 MB portrait still untouched
- **Caching plugin** — none installed on either site
- **Security plugin** — none installed on either site
- **Real Impressum and Datenschutz on Alex's site** — pages exist via
  footer links but 404 (not yet created); Alex has confirmed his
  old-site versions can be reused (minus Google Maps embed paragraph)
- **Real Impressum and Datenschutz on Birgit's site** — current placeholders
  are demo only; require lawyer review before launch
- **SEO redirect map** — not yet created (old `?page_id=X` URLs need to redirect
  to new clean URLs) for either site
- **Praxis page on Birgit's site** — exists as draft, not in menu, should be
  deleted
- **Sample Page and Privacy Policy drafts** — auto-generated drafts in
  Alex's wp-admin, need cleanup
- **Desktop `md:hidden` Tailwind generation** — explicit CSS used to
  hide hamburger on desktop; root cause (Tailwind scan-path config)
  not investigated. Pre-launch task.

### What's NOT YET STARTED in general

- **Birgit's child theme** — `shared/themes/birgit_child/` does not
  exist on disk; Birgit's site runs directly on the parent theme.
  Retrofit when needed. (Note: the 14-May Über mich/Termine changes
  were made in the shared parent theme — fine, as they're wanted on
  her site; but this is exactly the kind of change that would need a
  child theme if it ever had to be Birgit-only.)
- **Hostinger production deployment** — demo migration done;
  *production* plan provisioning, final migration, and DNS cutover
  not yet started
- **SDLC documentation** — URS, RA, project plan, internal record
  **delivered 14 May**; FRS, Test Plan, RTM still outstanding
  (the `docs/SDLC/03_functional_requirements_spec`,
  `04_testing`, `05_requirements_traceability_matrix` folders exist
  but are empty)
- **Pre-launch hardening** — performance, security, DSGVO compliance review
- **Custom front-end editor** — Birgit-Termine editor URS drafted
  14 May; treated as a prospective separate project, build not started

### Uncommitted local changes

- **Repo at start of 14 May session:** clean as of last push
  (commit `d67ffbe`)
- **Repo at end of 14 May session:** theme and doc changes staged
  for commit in five planned commits — (1) gitignore AIO exports,
  (2) Birgit Über mich/Termine structural changes
  (`page-ueber-mich.php`, `template-termine.php`, two ACF JSON
  groups), (3) prose CSS fix + alex_child tweaks, (4) alex_child
  assets (hero variants, screenshot, legal HTML), (5) the SDLC
  document set. **These must be committed and pushed.**
- **Database (Birgit):** changed this session — Über mich (bio
  paragraphs, new Qualifikationen, the two new Werdegang-replacement
  fields), Termine (new recurring entry for the IoPT Saturday group),
  Tanztherapie + Paartherapie new content. All in `wp_postmeta` on
  **Local**. **Not yet migrated to the Hostinger demo.** Travels via
  All-in-One WP Migration.
- **Database (Alex):** unchanged this session.
- **Orphaned data note:** old `ueber_mich_werdegang` postmeta still
  exists in Birgit's DB under the old field name after the field was
  renamed/split. Harmless (nothing reads it) but worth knowing if
  anyone inspects the DB.

[↑ Back to top](#table-of-contents)

---

## 9. Where Work Paused

Both sites were migrated to Hostinger temporary demo domains on
14 May 2026 (behind basic auth). Birgit's site was demo-complete and
approved by the Kretzschmars on 6 May (sticky nav + darker header,
both done). Alex's site is content-complete and demo-ready as of
12 May.

The 14 May session then did three things on **Local** (Birgit) and
in the **shared parent theme**: applied Birgit's first batch of
reworked content, made the two structural changes it required (Über
mich Werdegang→two-section split; Termine recurring-events section),
fixed a site-wide prose CSS gap (lists + links), and produced the
full SDLC document set (URSs, project plan, risk analyses, internal
record).

Pause point: **theme + ACF + doc changes are staged but not yet
committed/pushed, and Birgit's Local DB changes are not yet migrated
to the Hostinger demo.** The immediate next actions are mechanical:
commit in the five planned commits, push, then AIO-migrate Birgit's
updated Local build to her demo domain so the Kretzschmars see the
revised content.

After that: still waiting on Alex's review feedback, and the
pre-launch task list is unchanged (Impressum/Datenschutz, font
self-hosting, image optimisation, redirect map, deployment).

The Beriott engagement could expand to full IT support (separate
from this project).

Active waiting on Birgit:

- Reworked text for all pages (delivery: before end-of-May vacation)
- Photos from Canadian Rockies vacation for therapy pages (delivery: same)

Active waiting on Alex:

- Review feedback on the demo build
- His existing Impressum and Datenschutzerklärung text (from the old
  site, minus the Google Maps embed paragraph)

Henry's next focus:

- Send Alex the demo URL / screenshots and gather his feedback
- Investigate the Tailwind `md:hidden` scan-path issue (current
  workaround is explicit CSS, but worth fixing properly before launch)
- Cleanup of Alex's Sample Page and Privacy Policy drafts
- Begin pre-launch hardening tasks once Alex's feedback is applied

[↑ Back to top](#table-of-contents)

---

## 10. What's Next (Priority Order)

### Immediate (post-14-May session, in order)

1. **Commit and push** the staged work in five commits (gitignore
   AIO exports; Birgit Über mich/Termine structural changes; prose
   CSS fix + alex_child tweaks; alex_child assets; SDLC doc set)
2. **Migrate Birgit's updated Local build to the Hostinger demo**
   via All-in-One WP Migration, so the Kretzschmars review the
   revised content (Über mich split, Termine recurring, Tanz-/
   Paartherapie content)
3. **Run `npm run tw:build`** (or confirm the watcher ran) so the
   prose CSS fix is in `build/theme.css` before the migration export
4. **Send Alex the demo** for his review (URL/screenshots/Loom or
   point him at his Hostinger demo domain behind basic auth)
5. **Apply Alex's feedback** when it arrives
6. **Investigate Tailwind `md:hidden` scan-path issue** — fix
   properly so future `md:*` utilities work without explicit-CSS
   workarounds
7. **Cleanup Sample Page and Privacy Policy drafts** in Alex's
   wp-admin
8. **Real Impressum and Datenschutz on Alex's site** — reuse his
   old-site versions minus the Google Maps embed paragraph

### Short-term (before Birgit's vacation, end May 2026)

6. **Delete Birgit's draft "Praxis" page** to clean up wp-admin
7. **Self-host Google Fonts** (DSGVO compliance) — applies to both
   sites
8. **Receive Birgit's reworked content + Canadian Rockies photos** —
   schedule a session to apply them
9. **Custom front-end editing tool design** — at minimum, a
   wireframe/specification for what Birgit wants to be able to edit
   without wp-admin (this came up unexpectedly in the meeting; see
   Section 12)
10. **Image optimization** — compress portraits and large images
11. **Birgit's child theme** — scaffold `shared/themes/birgit_child/`
    if there are practice-specific overrides (low priority unless
    actually needed)

### Medium-term (during Kretzschmars' 4-week vacation, June 2026)

12. **Real Impressum and Datenschutz for Birgit's site** — lawyer
    review (Birgit's responsibility, not Beriott's)
13. **Pre-launch hardening:**

- Caching plugin (e.g. WP Super Cache or W3 Total Cache)
- Security plugin (e.g. Wordfence)
- SEO redirect map: old `?page_id=X` → new clean URLs

14. **Cross-browser / mobile QA**
15. **Performance + accessibility audit** — Lighthouse, alt text review,
    headings hierarchy
16. **SDLC documentation** (URS, RA, FRS, Test Plan, RTM) — derived from the URS
    interviews already conducted

### Production (target: before Kretzschmars return from vacation)

17. **Hostinger account provisioning** (Premium plan x2 — domains
    transferred to Hostinger; hosting plans for the new builds need
    provisioning)
18. **Migration via All-in-One WP Migration plugin** for each site
19. **DNS cutover** so the domains serve the new sites instead of the
    old ones currently at those URLs
20. **Pre-launch testing** (Test Plan execution from Work Package 6)
21. **Hand-off PDF guide** for Birgit/Alex on how to edit content via wp-admin
    AND via the new front-end editor
22. **Custom front-end editor — final implementation**

[↑ Back to top](#table-of-contents)

---

## 11. Open Questions / Decisions Pending

1. **Praxis page on Birgit's site** — confirmed deletion, no longer pending (
   just needs the click)
2. **Praxis photo strategy** — Birgit will supply new photos (Canadian Rockies
   for therapy pages); shared practice photos likely each get their own copy in
   each site's media library
3. **Singular vs plural Leistungen page intro** — could rename to "
   Therapieangebote" if Birgit prefers; defer until her content rewrite arrives
4. **Therapy page copy review** — Birgit is rewriting all of it; ETA before
   end-of-May vacation
5. **Mobile dropdown UX** — current behaviour (therapies inline below
   Leistungen, centered) accepted by Birgit; no change needed
6. **Werdegang page section** — placeholder still in place; will be replaced
   when Birgit sends new content
7. **Repeater image subfield (Leistung)** — never used in practice; can either
   leave as-is, add the missing subfield, or remove the template's reference.
   Defer to URS.
8. **Custom front-end editor scope** — what exactly should Birgit/Alex be able
   to edit without wp-admin? Termine for Birgit obviously. What else? Their bio?
   News announcements? This needs scoping before implementation.
9. **Alex's site shape** — *Closed 8 May 2026: multi-page architecture
   confirmed.* Alex's site mirrors Birgit's praxis_base architecture with
   nine separate pages. The 2024 one-pager is a visual reference for
   the hero motif only.

[↑ Back to top](#table-of-contents)

---

## 12. Meeting with Kretzschmars — 6 May 2026

This section captures the substance of the demo site meeting on the evening
of 6 May 2026. Kept here for project memory; future decisions can refer back to
what was actually agreed and discussed.

### Format

- Scheduled: 19:30, planned 1–1.5 hours
- Actual: ran until ~22:00 (longer than planned, indicating engagement)

### Reception

- **Generally very positive.** Both Kretzschmars satisfied with what's been
  built so far.
- Birgit specifically appreciated the "non-cluttered" look across all pages.
- Birgit liked the demo enough that she explicitly endorsed continuing in this
  direction.
- Birgit's verbatim reaction to the front-end-editor idea: "meine Begeisterung
  kennt keine Grenze!"

### Agreed changes

- **Birgit will rework all texts.** Her old texts date from ~2005 and "do not
  completely reflect her practice" any more. Delivery: before end-of-May
  vacation.
- **Birgit will provide new photos** for the therapy pages — from a recent
  Canadian Rocky Mountains vacation. Delivery: same timeline.
- **Sticky nav with darker cream colour** — implemented and approved during demo
  follow-up (commit `a7bb459`).
- **Demo screenshots shared with Birgit** — `docs/screenshots_birgit/` contains
  the 10 PNGs she received for offline review.

### Alex's input

- Alex reported on work done by an IT person on one of his Email systems.
  The practice has two systems an Outlook sysmtem (approx. 8 years old) and
  a Kassenärztliches System. Neither of these email systems are associated
  with the old websites and should remain independent from the new sites.
  The maintenance work done on the Outlook system was to allow Alex access
  to the system again - he had been locked out. The maintenance was
  successfully concluded.
- Initially said he didn't want any changes to his site
- Reversed during the evening; volunteered that he had once tried to change
  something on his old site and gave up because wp-admin was "very complicated"
- Liked the overall direction; specifically liked the look of a one-pager design
  Henry showed him in 2024 (now extracted at
  `/Users/.../alex_ref/version_00_alex/`). The "anonymous therapist + patient"
  hero motif is what he liked. The static-HTML implementation should NOT be
  ported as-is; the visual language should be ported into the WordPress +
  praxis_base architecture.

### Custom front-end editor

- Triggered by Alex's wp-admin frustration
- Henry proposed: build a tool so they can edit certain content (e.g. Birgit's
  Termine) without entering wp-admin
- Both Kretzschmars delighted; this is now a planned deliverable
- Scope to be defined; minimum: Birgit can edit Termine without wp-admin

### Patient data

- Alex specifically raised the new German "Elektronische Patientenakte" laws
- **Confirmed: NO patient data of any kind will be involved with the new sites.
  ** Both Kretzschmars use the Kassenärztliche Vereinigung systems for that. The
  websites are purely informational/marketing surfaces.
- Important for the URS — patient-data scope is explicitly out.

### Commercial outcomes

- €1.500 fixed-price quote accepted; described as "very generous"
- Henry explained the rate structure: post-URS changes at normal
  Beriott rate (€105/hour).
- **Beriott GmbH asked to take over the Kretzschmars' entire IT support.**
  Separate engagement from this website project; will be handled by another
  Beriott team. Proposal coming next week?

### Timelines agreed

- All Birgit-side content (texts + photos) delivered before her end-of-May
  vacation
- Kretzschmars away for 4 weeks during their vacation
- **Beriott has committed to delivering both sites by their return**

[↑ Back to top](#table-of-contents)

---

## 13. How to Resume Work

To continue this project after a break:

1. **Pull latest from GitHub:** `git pull origin main`
2. **Start Local by Flywheel** and confirm both sites are running:
- Birgit at `http://birgitkretzschmar.local/`
- Alex at `http://alexkretzschmar.local/`
3. **Open the project in PHPStorm**
4. **Start both Tailwind watchers** (each in its own terminal tab):
- `cd shared/themes/praxis_base && npm run dev`
- `cd shared/themes/alex_child && npm run tw:watch`
5. **Verify both sites load** in the browser
6. **Review this handoff doc** to remember where we paused — Section 8
   for current state, Section 10 for what's next
7. **Pick up at "What's Next"** (Section 10) — pick a specific item,
   don't try to "continue from where we left off" generically

### Resuming in a fresh AI chat

To start a new chat session for this project, the next chat needs:

**Files to attach** (zip these together and upload):

- `docs/handoffs/project_handoff.md` (this document — covers
  everything)
- `shared/themes/praxis_base/` (parent theme — full directory)
- `shared/themes/alex_child/` (child theme — full directory)
- `docs/content-inventory/` (all three Alex content-inventory files
  plus all three Birgit ones)
- `CLAUDE.md` (project rules)
- `.gitignore` (so the chat sees current ignore rules)
- `version_00_alex.zip` and `kfz_service_kunz_local.zip` only if the
  next session involves design references for Alex (e.g. extracting
  hero image)

**Briefing message** (rough shape):

> I'm continuing work on the Kretzschmars' WordPress sites. The
> project state is in `docs/handoffs/project_handoff.md`. Read that
> first.
>
> The specific task for this session is [pick from Section 10's
> Immediate list — be specific, e.g. "item 5: create Alex's nine pages
> in wp-admin"].
>
> Working tree state: [clean / has uncommitted changes from X].
>
> Operating rules from CLAUDE.md: plan first then ask approval; don't
> run git commands; don't guess — say so if you don't know.

Don't repeat project context in the briefing message — the handoff
covers it.

**Tailwind 4 gotcha worth remembering:** if utility classes appear in HTML but
produce no visual effect, restart the watcher (`Ctrl+C` then `npm run dev`)
before debugging anything else. Tailwind 4's class scanner can silently miss new
utilities introduced in PHP files.

[↑ Back to top](#table-of-contents)

---

## 14. Contact

- **Project owner:** Dr. Henry Macartney (macartneyhenry@gmail.com / +49 173
  3439 130)
- **Clients:** Frau Birgit Kretzschmar, Herr Dr. Alexander Kretzschmar (
  Wiesbaden)
- **Repository:** github.com/henrymacartney/praxis_kretzschmar

[↑ Back to top](#table-of-contents)
