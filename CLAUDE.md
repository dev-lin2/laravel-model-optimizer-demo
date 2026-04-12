# Claude Code Instructions: Laravel Model Optimizer Demo App

## Project Overview

This is a lightweight Laravel demo application that showcases the `devlin/laravel-model-analyzer` package. The app should have a small but realistic set of Eloquent models with intentional issues (and clean relationships) so the package's CLI commands produce meaningful, demonstrable output.

---

## Stack

- **Laravel 11** (minimal install)
- **SQLite** (zero-config database — no MySQL needed for a demo)
- **Blade** + **Tailwind CDN** (no build step, keep it lightweight)
- **devlin/laravel-model-analyzer** (the package being demoed)

---

## Models to Create

Build these 6 models with migrations. They represent a small blog/e-commerce hybrid:

| Model | Table | Purpose |
|-------|-------|---------|
| `User` | `users` | Standard auth user |
| `Post` | `posts` | Blog posts written by users |
| `Comment` | `comments` | Comments on posts by users |
| `Tag` | `tags` | Labels for posts (many-to-many) |
| `Order` | `orders` | Orders placed by users |
| `Product` | `products` | Products in an order |

### Relationship map (include these intentional issues)

```
User        hasMany     Post        ✅ (Post belongsTo User — complete)
User        hasMany     Comment     ✅ (Comment belongsTo User — complete)
User        hasMany     Order       ✅ (Order belongsTo User — complete)
Post        hasMany     Comment     ✅ (Comment belongsTo Post — complete)
Post        belongsToMany Tag       ✅ (pivot: post_tag)
Order       hasMany     Product     ✅ (Product belongsTo Order — complete)

--- Intentional issues for the analyzer to catch ---
Product     belongsTo   Category    ❌ (Category model does NOT exist — missing foreign key column)
Comment     hasOne      Reaction    ❌ (Reaction model does NOT exist — missing inverse)
Post        references  `editor_id` ❌ (column exists on posts table but no index)
```

These issues should make the health score non-perfect, demonstrating the analyzer's detection capabilities.

---

## Pages to Build

### 1. Home / Landing Page (`/`)

**Route:** `GET /`
**Controller:** `DemoController@index`

Show:
- Hero section: package name, tagline ("Detect relationship issues before they hit production")
- Quick-start code snippet (the composer install command)
- Three feature cards: Relationship Validation, Health Score, CI Integration
- CTA button linking to `/demo`

### 2. Demo Page (`/demo`)

**Route:** `GET /demo`
**Controller:** `DemoController@demo`

Show:
- **Model Map panel** (left/top): List all 6 demo models, their relationships, and mark which ones have issues (use a red/green badge)
- **Command Output panel** (right/bottom): Render pre-captured terminal output (styled as a dark terminal block) showing what `php artisan model-analyzer:analyze` would produce
- Include a tabbed UI: tab 1 = `analyze` output, tab 2 = `health` output, tab 3 = `list-models --with-relationships` output
- Each tab shows realistic fake terminal output styled with ANSI-like colors in HTML

### 3. Commands Reference Page (`/commands`)

**Route:** `GET /commands`
**Controller:** `DemoController@commands`

Show a clean reference table for all three commands:
- `model-analyzer:analyze` — options table + example output block
- `model-analyzer:health` — description + health score gauge (SVG or CSS)
- `model-analyzer:list-models` — options table + example output

### 4. Config Reference Page (`/config`)

**Route:** `GET /config`
**Controller:** `DemoController@config`

Show:
- The full published config with inline comments explaining each key
- Use a syntax-highlighted code block (use highlight.js from CDN)
- Explain `health_weights` visually — show a pie/bar breakdown of the 5 weight categories using CSS bars (no JS chart library needed)

### 5. API / JSON Output Page (`/json-demo`)

**Route:** `GET /json-demo`
**Controller:** `DemoController@jsonDemo`

Show:
- Explanation that the `--format=json` flag makes it CI/pipeline friendly
- A pretty-printed JSON block (realistic sample output from `model-analyzer:analyze --format=json`)
- Copy-to-clipboard button (vanilla JS)

---

## Layout & Design

