# Praxis Kretzschmar — Project Handoff

**Author:** Dr. Henry Macartney  
**Document version:** Wednesday, 6 May 2026  
**Project:** Two German psychotherapy practice websites  
**Repository:** github.com/henrymacartney/praxis_kretzschmar  
**Local development:** birgit-kretzschmar.local (Local by Flywheel)  

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
│   └── content-inventory/                              ← content extracted from old sites
│       ├── birgit_text_content.md
│       ├── birgit_image_inventory.md
│       ├── birgit_content_map.md
│       ├── alex_text_content.md
│       ├── alex_image_inventory.md
│       └── alex_content_map.md
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
│       ├── tailwind.css                                ← source CSS, @theme tokens, @source dirs
│       ├── package.json / package-lock.json
│       ├── page-ueber-mich.php                         ← Über mich page template (Step 9)
│       ├── template-leistung.php                       ← individual Leistung pages (Step 10)
│       ├── template-leistungen-overview.php            ← Leistungen overview with auto-listed children
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

### Commits on GitHub (15 total, linear history)

```
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

**Note:** Step 10 (Leistung template + Leistungen overview) is NOT YET COMMITTED. Local-only.

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

### Content inventories (committed)

For each practitioner, three Markdown files in `docs/content-inventory/`:

- `*_text_content.md` — text from old site, organized by page, cleaned to Markdown
- `*_image_inventory.md` — image library inventory with dimensions and groupings
- `*_content_map.md` — proposed mapping to new-site pages, gaps, decisions

These are working documents. The Kretzschmars are expected to revise the texts before final integration.

### Step 10 — Leistung template (in progress, NOT committed)

- `template-leistung.php` created — shared page template for individual Leistung pages
- ACF field group "Leistung" with 7 visible fields + 1 Repeater (Sections):
  - `leistung_tagline` (text)
  - `leistung_lead_image` (image)
  - `leistung_intro` (wysiwyg)
  - `leistung_sections` (Repeater: heading + body + image per row)
  - `leistung_quote` (text)
  - `leistung_cta_text` (text, default "Termin vereinbaren")
  - `leistung_cta_link` (URL)
- `template-leistungen-overview.php` — auto-lists child Leistung pages as cards on `/leistungen/`
- Tanztherapie page populated with real content and lead image; renders correctly at `/leistungen/tanztherapie/`
- Three other therapy pages created (Paartherapie, Weiterbildungen, Psychotraumatherapie) but ACF fields not yet populated
- Termine page created (default template, content not yet built)
- Page hierarchy: four therapy pages now have `parent = Leistungen`, URLs become `/leistungen/<therapy>/`
- Menu restructured: Leistungen has the four therapies as nested children

### Step 10.4.4 (dropdown menu CSS) — NOT YET DONE

The CSS to make the desktop dropdown work and mobile show indented children was prepared but not yet applied. **This is where work paused.**

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
| Tailwind 4 (not 3) | Modern `@theme` syntax cleaner; more performant build |
| Self-host Google Fonts before launch | DSGVO requirement (German practice cannot leak visitor IPs to Google) — TODO, not done yet |

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
- Stock images from Unsplash (free commercial license) used as placeholders for the four Leistung lead images:
  - `tanztherapie.jpg` (Tokyo subway/escalator space — concerns flagged but using anyway)
  - `paartherapie.jpg` (two dark wooden chairs)
  - `weiterbildungen.jpg` (open book reflected on surface)
  - `psychotraumatherapie.jpg` (calm lake reflection)
- All four uploaded to Birgit's Media Library
- Stock image for Termine (`termine.jpg`) downloaded but not yet wired to a page (no Termine template yet)

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

## 8. Current State (As of 6 May 2026)

### What's working

- Homepage renders with Birgit-specific content (real headline, subtitle, welcome text)
- Über mich page renders with bio, portrait, qualifications, werdegang, CTA
- Tanztherapie page renders complete (hero, lead image, intro, three sections, quote, CTA)
- Three other therapy pages exist but show only their title (ACF fields empty)
- Termine page exists but is empty (default template, no custom content yet)
- Leistungen overview page exists with intro paragraph, auto-lists the four therapy pages as cards
- Mobile navigation works (hamburger toggles dropdown panel)
- Desktop navigation works as flat 5-item nav (Startseite, Über mich, Leistungen, Termine, Kontakt)

### What's NOT working / NOT yet done

- **Desktop dropdown for Leistungen** — the four therapy pages are children in the menu but the CSS to show them as a hover dropdown hasn't been added yet
- **Mobile inline display of submenu** — same issue, the children exist in markup but aren't visible until CSS is added
- **Three of four therapy pages have empty ACF fields** — Tanztherapie is populated; Paartherapie, Weiterbildungen, Psychotraumatherapie are not
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

These are sitting on the local machine but not pushed to GitHub:

- `template-leistung.php` (new file)
- `template-leistungen-overview.php` (new file)
- ACF field group "Leistung" (created in wp-admin, exists in DB)
- Pages: Tanztherapie populated, Paartherapie/Weiterbildungen/Psychotraumatherapie/Termine created empty
- Tanztherapie reparented to Leistungen
- Menu restructured (four therapies indented under Leistungen)
- Four Leistung images uploaded to Media Library
- Termine image (`termine.jpg`) uploaded but not wired to anything

**Action required:** When ready to commit, the staging command needs to capture the new template files. ACF field group changes are stored in the database, NOT in the file system, so they don't appear in `git status` — they should be exported to JSON via ACF's export tool and committed separately. *(Not yet done.)*

---

## 9. Where Work Paused

The last instruction sent (and not yet acted on) was Step 10.4.4a — the CSS for the desktop dropdown menu and mobile inline display.

The CSS was prepared and ready to paste into `tailwind.css`:

```css
/* Hide all sub-menus by default */
.sub-menu { display: none; }

