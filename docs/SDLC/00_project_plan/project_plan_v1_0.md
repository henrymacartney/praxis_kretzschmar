# Project Plan — Praxis Kretzschmar Websites (Both Sites) 

**Document version:** Draft 1, 14 May 2026  
**Author:** Dr. Henry Macartney (Beriott GmbH)  
**Project:** Praxis Kretzschmar website build — Birgit Kretzschmar and
Dr. Alexander Kretzschmar  
**Scope:** Reconciled delivery plan taking both practice websites from their
current state (demo on Hostinger temporary domains) to live on their
production domains  
**Status:** Draft. Forward-looking plan. Supersedes the per-site §8 timeline
tables in the two URS documents.  

---

## Table of Contents

- [1. Purpose and how to read this plan](#1-purpose-and-how-to-read-this-plan)
- [2. Current state (as of 14 May 2026)](#2-current-state-as-of-14-may-2026)
- [3. Constraints and fixed points](#3-constraints-and-fixed-points)
- [4. Master schedule](#4-master-schedule)
  - [Phase 0 — Complete](#phase-0--complete)
  - [Phase 1 — Sign-off and content finalisation](#phase-1--sign-off-and-content-finalisation)
  - [Phase 2 — Pre-launch hardening and compliance](#phase-2--pre-launch-hardening-and-compliance)
  - [Phase 3 — Production provisioning and migration](#phase-3--production-provisioning-and-migration)
  - [Phase 4 — Go-live](#phase-4--go-live)
  - [Phase 5 — Post-launch](#phase-5--post-launch)
- [5. Task register (all outstanding work)](#5-task-register-all-outstanding-work)
- [6. Dependencies and critical path](#6-dependencies-and-critical-path)
- [7. Risks](#7-risks)
- [8. Ownership and sign-off](#8-ownership-and-sign-off)
- [Appendix A — Notes for the Beriott team](#appendix-a--notes-for-the-beriott-team)

---

## 1. Purpose and how to read this plan

This is a single reconciled project plan covering **both** Kretzschmar
practice websites:

- **Birgit Kretzschmar** — `birgit-kretzschmar.de` — runs on the
  `praxis_base` parent theme directly (no child theme)
- **Dr. Alexander Kretzschmar** — `kretzschmar-wiesbaden.de` — runs on the
  `alex_child` child theme over `praxis_base`

The two sites are treated as one project because they share a hosting
account, a parent theme, a delivery deadline, and most of the remaining
work. Each task in this plan is tagged:

- **[Both]** — applies to both sites, or is shared infrastructure
- **[Birgit]** — Birgit's site only
- **[Alex]** — Alex's site only

The two URS documents
(`birgit_user_requirements_specification_v1_1.md` and
`alex_user_requirements_specification_v1_1.md`) remain the specification
and acceptance-criteria reference. This plan is the *schedule* — what
happens next, in what order, and who owns it. Where this plan and the URS
§8 timeline tables differ, **this plan takes precedence** (the URS tables
were per-site snapshots; this is the reconciled view).

---

## 2. Current state (as of 14 May 2026)

| Item                                            | Birgit            | Alex                                                                                             |
|-------------------------------------------------|-------------------|--------------------------------------------------------------------------------------------------|
| Local development build                         | Complete          | Complete                                                                                         |
| Content population                              | Complete (demo/placeholder) | Complete (real German copy)                                                                      |
| Theme architecture                              | `praxis_base` direct | `alex_child` child theme                                                                         |
| Retrospective URS drafted                       | Complete (14 May) | Complete (13 May)                                                                                |
| URS reviewed and signed off                     | Pending           | Pending                                                                                          |
| Migration to Hostinger temp domain (demo)       | Complete          | Complete                                                                                         |
| Temp domain                                     | `lightpink-wolf-142779.hostingersite.com` | `springgreen-viper-610216.hostingersite.com` (link assignment verified)                          |
| Demo access protection (HTTP basic auth)        | To confirm        | To confirm                                                                                       |
| Production domain                               | `birgit-kretzschmar.de` (preserved old domain) | `kretzschmar-wiesbaden.de`                                                                       |
| Production provisioning + DNS                   | Not started       | Not started                                                                                      |
| Real Impressum / Datenschutz                    | Placeholder — needs lawyer review | Impressum skeleton + Datenschutz drafted; awaiting Alex's missing Impressum + Datenschutz fields |

Both sites are functional on their Hostinger temporary domains and are at
the "demo handover" pause point — ready for the Kretzschmars to review.

---

## 3. Constraints and fixed points

These are drawn from both URS documents' §5 and are non-negotiable:

- **Hard deadline:** both sites live before the Kretzschmars return from
  their vacation (4-week window in June 2026). This is the binding
  constraint on the whole schedule.
- **No patient data on either website.** Marketing and first contact only.
- **DSGVO compliance** on both sites — documentable fonts, forms, and
  embedded resources; self-hosted fonts before launch.
- **§ 5 TMG compliance** — client's responsibility; legally complete 
  Impressum on each site
  (Heilpraktikerin für Psychotherapie for Birgit; Psychologischer
  Psychotherapeut for Dr. Kretzschmar).
- **Shared parent theme.** Any change to `praxis_base` affects Birgit's
  site directly and Alex's site through inheritance. Parent-theme changes
  must be tested against both.
- **Henry runs all Git operations.** No AI assistant involvement on Git 
  commands.
- **Hosting:** Hostinger Premium, paid by the clients directly. Premium
  allows 3 sites per plan — both sites fit on one plan; management by Beriott.

---

## 4. Master schedule

Five phases. Phase 0 is done; Phases 1–5 are the path to launch.

### Phase 0 — Complete

| # | Task | Tag | Status |
|---|------|-----|--------|
| 0.1 | Local development build of both sites | [Both] | Done |
| 0.2 | Content population | [Both] | Done |
| 0.3 | Retrospective URS drafted for each site | [Both] | Done |
| 0.4 | Migration to Hostinger temporary domains (demo) | [Both] | Done |
| 0.5 | Leistungen overview template assigned (Alex) | [Alex] | Done |
| 0.6 | Sample Page / Privacy Policy draft cleanup (Alex) | [Alex] | Done |
| 0.7 | Impressum skeleton + Datenschutz prepared (Alex) | [Alex] | Done |
| 0.8 | Responsive hero image variants (Alex) | [Alex] | Done |

[↑ Back to top](#table-of-contents)

---

### Phase 1 — Sign-off and content finalisation

**Target: before end May 2026.** This phase is gated by the clients, not
by Beriott.

| #   | Task                                                                                                       | Tag      | Owner           | Target                  |
|-----|------------------------------------------------------------------------------------------------------------|----------|-----------------|-------------------------|
| 1.1 | Send both demo sites to the Kretzschmars for review                                                        | [Both]   | Henry           | Done                    |
| 1.2 | URS reviewed by each client                                                                                | [Both]   | Birgit / Alex   | By 22nd May 2026        |
| 1.3 | URS corrections (especially §11 inferred items) applied                                                    | [Both]   | Henry           | Within 2 days of review |
| 1.4 | URS finalised and signed off                                                                               | [Both]   | Henry + clients | Within 3 days of review |
| 1.5 | Receive Birgit's reworked text content + new photographs                                                   | [Birgit] | Birgit          | Before end May          |
| 1.6 | Receive Alex's missing Impressum fields (phone, email, Approbation Bundesland + Behörde, USt-IdNr. status) | [Alex]   | Alex            | Before end May          |
| 1.7 | Populate Birgit's final content + photos into her site                                                     | [Birgit] | Henry           | On receipt of 1.5       |
| 1.8 | Populate Alex's final content + photos into his site                                                       | [Alex]   | Henry           | On receipt of 1.5       |
| 1.8 | Apply any feedback from the demo review                                                                    | [Both]   | Henry           | On receipt of 1.2       |

[↑ Back to top](#table-of-contents)

---

### Phase 2 — Pre-launch hardening and compliance

**Target: June 2026, before migration.** Most of this is Beriott work and
can run in parallel with Phase 1's client-gated items.

| # | Task                                                                                                                       | Tag | Owner  | Target           |
|---|----------------------------------------------------------------------------------------------------------------------------|-----|--------|------------------|
| 2.1 | Self-host Google Fonts (Cormorant Garamond, Inter) — removes the CDN dependency                                            | [Both] | Henry  | June             |
| 2.2 | Update Datenschutzerklärung text to reflect self-hosted fonts (remove Google Webfonts paragraph)                           | [Both] | Henry  | After 2.1        |
| 2.3 | Real Impressum + Datenschutz finalised and lawyer-reviewed (Birgit)                                                        | [Birgit] | Birgit | Before launch    |
| 2.4 | Real Impressum + Datenschutz completed with Alex's fields; both legal pages published (Alex)                               | [Alex] | Henry  | After 1.6        |
| 2.5 | Delete the unpublished "Praxis" draft page (Birgit)                                                                        | [Birgit] | Henry  | June             |
| 2.6 | Investigate and fix the Tailwind `md:hidden` scan-path issue                                                               | [Both] | Henry  | June             |
| 2.7 | Image audit — verify all media-library uploads are sized appropriately                                                     | [Both] | Henry  | June             |
| 2.8 | Decide on caching + security plugin approach for production                                                                | [Both] | Henry  | Before migration |
| 2.9 | Build the SEO redirect map — old `?page_id=X` URLs, plus old top-level therapy slugs → new `/leistungen/...` URLs (Birgit) | [Both] | Henry  | Before go-live   |
| 2.10 | Confirm HTTP basic auth is active on both temp domains during the demo period                                              | [Both] | Henry  | Done             |

[↑ Back to top](#table-of-contents)

---

### Phase 3 — Production provisioning and migration

**Target: June 2026.** Cannot start until Phase 1 sign-off (1.4) — no point
migrating an unsigned-off build, because essential information would be missing.

| # | Task | Tag | Owner | Target                                      |
|---|------|-----|-------|---------------------------------------------|
| 3.1 | Provision the Hostinger Premium plan (both sites on one plan) | [Both] | Henry | June                                        |
| 3.2 | Strato → Hostinger migration groundwork (Birgit's existing hosting) | [Birgit] | Henry | June                                        |
| 3.3 | Migrate Birgit's finalised site to production (All-in-One WP Migration) | [Birgit] | Henry | June                                        |
| 3.4 | Migrate Alex's finalised site to production (All-in-One WP Migration) | [Alex] | Henry | June                                        |
| 3.5 | Post-migration check: theme files intact, `siteurl`/`home` correct, permalinks resaved | [Both] | Henry | Each migration                              |
| 3.6 | Change WordPress admin passwords from Local defaults on both production installs | [Both] | Henry | Each migration                              |
| 3.7 | Verify SMTP / contact-form email delivery works on production | [Both] | Henry | No longer required - mail accounts seperate |
| 3.8 | Apply the SEO redirect map on production | [Both] | Henry | After 3.3 / 3.4                             |
| 3.9 | Install caching + security per the 2.8 decision | [Both] | Henry | After migration                             |

[↑ Back to top](#table-of-contents)

---

### Phase 4 — Go-live

**Target: before the Kretzschmars return from vacation.**

| # | Task | Tag | Owner | Target |
|---|------|-----|-------|--------|
| 4.1 | Provision production domains + DNS — point `birgit-kretzschmar.de` and `kretzschmar-wiesbaden.de` at Hostinger | [Both] | Henry | June |
| 4.2 | Verify HTTPS certificate valid on both production domains | [Both] | Henry | At cutover |
| 4.3 | Run the acceptance-criteria checklist (URS §7) on each production site | [Both] | Henry | At cutover |
| 4.4 | Acceptance testing with each client present | [Both] | Henry + clients | Before final go-live |
| 4.5 | Remove HTTP basic auth; untick "discourage search engines" — sites become publicly visible and indexable | [Both] | Henry | Go-live moment |
| 4.6 | Confirm redirects resolve from old URLs on the live domains | [Both] | Henry | At cutover |

[↑ Back to top](#table-of-contents)

---

### Phase 5 — Post-launch

| # | Task | Tag | Owner | Target |
|---|------|-----|-------|--------|
| 5.1 | Monitor contact-form delivery and basic uptime for the first weeks | [Both] | Henry | Post-launch |
| 5.2 | Hand-off PDF guide for editing content via wp-admin | [Both] | Henry | Post-launch |
| 5.3 | Build the Birgit-Termine self-service editor (separate URS already exists) | [Birgit] | Henry | Per that URS |
| 5.4 | Decide whether a `birgit_child` child theme is needed (only if a Birgit-only change is ever required) | [Birgit] | Henry | As needed |
| 5.5 | Address any further self-service-editing requests via new URS documents | [Both] | Henry | As needed |

[↑ Back to top](#table-of-contents)

---

## 5. Task register (all outstanding work)

Consolidated information from client interviews, with the site tag and the phase each task sits in.

| Task                                                      | Tag | Phase |
|-----------------------------------------------------------|-----|-------|
| Send demos for client review                              | [Both] | 1 |
| URS review, correction, sign-off                          | [Both] | 1 |
| Birgit's reworked content + photos received and populated | [Birgit] | 1 |
| Alex's missing Impressum fields received                  | [Alex] | 1 |
| Apply demo feedback                                       | [Both] | 1 |
| Self-host Google Fonts                                    | [Both] | 2 |
| Update Datenschutz text post-font-change                  | [Both] | 2 |
| Real Impressum + Datenschutz, lawyer-reviewed (Birgit)    | [Birgit] | 2 |
| Impressum completed + legal pages published (Alex)        | [Alex] | 2 |
| Delete "Praxis" draft page (Birgit)                       | [Birgit] | 2 |
| Tailwind `md:hidden` scan-path fix                        | [Both] | 2 |
| Image audit of media library                              | [Both] | 2 |
| Caching + security plugin decision                        | [Both] | 2 |
| SEO redirect map built                                    | [Both] | 2 |
| Confirm HTTP basic auth on temp domains                   | [Both] | 2 |
| Provision Hostinger Premium plan                          | [Both] | 3 |
| Strato → Hostinger migration groundwork (Birgit)          | [Birgit] | 3 |
| Migrate Birgit's site to production                       | [Birgit] | 3 |
| Migrate Alex's site to production                         | [Alex] | 3 |
| Post-migration integrity checks                           | [Both] | 3 |
| Change admin passwords from Local defaults                | [Both] | 3 |
| Verify contact-form email on production                   | [Both] | 3 |
| Apply redirect map on production                          | [Both] | 3 |
| Install caching + security                                | [Both] | 3 |
| Production domains + DNS cutover                          | [Both] | 4 |
| HTTPS certificate verification                            | [Both] | 4 |
| Acceptance-criteria checklist (URS §7)                    | [Both] | 4 |
| Acceptance testing with clients                           | [Both] | 4 |
| Remove basic auth + enable indexing                       | [Both] | 4 |
| Verify old-URL redirects on live domains                  | [Both] | 4 |
| Post-launch monitoring                                    | [Both] | 5 |
| wp-admin editing hand-off guide (PDF)                     | [Both] | 5 |
| Birgit-Termine self-service editor build                  | [Birgit] | 5 |
| `birgit_child` retrofit (conditional)                     | [Birgit] | 5 |

[↑ Back to top](#table-of-contents)

---

## 6. Dependencies and critical path

The binding deadline is **go-live before the June vacation return**.
Working backward, the critical path is:

1. **Client sign-off (1.4)** gates the entire production phase. Migration of
   an un-signed-off build would risk re-doing the migration. Phase 3 cannot
   start until Phase 1 completes.
2. **Birgit's reworked content (1.5)** gates her final content population
   (1.7), which gates her migration (3.3). If her content is late, her
   launch slips — Alex's does not depend on it.
3. **Alex's reworked content and Impressum + Datenschutz fields (1.6)** gate 
   completing his additional / reworked texts and Impressum + Datenschutz (2. 4), 
   which gates his go-live (a site cannot launch with a
   legally incomplete Impressum / Datenschutz). If his fields are late, his 
   launch slips — Birgit's does not depend on it, but check for legality 
   necessary.
4. **Self-hosting fonts (2.1)** gates the Datenschutz text update (2.2),
   which is a launch-blocker for DSGVO compliance on both sites.
5. **Lawyer review of Birgit's legal pages (2.3)** is outside Beriott's
   control and should be initiated as early as possible — it is the most
   likely external bottleneck.
6. **Migration (Phase 3)** gates DNS cutover (Phase 4). The two migrations
   (3.3, 3.4) are independent of each other and can run in either order;
   Birgit first is recommended (simpler — no child theme).

**Parallelism:** Phase 2 (Beriott hardening work) can run almost entirely
in parallel with Phase 1 (client-gated review and content). Beriott should
not wait idle for sign-off — fonts, the Tailwind fix, the image audit, the
redirect map, and the caching/security decision can all proceed now.

**The two most likely things to slip:** Birgit's content delivery (1.5) and
the lawyer review (2.3). Both are outside Beriott's direct control and both
should be chased early. Responsibility lies with client.

[↑ Back to top](#table-of-contents)

---

## 7. Risks

| Risk                                                       | Affects | Mitigation |
|------------------------------------------------------------|---------|------------|
| Birgit's reworked content arrives late                     | [Birgit] launch | Chase now; her site can migrate with current demo content as a fallback if absolutely necessary, then content-update post-launch |
| Lawyer review of legal pages is slow                       | [Birgit] launch | Initiate the review request immediately; it is the longest external lead time |
| Alex's Impressum fields arrive late                        | [Alex] launch | Chase now; the Impressum skeleton already exists, so it is a fill-in-the-blanks task once fields arrive |
| AIO WP Migration symlink behaviour on export               | [Both] migration | The temp-domain demo migrations already succeeded, so this is largely de-risked; verify theme files intact post-migration (task 3.5) |
| Parent-theme change breaks one site while fixing the other | [Both] | Test every `praxis_base` change against both sites before deploying |
| DNS propagation delay at cutover                           | [Both] launch | Schedule cutover with buffer before the vacation-return deadline; do not cut over on the last possible day |
| Hostinger plan limits or feature changes                   | [Both] | Premium currently allows 3 sites; verify at provisioning time |
| Browser-cache confusion during testing                     | [Both] | Known issue from the demo phase; hard-refresh and incognito testing as standard practice |

A full risk analysis can be found in 'docs/SDLC/02_risk_analysis' - this folder.

[↑ Back to top](#table-of-contents)

---

## 8. Ownership and sign-off

**Henry (Beriott)** owns all build, migration, and deployment work, and all
Git/GitHub operations.

**Birgit Kretzschmar** owns: her URS review, her reworked content and
photographs, and arranging the lawyer review of her legal pages.

**Dr. Alexander Kretzschmar** owns: his URS review, and supplying his 
incomplete Datenschutz, missing Impressum fields and arranging the lawyer 
review of his legal pages.

This plan is a working document and will be updated as phases complete. It
does not itself require client sign-off — the two URS documents are the
signed contracts. This plan is the schedule by which those contracts are
delivered. On completion of this plan and delivery of the planned software 
products any changes will require a new project with the associated 
financial costs.

| Role                          | Name                          | Signature | Date |
|-------------------------------|-------------------------------|-----------|------|
| Beriott GmbH (project owner)  | Dr. Henry Macartney           |           |      |

[↑ Back to top](#table-of-contents)

---

## Appendix A — Notes for the Beriott team

Internal notes; not part of the client-facing plan.

- **Sequencing the two migrations.** Do Birgit first. Her site runs on
  `praxis_base` directly with no child theme — fewer moving parts to debug
  if the first production migration surfaces a problem. Apply lessons to
  Alex's migration.
- **The independent-copies decision.** Migration via AIO WP Migration
  resolves the symlinked themes into real files, so each production site
  carries its own copy of `praxis_base`. Future parent-theme changes must
  be deployed to both sites separately. This was accepted as the production
  architecture; revisit only if parent-theme drift becomes a real problem.
- **Phase 2 is the float.** It is almost entirely Beriott-controlled and
  parallelisable. If the schedule comes under pressure, Phase 2 is where
  Beriott can pull work forward; it is not where slippage should be
  absorbed.
- **The deadline is real and external.** The Kretzschmars' vacation-return
  date is fixed. The plan must hit it; the float is in *when* within
  June, not *whether* before the return.
- **Document set.** This plan sits alongside:
  `birgit_user_requirements_specification_v1_0.md`,
  `alex_user_requirements_specification_v1_0.md`, and the separate
  Birgit-Termine editor URS. The URSs are the specification; this is the
  schedule.

[↑ Back to top](#table-of-contents)

---

*End of project plan draft 1.*