#!/bin/bash

# Extract only DB variables we need
DB_NAME=$(grep "^DB_NAME=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_USER=$(grep "^DB_USER=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_PASSWORD=$(grep "^DB_PASSWORD=" .env | cut -d"=" -f2 | tr -d "'\"")

echo " Exporting database: $DB_NAME (user: $DB_USER)"
echo "⚠️  This will overwrite existing database.sql file!"
echo ""
echo "🔄 Starting export..."
# WAMP usually has no password for root
mysqldump -u "$DB_USER" "$DB_NAME" > database.sql

echo "✅ Database exported → database.sql"
echo "��� Size: $(du -h database.sql | cut -f1)"
