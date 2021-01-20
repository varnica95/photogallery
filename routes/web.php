<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

$app->get('/home', [HomeController::class, 'index']);

$app->get('/register', [RegisterController::class, 'index']);