@media (min-width: 768px) {
    .menu-item-has-children { position: relative; }
    .menu-item-has-children:hover > .sub-menu,
    .menu-item-has-children:focus-within > .sub-menu { display: block; }
    .sub-menu {
        position: absolute; top: 100%; left: 0;
        margin-top: 0.25rem; min-width: 14rem;
        background-color: var(--color-cream-50);
        border: 1px solid var(--color-cream-200);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        padding: 0.5rem 0; z-index: 50;
    }
    /* …list item styles… */
}

@media (max-width: 767px) {
    [data-mobile-nav-panel] .sub-menu {
        display: block; padding-left: 1rem; margin-top: 0.5rem;
    }
}
```

Full version is in the conversation history.

---

## 10. What's Next (Priority Order)

### Immediate

1. **Apply the dropdown CSS** (Step 10.4.4a) — get the desktop dropdown and mobile indent working
2. **Commit Step 10** — large commit covering:
  - `template-leistung.php`
  - `template-leistungen-overview.php`
  - The dropdown CSS in `tailwind.css`
  - ACF field group export (JSON, in `acf-json/` folder so it autoloads)
3. **Verify final menu** — five top-level items, hover-expand for Leistungen on desktop, indented inline on mobile

### Short-term (next 2-3 sessions)

4. **Populate Paartherapie, Weiterbildungen, Psychotraumatherapie ACF fields** with real content from `docs/content-inventory/birgit_text_content.md` — but only as starting points; Birgit will revise
5. **Build Termine page template** with appointment-booking content
6. **Build Kontakt page template** including the Datenschutzerklärung
7. **Decide what to do with the Praxis page** (currently exists, not in menu, content unclear)

### Medium-term

8. **Birgit's child theme** — scaffold `shared/themes/birgit_child/`
9. **Self-host Google Fonts** (DSGVO compliance)
10. **Image optimization** — compress the 12 MB portrait
11. **Impressum and Datenschutzerklärung pages** (legally required, lawyer review)
12. **Pre-launch hardening:**
  - Caching plugin (e.g. WP Super Cache or W3 Total Cache)
  - Security plugin (e.g. Wordfence)
  - SEO redirect map: old `?page_id=X` → new clean URLs
13. **SDLC documentation** (URS, RA, FRS, Test Plan, RTM)

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
4. **Replacement images for Tanztherapie and Weiterbildungen** — the current placeholders (Tokyo subway, train notebook) are demo-acceptable but not on-brand. Birgit should approve or replace.
5. **Mobile dropdown UX** — current plan is "always show inline indented." Alternative: tap-to-expand. Decision can be deferred.
6. **Werdegang page section** — currently has placeholder "Weitere Stationen ergänze ich in Kürze." Birgit needs to fill in.

---

## 12. How to Resume Work

To continue this project after a break:

1. **Pull latest from GitHub:** `git pull origin main`
2. **Start Local by Flywheel** and confirm Birgit's site is running
3. **Open the project in PHPStorm**
4. **Start the Tailwind watcher** in terminal: `cd shared/themes/praxis_base && npm run dev`
5. **Verify the site loads:** `http://birgitkretzschmar.local/`
6. **Review this handoff doc** to remember where we paused
7. **Pick up at "Where Work Paused"** (Section 9)

The next chat session should reference this document and the linear commit history. The conversation history of how we got here is preserved in journals/transcripts but isn't required reading — the code, commits, content inventory files, and this handoff carry the full context needed to continue.

---

## 13. Contact

- **Project owner:** Dr. Henry Macartney (macartneyhenry@gmail.com / +49 173 3439 130)
- **Clients:** Frau Birgit Kretzschmar, Herr Dr. Alexander Kretzschmar (Wiesbaden)
- **Repository:** github.com/henrymacartney/praxis_kretzschmar