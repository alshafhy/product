# Laravel 13 & Vite Upgrade Guide

This document outlines the changes made during the upgrade from Laravel 10 to Laravel 13 and the migration from Mix to Vite.

## 🚀 Automated Upgrade
Run the following script to perform the automated upgrade steps:
```bash
./upgrade.sh
```

## 🛠 Manual Steps Required

### 1. Update Blade Layouts
Vite replaces Laravel Mix. You MUST update your layout files (e.g., `app.blade.php`) to use the `@vite` directive instead of `mix()`.

**Old (Mix):**
```html
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}"></script>
```

**New (Vite):**
```html
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
```

### 2. Remove Legacy Files
The following files are now obsolete as their logic has been moved to `bootstrap/app.php`:
- `app/Http/Kernel.php`
- `app/Exceptions/Handler.php`

You can safely delete them after verifying that all custom logic has been correctly migrated to `bootstrap/app.php`.

### 3. Update Asset References
If you have images or other assets referenced via `mix()`, change them to use the `Vite::asset()` helper or standard relative paths if they are in the `public` directory.

## 📦 Changes Summary

### Upgraded Packages
- `laravel/framework`: `^13.0`
- `spatie/laravel-permission`: `^6.0`
- `spatie/laravel-activitylog`: `^4.10`
- `phpunit/phpunit`: `^11.0`
- `yajra/laravel-datatables-oracle`: `^11.0`

### Replaced/Removed Packages
- **Replaced**: `arcanedev/log-viewer` → `opcodesio/log-viewer`
- **Removed**: `laravel/ui`, `doctrine/dbal`, `infyomlabs/*`, `psr/simple-cache`, `php-coord/php-coord`.
- **Bundler**: `laravel-mix` and `yarn` removed. `vite` and `npm` are now standard.

## ⚠️ Package Support Warnings
The following packages were kept but should be verified for official Laravel 13 support:
- `carlos-meneses/laravel-mpdf`
- `tamer-dev/laravel-env-cli`
- `kalnoy/nestedset`
- `maatwebsite/excel`

## 🐳 Docker Changes
- Backend service renamed to `cashpos-backend`.
- New `cashpos-node` service added for Vite.
- Network renamed to `cashpos-network`.
