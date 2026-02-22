# Domain: Books

Books/publications collection with descriptions and external links.

---

## Model

### Book
**Table:** `books`

| Field | Type | Notes |
|-------|------|-------|
| title | string | Book title |
| description | text | Description text |
| info | text | Rich text additional info |
| url | string | External link or email |
| order | integer | Sort order |
| publish | boolean | Publishing flag |

**Relationships:**
- `media()` — morphMany `Media` (polymorphic, ordered by sort_order)

**Scopes:**
- `published()` — where publish = 1

---

## Media

Uses the shared polymorphic media system (see domain-awards.md for details).

---

## Admin Form

**Component:** `resources/js/app/views/books/Form.vue`

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Titel | text input | `title` | Yes |
| Beschreibung | textarea | `description` | Yes |
| Info | editor | `info` | — |
| Link/E-Mail | text input | `url` | — |
| Bilder | MediaUploader + MediaGrid | via media store | — |

### Fields from old version NOT carried over
- `media` (string column) — replaced by polymorphic media
