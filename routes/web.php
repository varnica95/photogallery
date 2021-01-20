<?php

use App\Http\Controllers\HomeController;

$app->get('/users/{id}', function ($id){
    return $id;
});

$app->get('/home', [HomeController::class, 'index']);
