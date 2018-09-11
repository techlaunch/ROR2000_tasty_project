<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Session\Adapter\Files as Session;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();
$loader->registerDirs([
    APP_PATH . '/controllers/',
    APP_PATH . '/models/',
])->register();

// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set('view', function () {
    $view = new View();
    $view->setLayoutsDir(APP_PATH . '/layouts/');
    $view->setViewsDir(APP_PATH . '/views/');
    return $view;
});

// Setup a base URI
$di->set('url', function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');
    return $url;
});

// start the session
$di->setShared('session', function () {
    $session = new Session();
    $session->start();
    return $session;
});

$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
