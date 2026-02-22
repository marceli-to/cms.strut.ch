# Domain: Team

Team member profiles with contact information and CVs.

---

## Model

### TeamMember
**Table:** `team`

| Field | Type | Notes |
|-------|------|-------|
| firstname | string | First name |
| name | string | Last name |
| role | string | Job function/title |
| position | string | Position in company |
| phone | string | Phone number |
| email | string | Email address |
| cv | text | Rich text biography/CV |
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

**Component:** `resources/js/app/views/team/Form.vue`

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Vorname | text input | `firstname` | Yes |
| Name | text input | `name` | Yes |
| Funktion | text input | `role` | — |
| Position | text input | `position` | — |
| Telefon | text input | `phone` | — |
| E-Mail | text input | `email` | Yes |
| Lebenslauf | editor | `cv` | — |
| Bilder | MediaUploader + MediaGrid | via media store | — |

### Fields from old version NOT carried over
- `media` (string column) — replaced by polymorphic media
