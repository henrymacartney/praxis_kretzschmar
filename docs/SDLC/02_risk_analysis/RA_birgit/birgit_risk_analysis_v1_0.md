# Risk Analysis — Birgit Kretzschmar's Practice Website 

**Document version:** Draft 1, 14 May 2026  
**Author:** Dr. Henry Macartney (Beriott GmbH)  
**Project:** Praxis Kretzschmar website build  
**Source document:** User Requirements Specification — Birgit Kretzschmar's
Practice Website (v1.0)  
**Status:** Draft. To be reviewed alongside the URS.  

---

## 1. Purpose and method

This document is a risk analysis of the requirements captured in the
User Requirements Specification (URS) for Birgit Kretzschmar's practice
website. For each requirement it identifies the associated risk — what
could go wrong with respect to that requirement — classifies that risk,
and, where the risk is **high**, specifies a mitigating action that either
removes the risk or reduces it to **low**.

### 1.1 Requirement identification

The URS is not written as a numbered requirements list; requirements are
embedded in its sections. For traceability, each discrete requirement has
been assigned a stable ID with the following prefixes:

- **CON-** — a constraint (URS § 5)
- **SCOPE-** — an out-of-scope boundary (URS § 6)
- **AC-** — an acceptance criterion (URS § 7)
- **BLD-** — a build-specification requirement (URS § 4)

Each row of the traceability matrix in § 3 traces one requirement ID back
to its source section in the URS.

### 1.2 Classification system

| Classification | Meaning |
|----------------|---------|
| **High** | Likely to occur and/or serious consequence (launch-blocking, legal exposure, or patient-trust damage). A high risk **must** carry a mitigating action in this document. |
| **Medium** | Plausible occurrence with a manageable consequence, or serious consequence with low likelihood. Monitored; mitigation advisable but not mandatory. |
| **Low** | Unlikely and/or minor consequence. Accepted without mandatory action. |

### 1.3 Mitigation rule

Every requirement classified **high** is given a mitigating action whose
effect is to remove the risk or reduce it to **low**. The matrix shows the
**residual classification** — the classification that applies once the
mitigating action is in place — so the reduction is explicit and auditable.

---

## 2. Risk summary

| Classification (pre-mitigation) | Count |
|---------------------------------|-------|
| High | 6 |
| Medium | 8 |
| Low | 6 |
| **Total requirements assessed** | **20** |

After the mitigating actions in § 3 are applied, all six high risks reduce
to low. No high residual risks remain.

---

## 3. Traceability matrix

Each row traces a single requirement to its risk, classification, and —
where high — its mitigating action and residual classification.

### 3.1 Constraints (URS § 5)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| CON-01 | No patient data on the website | § 5 | A future feature request (booking, intake form) introduces a patient-data pathway, creating DSGVO liability the site was designed to avoid | High | Out-of-scope boundary SCOPE-03 formally records the exclusion; any change introducing patient data requires a new URS and an explicit DSGVO assessment before build. Change-control gate makes the pathway impossible to add silently. | Low |
| CON-02 | DSGVO compliance; fonts, forms, embedded resources documentable | § 5 | Google Fonts are loaded from Google's CDN at launch, transmitting visitor IP addresses to a third party without a documented legal basis — a known German abmahnung risk | High | Self-host Google Fonts before launch (already a tracked pre-launch task); update the Datenschutzerklärung to remove the Google Webfonts paragraph. Removes the third-party transmission entirely. | Low |
| CON-03 | § 5 TMG-compliant Impressum for a Heilpraktikerin für Psychotherapie | § 5 | The current Impressum and Datenschutz pages hold demo placeholder content; the site is published with placeholder or legally incomplete legal pages, exposing Frau Kretzschmar to abmahnung | High | Real Impressum + Datenschutz finalised and lawyer-reviewed before launch (tracked pre-launch task); site cannot pass acceptance (AC-07/AC-08) until the legal pages are complete and reviewed. Acceptance gate blocks launch with placeholder legal content. | Low |
| CON-04 | Mobile-first responsive design | § 5 | Site renders poorly on phones/tablets, losing the growing share of patients who discover practices on mobile | Medium | — (covered by acceptance criteria AC-01/AC-02, which test all viewport classes) | Medium |
| CON-05 | Sibling parity with Dr. Kretzschmar's site; Birgit's site IS the parent theme directly | § 5 | Because Birgit's site runs on `praxis_base` directly with no child theme, any change to the parent theme — whether intended for her site or made for Dr. Kretzschmar's — hits her site immediately, with no child-theme layer to absorb it | High | Every `praxis_base` change is tested against both sites before deployment; the production architecture keeps each site on its own independent copy of the parent theme after migration; if a future change should affect only Birgit's site, a `birgit_child` child theme is scaffolded first (recorded as a conditional task). | Low |

