<?php

$loader = require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/config.php';

use Knp\Provider\ConsoleServiceProvider;
use Amqp\Silex\Provider\AmqpServiceProvider;

/**
 * Application Configuration
 */
$app = new Silex\Application();

/**
 * Console Service Provider
 */
$app->register(new ConsoleServiceProvider(), array(
    'console.name' => 'Silex console',
    'console.version' => '1.0',
    'console.project_directory' => __DIR__ . '/..',
));

/**
 * AMQP Service Provider
 */
$app->register(new AmqpServiceProvider, array(
    'amqp.connections' => array(
        'default' => array(
            'host' => 'localhost',
            'port' => 5672,
            'username' => 'guest',
            'password' => 'guest',
            'vhost'    => '/',
        ),
    ),
));

/**
 * Merge config
 */
foreach($config as $key => $value) {
    if (isset($app[$key]) && is_array($app[$key])) {
        $app[$key] = array_merge_recursive($app[$key], $value);
    } else {
        $app[$key] = $value;
    }
}

return $app;
