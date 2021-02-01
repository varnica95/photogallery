<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

$app->get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->middleware('cookie');

$app->post('/register', [RegisterController::class, 'store']);
$app->get('/register', [RegisterController::class, 'index']);

$app->post('/login', [LoginController::class, 'store']);
$app->get('/login', [LoginController::class, 'index']);

$app->get('/out', [LoginController::class, 'out']);

$app->get('/galleries/create', [GalleryController::class, 'create'])->middleware('auth');
$app->get('/galleries/{gallery}/show', [GalleryController::class, 'show'])->middleware('auth');
$app->get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->middleware('auth');
$app->put('/galleries/{gallery}/update', [GalleryController::class, 'update'])->middleware('auth');
$app->delete('/galleries/{gallery}/destroy', [GalleryController::class, 'destroy'])->middleware('auth');
$app->post('/galleries', [GalleryController::class, 'store'])->middleware('auth');


$app->get('/images/upload', [ImageController::class, 'upload'])->middleware('auth');
$app->delete('/images/{image}', [ImageController::class, 'destroy'])->middleware('auth');
$app->post('/images', [ImageController::class, 'store'])->middleware('auth');

$app->get('/profile/{user}/show', [ProfileController::class, 'show'])->middleware('auth');
