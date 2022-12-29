<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    require_once  dirname(__DIR__) . '/' . $class_name . '.php';
});

require_once dirname(__DIR__) . '/routes/Routes.php';

use core\Application;

$application = new Application();

$application->run();