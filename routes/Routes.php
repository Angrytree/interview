<?php

use core\Router;
use controllers\LoginController;
use controllers\RegistrationController;
use controllers\HomeController;
use controllers\InterviewController;
use controllers\AnswerController;
use controllers\ApiController;

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

Router::post('/interview/answer/store', [AnswerController::class, 'store'], 'auth');
Router::post('/interview/answer/edit', [AnswerController::class, 'edit'], 'auth');
Router::get('/interview/answer/delete', [AnswerController::class, 'delete'], 'auth');

Router::post('/api/getRandomInterview',[ApiController::class, 'getRandomInterview'], 'api');