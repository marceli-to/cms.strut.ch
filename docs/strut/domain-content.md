# Domain: Content

CMS-like content blocks used for static pages (e.g. About, Contact). Each content block has a unique key and optional image gallery.

---

## Model

### Content
**Table:** `content`

| Field | Type | Notes |
|-------|------|-------|
| key | string | Unique identifier for the content block |
| title | string | Block title |
| text | text | Rich text body |
| publish | boolean | Publishing flag |
| has_media | boolean | Whether block supports media uploads |

**Relationships:**
- `media()` — morphMany `Media` (polymorphic, ordered by sort_order)

**Scopes:**
- `published()` — where publish = 1

**Note:** No destroy endpoint — content blocks are managed, not freely created/deleted.

---

## Media

Uses the shared polymorphic media system (see domain-awards.md for details).
Media tab only shown when `has_media` is true.

### Old version used ContentImage sub-model
The old version had a `content_images` table with `name`, `caption`, `order`, `publish` per image. The new version replaces this with the polymorphic `Media` model (which has `alt`, `caption`, `sort_order`).

---

## Admin Form

**Component:** `resources/js/app/views/content/Form.vue`

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Titel | text input | `title` | Yes |
| Text | editor | `text` | Yes |
| Bilder | MediaUploader + MediaGrid | via media store | conditional (has_media) |

### Fields from old version NOT carried over
- `media` (string column) — replaced by polymorphic media
- `ContentImage` sub-model — replaced by polymorphic media
