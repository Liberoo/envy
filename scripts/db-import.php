#!/usr/bin/env php
<?php

// Extract only DB variables we need
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    echo "❌ Error: .env file not found!\n";
    exit(1);
}

$envContent = file_get_contents($envFile);
preg_match('/^DB_NAME=(.*)$/m', $envContent, $dbNameMatch);
preg_match('/^DB_USER=(.*)$/m', $envContent, $dbUserMatch);

$dbName = trim($dbNameMatch[1] ?? '', " \t\n\r\0\x0B'\"");
$dbUser = trim($dbUserMatch[1] ?? '', " \t\n\r\0\x0B'\"");

echo " Importing to database: {$dbName} (user: {$dbUser})\n";
echo "⚠️  WARNING: This will OVERWRITE all existing data in the database!\n";
echo "⚠️  All current data will be LOST and replaced with database.sql content!\n";
echo "\n";

// Check if database.sql exists
if (!file_exists(__DIR__ . '/../database.sql')) {
    echo "❌ Error: database.sql file not found!\n";
    exit(1);
}

// Check if --yes argument is provided or DB_CONFIRM environment variable
if ((isset($argv[1]) && $argv[1] === '--yes') || getenv('DB_CONFIRM') === 'yes') {
    $confirm = 'yes';
} else {
    // Check if stdin is available (interactive terminal)
    $isInteractive = (function_exists('posix_isatty') && posix_isatty(STDIN)) 
                  || (function_exists('stream_isatty') && stream_isatty(STDIN));
    
    if (!$isInteractive) {
        echo "⚠️  Non-interactive mode detected. Use --yes flag or DB_CONFIRM=yes environment variable.\n";
        echo "   Example: composer db:import -- --yes\n";
        echo "   Or: DB_CONFIRM=yes composer db:import\n";
        exit(1);
    }
    
    // Ask for confirmation
    echo "Are you sure you want to continue? Type 'yes' to confirm: ";
    
    if (function_exists('readline')) {
        $confirm = readline('');
    } else {
        $handle = fopen('php://stdin', 'r');
        $confirm = trim(fgets($handle));
        fclose($handle);
    }
}

if ($confirm !== 'yes') {
    echo "❌ Import cancelled.\n";
    exit(1);
}

echo "🔄 Starting import...\n";

// Create database if not exists
$createDbCommand = sprintf(
    'mysql -u "%s" -e "CREATE DATABASE IF NOT EXISTS `%s`;"',
    escapeshellarg($dbUser),
    escapeshellarg($dbName)
);

exec($createDbCommand, $output, $returnCode);

if ($returnCode !== 0) {
    echo "❌ Failed to create database!\n";
    exit(1);
}

// Import database
$importCommand = sprintf(
    'mysql -u "%s" "%s" < database.sql',
    escapeshellarg($dbUser),
    escapeshellarg($dbName)
);

exec($importCommand, $output, $returnCode);

if ($returnCode !== 0) {
    echo "❌ Import failed!\n";
    exit(1);
}

echo "✅ Database imported: database.sql → {$dbName}\n";

