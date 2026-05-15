# User Requirements Specification — Birgit's Termine Front-End Editor

**Document version:** Draft, 12 May 2026
**Author:** Dr. Henry Macartney (Beriott GmbH)
**Project:** Praxis Kretzschmar website build
**Scope:** Self-service editing of the Termine page on Birgit Kretzschmar's
practice website
**Status:** Draft for discussion with Frau Birgit Kretzschmar

---

## 1. Purpose of this document

This is a User Requirements Specification (URS). Its purpose is to capture, in
Birgit's own words wherever possible, what she needs to be able to
do with her 'Termine' page once the website is live. It is the input document
for the technical design that will follow.

The URS exists to make sure we build the right thing, not just a thing that
works. A URS reviewed and signed off by the client is the contract for what
"done" means.

**This URS deliberately covers only the Termine page.** Other editing needs
(bio, news, photos, etc.) will be scoped in separate URS documents (new 
versions) if and when they are agreed.

---

## 2. Background

During the demo meeting on 6 May 2026, two things became clear:

1. **Birgit's Termine list will need ongoing updates.** New workshops and
   group dates are added throughout the year, past ones removed (or kept as
   archive). The current Beriott build stores Termine in an ACF Repeater
   field accessed via WordPress admin (`wp-admin`).
2. **Birgit is not comfortable with wp-admin.** Her exact words: she would
   prefer a way to "keep her Termine up to date without having to log into
   the WordPress backend". Henry proposed building such a tool. Birgit's
   response was enthusiastic.

## 3. URS structure
The document is split into three audiences:

§1-§3 — Framing for Birgit: what a URS is, why we're doing one, what the 
Termine page actually contains technically (described in plain language)  
§4 — The actual questionnaire for her, organised into 10 questions covering 
frequency, edit type, device, comfort with various activities, design 
preferences, worries, missing/unused fields, draft workflow, and free-form thoughts  
§5-§9 — The contract bits: constraints, out-of-scope (deliberate boundaries 
to stop scope creep), acceptance criteria, timeline, signature block  
Appendix A — Internal Beriott notes that Birgit doesn't need to read but Henry (and future maintainers) will want

## Design choices worth noting

- The field list in §3 is taken directly from the live Termine template 
(template-termine.php) — datum, titel, uhrzeit, ort, beschreibung, gruppentyp. Including this anchors the rest of the conversation in something concrete
- §4.4's comfort table is deliberately ranked low to high so Birgit isn't 
  immediately confronted with "passwords yes/no" but eases into it
- §5 reaffirms the "no patient data" point explicitly. Worth restating in 
  every URS so it never gets accidentally relaxed
- §7 acceptance criteria are testable, observable, and Birgit-centric — they 
  all start "Frau Kretzschmar can…" and end with measurable outcomes. The phrase "without phoning Henry for help" is deliberate
- Appendix A is the bridge between Birgit's URS answers and what Henry 
  actually builds. Without it, the URS is just a questionnaire; with it, you have an honest internal record of how her answers will shape architecture

This URS turns that proposal into something we can actually build.

---

## 3. What the Termine page contains today (technical context)

The Termine page is rendered from a WordPress ACF Repeater field. Each
event in the list has six fields:

| Field             | Type             | Example                                                    | Notes                                |
|-------------------|------------------|------------------------------------------------------------|--------------------------------------|
| **Datum**         | Date             | 2026-05-16                                                 | Stored as ISO; displayed in German   |
| **Titel**         | Short text       | Tanztherapie-Wochenende                                    | Headline of the event                |
| **Uhrzeit**       | Short text       | 10:00–17:00                                                | Free-text time range                 |
| **Ort**           | Short text       | Praxis Wiesbaden, Nußbaumstraße 5                          | Venue                                |
| **Beschreibung**  | Long text        | Ein Wochenende mit Bewegung und Stille…                    | Free-form, can span paragraphs       |
| **Gruppentyp**    | Dropdown         | Offene Gruppe / Geschlossene Gruppe / Tagesseminar / Einzeltermin | Categorisation tag |

Past events are filtered out of the main listing automatically (based on
Datum). They appear in a collapsible "vergangene Termine" section. This
automatic split means Birgit does not have to delete old entries — they
move themselves out of the way.

---

## 4. The questions for Birgit

Please read through and answer at whatever level of detail feels right.
"I haven't thought about it" or "I don't have a strong opinion" are
perfectly valid answers — they tell us where to make a sensible default.

### 4.1 How often will you edit the Termine page?

