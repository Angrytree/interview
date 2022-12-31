<?php

use core\Router;
use controllers\LoginController;
use controllers\RegistrationController;
use controllers\HomeController;
use controllers\InterviewController;

Router::get('/', [LoginController::class, 'index']);
Router::post('/login', [LoginController::class, 'login']);
Router::get('/logout', [LoginController::class, 'logout'], 'auth');

Router::get('/registration', [RegistrationController::class, 'index']);
Router::post('/registration', [RegistrationController::class, 'register']);

Router::get('/home', [HomeController::class, 'index'], 'auth');

Router::get('/interview/show', [InterviewController::class, 'show'], 'auth');
Router::post('/interview/store', [InterviewController::class, 'store'], 'auth');
Router::post('/interview/edit', [InterviewController::class, 'edit'], 'auth');
Router::get('/interview/delete', [InterviewController::class, 'delete'], 'auth');