### 3.2 Out-of-scope boundaries (URS § 6)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| SCOPE-01 | Self-service editing of the Termine page is covered by its own separate URS | § 6 | The Termine editor is built to this risk analysis's parent URS rather than its own, or the two documents diverge | Low | — (the Birgit-Termine editor URS already exists as the governing document for that work) | Low |
| SCOPE-02 | No self-service editing of other pages | § 6 | Frau Kretzschmar in fact expects to edit pages beyond Termine herself; assumption is wrong and surfaces only after launch | Medium | — (inferred-requirements item in URS § 11 explicitly asks Frau Kretzschmar to confirm or correct this before sign-off; monitored) | Medium |
| SCOPE-03 | No patient booking, payment, or intake systems | § 6 | Client requests online booking later; scope expansion handled informally without a DSGVO assessment | Medium | — (monitored; a booking request triggers a new URS) | Medium |
| SCOPE-04 | German-only; no multilingual content | § 6 | International patients cannot read the site | Low | — | Low |
| SCOPE-05 | No analytics / third-party tracking | § 6 | Practice later wants visitor statistics and adds a non-compliant tracker | Low | — | Low |
| SCOPE-06 | No `birgit_child` child theme unless a Birgit-only change is needed | § 6 | A Birgit-only change is made directly to `praxis_base` instead of in a new child theme, breaking sibling parity (see CON-05) | Medium | — (CON-05 mitigation covers this: the rule is that a Birgit-only change triggers scaffolding `birgit_child` first) | Medium |

### 3.3 Acceptance criteria (URS § 7)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| AC-01 | All eleven pages render on desktop/tablet/mobile | § 7 | A page is broken at one viewport at launch | Medium | — (verified by the pre-launch acceptance checklist) | Medium |
| AC-02 | Primary navigation with hover dropdowns and inline mobile sub-menus works on all viewport classes | § 7 | Hamburger menu or dropdown sub-menus fail on mobile; patients cannot navigate. The hamburger is currently hidden on desktop via a CSS workaround, not a generated Tailwind utility — a sign the nav CSS is fragile | High | Investigate and fix the Tailwind `md:hidden` scan-path issue so the navigation relies on generated utilities, not a workaround; re-test the hamburger and sub-menus on real mobile devices as part of the acceptance checklist. | Low |
| AC-03 | Homepage hero, Galerie grid, CTA strip, welcome text all render from ACF and degrade gracefully | § 7 | A homepage section breaks, or fails to degrade, when an ACF field is empty | Low | — (templates already guard on field presence; verified by acceptance checklist) | Low |
| AC-04 | Termine page correctly splits upcoming vs past events, past collapsible | § 7 | Date-split logic misclassifies an event, or the past-events disclosure fails — patients see wrong or missing event information | Medium | — (verified by acceptance checklist; the logic is date-based and testable) | Medium |
| AC-05 | Kontakt form sends real email; DSGVO checkbox required | § 7 | Form silently fails on production; patient enquiries are lost without anyone knowing | High | Verify SMTP / contact-form email delivery on production as an explicit migration task; send a test enquiry end-to-end before go-live; add post-launch monitoring of form delivery for the first weeks. | Low |
| AC-06 | All footer links resolve (no 404s) | § 7 | A footer link 404s at launch | Medium | — (verified by acceptance checklist) | Medium |
| AC-07 | Impressum legally complete per § 5 TMG | § 7 | See CON-03 — this acceptance criterion is part of the gate that enforces CON-03 | High | Same as CON-03: acceptance cannot pass until the Impressum is complete and lawyer-reviewed. The criterion is itself the mitigation gate. | Low |
| AC-08 | Datenschutzerklärung reflects actual technical reality and is lawyer-reviewed | § 7 | Datenschutz text describes a different technical setup than the live site, or is published without lawyer review | High | Same gate as CON-03: the Datenschutzerklärung must be lawyer-reviewed and technically accurate (including the post-self-hosting font change) before acceptance passes. Lawyer review is the longest external lead time and is initiated as early as possible. | Low |
| AC-09 | Site loads over HTTPS with valid certificate | § 7 | Certificate misconfigured at cutover; browsers show a security warning | Low | — (Hostinger provides SSL automatically; verified at cutover) | Low |
| AC-10 | Site not indexed until explicit go-live approval | § 7 | Demo or pre-launch site is indexed by Google, exposing unfinished content and placeholder legal pages publicly | Medium | — (HTTP basic auth plus "discourage search engines" already in place for the demo period) | Medium |
| AC-11 | Homepage load time under three seconds | § 7 | Slow homepage loses patients before the page renders | Low | — (image audit is a tracked pre-launch task) | Low |
| AC-12 | Unpublished "Praxis" draft page deleted | § 7 | The orphan draft is published by accident, or left in place cluttering the admin | Medium | — (deletion is a tracked pre-launch task and an explicit acceptance criterion) | Medium |

