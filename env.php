<?php

return [
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'name' => 'gallery',
        'username' => 'root',
        'password' => 'secret',
    ],
    'views' => [
        'root' => __DIR__ . '/resources/views/layouts/app.phtml',
        'directory' => __DIR__ . '/resources/views/',
        'extension' => '.phtml'
    ],
    'middleware' => [
        'namespace' => 'App\\Middlewares\\'
    ],
    'storage' => [
        'default' => 'storage/default/',
        'gallery_images' => 'storage/gallery_images/',
        'images' => 'storage/images/',
    ]
];