# Laravel Model Analyzer Demo

A demo app showcasing the [`devlin/laravel-model-analyzer`](https://github.com/dev-lin2/laravel-model-optimizer) package — detect Eloquent relationship issues before they hit production.

## Setup

```bash
git clone <repo-url> && cd laravel-model-optimizer-demo
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Then visit `http://localhost:8000`.

## Pages

| Route | Description |
|-------|-------------|
| `/` | Landing page with features overview |
| `/demo` | Interactive model map + analyzer output |
| `/commands` | Command reference for all 3 artisan commands |
| `/config` | Configuration reference + health weight breakdown |
| `/json-demo` | JSON output example for CI/CD integration |

## Artisan Commands

```bash
php artisan model-analyzer:analyze
php artisan model-analyzer:health
php artisan model-analyzer:list-models --with-relationships
```

## Stack

- Laravel 12
- Tailwind CSS (CDN)
- `devlin/laravel-model-analyzer` v2.0

## License

MIT
