#!/bin/sh
set -e
cd /var/www/html

# Ensure deps once per fresh volume
if [ ! -d node_modules ] || [ -z "$(ls -A node_modules 2>/dev/null)" ]; then
  echo "[vite-node] Installing dependencies..."
  npm ci || npm install
fi

# Remove a stale hot file if any
rm -f public/hot

# Wait until public is writable (bind mount ready)
i=0
until [ -d public ] && [ -w public ] || [ $i -ge 20 ]; do
  echo "[vite-node] Waiting for public/ to be writable..."
  i=$((i+1))
  sleep 0.5
done

echo "[vite-node] Starting Vite dev server..."
exec npm run dev -- --host 0.0.0.0
