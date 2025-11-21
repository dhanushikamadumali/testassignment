


Laravel is accessible, powerful, and provides tools required for large, robust applications.

# TestAssignment (Laravel Application)

This repository is a Laravel application skeleton. It was generated from the Laravel project template and uses the Laravel framework and related tooling.

## Framework & key versions

- **Laravel framework:** v12.39.0 (locked in `composer.lock`, `composer.json` requires `^12.0`)
- **PHP required:** ^8.2 (see `composer.json`)
- **laravel/tinker:** v2.10.1
- **laravel/ui:** v4.6.1

You can find the exact installed package versions in `composer.lock` and the requested constraints in `composer.json`.

## Quick setup

1. Install PHP dependencies:

	composer install

2. Copy environment file and generate app key:

	cp .env.example .env
	php artisan key:generate

3. Run database migrations:

	php artisan migrate

4. Install frontend dependencies and build assets (uses Vite):

	npm install
	npm run dev

5. Start the development server:

	php artisan serve

## Running tests

Run the test suite with:

	php artisan test

or using PHPUnit directly:

	./vendor/bin/phpunit

## Notes

- If you need to change PHP or Laravel versions, edit `composer.json` and run `composer update`.
- Check `composer.lock` for the concrete versions actually installed in this workspace.

If you'd like, I can also:
- Add badges (PHP / Laravel / Tests) to this `README.md`.
- Add deployment or Docker instructions.

Let me know which additions you want.

## Install & setup (detailed)

These commands assume you're using the repository root (`.`) and a Bash-like shell on Windows (e.g., `bash.exe`, Git Bash, or WSL). Adjust the commands if you use PowerShell or cmd.exe.

1) Install PHP dependencies (Composer)

```bash
composer install --no-interaction --prefer-dist
```

2) Prepare environment file and app key

```bash
cp .env.example .env
php artisan key:generate
```

3) Configure your database

- SQLite (quick local setup):

```bash
touch database/database.sqlite
# then set DB_CONNECTION=sqlite in your .env
```

- MySQL / MariaDB / PostgreSQL: edit the `.env` values for `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

4) Run database migrations and (optionally) seeders

```bash
php artisan migrate
# To also run seeders:
php artisan db:seed
```

5) Install frontend dependencies and run Vite in dev mode

```bash
npm install
npm run dev
```

6) Start the application server (development)

```bash
php artisan serve --host=127.0.0.1 --port=8000
# open http://127.0.0.1:8000
```

7) Run the test suite

```bash
php artisan test
# or
./vendor/bin/phpunit
```

8) Production build for assets

```bash
npm run build
```

9) Common troubleshooting tips

- Ensure your CLI PHP matches the required version (`^8.2`). Check with `php -v`.
- If migrations fail because of DB credentials, double-check `.env` values and that the database server is reachable.
- If you use SQLite and migrations fail, ensure `database/database.sqlite` exists and is writable.
- Give webserver write permissions to `storage` and `bootstrap/cache` where required:

```bash
chmod -R 0775 storage bootstrap/cache
```



