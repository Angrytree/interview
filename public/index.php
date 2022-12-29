<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once  dirname(__DIR__) . '/' . $class_name . '.php';
});

use core\Application;
use controllers\HomeController;

$application = new Application();

$application->router->get('/', [HomeController::class, 'index']);
//$application->router->get('/test', []);

$application->run();