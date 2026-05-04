# Migration Plan: Strato → Hostinger  

### Author: Dr. Henry Macartney
### Date: 01.05.2026

## Change history

| Version | Date | Main changes |
|---------|---|---|
| 1.0     | 1 May 2026 | Initial document. Three workstreams identified: domain registration transfer, WordPress + database migration, email migration. Email approach: live IMAP-to-IMAP sync (e.g. `imapsync`) with both providers active simultaneously. WordPress migration treated as the long-term destination, requiring full primary-domain swap and database search-replace. |
| 1.1     | 1 May 2026 | **Email migration approach changed** to backup-and-restore: the Kretzschmars take a local Thunderbird/MailStore copy of all mail before cutover, then restore via drag-and-drop into the new Hostinger mailboxes. Lower-risk, gives the practice owners a permanent local archive, GDPR encryption guidance added. <br><br> **Site rebuild added as a parallel workstream**: the migrated WP sites are now treated as an interim solution only — both sites will be rebuilt from scratch on Hostinger with a modern design. Added German-specific compliance guidance (DSGVO, locally hosted fonts per LG München, BFSG accessibility) and a decision table for what visitors see between domain transfer and new-site launch. <br><br> **Order of operations expanded** from 5 to 8 steps to reflect the parallel rebuild. <br><br> **Risk register expanded** with entries for backup completeness, drive encryption, forgotten calendar/contacts exports, and GDPR violations at new-site launch. <br><br> **New reference table** comparing Thunderbird, MailStore Home, and imapsync. |

---

## Domains in scope

| Domain | Practice owner | Status |
|---|---|---|
| `birgit-kretzschmar.de` | Birgit Kretzschmar (Tanz- und Lehrtherapeutin) | WordPress + DB migrated to Hostinger staging at `mediumspringgreen-ant-406352.hostingersite.com` (kept as interim live site) |
| `kretzschmar-wiesbaden.de` | Dr. Alexander Kretzschmar (Psychologischer Psychotherapeut) | WordPress + DB migrated to Hostinger staging at `sienna-kudu-455515.hostingersite.com` (kept as interim live site) |

Both staging sites have been verified live and rendering correctly (content, navigation, images all present).

## Context & constraints

- Both are **professional psychotherapy practices** — patient-facing, GDPR-relevant, downtime should be minimised
- Strato cancellation was filed approx. 1 month ago; **AuthInfo codes for both domains are approaching the 30-day expiry** (.de domains)
- Both Auth codes are already in our possession
- The migrated WordPress sites serve as an **interim solution only** — both sites will be **rebuilt from scratch** on Hostinger with a modern design
- Until the rebuild is ready, the migrated sites stay live so patients always reach working contact information

## Workstreams

Three workstreams in scope:

1. ⏳ **Domain registration transfer** (.de) — pending, time-critical
2. ⏳ **Email migration** via backup-and-restore — pending, critical for the practices
3. ⏳ **New site rebuild** on Hostinger with modern design — separate project, runs in parallel

The migrated WordPress sites are an **interim measure** to keep the practices reachable during the transition, not a long-term destination.

---

## 1. Domain registration transfer (URGENT — Auth code clock)

Action at **Hostinger**:

1. Open Hostinger's Transfer Domain page
2. Enter `birgit-kretzschmar.de` → pay → paste the AuthInfo code
3. When prompted about nameservers, select **"Use Hostinger nameservers"**
4. Repeat for `kretzschmar-wiesbaden.de`
5. Confirm the transfer email Hostinger sends

For .de domains the transfer typically completes within 1–4 days.

**If an Auth code expires before we act:** request a fresh one from the Strato Customer Service Area (Login area → Domain Administration → Request Authcode link next to the cancelled domain). .de Auth codes are valid 30 days and must be re-requested after.

**Hard deadline:** the Strato cancellation date itself. After that the domain is released and at risk. Confirm the exact "Vertragsende" date from the Strato cancellation confirmation email.

---

## 2. Email migration via backup-and-restore

This approach gives the Kretzschmars full local control of their mail at all times — lower risk than a live IMAP-to-IMAP sync, and the local copy is a permanent archive in their possession.

### Step A — Inventory at Strato

In the Strato email control panel, list per domain:
- All mailboxes (e.g. `kontakt@…`, `praxis@…`, `info@…`)
- All forwarders and aliases
- Quotas and approximate mail volume per mailbox
- Any CalDAV/CardDAV calendars/contacts that need separate export

### Step B — Local backup BEFORE cutover (while Strato is still live)

