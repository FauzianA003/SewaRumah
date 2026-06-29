<?php
/*
|--------------------------------------------------------------------------
| Re-route Putaran Cache untuk Serverless
|--------------------------------------------------------------------------
*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Paksa Laravel menulis view cache ke folder /tmp
$viewPath = '/tmp/storage/framework/views';
if (!is_dir($viewPath)) {
    mkdir($viewPath, 0755, true);
}
config(['view.compiled' => $viewPath]);

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
