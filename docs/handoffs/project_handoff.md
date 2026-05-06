# Praxis Kretzschmar — Project Handoff 

**Author:** Dr. Henry Macartney  
**Document version:** Wednesday, 6 May 2026 (afternoon update)  
**Project:** Two German psychotherapy practice websites  
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
8. [Current State (As of 6 May 2026, afternoon)](#8-current-state-as-of-6-may-2026-afternoon)
9. [Where Work Paused](#9-where-work-paused)
10. [What's Next (Priority Order)](#10-whats-next-priority-order)
11. [Open Questions / Decisions Pending](#11-open-questions--decisions-pending)
12. [How to Resume Work](#12-how-to-resume-work)
13. [Contact](#13-contact)

---

## 1. Project Overview

### What this project is

A WordPress build for two related psychotherapy practices in Wiesbaden:

- **Frau Birgit Kretzschmar** — Heilpraktikerin für Psychotherapie. Körperzentrierte Psychotherapie, Tanztherapie, Paartherapie, Weiterbildungen, Psychotraumatherapie. Private Praxis.
- **Herr Dr. Alexander Kretzschmar** — Psychologischer Psychotherapeut mit Kassenzulassung. Tiefenpsychologisch fundierte Psychotherapie, Hypnotherapie, Psychoonkologie, Coaching, Gestalttherapie. Kassen- und Privatpraxis.

Both share physical premises in Wiesbaden but operate as separate practices with separate websites and separate domains.

### Strategy

- **Two separate WordPress sites**, sharing a parent theme (`praxis_base`)
- **Each site has a child theme** for practice-specific overrides (Birgit's child theme exists in scaffolding form; Alex's not yet started)
- **Both old domains preserved** for SEO continuity and patient memory:
  - `birgit-kretzschmar.de` (Birgit)
  - `kretzschmar-wiesbaden.de` (Alex)
- **Email infrastructure separate from websites** — Outlook/365 + Kassenärztliches/KV-SafeNet for Alex's Kassenpraxis correspondence

### Commercial structure

Formal proposal sent and awaiting client response (proposal document at `docs/angebot_praxen_kretzschmar.docx`):

- **Total:** €1.500 fixed price
- **Duration:** 18 working days
- **Strato → Hostinger migration:** included as Goodwill (unbilled)
- **Methodology:** GAMP-5-inspired SDLC documentation (URS, RA, FRS, Test Plan, RTM)
- **Hosting:** Hostinger Premium (~€3-4/month each, paid by clients directly)
- **License:** ACF Pro Freelancer license (paid by Henry, charged through)

Seven work packages defined in the proposal. Currently executing through them.

---

## 2. Tech Stack

| Layer | Choice | Notes |
|---|---|---|
| CMS | WordPress 6.9.4 | Latest stable |
| PHP | 8.2.27 | Local by Flywheel default |
| Database | MySQL 8.0.35, charset utf8mb4 | Local default |
| CSS | Tailwind 4 | Custom design tokens via `@theme` block; build pipeline via npm |
| Custom fields | ACF Pro 6.5+ | Note: UI changed significantly from older versions |
| ACF Local JSON | `acf-json/` folder in theme root | Auto-saves field group changes; auto-loads on activation |
| Build tool | npm + Tailwind CLI | `npm run dev` watches and rebuilds on save |
| Local dev | Local by Flywheel | Site at `http://birgitkretzschmar.local/` (note: hyphen stripped by Local) |
| Version control | git + GitHub | Linear history on `main` branch |
| Production deployment (planned) | Hostinger Premium + All-in-One WP Migration plugin | Not yet executed |

---

## 3. Project Structure

```
praxis_kretzschmar/                                    ← project root
├── .git/                                               ← single repo
├── .gitignore                                          ← excludes build/, node_modules/, sites/
├── CLAUDE.md                                           ← project rules (committed)
├── docs/
│   ├── angebot_praxen_kretzschmar.docx                ← formal proposal (sent)
│   ├── content-inventory/                              ← content extracted from old sites
│   │   ├── birgit_text_content.md
│   │   ├── birgit_image_inventory.md
│   │   ├── birgit_content_map.md
│   │   ├── alex_text_content.md
│   │   ├── alex_image_inventory.md
│   │   └── alex_content_map.md
│   └── handoffs/                                       ← project handoff artefacts
│       ├── project_handoff.md                          ← this document
│       └── previous_chat.md                            ← conversation log from Step 10 session
├── migration_strato_to_hostinger/                      ← Strato→Hostinger migration plan
│   ├── docs/
│   │   └── hostinger_umzug.pdf
│   └── plan_strato_hostinger/                          ← markdown plan drafts
├── resources/                                          ← OFF-LIMITS per CLAUDE.md
│   └── birgit-kretzschmar.de/                          ← raw old-site source files
├── shared/themes/
│   └── praxis_base/                                    ← parent theme (committed)
│       ├── functions.php                               ← theme bootstrap, enqueues, hooks
│       ├── header.php / footer.php                     ← document chrome only
│       ├── front-page.php                              ← homepage (reads ACF fields)
│       ├── page.php / index.php                        ← fallback templates
│       ├── style.css                                   ← WP theme detection only
│       ├── tailwind.css                                ← source CSS, @theme tokens, dropdown CSS
│       ├── package.json / package-lock.json
│       ├── page-ueber-mich.php                         ← Über mich page template (Step 9)
│       ├── template-leistung.php                       ← individual Leistung pages (Step 10)
│       ├── template-leistungen-overview.php            ← Leistungen overview with auto-listed children
│       ├── acf-json/                                   ← ACF field group definitions (auto-managed)
│       │   ├── group_69f9d6b401bba.json                ← Über mich field group
│       │   └── group_69f9f7c7c674f.json                ← Leistung field group
│       ├── template-parts/
│       │   ├── site-header.php                         ← logo, nav, mobile menu panel
│       │   └── site-footer.php                         ← footer
│       ├── assets/js/
│       │   └── mobile-nav.js                           ← hamburger toggle (Step 8)
│       ├── build/
│       │   └── theme.css                               ← compiled Tailwind (gitignored)
│       └── node_modules/                               ← gitignored
└── sites/                                              ← gitignored
    └── birgit/ (symlink to Local by Flywheel site)
        └── app/public/                                 ← actual WordPress install
```

### Files NOT in version control (gitignored)

- `shared/themes/praxis_base/build/` (compiled CSS rebuilt on each `npm run dev`)
- `shared/themes/praxis_base/node_modules/`
- `sites/` (entire Local by Flywheel installation)
- `resources/` (raw materials, off-limits)

---

## 4. What's Been Accomplished

### Commits on GitHub (16 total, linear history)

```
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
- Design system established: navy `#1B3A5C` + warm cream `#FDFBF5` + warm stone neutrals; Cormorant Garamond display + Inter sans
- Design tokens defined as CSS custom properties in `@theme` block
- Navigation menus registered (primary + footer)
- Header/footer extracted into `template-parts/` for reuse
- Gutenberg disabled on the Startseite (homepage uses ACF, not blocks)

### Step 8 — Mobile navigation (committed)

- Hamburger button visible only below `md` breakpoint (768px)
- Tappable hamburger toggles a dropdown panel with the menu
- Vanilla JS, ~25 lines, no library dependencies
- Accessibility: `aria-expanded` and `aria-label` toggle in sync
- Verified working on iPhone 12 viewport

### Step 9 — Über mich page (committed)

- Page template `page-ueber-mich.php` (auto-applied to slug `ueber-mich`)
- ACF field group "Über mich" with 5 fields:
  - `ueber_mich_tagline` (text)
  - `ueber_mich_portrait` (image)
  - `ueber_mich_bio` (wysiwyg)
  - `ueber_mich_qualifikationen` (Repeater: bezeichnung + detail)
  - `ueber_mich_werdegang` (wysiwyg)
- Page populated with real biographical content (4 qualifications, bio, portrait)
- Layout: hero + two-column (portrait left, bio right) + qualifications list + werdegang + CTA
- Field group exported to `acf-json/group_69f9d6b401bba.json` (in Step 10 commit)

### Content inventories (committed)

For each practitioner, three Markdown files in `docs/content-inventory/`:

- `*_text_content.md` — text from old site, organized by page, cleaned to Markdown
- `*_image_inventory.md` — image library inventory with dimensions and groupings
- `*_content_map.md` — proposed mapping to new-site pages, gaps, decisions

These are working documents. The Kretzschmars are expected to revise the texts before final integration.

### Step 10 — Leistung pages (committed as 8dac51d)

**Template & infrastructure:**

- `template-leistung.php` — shared page template for individual Leistung pages
- `template-leistungen-overview.php` — auto-lists child Leistung pages as cards on `/leistungen/`
- ACF field group "Leistung" with 7 visible fields + 1 Repeater:
  - `leistung_tagline` (text)
  - `leistung_lead_image` (image)
  - `leistung_intro` (wysiwyg)
  - `leistung_sections` (Repeater: heading + body)
  - `image` (image, top-level — currently unused)
  - `leistung_quote` (text)
  - `leistung_cta_text` (text, default "Termin vereinbaren")
  - `leistung_cta_link` (URL)
- Field group exported to `acf-json/group_69f9f7c7c674f.json`
- ACF Local JSON folder `acf-json/` established as canonical store for field group definitions

**Navigation:**

- Page hierarchy: four therapy pages have `parent = Leistungen`, URLs are `/leistungen/<therapy>/`
- Menu restructured: Leistungen has the four therapies as nested children
- Dropdown CSS applied to `tailwind.css`:
  - Desktop (≥768px): hover-revealed dropdown panel with cream background and shadow
  - Mobile (<768px): inline display below parent in mobile nav panel
- Verified working on desktop and iPhone 12 viewport

**Content populated (Birgit's site):**

- Tanztherapie — full content + lead image
- Paartherapie — full content + lead image
- Weiterbildungen — full content + lead image
- Psychotraumatherapie — full content + lead image (4 sections)

All four pages use voice-matched, modernised German copy drawn from `docs/content-inventory/birgit_text_content.md` and the practitioner's qualifications. Birgit will review and revise.

**Note on field schema:** The Repeater has `heading` and `body` subfields only. The template (`template-leistung.php`) reads `$section['image']` per-section, but no per-section image subfield exists — all four pages were populated with section images blank, so this discrepancy is currently invisible. If per-section images are wanted in future, the Repeater needs an `image` subfield added.

### Documentation handoff (committed as part of 8dac51d)

- `docs/handoffs/project_handoff.md` — this document
- `docs/handoffs/previous_chat.md` — full conversation log from the Step 10 session

---

## 5. Key Decisions Made

### Architecture

| Decision | Rationale |
|---|---|
| Two separate WordPress sites (not multisite) | Simpler deployment, independent failure modes, separate hosting plans, no cross-contamination of plugins/themes |
| Shared parent theme + child themes | DRY for design system; child themes give per-practice override capability |
| Both old domains kept | SEO continuity, patients have memorized URLs over years |
| Email kept entirely separate from web | Different security profiles (Kassenärztliches requires KV-SafeNet); no SMTP entanglement |
| ACF Pro for content fields | Established WordPress pattern; less custom code than custom post types |
| ACF Local JSON for version control | Field group definitions live in `acf-json/` and travel with the codebase |
| Tailwind 4 (not 3) | Modern `@theme` syntax cleaner; more performant build |
| Self-host Google Fonts before launch | DSGVO requirement (German practice cannot leak visitor IPs to Google) — TODO, not done yet |
| Modernised voice for therapy page copy | Plain register replacing academic source text; matches reference sites (Kappel, Zentrum-Psychotherapie); subject to Birgit's review |

### Content & Pages

**Birgit's seven pages** (confirmed by Birgit personally):

1. Über mich
2. Tanztherapie
3. Paartherapie
4. Weiterbildungen *(plural, confirmed by Birgit)*
5. Psychotraumatherapie
6. Termine
7. Kontakt

Plus an overview page:
- **Leistungen** (parent of the four therapy pages, auto-lists them)

The Praxis page that originally appeared in scaffolding has not been confirmed by Birgit. Currently NOT in the menu but the page still exists as a draft. **Decision pending: bin it, or ask Birgit if she wants it.**

**Alex's nine pages** (per his old-site published structure, which he confirmed):

1. Über mich
2. Psychotherapie *(general intro)*
3. Tiefenpsychologie
4. Gestalttherapie
5. Psychoonkologie
6. Hypnotherapie
7. Coaching
8. Praxis
9. Kontakt

Note differences from Birgit: Alex has Praxis, Birgit doesn't. Birgit has Termine, Alex doesn't. This asymmetry is intentional and reflects the different practice styles.

### Slug strategy

- **Birgit's old slugs were a mess** (titles and slugs mismatched due to a botched site-merge attempt). Slugs were corrected when creating new pages.
- **Alex's old slugs are clean** — they map directly to new slugs, no rewriting needed.
- **Four therapy pages now nested under `/leistungen/`** — URLs are `/leistungen/tanztherapie/` etc. Pre-launch redirect map will need to handle old `/tanztherapie/` → new `/leistungen/tanztherapie/`.

### Image strategy

- Birgit's portrait at 3648×5472 (high-quality DSLR) — already in Media Library
- Practice photos (Wartezimmer, Therapieraum, Haus) — same files appear in both Birgit's and Alex's old image libraries since they share premises
- Five Unsplash images (free commercial license) used as Lead Images for the Leistung pages and Termine. After two iterations of search-and-review, the four therapy lead images were selected by Henry browsing curated Unsplash search URLs:
  - `leistung-tanztherapie.jpg`
  - `leistung-paartherapie.jpg` (two dark wooden chairs — strong visual)
  - `leistung-weiterbildungen.jpg`
  - `leistung-psychotrauma.jpg` (calm lake reflection — strong visual)
  - `termine.jpg` (downloaded but not yet wired to a page; no Termine template yet)
- All five uploaded to Birgit's Media Library

---

## 6. Credentials & Access Details

### GitHub
- Repository: `github.com/henrymacartney/praxis_kretzschmar`
- Owner: Henry (henrymacartney)
- Branch: `main` (linear history)
- Commit author: Henry (macartneyhenry@gmail.com)

### Local WordPress (Birgit's site)
- URL: `http://birgitkretzschmar.local/` (no hyphen — Local by Flywheel stripped it)
- WP Admin: `http://birgitkretzschmar.local/wp-admin/`
- Admin user: `admin`
- Admin password: `admin`
- Database: managed by Local by Flywheel (Adminer accessible via Local's "Database" tab)

### Anthropic (ACF Pro license)
- ACF Pro Freelancer license (paid by Henry)
- Activated on Birgit's local site

### Production (planned, not yet provisioned)
- Hostinger Premium for Birgit (planned)
- Hostinger Premium for Alex (planned)
- Domains stay with Strato (DNS pointing to Hostinger after cutover)

### Outlook/Microsoft 365 for email
- Birgit and Alex use existing email accounts (not part of this project)
- Critically: Alex's Kassenpraxis correspondence uses KV-SafeNet — must NOT be touched

---

## 7. Project Rules (CLAUDE.md)

The project has strict working rules in `CLAUDE.md`. Key points:

- **`resources/birgit-kretzschmar.de/` is OFF-LIMITS** — original old-site files. Do not read, modify, or copy from this folder without explicit permission.
- **Always show plan before doing anything; await approval.**
- **Always specify which files/folders will be touched.**
- **Always provide rollback plan.**
- **Henry runs ALL Git/GitHub operations.** Claude (or any AI assistant) should never run `git` commands.
- **Although Claude (and other AI assistants) do not issue/run `git`commands
  they should prompt when to run `git` making a suitable commit statement
  suggestion.**
- **Never guess.** If uncertain, say so.
- Be evidence-driven, not speculative.

---

## 8. Current State (As of 6 May 2026, afternoon)

### What's working

- Homepage renders with Birgit-specific content (real headline, subtitle, welcome text)
- Über mich page renders with bio, portrait, qualifications, werdegang, CTA
- All four therapy pages render complete (hero, lead image, intro, sections, quote, CTA):
  - Tanztherapie
  - Paartherapie
  - Weiterbildungen
  - Psychotraumatherapie
- Leistungen overview page exists with intro paragraph, auto-lists the four therapy pages as cards
- Mobile navigation works (hamburger toggles dropdown panel)
- Desktop navigation works with hover dropdown for Leistungen
- Mobile navigation shows the four therapies inline below Leistungen

### What's NOT working / NOT yet done

- **Termine page** — empty, no custom template yet
- **Kontakt page** — exists but empty, no custom template yet
- **Self-hosting Google Fonts** — currently loaded from Google CDN (DSGVO problem, must fix before launch)
- **Image optimization** — none applied yet (the 12 MB Birgit portrait original is in the media library)
- **Caching plugin** — none installed
- **Security plugin** — none installed
- **Impressum and Datenschutzerklärung pages** — not yet created (legally required, content needs lawyer review)
- **SEO redirect map** — not yet created (old `?page_id=X` URLs need to redirect to new clean URLs)

### What's NOT YET STARTED

- **Alex's site entirely** — no Local site exists yet, no child theme scaffolded, no content populated
- **Birgit's child theme** — `shared/themes/birgit_child/` exists in concept only, not actually scaffolded
- **Alex's child theme** — not started
- **Hostinger deployment** — accounts not provisioned, no DNS planning yet
- **SDLC documentation** (Work Package 1 of the proposal) — URS, RA, FRS, Test Plan, RTM not yet drafted
- **Pre-launch hardening** — performance, security, DSGVO compliance review

### Uncommitted local changes

State of repo and database after the 6 May afternoon session:

- **Repo:** clean (no uncommitted file changes; everything from Step 10 is in commit `8dac51d`)
- **Database:** Tanztherapie, Paartherapie, Weiterbildungen, Psychotraumatherapie pages populated with full ACF content. This content lives in `wp_postmeta` and is NOT in git. It travels to production via the All-in-One WP Migration plugin at deploy time.

---

## 9. Where Work Paused

The 6 May session ended cleanly with all four therapy pages populated and Step 10 committed. The next natural pieces of work are:

1. Update this handoff document (in progress as the last action of the session)
2. Build the Termine page template
3. Build the Kontakt page template

No half-finished work, no broken state. Resume from any of these.

---

## 10. What's Next (Priority Order)

### Immediate

1. **Build Termine page template** — Birgit needs a way to publish appointment-availability information; image asset (`termine.jpg`) is already in the Media Library awaiting use
2. **Build Kontakt page template** — practice address, phone, email, contact form, DSGVO notice; coordinates with Impressum/Datenschutz work below
3. **Decide what to do with the Praxis page** (currently exists as draft, not in menu, content unclear — ask Birgit or bin)

### Short-term

4. **Birgit's child theme** — scaffold `shared/themes/birgit_child/`
5. **Self-host Google Fonts** (DSGVO compliance)
6. **Image optimization** — compress the 12 MB portrait
7. **Impressum and Datenschutzerklärung pages** (legally required, lawyer review)
8. **Footer content** — replace placeholder with proper site footer (links, address, legal)

### Medium-term

9. **Pre-launch hardening:**
  - Caching plugin (e.g. WP Super Cache or W3 Total Cache)
  - Security plugin (e.g. Wordfence)
  - SEO redirect map: old `?page_id=X` → new clean URLs
10. **Cross-browser / mobile QA** — beyond the iPhone 12 preset, real device testing
11. **Performance + accessibility audit** — Lighthouse, alt text review, headings hierarchy
12. **SDLC documentation** (URS, RA, FRS, Test Plan, RTM)
13. **Birgit content review pass** — sit with Birgit, walk through every populated page, capture her edits

### Alex's parallel build

14. **Local site for Alex** (`alexander_kretzschmar` on Local by Flywheel)
15. **Alex's child theme**
16. **Populate Alex's nine pages** using same Leistung template pattern
17. **Domain redirect strategy** for old `kretzschmar-wiesbaden.de` URLs

### Production

18. **Hostinger account provisioning** (Premium plan x2)
19. **Domain DNS planning** (Strato A records → Hostinger nameservers)
20. **Migration via All-in-One WP Migration plugin**
21. **Pre-launch testing** (Test Plan execution from Work Package 6)
22. **Hand-off PDF guide** for Birgit/Alex on how to edit content via wp-admin

---

## 11. Open Questions / Decisions Pending

1. **Praxis page on Birgit's site** — keep, bin, or ask Birgit?
2. **Praxis photo strategy** — both practices share the same physical premises and image files. On the new sites, should they each upload their own copy, or share via a parent-theme media folder?
3. **Singular vs plural Leistungen page intro** — the page is "Leistungen" but the parent of just four items. Could rename to "Therapieangebote" if Birgit prefers.
4. **Therapy page copy review** — current copy is Henry's modernised draft drawn from source content. Birgit needs to read and revise. Particularly Tanztherapie and Psychotraumatherapie, which are her core specialisms.
5. **Mobile dropdown UX** — current behaviour: therapies show inline below Leistungen, centered. Alternatives considered (left-aligned indentation, tap-to-expand) deferred. Birgit may have a view.
6. **Werdegang page section** — currently has placeholder "Weitere Stationen ergänze ich in Kürze." Birgit needs to fill in.
7. **Repeater image subfield** — the Leistung Repeater has no per-section image. The template assumes one. Currently invisible because no page uses per-section images. Decide whether to add the subfield (clean) or remove the template's reference (also clean).

---

## 12. How to Resume Work

To continue this project after a break:

1. **Pull latest from GitHub:** `git pull origin main`
2. **Start Local by Flywheel** and confirm Birgit's site is running
3. **Open the project in PHPStorm**
4. **Start the Tailwind watcher** in terminal: `cd shared/themes/praxis_base && npm run dev`
5. **Verify the site loads:** `http://birgitkretzschmar.local/`
6. **Review this handoff doc** to remember where we paused
7. **Pick up at "What's Next"** (Section 10)

The next chat session should reference this document and the linear commit history. The conversation history of how we got here is preserved in `docs/handoffs/previous_chat.md` but isn't required reading — the code, commits, content inventory files, and this handoff carry the full context needed to continue.

---

## 13. Contact

- **Project owner:** Dr. Henry Macartney (macartneyhenry@gmail.com / +49 173 3439 130)
- **Clients:** Frau Birgit Kretzschmar, Herr Dr. Alexander Kretzschmar (Wiesbaden)
- **Repository:** github.com/henrymacartney/praxis_kretzschmar