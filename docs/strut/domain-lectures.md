# Domain: Lectures

Lectures and talks, organized by year.

---

## Model

### Lecture
**Table:** `lectures`

| Field | Type | Notes |
|-------|------|-------|
| title | string | Lecture title |
| description | text | Description text |
| year | string | Year given |
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

**Component:** `resources/js/app/views/lectures/Form.vue`

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Titel | text input | `title` | Yes |
| Beschreibung | textarea | `description` | — |
| Jahr | select (years) | `year` | Yes |
| Bilder | MediaUploader + MediaGrid | via media store | — |

### Fields from old version NOT carried over
- `media` (string column) — replaced by polymorphic media
- `file` (document filename) — not used in old form
- `url` (external link) — not used in old form
