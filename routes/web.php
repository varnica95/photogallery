<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

$app->get('/home', [HomeController::class, 'index'])->middleware('auth');

$app->post('/register', [RegisterController::class, 'store']);
$app->get('/register', [RegisterController::class, 'index']);

$app->post('/login', [LoginController::class, 'store']);
$app->get('/login', [LoginController::class, 'index']);

$app->get('/out', [LoginController::class, 'out']);

$app->get('/gallery/create', [GalleryController::class, 'index'])->middleware('auth');
$app->get('/gallery/store', [GalleryController::class, 'store'])->middleware('auth');