The Kretzschmars perform this on each practice computer:

1. Install **Thunderbird** (free, Windows/Mac/Linux)
2. Add each Strato mailbox via **IMAP** (not POP3 — this is critical)
3. For every folder (Inbox, **Sent**, Drafts, custom folders): right-click → Properties → tick **"Synchronize this folder for offline use"**
4. Let Thunderbird download everything — years of practice mail may take hours, possibly overnight
5. Locate the Thunderbird **profile folder** on disk and copy it to an **encrypted external drive** (BitLocker / FileVault / VeraCrypt) — this contains patient correspondence and is GDPR-sensitive

**Alternative tool:** **MailStore Home** (free, Windows) — purpose-built for IMAP archiving, more guided than Thunderbird. Often used by small German practices for provider migrations. Recommend this if Thunderbird feels fiddly.

**Don't forget:**
- Sent folder (easy to overlook)
- Calendar (export as `.ics`) and contacts (export as `.vcf`) if used via CalDAV/CardDAV at Strato
- Verify backup completeness before proceeding to Step C

### Step C — Decide on the email solution at Hostinger

Options:
- Hostinger's bundled email accounts (limited; check what the purchased plan includes)
- Hostinger Email (paid, separate from web hosting — recommended for professional use)
- Google Workspace (external, most robust, requires MX pointed at Google instead of Hostinger)

### Step D — Recreate mailboxes at Hostinger

In hPanel → Emails → create each mailbox with the **same address** as on Strato. Strong new passwords. Document them securely (password manager preferred).

### Step E — Restore mail from local backup into Hostinger mailboxes

In Thunderbird:

1. Add the **new Hostinger mailbox** as a second IMAP account
2. With both old (Strato) and new (Hostinger) accounts visible, **drag folders or selected emails** from the old account into the corresponding folders in the Hostinger account
3. Thunderbird uploads to Hostinger via IMAP — folder structure, dates, read/unread state, and attachments are preserved
4. If the Strato mailbox is already gone by this point, drag from **Local Folders** (the offline copy) instead

For MailStore Home users: use its "Export to IMAP Mailbox" function pointing at the new Hostinger account.

### Step F — Switch MX records

After mailboxes exist at Hostinger and content has been restored, update MX records (in Hostinger DNS once authoritative for the .de domains) to point to Hostinger's mail servers. Allow 24–72 hours for propagation; some mail may still arrive at Strato during this window — keep the Strato mailbox active until the window closes.

### Step G — Update mail clients

Birgit and Alexander update Outlook / Apple Mail / phone IMAP+SMTP settings to Hostinger's servers. Schedule for a quiet day. Provide them with the new server names, ports, and passwords.

---

## 3. New site rebuild on Hostinger (parallel project)

The migrated WordPress sites are a holding pattern. The actual goal is **two new sites with a modern design**, built fresh on Hostinger.

### Approach

