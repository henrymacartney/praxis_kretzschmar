# Risk Analysis — Dr. Alexander Kretzschmar's Practice Website 

**Document version:** Draft 1, 14 May 2026  
**Author:** Dr. Henry Macartney (Beriott GmbH)  
**Project:** Praxis Kretzschmar website build  
**Source document:** User Requirements Specification — Dr. Alexander
Kretzschmar's Practice Website (v1.0)  
**Status:** Draft. To be reviewed alongside the URS.  

---

## 1. Purpose and method

This document is a risk analysis of the requirements captured in the
User Requirements Specification (URS) for Dr. Alexander Kretzschmar's
practice website. For each requirement it identifies the associated
risk — what could go wrong with respect to that requirement — classifies
that risk, and, where the risk is **high**, specifies a mitigating action
that either removes the risk or reduces it to **low**.

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
| Medium | 7 |
| Low | 6 |
| **Total requirements assessed** | **19** |

After the mitigating actions in § 3 are applied, all six high risks reduce
to low. No high residual risks remain.

---

## 3. Traceability matrix

Each row traces a single requirement to its risk, classification, and —
where high — its mitigating action and residual classification.

### 3.1 Constraints (URS § 5)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| CON-01 | No patient data on the website | § 5 | A future feature request (booking, intake form) introduces a patient-data pathway, creating DSGVO liability the site was designed to avoid | High | Out-of-scope boundary SCOPE-02 formally records the exclusion; any change introducing patient data requires a new URS and an explicit DSGVO assessment before build. Change-control gate makes the pathway impossible to add silently. | Low |
| CON-02 | DSGVO compliance; fonts, forms, embedded resources documentable | § 5 | Google Fonts are loaded from Google's CDN at launch, transmitting visitor IP addresses to a third party without a documented legal basis — a known German abmahnung risk | High | Self-host Google Fonts before launch (already a tracked pre-launch task); update the Datenschutzerklärung to remove the Google Webfonts paragraph. Removes the third-party transmission entirely. | Low |
| CON-03 | § 5 TMG-compliant Impressum | § 5 | Impressum is published legally incomplete (missing Berufsbezeichnung, Kammer, or USt-IdNr. status), exposing Dr. Kretzschmar to abmahnung | High | Impressum skeleton already lists every § 5 TMG-required field as a placeholder; site cannot pass acceptance (AC-06) until Dr. Kretzschmar supplies the missing fields and the page is reviewed. Acceptance gate blocks launch with an incomplete Impressum. | Low |
| CON-04 | Mobile-first responsive design | § 5 | Site renders poorly on phones/tablets, losing the growing share of patients who discover practices on mobile | Medium | — (covered by acceptance criteria AC-01/AC-02/AC-03, which test all three viewport classes) | Medium |
| CON-05 | Sibling parity with Birgit's site via shared parent theme | § 5 | A change to `praxis_base` to fix or improve Alex's site silently breaks Birgit's site, or vice versa | High | Every `praxis_base` change is tested against both sites before deployment; the production architecture keeps each site on its own independent copy of the parent theme after migration, so a post-launch parent-theme edit cannot propagate an untested change. | Low |

### 3.2 Out-of-scope boundaries (URS § 6)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| SCOPE-01 | No self-service content editing tool | § 6 | Dr. Kretzschmar in fact expects to edit content himself; assumption is wrong and surfaces only after launch, causing rework and dissatisfaction | Medium | — (inferred-requirements item in URS § 11 explicitly asks Dr. Kretzschmar to confirm or correct this before sign-off; monitored) | Medium |
| SCOPE-02 | No patient booking, payment, or intake systems | § 6 | Client requests online booking later; scope expansion handled informally without a DSGVO assessment | Medium | — (monitored; a booking request triggers a new URS per the URS § 6 wording) | Medium |
| SCOPE-03 | German-only; no multilingual content | § 6 | International patients cannot read the site | Low | — | Low |
| SCOPE-04 | No analytics / third-party tracking | § 6 | Practice later wants visitor statistics and adds a non-compliant tracker | Low | — | Low |
| SCOPE-05 | No email marketing / newsletter system | § 6 | Practice wants a newsletter later; not a launch concern | Low | — | Low |