For example: once a year when planning the calendar; once a month when adding
new dates; whenever something changes.

> *(Your answer)*

### 4.2 What does a typical edit look like?

Pick whichever applies, or describe your own:

- Adding a single new Termin (e.g. a new workshop date came up)
- Adding multiple Termine at once (e.g. planning the autumn calendar)
- Changing the date or location of an existing Termin
- Cancelling a Termin
- Adding a description to a Termin you already created
- Other:

> *(Your answer)*

### 4.3 Where will you typically be when editing?

This matters for device choice — phone screens, laptop screens, and iPad
screens all need different design choices.

- At your desk on a laptop or desktop computer
- On your phone, between sessions
- On an iPad or tablet
- A mix of the above
- Don't know yet

> *(Your answer)*

### 4.4 How comfortable are you with the following?

Honest answers help us design at the right level. There is no right answer.

| Activity                                         | Comfortable | Need help | Avoid if possible |
|--------------------------------------------------|:-----------:|:---------:|:-----------------:|
| Logging into a website with username & password  |             |           |                   |
| Receiving and clicking a one-time login link in email |        |           |                   |
| Typing in a form field                           |             |           |                   |
| Choosing a date from a calendar picker           |             |           |                   |
| Selecting from a dropdown                        |             |           |                   |
| Copy-pasting text from elsewhere                 |             |           |                   |
| Uploading a photo from your phone or computer    |             |           |                   |

### 4.5 What would make this tool feel "easy"?

Some examples to react to:

- "I want to see exactly what the visitor will see, as I edit"
- "I want a simple list of Termine with an Edit button next to each"
- "I want to be reminded what I last changed and when"
- "I want a 'Save' button I can clearly see, not auto-save"
- "I want a 'Preview' button before publishing"
- "I want to add a Termin in under one minute"
- "I want the tool to look nothing like wp-admin"

> *(Your reactions, agreement, disagreement, or additions)*

### 4.6 What worries you?

Things that have worried other clients we've worked with:

- "What if I accidentally delete something?"
- "What if I change something and the page breaks?"
- "What if I forget my password?"
- "Will my changes go live immediately, or can I review first?"
- "Can anyone else edit by accident?"

> *(Your worries, or "none")*

### 4.7 Are there fields you wish were on a Termin that are not on the list above?

Current fields are Datum, Titel, Uhrzeit, Ort, Beschreibung, Gruppentyp. For
example: should there be a registration link? A price? A photo? Contact
person?

> *(Your answer)*

### 4.8 Are there fields on the list above you never use?

If a field is always empty, we can remove it from your editor entirely (it
stays in the website code but is hidden from your view).

> *(Your answer)*

### 4.9 Do you ever want to publish a Termin "in draft" and finalise later?

For example: you've blocked out a date but the time and location aren't set
yet. Should that Termin appear on the website immediately, or stay hidden
until you mark it ready?

> *(Your answer)*

### 4.10 Anything else you've been thinking about?

Free space. Anything that comes to mind. No structure required.

> *(Your answer)*

---

## 5. Constraints we already know

Some things are decided by external factors and are not negotiable in this URS:

- **No patient data, ever.** Termine are public events, not patient sessions.
  This URS does not create any patient-data pathway. (Reaffirmed from the 6 May
  meeting and the German "Elektronische Patientenakte" regulation.)
- **Must work without you ever using wp-admin.** That is the founding premise.
- **Must work on the devices you actually use.** We will not require a desktop
  computer if you primarily use a phone (or vice versa).
- **Changes must be visible on the live site within minutes.** Not next-day,
  not "after Henry reviews". (Henry should actually never need to look at 
  anything unless there is a technical question.)
- **DSGVO compliance.** Anything we build must be documentable in your
  Datenschutzerklärung.

---

## 6. Out of scope (deliberately)

To keep this URS focused, the following are explicitly **out of scope**:

- Editing any page other than Termine (Über mich, therapy pages, Kontakt,
  Praxis information). These remain wp-admin-only for now and will be
  covered by separate URS documents if and when Birgit asks for them.
- Editing the website's design, colours, fonts, layout, or navigation.
  Those remain Beriott's responsibility.
- Patient-facing features (booking, payment, intake forms). Out of scope
  per German regulation.
- Allowing anyone other than Birgit to edit. The tool serves one user.
  Multi-user editing or staff accounts can be added later if needed.
- Importing Termine from external calendars (Google Calendar, Outlook, .ics
  files). Possibly a future enhancement; not in v1.

