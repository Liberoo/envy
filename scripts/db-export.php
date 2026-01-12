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

echo " Exporting database: {$dbName} (user: {$dbUser})\n";
echo "⚠️  This will overwrite existing database.sql file!\n";
echo "\n";

// Check if --yes argument is provided or DB_CONFIRM environment variable
if ((isset($argv[1]) && $argv[1] === '--yes') || getenv('DB_CONFIRM') === 'yes') {
    $confirm = 'yes';
} else {
    // Check if stdin is available (interactive terminal)
    $isInteractive = (function_exists('posix_isatty') && posix_isatty(STDIN)) 
                  || (function_exists('stream_isatty') && stream_isatty(STDIN));
    
    if (!$isInteractive) {
        echo "⚠️  Non-interactive mode detected. Use --yes flag or DB_CONFIRM=yes environment variable.\n";
        echo "   Example: composer db:export -- --yes\n";
        echo "   Or: DB_CONFIRM=yes composer db:export\n";
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
    echo "❌ Export cancelled.\n";
    exit(1);
}

echo "🔄 Starting export...\n";

// Execute mysqldump
$command = sprintf(
    'mysqldump -u "%s" "%s" > database.sql',
    escapeshellarg($dbUser),
    escapeshellarg($dbName)
);

exec($command, $output, $returnCode);

if ($returnCode !== 0) {
    echo "❌ Export failed!\n";
    exit(1);
}

echo "✅ Database exported → database.sql\n";

// Get file size
if (file_exists('database.sql')) {
    $size = filesize('database.sql');
    $units = ['B', 'KB', 'MB', 'GB'];
    $unitIndex = 0;
    while ($size >= 1024 && $unitIndex < count($units) - 1) {
        $size /= 1024;
        $unitIndex++;
    }
    echo " Size: " . round($size, 2) . " " . $units[$unitIndex] . "\n";
}

