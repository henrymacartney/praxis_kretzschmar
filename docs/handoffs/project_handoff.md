# Praxis Kretzschmar — Project Handoff

**Author:** Dr. Henry Macartney  
**Document version:** Thursday, 7 May 2026 (mid-afternoon update)  
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
8. [Current State (As of 7 May 2026, mid-afternoon)](#8-current-state-as-of-7-may-2026-mid-afternoon)
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
- **Each site has a child theme** for practice-specific overrides (Birgit's
  child theme exists in scaffolding form; Alex's not yet started)
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

---

## 2. Tech Stack

| Layer                           | Choice                                             | Notes                                                                                                   |
|---------------------------------|----------------------------------------------------|---------------------------------------------------------------------------------------------------------|
| CMS                             | WordPress 6.9.4                                    | Latest stable                                                                                           |
| PHP                             | 8.2.27                                             | Local by Flywheel default                                                                               |
| Database                        | MySQL 8.0.35, charset utf8mb4                      | Local default                                                                                           |
| CSS                             | Tailwind 4                                         | Custom design tokens via `@theme` block; build pipeline via npm                                         |
| Custom fields                   | ACF Pro 6.5+                                       | Note: UI changed significantly from older versions                                                      |
| ACF Local JSON                  | `acf-json/` folder in theme root                   | Auto-saves field group changes; auto-loads on activation                                                |
| Build tool                      | npm + Tailwind CLI                                 | `npm run dev` watches and rebuilds on save. Worth restarting if utility classes silently fail to apply. |
| Local dev                       | Local by Flywheel                                  | Site at `http://birgitkretzschmar.local/` (note: hyphen stripped by Local)                              |
| Version control                 | git + GitHub                                       | Linear history on `main` branch                                                                         |
| Contact form                    | Contact Form 7 (CF7)                               | German labels, DSGVO consent checkbox, basic styling matching design system                             |
| Production deployment (planned) | Hostinger Premium + All-in-One WP Migration plugin | Not yet executed                                                                                        |

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
│   └── praxis_base/                                    ← parent theme (committed)
│       ├── functions.php                               ← theme bootstrap; declares custom-logo support
│       ├── header.php / footer.php                     ← document chrome only
│       ├── front-page.php                              ← homepage (reads ACF fields, includes gallery)
│       ├── page.php / index.php                        ← fallback templates
│       ├── style.css                                   ← WP theme detection only
│       ├── tailwind.css                                ← source CSS, @theme tokens, dropdown CSS, CF7 styles
│       ├── package.json / package-lock.json
│       ├── page-ueber-mich.php                         ← Über mich page template (Step 9)
│       ├── template-leistung.php                       ← individual Leistung pages (Step 10)
│       ├── template-leistungen-overview.php            ← Leistungen overview with auto-listed children
│       ├── template-termine.php                        ← Termine page with past-events disclosure (Step 11)
│       ├── template-kontakt.php                        ← Kontakt page with form (Step 12)
│       ├── template-legal.php                          ← shared template for Impressum/Datenschutz (Step 12)
│       ├── acf-json/                                   ← ACF field group definitions (auto-managed)
│       │   ├── group_69f9d6b401bba.json                ← Über mich field group
│       │   ├── group_69f9f7c7c674f.json                ← Leistung field group
│       │   ├── group_69fb1caeb8462.json                ← Termine field group
│       │   ├── group_69fb3e588f366.json                ← Kontakt field group
│       │   └── group_69f1eb4c7058a.json                ← Homepage field group (incl. Galerie Repeater)
│       ├── template-parts/
│       │   ├── site-header.php                         ← logo, brand text, nav, mobile menu, sticky positioning
│       │   └── site-footer.php                         ← footer
│       ├── assets/js/
│       │   ├── mobile-nav.js                           ← hamburger toggle (Step 8)
│       │   └── past-termine-toggle.js                  ← past-events disclosure label toggle (Step 11)
│       ├── build/
│       │   └── theme.css                               ← compiled Tailwind (gitignored)
│       └── node_modules/                               ← gitignored
└── sites/                                              ← gitignored
    └── birgit/ (symlink to Local by Flywheel site)
        └── app/public/                                 ← actual WordPress install
```

### Files NOT in version control (gitignored)

- `shared/themes/praxis_base/build/` (compiled CSS rebuilt on each
  `npm run dev`)
- `shared/themes/praxis_base/node_modules/`
- `sites/` (entire Local by Flywheel installation)
- `resources/` (raw materials, off-limits)
- `*.zip` files anywhere in the repo (added 7 May 2026)

---

## 4. What's Been Accomplished

### Recent commits on GitHub (most recent first)

```
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

**Alex's site direction (added 7 May 2026):**

Per the meeting, Alex initially said he didn't want changes; later reversed and
indicated he liked a previous one-pager design Henry showed him in 2024. That
reference design is in the local extracted reference at
`/Users/.../alex_ref/version_00_alex/` (a static HTML/CSS/JS one-pager with hero
background image of an anonymous therapist+patient, modal-based service details,
hamburger menu, contact form). The visual language and "anonymous
therapist+patient" hero motif is what Alex wants — **not** the static-HTML
implementation; that should be ported into the same WordPress + praxis_base
parent theme architecture used for Birgit.

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

---

## 7. Project Rules (CLAUDE.md)

The project has strict working rules in `CLAUDE.md`. Key points:

- **`resources/birgit-kretzschmar.de/` is OFF-LIMITS** — original old-site
  files. Do not read, modify, or copy from this folder without explicit
  permission.
- **Always show plan before doing anything; await approval.**
- **Always specify which files/folders will be touched.**
- **Always provide rollback plan.**
- **Henry runs ALL Git/GitHub operations.** Claude (or any AI assistant) should
  never run `git` commands.
- **Although Claude (and other AI assistants) do not issue/run `git` commands
  they should prompt when to run `git` making a suitable commit statement
  suggestion.**
- **Never guess.** If uncertain, say so.
- Be evidence-driven, not speculative.

---

## 8. Current State (As of 7 May 2026, mid-afternoon)

### What's working

- All seven of Birgit's pages render with real (placeholder) content
- Plus Leistungen overview, Impressum, Datenschutzerklärung
- Homepage three-image gallery
- Branded header with logo and wordmark
- Sticky navigation with subtle cream contrast against page sections
- Desktop and mobile navigation (hamburger + dropdown)
- Hover dropdown for Leistungen with four therapy items
- Footer with Startseite, Kontakt, Impressum, Datenschutzerklärung links
- Contact Form 7 on Kontakt page with German labels and DSGVO consent
- All "Kontakt aufnehmen" CTAs pointing to /kontakt/

### What's NOT working / NOT yet done

- **Self-hosting Google Fonts** — currently loaded from Google CDN (DSGVO
  problem, must fix before launch)
- **Image optimization** — none applied yet (the 12 MB Birgit portrait original
  is in the media library)
- **Caching plugin** — none installed
- **Security plugin** — none installed
- **Real Impressum and Datenschutz** — current placeholders are demo only;
  require lawyer review before launch
- **SEO redirect map** — not yet created (old `?page_id=X` URLs need to redirect
  to new clean URLs)
- **Praxis page on Birgit's site** — exists as draft, not in menu, should be
  deleted

### What's NOT YET STARTED

- **Alex's site entirely** — no Local site exists yet, no child theme
  scaffolded, no content populated
- **Birgit's child theme** — `shared/themes/birgit_child/` exists in concept
  only, not actually scaffolded
- **Alex's child theme** — not started
- **Hostinger deployment** — accounts not provisioned, no DNS planning yet
- **SDLC documentation** (Work Package 1 of the proposal) — URS, RA, FRS, Test
  Plan, RTM not yet drafted
- **Pre-launch hardening** — performance, security, DSGVO compliance review
- **Custom front-end editor** — agreed in principle in 6 May meeting (so Birgit
  can edit Termine and similar without entering wp-admin); scope and design
  pending

### Uncommitted local changes

- **Repo:** clean as of last push (commit `addc5a7`)
- **Database:** all populated content (homepage, Über mich, four therapy pages,
  Termine, Kontakt, Impressum, Datenschutz) lives in `wp_postmeta`. NOT in git.
  Travels to production via All-in-One WP Migration plugin at deploy time.

---

## 9. Where Work Paused

Birgit's site is demo-complete, reviewed by the Kretzschmars on 6 May 2026, and
approved with two specific changes (sticky nav, darker header — both completed
and approved by Birgit).
The Beriott engagement could expand to full IT support (proposal coming next
week?; separate from this project).

Active waiting on Birgit:

- Reworked text for all pages (delivery: before end-of-May vacation)
- Photos from Canadian Rockies vacation for therapy pages (delivery: same)

Henry's next focus:

- Updating handoff doc (this commit)
- Beginning Alex's site — extracting from his liked reference design

---

## 10. What's Next (Priority Order)

### Immediate

1. **Begin Alex's site:** create Local site `alex_kretzschmar`, scaffold child
   theme, port the visual language from his reference design into the
   praxis_base architecture
2. **Delete Birgit's draft "Praxis" page** to clean up wp-admin
3. **Self-host Google Fonts** (DSGVO compliance) — applies to both sites

### Short-term (before Birgit's vacation, end May 2026)

4. **Receive Birgit's reworked content + Canadian Rockies photos** — schedule a
   session to apply them
5. **Custom front-end editing tool design** — at minimum, a
   wireframe/specification for what Birgit wants to be able to edit without
   wp-admin (this came up unexpectedly in the meeting; see Section 12)
6. **Image optimization** — compress portraits and large images
7. **Birgit's child theme** — scaffold `shared/themes/birgit_child/` if there
   are practice-specific overrides
8. **Alex's child theme** — scaffold

### Medium-term (during Kretzschmars' 4-week vacation, June 2026)

9. **Build Alex's site to demo-complete state** in parallel
10. **Real Impressum and Datenschutz** for both sites — lawyer review;
    according to Alex review is not necessary - this has already been done
    and we can use Impressum and Datenschutzerklärung from old site (his
    responsibility not Beriott's)
11. **Pre-launch hardening:**

- Caching plugin (e.g. WP Super Cache or W3 Total Cache)
- Security plugin (e.g. Wordfence)
- SEO redirect map: old `?page_id=X` → new clean URLs

12. **Cross-browser / mobile QA**
13. **Performance + accessibility audit** — Lighthouse, alt text review,
    headings hierarchy
14. **SDLC documentation** (URS, RA, FRS, Test Plan, RTM) — derived from the URS
    interviews already conducted

### Production (target: before Kretzschmars return from vacation)

15. **Hostinger account provisioning** (Premium plan x2)
16. **Domain DNS planning** (Strato A records → Hostinger nameservers)
17. **Migration via All-in-One WP Migration plugin**
18. **Pre-launch testing** (Test Plan execution from Work Package 6)
19. **Hand-off PDF guide** for Birgit/Alex on how to edit content via wp-admin
    AND via the new front-end editor
20. **Custom front-end editor — final implementation**

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
9. **Alex's site shape** — port the one-pager visual language but probably
   retain the multi-page structure for SEO and content depth. To be decided in
   consultation with Alex.

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
- Henry explained the rate structure: post-URS changes at €105/hour. They
  accepted.
- **Beriott GmbH asked to take over the Kretzschmars' entire IT support.**
  Separate engagement from this website project; will be handled by another
  Beriott team. Proposal coming next week?

### Timelines agreed

- All Birgit-side content (texts + photos) delivered before her end-of-May
  vacation
- Kretzschmars away for 4 weeks during their vacation
- **Beriott has committed to delivering both sites by their return**

---

## 13. How to Resume Work

To continue this project after a break:

1. **Pull latest from GitHub:** `git pull origin main`
2. **Start Local by Flywheel** and confirm Birgit's site is running
3. **Open the project in PHPStorm**
4. **Start the Tailwind watcher** in terminal:
   `cd shared/themes/praxis_base && npm run dev`
5. **Verify the site loads:** `http://birgitkretzschmar.local/`
6. **Review this handoff doc** to remember where we paused
7. **Pick up at "What's Next"** (Section 10)

The next chat session should reference this document and the linear commit
history.

**Tailwind 4 gotcha worth remembering:** if utility classes appear in HTML but
produce no visual effect, restart the watcher (`Ctrl+C` then `npm run dev`)
before debugging anything else. Tailwind 4's class scanner can silently miss new
utilities introduced in PHP files.

---

## 14. Contact

- **Project owner:** Dr. Henry Macartney (macartneyhenry@gmail.com / +49 173
  3439 130)
- **Clients:** Frau Birgit Kretzschmar, Herr Dr. Alexander Kretzschmar (
  Wiesbaden)
- **Repository:** github.com/henrymacartney/praxis_kretzschmar