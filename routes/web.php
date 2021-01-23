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

$app->get('/galleries/create', [GalleryController::class, 'create'])->middleware('auth');
$app->post('/galleries', [GalleryController::class, 'store'])->middleware('auth');