- Build the new sites on a **staging environment** (e.g. `dev.kretzschmar-wiesbaden.de` subdomain or Hostinger's built-in staging tools) so the old sites stay live for patients during development
- When a new site is ready and approved, swap it in as the primary site for the real domain
- The migrated old sites can then be archived or deleted

This is why we **don't** need the search-and-replace database surgery on the migrated WP sites — they're not the long-term home.

### Recommendations for the new sites (German psychotherapy practices)

**GDPR / DSGVO compliance — non-negotiable:**
- Proper Datenschutzerklärung and Impressum
- Cookie consent banner only if tracking/cookies are actually used
- **No Google Fonts loaded from Google's CDN** — host fonts locally (LG München ruling, 2022)
- **No Google Analytics without explicit consent**; consider privacy-friendly alternatives (Matomo self-hosted, Plausible)
- TLS/SSL enforced sitewide (Hostinger handles this via Let's Encrypt automatically)

**Content and forms:**
- Many German practices avoid contact forms entirely and publish phone + info email — simpler and reduces data minimisation concerns
- If a contact form is used: minimal fields, encrypted transmission, clear consent text, retention policy documented
- **No patient testimonials** — professionally and legally tricky for therapists in Germany

**Accessibility:**
- BFSG (Barrierefreiheitsstärkungsgesetz) effective June 2025 — psychotherapy sites aren't directly mandated yet, but following WCAG 2.1 AA is good practice and protects against future scope expansion

**Technical foundation:**
- WordPress on Hostinger with a clean modern theme (Astra, Kadence, Blocksy — all good choices)
- Hostinger's AI Website Builder is an option for simpler sites but offers less flexibility than WordPress
- Enable automatic backups in Hostinger from day one

---

## What happens to the migrated WP sites in the meantime?

Three options for the period between domain transfer completion and new site launch:

| Option | Description | Recommendation |
|---|---|---|
| **Keep the migrated WP sites live** | Swap the primary domain on each Hostinger site from `*.hostingersite.com` to the real `.de` so visitors see the existing (old-design) content | ✅ **Recommended** — patients always reach working contact info |
| **Placeholder "Site under construction"** | Simple holding page with practice phone, address, email | Acceptable but visibly broken; patients in distress shouldn't see this |
| **Redirect to a temporary contact page** | Single static page with contact info only | Worst option for active medical practices |

For **active psychotherapy practices**, option 1 is the right call. The old design isn't pretty, but a working page is far better than a placeholder when someone urgently needs an appointment.

If you do go with option 1, this small step is needed once DNS resolves the .de domain to Hostinger:
- In hPanel for each site: change primary domain from `*.hostingersite.com` to the real `.de` domain
- Run search-replace in the WP database to update internal URLs (Hostinger has a built-in tool, or use Better Search Replace plugin)
- Verify SSL is auto-issued for the .de domain

---

## Recommended order of operations

1. **Today:** Initiate both domain transfers at Hostinger using the Auth codes. This starts the clock and protects against Auth code expiry.
2. **Today / tomorrow:** Inventory Strato mailboxes; the Kretzschmars start the local Thunderbird/MailStore backup of all mail.
3. **Within 1–3 days:** Verify backups are complete; create matching mailboxes at Hostinger.
4. **When domain transfer completes** (1–4 days for .de):
  - Swap the migrated WP sites' primary domain to the real `.de` (interim solution)
  - Run search-replace in WP databases
  - Update MX records to Hostinger mail servers
  - Verify SSL is issued
5. **Restore email** from local backup into Hostinger mailboxes via Thunderbird drag-and-drop or MailStore export.
6. **After cutover:**
  - Update Birgit's and Alexander's email client settings (IMAP/SMTP)
  - Test all contact forms, inbound and outbound mail
  - **Keep Strato active for at least 7 days** as a safety net for stray mail
7. **In parallel (separate project):** Begin design and build of new modern WordPress sites on Hostinger staging environments.
8. **When new sites are ready:** Swap each domain to point to the new build; archive or delete the migrated old WP installs.

---

## Risk register

| Risk | Mitigation |
|---|---|
| Auth code expires before transfer initiated | Initiate transfers immediately; re-request from Strato if needed |
| Strato cancellation date passes before transfer initiated | Verify exact "Vertragsende" date today; transfer must be initiated before this |
| Local email backup incomplete (e.g. Sent folder missed) | Verify all folders synced offline before Strato shutdown; re-check folder counts before cutover |
| Backup drive lost or unencrypted (GDPR risk) | Use BitLocker / FileVault / VeraCrypt; treat the drive as patient data |
| Calendar/contacts forgotten in backup | Explicitly export CalDAV/CardDAV as .ics/.vcf if used at Strato |
| Email lost during cutover | Local backup is the safety net; Strato kept active 7+ days post-cutover for stragglers |
| Interim WP site breaks after primary-domain swap | Run thorough search-replace; test admin + frontend before announcing |
| SSL not issued on .de domain | Hostinger auto-issues Let's Encrypt; if delayed, manually trigger from hPanel |
| Patients can't reach practice during transition | Keep migrated WP sites live as interim solution; only swap to new design when fully ready |
| New site goes live with GDPR violations | Pre-launch checklist: locally hosted fonts, no Google Analytics without consent, Datenschutzerklärung + Impressum present |

---

## Reference: Strato Auth code retrieval (if re-issue needed)

1. Log into the Strato Login area with customer number or domain name
2. Settings button → Contract Support → Domain Administration → Domain(s) Overview
3. Next to the cancelled domain, click **Request Auth-Code** / **Request Authcode**
4. Code is emailed to the domain owner's registered address (delivery within ~24 hours)
5. .de codes are valid for 30 days from issue

## Reference: Email backup tools

| Tool | Platform | Cost | Best for |
|---|---|---|---|
| **Thunderbird** | Windows / Mac / Linux | Free | Drag-and-drop backup and restore via IMAP; flexible but manual |
| **MailStore Home** | Windows | Free (personal use) | Guided IMAP archiving with searchable archive; easier UI |
| **imapsync** | Linux / Mac CLI | Free (some paid binaries) | Server-to-server sync without local intermediate; technical users |