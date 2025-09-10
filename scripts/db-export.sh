#!/bin/bash

# Extract only DB variables we need
DB_NAME=$(grep "^DB_NAME=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_USER=$(grep "^DB_USER=" .env | cut -d"=" -f2 | tr -d "'\"")
DB_PASSWORD=$(grep "^DB_PASSWORD=" .env | cut -d"=" -f2 | tr -d "'\"")

echo "í³¤ Exporting database: $DB_NAME (user: $DB_USER)"

# WAMP usually has no password for root
mysqldump -u "$DB_USER" "$DB_NAME" > database.sql

echo "âœ… Database exported â†’ database.sql"
echo "í³Š Size: $(du -h database.sql | cut -f1)"
