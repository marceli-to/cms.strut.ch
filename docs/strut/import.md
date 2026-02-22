# Data Import

Import production data from the old website into the new CMS.

## Source

- SQL dump: `storage/app/private/import/dump.sql`
- Media files: `storage/app/private/import/media/` (images in root, PDFs in `downloads/`)

## Usage

```bash
# Full import (all modules)
php artisan migrate:fresh
php artisan app:import

# Single module
php artisan app:import --module=team

# Preview without changes
php artisan app:import --dry-run
```

## Modules

| Module | Records | Media | Notes |
|--------|---------|-------|-------|
| categories | 3 + 7 types | — | Must run before projects |
| projects | 61 | 446 images, 28 PDFs | Includes grids (127 grids, 308 items) |
| awards | 13 | 3 | Grouped by year |
| books | 15 | 15 | |
| content | 4 | 2 | Static pages (contact, imprint, about, jobs) |
| jobs | 3 | 2 | 1 missing PDF (old 2020 posting) |
| lectures | 10 | 1 | Grouped by year |
| news | 25 | 10 | No publish column |
| press | 37 | 19 | Links to projects via ID mapping |
| team | 12 | 12 | |

## Import order

The command runs modules in this order: categories, projects, awards, books, content, jobs, lectures, news, press, team.

- `categories` must run before `projects` (FK dependency). If you run `--module=projects` alone, categories are auto-imported first.
- `projects` must run before `press` for `project_id` mapping to work. The ID mapping lives in memory, so both must be in the same run.

## What it does

1. Parses INSERT statements from the SQL dump
2. Unwraps `{"de": "..."}` JSON translation wrappers to plain strings
3. Creates model records with mapped columns
4. Copies media files from `import/media/` to `storage/app/public/uploads/` with randomized filenames
5. Creates polymorphic `Media` records with MIME type, dimensions, file size
6. For projects: builds `ProjectGrid` + `ProjectGridItem` records, maps old `project_image_id` to new `media_id`
7. For press: maps old `project_id` to new project IDs

## Before re-importing

Always `migrate:fresh` first — the command doesn't truncate tables, so running twice creates duplicates.

After a fresh migration, re-create the user:

```bash
php artisan tinker --execute="
\App\Models\User::create([
    'name' => 'Marcel Stadelmann',
    'email' => 'm@marceli.to',
    'password' => \Illuminate\Support\Facades\Hash::make('7aq31rr23'),
]);
"
```

## Known issues

- `5ede2863a5b0a_job_strut_architekten_2020.pdf` — missing from media folder (old unpublished job posting)
- One project has a null title in the dump (`{"de": null}`), resolved to `Machbarkeitsstudie, Oberwenigen` from name + location fields
- Duplicate project slugs (e.g. "Haus A" in Winterthur and Herisau) are resolved by appending the location
