#!/bin/bash

# Extract only DB variables we need
DB_NAME=$(grep "^DB_NAME=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_USER=$(grep "^DB_USER=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_PASSWORD=$(grep "^DB_PASSWORD=" .env | cut -d"=" -f2 | tr -d "'\"")

echo " Importing to database: $DB_NAME (user: $DB_USER)"
echo "⚠️  WARNING: This will OVERWRITE all existing data in the database!"
echo "⚠️  All current data will be LOST and replaced with database.sql content!"
echo ""
echo "🔄 Starting import..."
# Create database if not exists and import
mysql -u "$DB_USER" -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`;"
mysql -u "$DB_USER" "$DB_NAME" < database.sql

echo "✅ Database imported: database.sql → $DB_NAME"