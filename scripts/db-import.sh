#!/bin/bash

# Extract only DB variables we need
DB_NAME=$(grep "^DB_NAME=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_USER=$(grep "^DB_USER=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_PASSWORD=$(grep "^DB_PASSWORD=" .env | cut -d"=" -f2 | tr -d "'\"")

echo "í³¥ Importing to database: $DB_NAME (user: $DB_USER)"

# Create database if not exists and import
mysql -u "$DB_USER" -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\`;"
mysql -u "$DB_USER" "$DB_NAME" < database.sql

echo "âœ… Database imported: database.sql â†’ $DB_NAME"