- Use a shared `layouts/app.blade.php` with a **top navbar** (links: Home, Demo, Commands, Config, JSON Output)
- Tailwind via CDN: `<script src="https://cdn.tailwindcss.com"></script>`
- Color theme: dark sidebar/navbar (`gray-900`), white content, accent color `indigo-600`
- Terminal output blocks: `bg-gray-900 text-green-400 font-mono text-sm rounded-lg p-4`
- Issue badges: `bg-red-100 text-red-700` for errors, `bg-yellow-100 text-yellow-700` for warnings, `bg-green-100 text-green-700` for OK

---

## Seeder

Create a `DemoSeeder` that seeds:
- 3 users
- 5 posts (with tags via pivot)
- 10 comments
- 2 orders with 3 products each

Run automatically in `DatabaseSeeder`.

---

## Routes

```php
// routes/web.php
Route::get('/', [DemoController::class, 'index']);
Route::get('/demo', [DemoController::class, 'demo']);
Route::get('/commands', [DemoController::class, 'commands']);
Route::get('/config', [DemoController::class, 'config']);
Route::get('/json-demo', [DemoController::class, 'jsonDemo']);
```

---

## File Structure to Create

```
app/
  Http/Controllers/DemoController.php
  Models/
    User.php
    Post.php
    Comment.php
    Tag.php
    Order.php
    Product.php

database/
  migrations/
    ...(standard users) + posts, comments, tags, post_tag, orders, products
  seeders/
    DemoSeeder.php

resources/
  views/
    layouts/app.blade.php
    pages/
      index.blade.php
      demo.blade.php
      commands.blade.php
      config.blade.php
      json-demo.blade.php

routes/web.php
```

---

## Terminal Output Samples (use these verbatim in blade views)

### `model-analyzer:analyze` output

```
Scanning models in: app/Models
Found 6 models

Analyzing relationships...

  User .............. OK    (4 relationships, no issues)
  Post .............. WARN  (missing index on `editor_id`)
  Comment ........... WARN  (Reaction inverse missing)
  Tag ............... OK    (1 relationship, no issues)
  Order ............. OK    (1 relationship, no issues)
  Product ........... ERROR (foreign key column `category_id` does not exist)

──────────────────────────────────────────────────────
 Issues found: 1 error, 2 warnings
 Health Score: 62 / 100
──────────────────────────────────────────────────────

  [ERROR]   Product::belongsTo(Category)
            → Column `category_id` not found on `products` table

  [WARNING] Post
            → Column `editor_id` has no index (performance risk)

  [WARNING] Comment::hasOne(Reaction)
            → No inverse relationship found on Reaction model
```

### `model-analyzer:health` output

```
 Model Health Report
 ═══════════════════

 Score: 62/100  ██████░░░░  FAIR

 Breakdown:
  ✔ Inverse relationships    30/30
  ✔ No circular deps         30/30
  ✘ Column existence         10/20  (1 missing column)
  ✔ Foreign key indexes       8/10  (1 unindexed FK)
  ✘ Foreign key constraints   4/10  (missing FK definition)

 Recommendations:
  1. Add `category_id` column to `products` table or remove the Category relationship
  2. Add an index to `posts.editor_id`
  3. Define a Reaction model or remove the hasOne from Comment
```

### `model-analyzer:list-models --with-relationships` output

```
 Discovered Models
 ═════════════════

  Model      Namespace                   Relationships
  ─────────────────────────────────────────────────────
  User       App\Models\User             4
  Post       App\Models\Post             4
  Comment    App\Models\Comment          3
  Tag        App\Models\Tag              1
  Order      App\Models\Order            2
  Product    App\Models\Product          2

 Total: 6 models, 16 relationships
```

---

## Notes for Claude Code

- Keep controllers thin — no business logic, just pass data to views
- Do NOT install Laravel Breeze or any auth scaffolding
- Do NOT use Vite or npm — Tailwind CDN only
- SQLite config: set `DB_CONNECTION=sqlite` in `.env`, create `database/database.sqlite`
- The package itself does not need to produce live output in the web UI — use the pre-captured strings above rendered in Blade
- Add `devlin/laravel-model-analyzer` to `composer.json` and run `composer require` so the artisan commands are actually available (useful for the README demo)
- Include a `README.md` in the project root explaining how to run the demo locally