#!/bin/sh
set -eu

APP_DIR=/var/www/html
STORAGE_DIR="$APP_DIR/storage"
KEY_FILE="$STORAGE_DIR/app/app.key"

mkdir -p \
  "$APP_DIR/bootstrap/cache" \
  "$STORAGE_DIR/app" \
  "$STORAGE_DIR/framework/cache/data" \
  "$STORAGE_DIR/framework/sessions" \
  "$STORAGE_DIR/framework/views" \
  "$STORAGE_DIR/logs"

touch "$STORAGE_DIR/app/database.sqlite"

if [ -z "${APP_KEY:-}" ]; then
  if [ -s "$KEY_FILE" ]; then
    APP_KEY="$(cat "$KEY_FILE")"
  else
    APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
    printf '%s\n' "$APP_KEY" > "$KEY_FILE"
  fi

  export APP_KEY
fi

chown -R www-data:www-data "$STORAGE_DIR" "$APP_DIR/bootstrap/cache"
chmod -R ug+rwX "$STORAGE_DIR" "$APP_DIR/bootstrap/cache"

exec "$@"
