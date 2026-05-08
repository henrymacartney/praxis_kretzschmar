# Inline-SVG icon set — Alex's Leistungen grid

Each icon is a single `.svg` file in this folder. Filename = ACF select-field
value (kebab-case). `front-page.php` reads the file via `file_get_contents`
and inlines the SVG into the card markup — no `<img>` tags, no icon font.

## Conventions

- `viewBox="0 0 24 24"` (Heroicons / Lucide compatible)
- `stroke="currentColor"`, `fill="none"`, `stroke-width="1.5"`
- `width` and `height` not set on the SVG itself — sized by the parent
  CSS (`.icon-square svg` → 24×24)
- Currentcolor inheritance lets the icon pick up `text-accent-600` from
  the surrounding `<div class="icon-square ...">`

## Required icons (6 total, one per Leistung card)

The six therapy areas Alex has on his old site, mapped to icon
filenames the ACF select field will offer:

| Filename               | Therapy / service     |
|------------------------|-----------------------|
| `tiefenpsychologie.svg` | Tiefenpsychologie     |
| `gestalttherapie.svg`   | Gestalttherapie       |
| `psychoonkologie.svg`   | Psychoonkologie       |
| `hypnotherapie.svg`     | Hypnotherapie         |
| `coaching.svg`          | Coaching              |
| `praxis.svg`            | Praxis                |

Until these files exist, the cards render without an icon square and
the layout still works. The `$render_icon()` helper in `front-page.php`
returns an empty string for missing files — no broken images, no errors.

## Example shape (placeholder; do not use in production)

See `_example.svg` in this folder for a minimal valid SVG following
the conventions above. Replace each per-service icon with one matched
to the therapy modality.
