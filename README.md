# Market Princeps Website

Laravel 13 + Filament 4 CMS for the Market Princeps marketing site, with MySQL and a full admin panel for page content and SEO.

## Requirements

- PHP 8.2+
- Composer
- MySQL
- Node.js (optional; frontend currently uses Tailwind CDN matching the design)

## Setup

```bash
composer install
cp .env.example .env   # or use existing .env
php artisan key:generate
```

Configure MySQL in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=market_princeps
DB_USERNAME=root
DB_PASSWORD=root
```

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## URLs

| URL | Purpose |
|-----|---------|
| http://127.0.0.1:8000 | Homepage |
| http://127.0.0.1:8000/admin | Filament admin |

**Admin login:** `admin@marketprinceps.com` / `password`

## Admin capabilities

- **Site Settings** — brand, contact, global SEO defaults, analytics IDs, social links
- **Pages** — page content + per-page SEO (meta, OG, robots, canonical, schema JSON-LD)
- **Page Sections** — editable JSON sections for homepage (hero, metrics, philosophy, triad, simulator, process, intake)
- **Services / Categories** — mega-menu & footer services with SEO fields
- **Navigation Items** — optional extra nav links
- **Contact Leads** — form submissions from the homepage intake
- **Newsletter** — footer subscribers

## Notes

- Homepage content is seeded from the Stitch design; edit it under **Pages → Home → Sections**
- SEO: page-level fields override site defaults
- More pages can be added the same way (new `Page` + sections + Blade template)