---

## 7. Acceptance criteria (the test of "done")

Once built, the tool will be accepted when Frau Kretzschmar can, on her own
device, without Henry present, and without using wp-admin:

1. Add a new Termin (all six fields) and see it on the live website within
   five minutes
2. Edit any field of an existing Termin and see the change on the live
   website within five minutes
3. Delete a Termin and see it removed from the live website within five
   minutes
4. Recover access to her account if she forgets her password (or login
   method)
5. Identify which Termin she most recently edited
6. Complete each of the above tasks without phoning Henry for help

These criteria will be tested with Frau Kretzschmar present, using her own
device, before the tool is considered delivered.

---

## 8. Timeline expectations

This URS is a draft as of 12 May 2026. The expected timeline is:

| Milestone                                    | Target date           | Owner                  |
|----------------------------------------------|-----------------------|------------------------|
| URS reviewed by Frau Kretzschmar             | Before end May 2026   | Birgit                 |
| URS finalised and signed off                 | Within 1 week of review | Henry + Birgit       |
| Technical design proposal (FRS) drafted      | June 2026             | Henry                  |
| Build                                        | June–July 2026        | Henry                  |
| Acceptance testing with Birgit               | Before site launch    | Birgit + Henry         |

This sits within the overall Kretzschmars-vacation window (4 weeks in June)
that Beriott has committed to using for delivery.

---

## 9. Sign-off

By signing below, both parties agree this URS accurately captures Frau
Kretzschmar's requirements for self-service editing of the Termine page.
The technical design that follows will reference this document as its
source of truth.

| Role                              | Name                          | Signature | Date |
|-----------------------------------|-------------------------------|-----------|------|
| Client                            | Frau Birgit Kretzschmar       |           |      |
| Beriott GmbH (project owner)      | Dr. Henry Macartney           |           |      |

---

## Appendix A — Notes for the Beriott team (not for Birgit)

This appendix is for internal Beriott use; it does not need to be reviewed
by Frau Kretzschmar.

### Design implications already visible from the field list

- Six fields, one of which is a dropdown. The form fits comfortably on a
  phone screen.
- The Datum field is the most error-prone (date format, timezones, locale).
  A native date-picker on whichever device Birgit uses is non-negotiable.
- The Beschreibung field is the only "long" field — single multi-line
  textarea is fine; full WYSIWYG would be overkill and add complexity.

### Likely architecture choice

Pending Birgit's answers to §4, the most defensible architecture is:

- **Option 4 from the design discussion** (separate small editing app), if
  Birgit confirms she wants something that "looks nothing like wp-admin"
  and is willing to learn a single new login flow
- **Option 1** (custom wp-admin page locked to her account, branded to not
  feel like wp-admin), if she'd accept logging into a custom URL that
  happens to use the WordPress auth stack underneath

The difference is mostly cosmetic from Birgit's perspective but significant
in engineering cost. §4.4 (comfort questions) will largely decide.

### Auth design

- Magic-link auth (email a one-time link) is the strongest candidate per
  §4.4. Removes the "forgot password" worry entirely. Requires a working
  SMTP path from the production server — to be verified against Hostinger
  plan capabilities
- Application Passwords (WP built-in feature) is the fallback if magic-link
  cannot be made reliable on the chosen hosting
- Whatever is chosen must be documented in the Datenschutzerklärung before
  launch

### Data model

No new ACF fields needed for v1. The existing `termine_eintraege` Repeater
already captures everything in §3. The editor reads and writes the same
postmeta the public template renders from. Same source of truth.

### "Draft Termine" question (§4.9)

If Birgit wants a draft state, we add a `status` subfield (boolean or
`draft`/`published` enum) to the Repeater. The template-termine.php
rendering loop already filters by Datum; adding a status filter is one line.
Defer the decision until Birgit answers — adding the field later is cheap
if she doesn't need it now.

### Recovery / undo

The acceptance criterion "Recover access if forgot password" is covered by
WP's existing password-reset flow even in Option 1. For magic-link auth,
the recovery is "send another magic link to the same email".

Undo of accidental edits is NOT in the acceptance criteria as written. If
Birgit raises this in §4.6, we should consider:

- WP's built-in post revision history (works for Repeater meta if
  `acf/save_post` is wired correctly)
- A "last 5 versions" snapshot kept in postmeta
- A simple "are you sure?" modal on delete

The minimal answer for v1 is the modal. Revision history is a v2 feature.

---

*End of URS draft.*
