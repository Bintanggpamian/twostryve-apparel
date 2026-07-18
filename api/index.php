<?php

// Change working directory to Laravel root for proper relative path resolution
chdir(__DIR__ . '/..');

define('LARAVEL_START', microtime(true));

// Setup environment for Vercel Serverless
putenv('APP_ENV=production');
putenv('APP_DEBUG=true');
putenv('APP_KEY=base64:X8nF107+D0N3yv/QWwYy2Hl1K8N7p1+v9q4+R2B/8A8=');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('VIEW_COMPILED_PATH=/tmp/views');
putenv('CACHE_STORE=array');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=/tmp/database.sqlite');

$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'true';
$_ENV['APP_KEY'] = 'base64:X8nF107+D0N3yv/QWwYy2Hl1K8N7p1+v9q4+R2B/8A8=';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
$_ENV['CACHE_STORE'] = 'array';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

if (!file_exists('/tmp/views')) {
    @mkdir('/tmp/views', 0755, true);
}

$sourceDb = __DIR__ . '/../database/database.sqlite';
if (!file_exists('/tmp/database.sqlite')) {
    if (file_exists($sourceDb)) {
        @copy($sourceDb, '/tmp/database.sqlite');
    } else {
        @touch('/tmp/database.sqlite');
    }
}

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    echo "<h1>Laravel Execution Error</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
