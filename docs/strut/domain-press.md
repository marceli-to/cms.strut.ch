# Domain: Press

Press coverage and publications, optionally linked to a project. Organized by year.

---

## Model

### Press
**Table:** `press`

| Field | Type | Notes |
|-------|------|-------|
| title | string | Press item title |
| description | text | Description text |
| year | string | Year of publication |
| url | string | External link |
| project_id | FK | → Project (nullable) |
| publish | boolean | Publishing flag |

**Relationships:**
- `media()` — morphMany `Media` (polymorphic, ordered by sort_order)
- `project()` — belongsTo `Project`

**Scopes:**
- `published()` — where publish = 1

---

## Media

Uses the shared polymorphic media system (see domain-awards.md for details).

**Note:** The old version had separate `media` (image) and `file` (PDF) string columns. In the new version, both images and PDFs are handled through the polymorphic media system.

---

## Admin Form

**Component:** `resources/js/app/views/press/Form.vue`

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Titel | text input | `title` | Yes |
| Beschreibung | textarea | `description` | — |
| Jahr | select (years) | `year` | Yes |
| Projekt | select (projects) | `project_id` | — |
| Link | text input | `url` | — |
| Medien | MediaUploader + MediaGrid | via media store | — |

### Fields from old version NOT carried over
- `media` (string column) — replaced by polymorphic media
- `file` (PDF string column) — replaced by polymorphic media
