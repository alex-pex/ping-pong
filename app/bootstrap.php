<?php

$loader = require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/config.php';

use Knp\Provider\ConsoleServiceProvider;

/**
 * Application Configuration
 */
$app = new Silex\Application($config);

/**
 * Console Service Provider
 */
$app->register(new ConsoleServiceProvider(), array(
    'console.name'              => 'Silex console',
    'console.version'           => '1.0',
    'console.project_directory' => __DIR__ . '/..'
));

return $app;
