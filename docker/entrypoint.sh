#!/bin/sh
set -e

cd /var/www/html

echo "[entrypoint] Preparing Laravel runtime..."

# If dependencies are not installed yet, do NOT run artisan.
if [ ! -f "vendor/autoload.php" ]; then
  echo "[entrypoint] vendor/autoload.php missing."
  echo "[entrypoint] Run: docker compose run --rm --entrypoint composer laravel install"
  exec php-fpm
fi

echo "Fixing permissions..."
chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

# only generate key if not set
if ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then
  echo "Generating Laravel APP_KEY..."
  php artisan key:generate --force
fi

# create storage link if missing
if [ ! -L "public/storage" ]; then
  echo "Creating storage link..."
  php artisan storage:link
fi

echo "Starting cron + PHP-FPM..."
cron -f & exec php-fpm
