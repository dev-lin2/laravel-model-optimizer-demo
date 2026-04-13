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

## Docker Deployment

This repo includes a production-style Docker setup for servers that only have Docker installed. It runs a single app container on host port `8085` and uses a SQLite file inside the persistent `storage` volume, so no separate database container is needed.

```bash
cp .env.docker.example .env
docker compose up -d --build
```

The app container includes PHP and Composer inside the image build, so the server does not need host PHP or host Composer.

If `APP_KEY` is left empty, the container will generate one on first boot and save it in the persistent volume at `storage/app/app.key`. Set `APP_URL=https://model-optimizer.linaung.dev` in `.env` for your reverse proxy deployment.

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
