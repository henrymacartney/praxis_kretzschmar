# ACF Local JSON — Alex Child

ACF Pro auto-saves field-group definitions into this folder when they're
created or edited in wp-admin, and auto-loads them on theme activation.
This is the same pattern as `praxis_base/acf-json/`.

**Workflow:** Create field groups in wp-admin → Custom Fields → Field Groups,
assign location rules to Alex's Front Page (and the Footer Options page when
that's set up), and save. ACF writes a `group_<hash>.json` file into this
folder. Commit those files alongside the PHP that consumes them.

## Field groups planned for Alex's child theme

The five-band landing page (`front-page.php`) reads these top-level fields.
Names below match the `get_field()` calls in `front-page.php` — change one,
change both.

### Group: `Alex Hero` (location: page → front page)

| Field name              | Type             | Notes                               |
|-------------------------|------------------|-------------------------------------|
| `hero_background_image` | Image (array)    | Faded B/W therapist+patient image   |
| `hero_headline`         | Text             | Large display headline              |
| `hero_subheadline`      | Textarea         | One or two sentences                |
| `hero_cta_primary_label`   | Text          | e.g. "Kontakt aufnehmen"            |
| `hero_cta_primary_url`     | URL           | Defaults to `/kontakt/`             |
| `hero_cta_secondary_label` | Text          | e.g. "Mehr über mich"               |
| `hero_cta_secondary_url`   | URL           | Defaults to `/ueber-mich/`          |

### Group: `Alex Leistungen Grid` (location: page → front page)

| Field name             | Type           | Notes                                        |
|------------------------|----------------|----------------------------------------------|
| `leistungen_heading`   | Text           | e.g. "Unsere Leistungen"                     |
| `leistungen_intro`     | Textarea       | Psychotherapie intro paragraph (acts as 7th) |
| `leistungen_cards`     | Repeater       | Min 0, max 6 rows                            |
| └ `icon`               | Select         | Options sourced from `assets/icons/*.svg`    |
| └ `title`              | Text           | Card heading                                 |
| └ `summary`            | Textarea       | 1-2 sentences                                |
| └ `link`               | Page Link / Post Object → Page | Returns page object         |

### Group: `Alex Über mich Band` (location: page → front page)

| Field name        | Type          | Notes                          |
|-------------------|---------------|--------------------------------|
| `ueber_heading`   | Text          | e.g. "Über mich"               |
| `ueber_lead`      | Textarea      | One-line lead-in               |
| `ueber_body`      | Textarea      | Short bio paragraph(s)         |
| `ueber_cta_label` | Text          | e.g. "Mehr über mich"          |
| `ueber_cta_url`   | URL           | Defaults to `/ueber-mich/`     |
| `ueber_portrait`  | Image (array) | Portrait of Dr. Kretzschmar    |

### Group: `Alex Kontakt CTA Band` (location: page → front page)

| Field name                      | Type     | Notes                          |
|---------------------------------|----------|--------------------------------|
| `kontakt_heading`               | Text     | e.g. "Kontaktieren Sie uns"    |
| `kontakt_sub`                   | Textarea | One or two sentences           |
| `kontakt_cta_primary_label`     | Text     | e.g. "Kontakt"                 |
| `kontakt_cta_primary_url`       | URL      | Defaults to `/kontakt/`        |
| `kontakt_cta_secondary_label`   | Text     | e.g. "Termin vereinbaren"      |
| `kontakt_cta_secondary_url`     | URL      | TBD                            |

### Group: `Alex Footer` (location: ACF Options Page → "Footer")

The footer options page must be registered separately
(`acf_add_options_page()` — add to child `functions.php` when the
field group is built). Field names are read with the second argument
`'option'` in `template-parts/site-footer.php`.

| Field name                   | Type      | Notes                            |
|------------------------------|-----------|----------------------------------|
| `footer_about`               | Textarea  | "Über uns" blurb                 |
| `footer_schnelllinks`        | Repeater  | label + url subfields            |
| `footer_leistungen`          | Repeater  | label + url subfields            |
| `footer_kontakt_address`     | Textarea  | Multi-line address               |
| `footer_kontakt_phone`       | Text      | Display format with spaces       |
| `footer_kontakt_email`       | Email     |                                  |
| `footer_socials`             | Repeater  | label + url subfields            |

The footer template falls back gracefully when these fields are absent
(uses `wp_nav_menu( 'primary' )` for Schnelllinks, italic placeholder
text for the rest), so the site is not broken between scaffolding the
template and creating the field group.
