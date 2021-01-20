<?php

use App\Http\Controllers\HomeController;

$app->get('/home', [HomeController::class, 'index']);