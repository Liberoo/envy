#!/bin/bash

# Przerwij skrypt jeśli wystąpi błąd
set -e

# Sprawdź czy plik .env istnieje
if [ ! -f .env ]; then
  echo "❌ Error: .env file not found!"
  exit 1
fi

# Sprawdź czy plik database.sql istnieje
if [ ! -f database.sql ]; then
  echo "❌ Error: database.sql file not found!"
  exit 1
fi

# Załaduj zmienne z .env
set -a
source .env
set +a

echo " Importing to database: $DB_NAME (user: $DB_USER)"
echo "⚠️  WARNING: This will OVERWRITE all existing data in the database!"
echo "⚠️  All current data will be LOST and replaced with database.sql content!"
echo ""
echo "🔄 Starting import..."

# Utwórz bazę jeśli nie istnieje
MYSQL_PWD="$DB_PASSWORD" mysql -u "$DB_USER" -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`;"

# Import bazy
MYSQL_PWD="$DB_PASSWORD" mysql -u "$DB_USER" "$DB_NAME" < database.sql

echo "✅ Database imported successfully: database.sql → $DB_NAME"