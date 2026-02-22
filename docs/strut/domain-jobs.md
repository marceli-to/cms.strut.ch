# Domain: Jobs

Job postings/vacancies with descriptions and downloadable PDFs.

---

## Model

### Job
**Table:** `domain_jobs` (avoids conflict with Laravel's built-in jobs table)

| Field | Type | Notes |
|-------|------|-------|
| title | string | Job title |
| lead | text | Lead/short description |
| info | text | Rich text detailed info |
| order | integer | Sort order |
| publish | boolean | Publishing flag |

**Relationships:**
- `media()` — morphMany `Media` (polymorphic, ordered by sort_order)

**Scopes:**
- `published()` — where publish = 1

---

## Media

Uses the shared polymorphic media system (see domain-awards.md for details).

**Note:** In the old version, the `media` field stored a PDF filename. In the new version, PDFs should be uploaded through the media system. The `MediaUploader` accept prop can be configured if needed.

---

## Admin Form

**Component:** `resources/js/app/views/jobs/Form.vue`

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Titel | text input | `title` | Yes |
| Lead/Beschreibung | textarea | `lead` | Yes |
| Info | editor | `info` | — |
| Medien | MediaUploader + MediaGrid | via media store | — |

### Fields from old version NOT carried over
- `media` (string column) — replaced by polymorphic media