### 3.3 Acceptance criteria (URS § 7)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| AC-01 | All twelve pages render on desktop/tablet/mobile | § 7 | A page is broken at one viewport at launch | Medium | — (verified by the pre-launch acceptance checklist) | Medium |
| AC-02 | Primary navigation works on all viewport classes | § 7 | Hamburger menu fails on mobile; patients cannot navigate. Note: the hamburger is currently hidden on desktop via a CSS workaround, not a generated Tailwind utility — a sign the nav CSS is fragile | High | Investigate and fix the Tailwind `md:hidden` scan-path issue so the navigation relies on generated utilities, not a workaround; re-test the hamburger on real mobile devices as part of the acceptance checklist. | Low |
| AC-03 | Three hero-image variants load at correct breakpoints | § 7 | Wrong image (or no image) loads at a breakpoint; the inline-style background plus `!important` override is a known-fragile mechanism | Medium | — (verified by acceptance checklist; the demo migration already exercised this) | Medium |
| AC-04 | Kontakt form sends real email; DSGVO checkbox required | § 7 | Form silently fails on production; patient enquiries are lost without anyone knowing | High | Verify SMTP / contact-form email delivery on production as an explicit migration task; send a test enquiry end-to-end before go-live; add post-launch monitoring of form delivery for the first weeks. | Low |
| AC-05 | All footer links resolve (no 404s) | § 7 | A footer link 404s at launch (the Impressum/Datenschutz pages and footer menu were a known weak point) | Medium | — (verified by acceptance checklist) | Medium |
| AC-06 | Impressum legally complete per § 5 TMG | § 7 | See CON-03 — this acceptance criterion is the gate that enforces CON-03 | High | Same as CON-03: acceptance cannot pass until the Impressum is complete and reviewed. The criterion is itself the mitigation gate. | Low |
| AC-07 | Datenschutzerklärung reflects actual technical reality | § 7 | Datenschutz text describes a different technical setup than the live site (e.g. still mentions Google Fonts CDN after self-hosting, or omits a cookie) | Medium | — (the CON-02 mitigation includes updating the Datenschutz text; this criterion verifies it) | Medium |
| AC-08 | Site loads over HTTPS with valid certificate | § 7 | Certificate misconfigured at cutover; browsers show a security warning | Low | — (Hostinger provides SSL automatically; verified at cutover) | Low |
| AC-09 | Site not indexed until explicit go-live approval | § 7 | Demo or pre-launch site is indexed by Google, exposing unfinished content and placeholder legal pages publicly | Medium | — (HTTP basic auth plus "discourage search engines" already in place for the demo period) | Medium |
| AC-10 | Homepage load time under three seconds | § 7 | Slow homepage loses patients before the page renders | Low | — (image audit is a tracked pre-launch task; hero variants already optimised) | Low |

### 3.4 Build-specification requirements (URS § 4)

| Req. ID | Requirement (short) | Source | Risk | Class | Mitigating action (high risks) | Residual |
|---------|---------------------|--------|------|-------|--------------------------------|----------|
| BLD-01 | Parent/child theme architecture (`alex_child` over `praxis_base`) | § 4.1 | After migration each site carries its own copy of `praxis_base`; a parent-theme fix is applied to one site and forgotten on the other, causing drift | Medium | — (documented in the project plan; parent-theme changes are a known two-deployment task) | Medium |
| BLD-02 | Content driven by ACF field groups | § 4.5 | ACF Pro licence lapses or the plugin is deactivated; all field-driven content disappears from the front end | High | Confirm ACF Pro licence is active and registered to the production site; document the licence and renewal date in the handover material; the theme templates already guard on field presence so the site degrades rather than fatally errors, but content loss is still unacceptable — licence continuity is the mitigation. | Low |

---

## 4. Residual risk statement

After the mitigating actions in § 3 are applied:

- **High residual risks:** none.
- **Medium residual risks:** 7 (CON-04, SCOPE-01, SCOPE-02, AC-01, AC-03,
  AC-05, AC-07, AC-09, BLD-01). These are accepted and monitored; each is
  either covered by an acceptance-checklist test or by an explicit
  confirmation item in URS § 11.
- **Low residual risks:** the remainder, accepted without further action.

The six pre-mitigation high risks — CON-01, CON-02, CON-03, CON-05, AC-02,
AC-04, AC-06, BLD-02 — all reduce to low once their mitigating actions are
in place. Every one of those mitigating actions is already represented as a
task in the project plan or as a gate in the acceptance criteria, so this
risk analysis introduces no work that is not already scheduled.

---

*End of risk analysis draft 1.*