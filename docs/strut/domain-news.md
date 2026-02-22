# Domain: News

News articles that can appear standalone or be embedded into homepage grid elements.

---

## Model

### News
**Table:** `news`

| Field | Type | Notes |
|-------|------|-------|
| date | string | Date as free text |
| title | string | Main title |
| subtitle | string | Subtitle |
| text | text | Body text |
| link | string | External URL or email |
| link_text | string | Anchor text for the link |

**Relationships:**
- `media()` — morphMany `Media` (polymorphic, ordered by sort_order)

**Note:** No `publish` field — all news items are visible.

---

## Media

Uses the shared polymorphic media system (see domain-awards.md for details).

---

## Admin Form

**Component:** `resources/js/app/views/news/Form.vue`

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Datum | text input | `date` | — |
| Titel | text input | `title` | Yes |
| Subtitel | text input | `subtitle` | — |
| Text | textarea | `text` | — |
| Link/E-Mail | text input | `link` | — |
| Link Text | text input | `link_text` | — |
| Bilder | MediaUploader + MediaGrid | via media store | — |

### Fields from old version NOT carried over
- `media` (string column) — replaced by polymorphic media
