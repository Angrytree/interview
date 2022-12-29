<?php

use core\Router;
use controllers\HomeController;

Router::get('/', [HomeController::class, 'index']);