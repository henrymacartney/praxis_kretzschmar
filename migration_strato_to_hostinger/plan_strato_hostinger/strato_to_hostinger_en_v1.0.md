# Migration Plan: Strato → Hostinger

### Autor: Dr. Henry Macartney
### Datum: 01.05.2026

## Domains in scope

| Domain | Practice owner | Status |
|---|---|---|
| `birgit-kretzschmar.de` | Birgit Kretzschmar (Tanz- und Lehrtherapeutin) | WordPress + DB already migrated to Hostinger staging at `mediumspringgreen-ant-406352.hostingersite.com` |
| `kretzschmar-wiesbaden.de` | Dr. Alexander Kretzschmar (Psychologischer Psychotherapeut) | WordPress + DB already migrated to Hostinger staging at `sienna-kudu-455515.hostingersite.com` |

Both staging sites have been verified live and rendering correctly (content, navigation, images all present).

## Context & constraints

- Both are **professional psychotherapy practices** — patient-facing, 
  GDPR-relevant, regulatory authorities relevant, downtime should be minimised
- Strato cancellation was filed approx. 1 month ago; **AuthInfo codes for both domains are approaching the 30-day expiry** (.de domains)
- Both Auth codes are already in our possession
- WordPress + database migration is **complete** (this part is done)
- Three components per domain originally needed migration:
  1. ✅ WordPress files + MySQL database — **done**
  2. ⏳ Domain registration (.de) — pending, time-critical
  3. ⏳ Email mailboxes — pending, critical for the practices

## What's left — three workstreams

### 1. Domain registration transfer (URGENT — Auth code clock)

Action at **Hostinger**:

1. Open Hostinger's Transfer Domain page
2. Enter `birgit-kretzschmar.de` → pay → paste the AuthInfo code
3. When prompted about nameservers, select **"Use Hostinger nameservers"** (cleanest option since the sites are already on Hostinger)
4. Repeat for `kretzschmar-wiesbaden.de`
5. Confirm the transfer email Hostinger sends

For .de domains the transfer typically completes within 1–4 days.

**If an Auth code expires before we act:** request a fresh one from the Strato Customer Service Area (Login area → Domain Administration → Request Authcode link next to the cancelled domain). Note: per Strato's docs, .de Auth codes are valid 30 days and must be re-requested after.

**Hard deadline:** the Strato cancellation date itself. After that the domain is released and at risk. Confirm the exact "Vertragsende" date from the Strato cancellation confirmation email.

### 2. WordPress primary-domain swap at Hostinger (after transfer initiates)

Right now each site responds to the `*.hostingersite.com` staging hostname. Once Hostinger nameservers take over the real .de domains, each WordPress install needs to switch to responding on the real domain.

In **hPanel**, for each site:

1. Go to the website's settings → change primary domain from `*.hostingersite.com` to the real `.de` domain
2. Run Hostinger's search-replace tool (or use WP-CLI / a plugin like Better Search Replace) to update **all** instances of the staging URL to the real domain in the database — this covers `wp_options` (`siteurl`, `home`), post content, image URLs, theme options, plugin configs
3. Confirm SSL is auto-issued for the .de domain (Let's Encrypt via Hostinger — usually within minutes of DNS resolving)
4. Test thoroughly: navigation, image loading, contact form submissions, admin login

**Order matters:** don't swap the WP primary domain until DNS has propagated to Hostinger, or the site will briefly be unreachable.

### 3. Email mailboxes (the trickiest part — plan carefully)

Patients email these addresses, so this needs to be handled with care.

**Step A — Inventory at Strato**

Log into the Strato email control panel and list, per domain:
- All mailboxes (e.g. `kontakt@…`, `praxis@…`, `info@…`)
- All forwarders and aliases
- Quotas and approximate mail volume per mailbox

**Step B — Decide on the email solution at Hostinger**

Options:
- Hostinger's bundled email accounts (limited; check what the purchased plan includes)
- Hostinger Email (paid, separate from web hosting — recommended for professional use)
- Google Workspace (external, most robust, requires MX pointed at Google instead of Hostinger)

**Step C — Recreate mailboxes at Hostinger**

In hPanel → Emails → create each mailbox with the **same address** as on Strato. Strong new passwords. Document them securely.

**Step D — Migrate existing mail (do this BEFORE Strato is shut off)**

Both mailboxes need to be alive simultaneously for migration. Two viable methods:

- **IMAP-to-IMAP sync** via `imapsync` (CLI tool) or Hostinger's built-in email migration tool if available on the plan. Preserves folders, dates, read/unread state. Best for large mailboxes.
- **Thunderbird drag-and-drop**: connect Thunderbird to both old and new mailboxes via IMAP, drag folders across. Slower but visual and reliable.

**Step E — Switch MX records**

After mailboxes exist at Hostinger and existing mail has been copied across, change the MX records (in Hostinger DNS once they're authoritative for the .de domains) to point to Hostinger's mail servers. Expect a 24–72 hour window where some mail might still arrive at Strato — this is why both mailboxes stay active during cutover.

**Step F — Update mail clients**

Birgit and Alexander will need to update Outlook / Apple Mail / phone IMAP+SMTP settings to Hostinger's servers. Schedule for a quiet day. Provide them with the new server names, ports, and passwords.

## Recommended order of operations

1. **Today:** Initiate both domain transfers at Hostinger using the Auth codes. This starts the clock and protects against Auth code expiry.
2. **Today / tomorrow:** Inventory Strato mailboxes; create matching mailboxes at Hostinger.
3. **Within 1–3 days** (during the transfer window): Run IMAP migration of existing mail from Strato to Hostinger.
4. **When domain transfer completes** (1–4 days later for .de):
  - Switch the WordPress primary domain on each site from `*.hostingersite.com` to the real `.de`
  - Run search-replace in the WP databases
  - Update MX records to Hostinger mail servers
  - Verify SSL is issued
5. **After cutover:**
  - Update Birgit's and Alexander's email client settings (IMAP/SMTP)
  - Test all contact forms, inbound and outbound mail
  - **Keep Strato active for at least 7 days** as a safety net for stray mail and DNS propagation edge cases

## Risk register

| Risk | Mitigation |
|---|---|
| Auth code expires before transfer initiated | Initiate transfers immediately; re-request from Strato if needed |
| Strato cancellation date passes before transfer initiated | Verify exact "Vertragsende" date today; transfer must be initiated before this |
| Email lost during cutover | Migrate IMAP-to-IMAP while both providers are live; keep Strato active 7+ days post-cutover |
| WP site breaks after domain swap (hardcoded staging URLs) | Run thorough search-replace in DB; test admin + frontend before announcing |
| SSL not issued on .de domain | Hostinger auto-issues Let's Encrypt; if delayed, manually trigger from hPanel |
| Patients can't reach practice during transition | Schedule cutover for low-traffic period; consider posting a notice if any downtime expected |

## Reference: Strato Auth code retrieval (if re-issue needed)

1. Log into the Strato Login area with customer number or domain name
2. Settings button → Contract Support → Domain Administration → Domain(s) Overview
3. Next to the cancelled domain, click **Request Auth-Code** / **Request Authcode**
4. Code is emailed to the domain owner's registered address (delivery within ~24 hours)
5. .de codes are valid for 30 days from issue