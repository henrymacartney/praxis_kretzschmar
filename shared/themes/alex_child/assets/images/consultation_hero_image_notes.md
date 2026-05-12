# Consultation Hero Image — Implementation Notes

**Site:** Alex Kretzschmar (`shared/themes/alex_child/`)
**File:** `consultation_bw_web.jpg`
**Prepared:** 9 May 2026
**Status:** File ready; CSS and ACF wiring deferred to items 8/10 of the project handoff.

---

## File details

| Property        | Value                                                |
|-----------------|------------------------------------------------------|
| Filename        | `consultation_bw_web.jpg`                            |
| Source          | Pexels stock photo (model release, free for commercial use) |
| Original size   | 5586 × 3724 px, 1.78 MB, RGB JPEG                    |
| Output size     | 2400 × 1600 px, ~444 KB, greyscale JPEG, progressive, q82 |
| Conversion      | Pillow `convert("L")` (ITU-R BT.601 luminance), Lanczos resampling |
| Crop            | None — full frame preserved                          |

The file is fully opaque. Opacity is applied at render time via CSS, not baked into the file. This keeps it palette-agnostic and lets you tune the effect without re-uploading.

## Where it goes

Most likely use site is the Hero band of `front-page.php` (around line 75), via the `hero_background_image` ACF field on the Startseite page.

Upload via **wp-admin → Media → Add New**, then attach to the field:
**Pages → Startseite → edit → Alex Hero field group → Hero Background Image → Add Image.**

ACF field definition (already published, see `shared/themes/alex_child/acf-json/group_69fea7e373804.json`):

- Field name: `hero_background_image`
- Field type: Image
- Return Format: Image Array

The template reads it as `$hero_bg['sizes']['2048x2048']` with a fallback to `$hero_bg['url']` — so WordPress's auto-generated `2048x2048` size will be used when available, and our 2400px-wide source image gives that crop room to breathe.

## CSS for the "hint of background" effect

The `front-page.php` Hero band already wraps the background image in a `.hero-bg` element with an inline `style="background-image: url(...)"`. The hero text lives in a sibling `.hero-content`, so an `opacity` utility on `.hero-bg` does *not* fade the text — only the bg image.

**Recommended pattern** — Tailwind opacity utility on the bg-image element:

```html
<div class="hero-bg absolute inset-0 bg-cover bg-center opacity-15"
     style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');"></div>
```

Tweak between `opacity-10` and `opacity-25` (i.e. 10–25 %) until it reads as a hint against the navy. Start at `opacity-15`.

If this needs to be applied conditionally only when an image is set (rather than against the navy fallback), gate the opacity utility:

```php
<div class="hero-bg absolute inset-0 bg-cover bg-center <?php echo $hero_bg ? 'opacity-15' : ''; ?>"
     style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');"></div>
```

## Cropping & focal point

At 2400×1600 (3:2), the image is wider than it is tall. The Hero band uses `bg-cover bg-center`, so the centre of the image — the gap between the two figures — is the focal point at most viewport sizes.

For a low-opacity wash this is right: neither figure dominates, and the symmetry suits a "consultation/dialogue" tone without putting either party forward.

If at any point you want the focal point on a specific figure, switch to:

- `bg-left` — keeps the male figure (left side of frame) in shot at narrow viewports
- `bg-right` — keeps the female figure in shot

Don't change the file; change the utility.

## Alternative: stronger blend approach

If `opacity-15` looks washed out and you want more control, replace the simple opacity with a `mix-blend-mode` + `bg-blend` pattern. This keeps the bg image visible at higher opacity but blends it into the navy:

```html
<div class="hero-bg absolute inset-0 bg-cover bg-center bg-blend-multiply bg-navy-800"
     style="background-image: url('...');"></div>
```

`bg-blend-multiply` darkens the image into the navy — useful if the photo is reading as too "white" against the dark hero. `bg-blend-soft-light`, `bg-blend-overlay`, or `bg-blend-luminosity` give different effects; experiment in browser devtools before committing to one.

This is more sophisticated than straight opacity and gives a more "designed" look, but is overkill if the simple opacity-15 already reads as intended.

## Performance notes

- 444 KB is acceptable for a hero image but not feather-light. If first-paint speed matters more than image quality, re-export at quality 75 (probably 280–320 KB) or downscale to 1920px wide (probably 280–360 KB).
- WordPress will auto-generate smaller responsive sizes (`medium`, `large`, `1536x1536`, `2048x2048`) on upload. The template's `srcset` should pick the appropriate size per viewport. The 2400px source we uploaded is the *largest* served, not the only one.
- Consider lazy-loading the hero bg via `<picture>` and `loading="lazy"` if the band is below the fold on any viewport. (It's not, on desktop. May be on long-handled mobile.)

## Licence trail

Image was downloaded from Pexels.com under their free-for-commercial-use licence with model release. No attribution required by the licence, but worth noting in `docs/content-inventory/alex_image_inventory.md` (or equivalent) for future audits — particularly so a successor working on the site can verify provenance without contacting Alex.

If Alex finds a different image he prefers, this file is superseded — no rework needed beyond re-running the same Pillow pipeline:

```python
from PIL import Image
img = Image.open("source.jpg")
bw = img.convert("L")
target_w = 2400
ratio = target_w / bw.width
bw = bw.resize((target_w, round(bw.height * ratio)), Image.LANCZOS)
bw.save("consultation_bw_web.jpg", "JPEG", quality=82, optimize=True, progressive=True)
```

## Related items in the project handoff

- **Item 8** (handoff §10): Extract the original-design hero image from `version_00_alex.zip` and decide whether *that* image, this `consultation_bw_web.jpg`, or both are used. Consultation imagery may suit the Coaching sub-page rather than the front Hero — worth thinking about with Alex.
- **Item 10** (handoff §10): Populate Startseite ACF fields, including `hero_background_image`. This file is the candidate for that field.
- **Item 11** (handoff §10): Interior pages including the Coaching sub-page (`/leistungen/coaching/`), where this consultation imagery may have a stronger thematic fit.
