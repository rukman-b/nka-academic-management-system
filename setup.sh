#!/bin/sh
set -e

echo "[setup] Preparing NKA Academic Management System..."

if [ ! -f ".env" ]; then
  echo "[setup] Creating .env from .env.example..."
  cp .env.example .env
else
  echo "[setup] .env already exists. Skipping copy."
fi

echo "[setup] Creating Laravel runtime folders on host..."

mkdir -p storage/app/public \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/testing \
  storage/framework/views \
  storage/logs \
  bootstrap/cache

find storage bootstrap/cache -type d -exec chmod 775 {} \; || true
find storage bootstrap/cache -type f -exec chmod 664 {} \; || true

echo "[setup] Building and starting Docker containers..."

docker compose up -d --build

echo "[setup] Running Laravel setup inside the container..."

docker compose exec --user root laravel sh docker/setup.sh

echo "[setup] NKA setup completed."
echo "[setup] Application: http://localhost:${APP_FORWARD_PORT:-8000}"
echo "[setup] phpMyAdmin:  http://localhost:${PHPMYADMIN_FORWARD_PORT:-8080}"