### 3.4 Build-specification requirements (URS § 4)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| BLD-01 | Site runs on `praxis_base` directly, no child theme | § 4.1 | A practice-specific change is needed for Birgit's site and is made directly to the shared parent theme, breaking Dr. Kretzschmar's site | High | The rule is recorded in CON-05 and URS § 6: any Birgit-only change requires scaffolding a `birgit_child` child theme first. This converts an architectural hazard into a defined, gated procedure. | Low |
| BLD-02 | Content driven by ACF field groups | § 4.6 | ACF Pro licence lapses or the plugin is deactivated; all field-driven content disappears from the front end | High | Confirm ACF Pro licence is active and registered to the production site; document the licence and renewal date in the handover material; the theme templates already guard on field presence so the site degrades rather than fatally errors, but content loss is still unacceptable — licence continuity is the mitigation. | Low |
| BLD-03 | Old domain `birgit-kretzschmar.de` preserved for SEO continuity; old URLs change to new `/leistungen/...` structure | § 4.2 | Old indexed URLs (`?page_id=X` and old top-level therapy slugs) break on launch; existing search ranking and patient bookmarks are lost | Medium | — (SEO redirect map is a tracked pre-launch task and is applied on production before go-live) | Medium |

---

## 4. Residual risk statement

After the mitigating actions in § 3 are applied:

- **High residual risks:** none.
- **Medium residual risks:** 9 (CON-04, SCOPE-02, SCOPE-03, SCOPE-06,
  AC-01, AC-04, AC-06, AC-10, AC-12, BLD-03). These are accepted and
  monitored; each is either covered by an acceptance-checklist test, by an
  explicit confirmation item in URS § 11, or by a tracked pre-launch task.
- **Low residual risks:** the remainder, accepted without further action.

The pre-mitigation high risks — CON-01, CON-02, CON-03, CON-05, AC-02,
AC-05, AC-07, AC-08, BLD-01, BLD-02 — all reduce to low once their
mitigating actions are in place. Every one of those mitigating actions is
already represented as a task in the project plan or as a gate in the
acceptance criteria, so this risk analysis introduces no work that is not
already scheduled.

The single most important mitigation for Birgit's site specifically is the
`birgit_child` rule (CON-05 / BLD-01): because her site has no child-theme
layer, the discipline of scaffolding one before any Birgit-only parent-theme
change is what protects both sites from each other.

---

*End of risk analysis draft 1.*