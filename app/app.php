<?php

session_start();

date_default_timezone_set("GMT");
// Load vendors
require __DIR__.'/../vendor/autoload.php';

// Initialize app

$settings_path = __DIR__.'/settings.php';

if (file_exists($settings_path)) {
    $settings = require $settings_path;
} else {
    $settings = require __DIR__.'/settings.default.php';
}

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__.'/dependencies.php';

// Register middleware
require __DIR__.'/middleware.php';

// Register routes
require __DIR__.'/routes.php';

$app->run();