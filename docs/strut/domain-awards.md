# Domain: Awards

Awards and honors received, organized by year.

---

## Model

### Award
**Table:** `awards`

| Field | Type | Notes |
|-------|------|-------|
| title | string | Award title |
| description | text | Description text |
| year | string | Year received |
| url | string | External link |
| publish | boolean | Publishing flag |

**Relationships:**
- `media()` — morphMany `Media` (polymorphic, ordered by sort_order)

**Scopes:**
- `published()` — where publish = 1

---

## Media

Uses the shared polymorphic media system. See [Media System](#media-system) below.

- Upload via `MediaUploader` component → stored in `temp/`
- On save, temp media attached via `AttachAction` → moved to `uploads/`
- Media managed (edit, delete, reorder) via `MediaController` endpoints

---

## Admin Form

**Component:** `resources/js/app/views/awards/Form.vue`

No sidebar layout (too few sidebar fields). Single column with `max-w-4xl`.

| Label | Field Type | Binding | Required |
|-------|-----------|---------|:---:|
| Titel | text input | `title` | Yes |
| Beschreibung | editor | `description` | — |
| Jahr | select (years) | `year` | Yes |
| URL | text input | `url` | — |
| Bilder | MediaUploader + MediaGrid | via media store | — |

### Fields from old version NOT carried over
- `file` (document filename) — not used in old form
- `url` was in old model fillable but not in old form; **kept** in new version as it's useful

---

## Media System

All domains use a shared polymorphic media table instead of string columns on domain tables.

### Flow
1. **Upload:** `POST /api/dashboard/media/upload` → file stored in `storage/app/public/temp/`, returns metadata (uuid, file, dimensions, etc.) with `_temp: true`
2. **Frontend:** `MediaUploader` emits `uploaded` event → `mediaStore.addItem()` tracks temp items
3. **Save:** Form collects `mediaStore.tempItems` and sends as `media[]` array with domain data
4. **Attach:** Backend `AttachAction` moves files from `temp/` to `uploads/`, creates `Media` records with polymorphic relationship
5. **Manage:** Edit alt/caption, reorder, delete, set teaser — all via `MediaController` API

### Backend pattern
```php
// Model
public function media(): MorphMany
{
    return $this->morphMany(Media::class, 'mediable')->orderBy('sort_order');
}

// StoreAction / UpdateAction
$media = $data['media'] ?? [];
unset($data['media']);
$model = Model::create($data);
if (!empty($media)) {
    (new AttachMediaAction)->execute($media, $model);
}

// Controller — always eager load
Model::with('media')->...
return new ModelResource($model->load('media'));
```

### Frontend pattern
```javascript
// Form.vue
import { useMediaStore } from '@/stores/media'
const mediaStore = useMediaStore()

// On mount (edit mode)
mediaStore.setItems(model.media || [])

// On submit
const tempMedia = mediaStore.tempItems.map(item => ({
    uuid, file, original_name, mime_type, size, width, height, alt, caption
}))
store.save(form, id, tempMedia)

// Store action
async save(form, id, media = []) {
    const payload = { ...form }
    if (media.length) payload.media = media
    // ...
}
```
