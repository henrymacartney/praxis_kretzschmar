# Praxis Kretzschmar — Internal Project Record

**Document type:** Internal project record / project summary  
**Prepared for:** Beriott GmbH (internal)  
**Prepared by:** Dr. Henry Macartney  
**Date:** 14 May 2026  
**Project:** Praxis Kretzschmar website build (`praxis_kretzschmar`)  
**Status:** Both sites live on Hostinger temporary (demo) domains; production
cutover pending; target go-live June 2026.  

---

## Table of Contents

- [1. Purpose of this document](#1-purpose-of-this-document)
- [2. Project at a glance](#2-project-at-a-glance)
- [3. Origin and commercial basis](#3-origin-and-commercial-basis)
- [4. The two practices and their websites](#4-the-two-practices-and-their-websites)
- [5. Technical architecture](#5-technical-architecture)
- [6. Content provenance and status](#6-content-provenance-and-status)
- [7. Development history](#7-development-history)
- [8. Documentation set](#8-documentation-set)
- [9. Current state](#9-current-state)
- [10. Outstanding work and path to go-live](#10-outstanding-work-and-path-to-go-live)
- [11. Risk posture](#11-risk-posture)
- [12. Scope tensions and decisions on record](#12-scope-tensions-and-decisions-on-record)
- [13. Future work beyond this project](#13-future-work-beyond-this-project)

---

## 1. Purpose of this document

This is the internal project record for the `praxis_kretzschmar` engagement.
It consolidates, in one place, what the project is, how it came about, how it
was built, where it stands, and what remains to be done at the end of the 
demo phase. There are two working temporary sites at the following links:  

https://lightpink-wolf-142779.hostingersite.com/  
https://springgreen-viper-610216.hostingersite.com/

This report is written for Beriott — it is candid about scope tensions and open risks in a way the
client-facing documents are not.

It is a summary, not a replacement for the underlying documents. Where detail
matters, it points to the governing document (the Angebot, the two URSs, the
project plan, the two risk analyses, the content inventories, the theme
source).

---

## 2. Project at a glance

Beriott was engaged to deliver **two WordPress websites** for two
psychotherapy practices that share a building in Wiesbaden and are run by two
members of the Kretzschmar family. The two sites are deliberately built as
**sibling sites on a shared parent theme** (`praxis_base`), so they read as
related practices while remaining independent.

- **Birgit Kretzschmar** — `birgit-kretzschmar.de` — Heilpraktikerin für
  Psychotherapie; body-oriented and dance-based practice. Runs on the
  `praxis_base` parent theme **directly**, no child theme.
- **Dr. Alexander Kretzschmar** — `kretzschmar-wiesbaden.de` —
  Psychologischer Psychotherapeut; Kassen- and Privatpraxis. Runs on the
  `alex_child` **child theme** over `praxis_base`, with a warm-red brand
  palette and a bespoke five-band homepage.

Both sites are content-driven through ACF field groups, built with a
Tailwind 4 pipeline, and were developed locally before migration to Hostinger
temporary domains for client review. Both are currently functional on those
demo domains. Production cutover to the real domains is the remaining major
phase, targeted for June 2026, before the Kretzschmars return from a summer
vacation.

The commercial value of the engagement is **€1,904 gross** (€1,600 net plus
19% VAT), a fixed-price quote, plus an optional ongoing monthly SEO retainer
and a €150/year running-costs package, neither of which is part of the build
itself.

---

## 3. Origin and commercial basis

The project's contractual basis is **Angebot AG0081**, issued by Beriott to
Dr. Alexander Kretzschmar on 5 May 2026 (valid to 19 May 2026, customer
number 10002). There was no separate written project brief — the Angebot is
the founding scope document, and the two URSs that exist are *retrospective*,
reconstructed from the delivered build rather than written in advance.

The Angebot breaks the engagement into six fixed-price positions:

| Pos. | Scope item | Net € |
|------|------------|-------|
| 1 | Consulting & project management — kickoff, scope and acceptance-criteria definition, technical advice, coordination to go-live | 180 |
| 2 | Website development — responsive WordPress build of two similarly-structured sites; per site: Startseite, Leistungs-/Informationsseiten, Über uns/Profil, Kontakt, legal pages; structuring of supplied content | 850 |
| 3 | SEO baseline — per-site SEO setup, on-page basics, titles/meta/heading structure, analytics/tracking setup "DSGVO-compliant via a consent solution" | 120 |
| 4 | Domain transfer & technical setup — transfer of two existing domains into the Hostinger environment, DNS, post-transfer function test | 170 |
| 5 | Handover & training — instruction on using and maintaining the sites, content/page-care basics, handover of credentials, joint pre-go-live review | 80 |
| 6 | Website, domain & hosting provision — both sites on a secure, fast WordPress host; hosting and domain costs covered for one year | 200 |
| | **Net total** | **1,600** |
| | **Gross (incl. 19% VAT)** | **1,904** |

Two further commercial elements are quoted but sit outside the build:

- **Optional monthly SEO monitoring & optimisation** — €150/month, minimum
  6-month term, starting at go-live.
- **Running-costs package** — €150/year flat, covering technical
  infrastructure (domain, mail, web hosting), regular WordPress/plugin/theme
  updates, and support (DNS changes, minor fixes), with a fair-use cap of
  5 hours; work beyond that billed separately.

Third-party software licences (e.g. ACF Pro) are flagged in the Angebot as
billable at cost and to be agreed with the client before procurement.

---

## 4. The two practices and their websites

### 4.1 Birgit Kretzschmar

Birgit Kretzschmar is a Heilpraktikerin für Psychotherapie running a
Privatpraxis at Nussbaumstraße 5, 65187 Wiesbaden. Her work centres on
body-oriented and dance-based therapy. Her site comprises eleven pages:
Startseite, Über mich, a Leistungen overview, four therapy pages
(Tanztherapie, Paartherapie, Weiterbildungen, Psychotraumatherapie), Termine,
Kontakt, Impressum, and Datenschutzerklärung. The Termine page — an events
calendar with an upcoming/past split — is specific to her practice.

Her site runs on the `praxis_base` parent theme **with no child theme**: it
is effectively the "base" expression of the shared design system. The old
domain `birgit-kretzschmar.de` is preserved for SEO continuity.

### 4.2 Dr. Alexander Kretzschmar

Dr. Alexander Kretzschmar is a Psychologischer Psychotherapeut running a
combined Kassen- and Privatpraxis at the same building (Nußbaumstraße 5).
His site comprises twelve pages: Startseite, Über mich, a Leistungen
overview, six therapy pages (Tiefenpsychologie, Gestalttherapie,
Psychoonkologie, Hypnotherapie, Coaching, Praxis), Kontakt, Impressum, and
Datenschutz.

His site runs on the `alex_child` **child theme** over `praxis_base`. The
child theme applies a warm-red accent palette (derived from his circular
wordmark logo: outer ring `#AB2815`, inner core `#FB944B`), a bespoke
five-band homepage, a four-column ACF-driven footer, and responsive hero
imagery. He has a "Praxis" page; he has no Termine page.

### 4.3 The intentional asymmetry

The two practices differ structurally and the websites reflect this on
purpose: Birgit has a Termine page and no Praxis page; Alex has a Praxis page
and no Termine page. Birgit's site has no child theme; Alex's does. Both
asymmetries are deliberate and documented, not oversights.

---

## 5. Technical architecture

### 5.1 Theme structure

`praxis_base` is the shared parent theme — the design system, the base
templates, and all ACF field-group definitions. It carries a navy + cream +
stone palette, Cormorant Garamond (display serif) and Inter (body)
typography, and a full set of templates: `front-page.php`, `index.php`,
`page.php`, `page-ueber-mich.php`, `template-leistung.php`,
`template-leistungen-overview.php`, `template-kontakt.php`,
`template-legal.php`, `template-termine.php`, plus `header.php`,
`footer.php`, and the `site-header.php` / `site-footer.php` template-parts.

`alex_child` is Dr. Kretzschmar's child theme. It overrides the homepage
(`front-page.php`), the footer template-part (a four-column footer), the
`style.css` header, `functions.php` (child bootstrap — enqueues compiled
CSS, registers the Footer ACF Options Page, adds the parent's `acf-json/` to
ACF's load paths), and `tailwind.css` (warm-red accent token overrides plus
hero responsive rules). Everything else it inherits.

Birgit's site has no child-theme layer. The practical consequence is
recorded in her risk analysis: any change to `praxis_base` hits her site
immediately, and a Birgit-only change would require scaffolding a
`birgit_child` theme first.

### 5.2 Content model

Both sites are content-driven through **five ACF field groups** defined as
JSON in `praxis_base/acf-json/`: Homepage, Über mich, Leistung, Termine, and
Kontakt. The theme templates all guard on field presence, so the sites
degrade gracefully rather than fatally erroring when a field is empty.
Content authors work in WordPress admin; the block editor is deliberately
disabled for ACF-driven pages via a `use_block_editor_for_post` filter.

### 5.3 Build pipeline

`praxis_base/package.json` defines a Tailwind 4 pipeline: `tw:build`
(minified production build) and `tw:watch` (development watcher), both
compiling `tailwind.css` → `build/theme.css`. The compiled stylesheet is
enqueued with `filemtime()` cache-busting. The dependency set is
`tailwindcss` and `@tailwindcss/cli` at ^4.2.4. `style.css` carries only the
WordPress theme header and is not used for styling.

### 5.4 JavaScript

Three small vanilla-JS files in `praxis_base/assets/js/`, all defensively
written to no-op if their markup is absent:

- `mobile-nav.js` — wires the hamburger button to the mobile menu panel,
  keeping `aria-expanded` and the `aria-label` in sync for screen readers.
- `back-to-top.js` — shows a back-to-top button after 300px of scroll,
  throttled with `requestAnimationFrame`; smooth-scrolls to top on click.
- `past-termine-toggle.js` — on the Termine page only, swaps the past-events
  `<summary>` label between "anzeigen" and "ausblenden" on toggle.

### 5.5 Hosting

Production hosting is **Hostinger Premium**, which permits three sites per
plan — both sites fit on one plan. Both sites are currently on Hostinger
temporary domains for the demo phase. The Strato → Hostinger domain
migration has been **completed successfully**; nothing remains hosted at
Strato.

---

## 6. Content provenance and status

Content for both sites was extracted from All-in-One WP Migration backups of
the practices' previous websites, inventoried into the `docs/content-inventory/`
folder (content maps, image inventories, and raw text-content files per
practice).

### 6.1 Birgit's content

Source: AI1WM backup of 1 May 2026. The old site's slugs were from an
incomplete earlier handover attempt and did not match the page titles — the
content map records the old-slug → new-slug correction (e.g. old
`psychotherapie` → new `tanztherapie`, old `coaching` → new `termine`). Seven
content pages were carried over, ranging from a 756-character Weiterbildungen
page to an 11,435-character Kontakt page. The Termine page's old content
includes real 2024 event data, useful as a structural template. Her image
backup holds 75 files; notable items are her portrait (`1606_Birgit_0406`,
shot April 2026), two 2023 Weiterbildung flyers, and a newer logo variant
(`logo3-1.jpg`).

### 6.2 Alex's content

Source: AI1WM backup of 16 October 2025. Unlike Birgit's, his old slugs and
titles already matched — no slug correction needed. Nine content pages were
carried over, from an 1,183-character Praxis page to an 11,905-character
Kontakt page. His image backup holds 52 files, including his portrait
(`Alexander-Kretzschmar-250409-013-web`) and the three shared practice-room
photos.

### 6.3 Shared images and open content questions

Because the two practices share a building, several images appear in both
backups: the practice-room photos (`haus.jpg`, `therapieraum.jpg`,
`wartezimmer.jpg`), a possibly-joint photo (`kretzschmar-1.jpg`), and
unidentified iPhone photos (`IMG_0039.heic` and variants). The content maps
flag these for a joint decision by both practice owners on which image goes
where.

Both content sets are explicitly **starting points, not final content**.
Both practice owners are to rework their text, and Birgit is to supply new
photographs. The content maps also flag two unresolved structural questions
that have since been answered in the build: whether to bundle therapy pages
under a `/leistungen/` overview (decided: yes, both sites) and, for Alex,
whether Kassen- vs Privatleistungen are clearly distinguished in the copy
(left to Dr. Kretzschmar's content rework).

---

## 7. Development history

The Git history (`praxis_base` repository, `main` branch) runs to 38 commits,
from `4bc98fe` — "First commit steps 1 & 2: Scaffold praxis_base theme" — to
`d67ffbe` at HEAD. The build proceeded as a numbered sequence of steps:

- **Steps 1–3** — `praxis_base` scaffolded as a minimum-viable WordPress
  theme; Tailwind 4 build pipeline established.
- **Step 4** — navy + cream palette, Cormorant Garamond + Inter typography.
- **Steps 5–6** — ACF Pro wired to the homepage; primary and footer nav
  menus.
- **Steps 7–7.5** — visible header/footer extracted into template-parts;
  Gutenberg disabled on the Startseite.
- **Step 8** — mobile navigation with hamburger toggle.
- **Step 9** — Über mich page template and ACF field group.
- **Step 10** — Leistung template, Leistungen overview, ACF JSON export,
  dropdown nav CSS.
- **Step 11** — Termine page template with the past-events disclosure.
- **Step 12** — Kontakt page with contact form, Impressum, Datenschutz.
- **Step 13** — post-demo-meeting updates.
- **`alex_child` sequence** — child theme scaffolded with the bespoke
  front-page and four-column footer; six Leistungen SVG icons; Footer Options
  Page; Über mich and Kontakt field groups; parallax hero; parent-ACF-JSON
  loading; hamburger hidden on desktop; logo asset and hero-height work.

The history also shows housekeeping discipline: `.gitignore` work for
`build/` and Word lock files, removal of large zip files, the
Strato→Hostinger migration docs added, the Angebot PDF committed, and
content inventories for both practices added. A recurring `docs: update
handoff` pattern shows the `project_handoff.md` was maintained as a living
document through the build.

A notable point of interest in the commit log: a meeting with the
Kretzschmars on (around) 6 May 2026 — "Commit updates to sources following
meeting with Kretzschmars" — and a demo meeting that fed Step 13 and the
Termine-editor URS.

---

## 8. Documentation set

The project's `docs/` folder is organised into a lightweight SDLC structure:

- **`docs/handoffs/`** — `project_handoff.md`, the living state-of-the-project
  document maintained throughout the build.
- **`docs/content-inventory/`** — six files: content map, image inventory,
  and raw text content, per practice.
- **`docs/SDLC/`** — numbered SDLC stages: `00_project_plan`,
  `01_user_requirements_spec`, `02_risk_analysis`,
  `03_functional_requirements_spec`, `04_testing`,
  `05_requirements_traceability_matrix`.
- **`docs/Angebot_AG0081.pdf`** and `angebot_praxen_kretzschmar.docx` — the
  commercial founding documents.

Documents produced to date and their status:

| Document | Status |
|----------|--------|
| Angebot AG0081 | Issued 5 May 2026 — commercial basis |
| `project_handoff.md` | Living document, current |
| Content inventories (×6) | Complete — extracted from old-site backups |
| URS — Birgit Kretzschmar (v1.0 → v1.1) | Retrospective; v1.1 adds TOC + back-to-top; awaiting client sign-off |
| URS — Dr. Alexander Kretzschmar (v1.0 → v1.1) | Retrospective; v1.1 adds TOC + back-to-top; awaiting client sign-off |
| Project plan (both sites) | Draft 1 — reconciled master schedule; supersedes the per-site URS §8 timelines |
| Risk analysis — Birgit | Draft 1 — 20 requirements, traceability matrix |
| Risk analysis — Dr. Alexander Kretzschmar | Draft 1 — 19 requirements, traceability matrix |
| German PDF translations | Project plan + both URSs + both risk analyses translated; client-facing parts only |
| URS — Birgit's Termine Front-End Editor | Draft, 12 May 2026 — a *prospective* separate project (see §13) |

The `03_functional_requirements_spec`, `04_testing`, and
`05_requirements_traceability_matrix` SDLC folders exist but are not yet
populated — they represent the natural next documentation stages.

---

## 9. Current state

Both sites are **built, content-populated, and live on Hostinger temporary
demo domains**:

- Birgit: `lightpink-wolf-142779.hostingersite.com`
- Alex: `springgreen-viper-610216.hostingersite.com`

Both are at the "demo handover" pause point — functional and ready for the
Kretzschmars to review. Birgit's content is still demo/placeholder pending
her rework; Alex's content is the real German copy. The Strato→Hostinger
migration is done. The legal pages are the weakest area: Birgit's Impressum
and Datenschutz are placeholder content awaiting lawyer review; Alex's
Impressum exists as a skeleton awaiting his missing professional details
(phone, email, Approbation Bundesland and Behörde, USt-IdNr. status).

Demo-domain protection is via HTTP basic auth plus the "discourage search
engines" setting.

---

## 10. Outstanding work and path to go-live

The reconciled project plan organises the remaining work into five phases;
the binding constraint is **go-live before the Kretzschmars return from their
June vacation**. In summary:

- **Phase 1 — Sign-off and content (client-gated, before end May).** URS
  review and sign-off by both clients; Birgit's reworked content and
  photographs; Alex's missing Impressum fields; demo feedback applied.
- **Phase 2 — Pre-launch hardening (Beriott, parallelisable, June).**
  Self-host Google Fonts and update the Datenschutz text; finalise and
  lawyer-review Birgit's legal pages; complete Alex's Impressum; delete
  Birgit's orphan "Praxis" draft page; fix the Tailwind `md:hidden`
  scan-path issue; image audit; caching/security plugin decision; build the
  SEO redirect map.
- **Phase 3 — Production provisioning and migration (June).** Provision the
  Hostinger Premium plan; migrate both finalised sites to production; change
  admin passwords from Local defaults; verify contact-form email on
  production; apply the redirect map.
- **Phase 4 — Go-live.** Production domains and DNS cutover; HTTPS
  verification; run the URS §7 acceptance checklists; acceptance testing with
  each client; remove basic auth and enable indexing.
- **Phase 5 — Post-launch.** Monitoring; the wp-admin editing handover guide;
  then the Birgit-Termine editor as a separate project.

The two items most likely to slip — both outside Beriott's direct control —
are Birgit's content delivery and the lawyer review of her legal pages. Both
should be chased early.

---

## 11. Risk posture

Two risk analyses exist, one per site, each tracing every requirement to its
risk with a high/medium/low classification and a mitigating action for every
high risk that reduces it to low.

- **Birgit:** 20 requirements assessed; 6 high risks pre-mitigation, all
  reduced to low. The single most important Birgit-specific mitigation is the
  `birgit_child` rule — because her site has no child-theme layer, the
  discipline of scaffolding one before any Birgit-only parent-theme change is
  what protects both sites from each other.
- **Alex:** 19 requirements assessed; 6 high risks pre-mitigation, all
  reduced to low.

The high-risk themes common to both sites: the DSGVO/Google-Fonts exposure,
the legally-incomplete-Impressum exposure, the shared-parent-theme blast
radius, the silently-failing contact form, and ACF Pro licence continuity.
Crucially, every mitigating action in both risk analyses is already a task in
the project plan or a gate in the acceptance criteria — the risk analyses
introduce no unscheduled work.

After mitigation, **neither site carries a high residual risk.**

---

## 12. Scope tensions and decisions on record

A candid internal note on points where the documents do not perfectly agree,
and where Beriott should be deliberate:

1. **SEO and analytics — Angebot vs URSs.** The Angebot (Pos. 3) quotes an
   SEO baseline including "analytics/tracking setup, DSGVO-compliant via a
   consent solution." Both URSs, by contrast, list analytics and third-party
   tracking as explicitly *out of scope*, citing DSGVO and the practices'
   preference for understatement. This is a genuine divergence. It needs an
   explicit decision: either the URSs override the Angebot on this point (no
   analytics) or analytics goes in with a consent solution per the Angebot.
   It should not be left for the client to notice.

2. **Retrospective URSs.** Both URSs were written *after* the build, not
   before. They are honest about this — each has a "what was inferred vs
   documented" section — but Beriott should be aware that the contractual
   "acceptance criteria" referenced in Angebot Pos. 1 were effectively
   reverse-engineered. The sign-off step (Phase 1) is where this gets
   regularised.

3. **The Termine editor.** The Angebot's handover/training position (Pos. 5)
   covers "instruction on using and maintaining the sites." Birgit's
   discomfort with wp-admin surfaced at the 6 May demo and led to a *new* URS
   for a front-end Termine editor — which is a genuine scope expansion beyond
   the Angebot, correctly being treated as a separate project rather than
   absorbed silently.

4. **Independent theme copies post-migration.** AIO WP Migration resolves the
   shared/symlinked parent theme into real files on each production site, so
   each site ends up with its own independent copy of `praxis_base`. This was
   accepted as the production architecture, but it means future parent-theme
   changes must be deployed twice. Worth revisiting only if drift becomes a
   real problem.

5. **Webshop language in the Angebot.** Angebot Pos. 2 is headed "Website- &
   Webshop-Entwicklung." No webshop was specified, built, or needed — the
   heading appears to be boilerplate. Harmless, but worth not reading too
   much into.

---

## 13. Future work beyond this project

- **Birgit's Termine front-end editor.** A drafted URS (12 May 2026) exists
  for a self-service tool letting Birgit update her Termine page without
  logging into wp-admin. It is explicitly scoped as a *separate project*; it
  may or may not be folded into the `praxis_kretzschmar` repository — that
  decision is open. The URS is at the questionnaire stage, awaiting Birgit's
  answers on editing frequency, device, comfort level, and desired fields.
- **Further self-service editing.** Both main URSs flag the assumption that
  the clients do not want to edit content beyond what is specified. If wrong
  — particularly for Birgit beyond Termine, or for Alex at all — each case
  triggers its own URS.
- **Optional SEO retainer.** The €150/month monitoring-and-optimisation
  package from the Angebot is available from go-live, on a 6-month minimum
  term, if the clients opt in.
- **`birgit_child` retrofit.** Conditional — only if a Birgit-only change is
  ever needed.
- **SDLC documentation completion.** The `03_functional_requirements_spec`,
  `04_testing`, and `05_requirements_traceability_matrix` folders are the
  natural next documentation stages.

---

*End of internal project record.*