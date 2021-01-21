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
        'namespace' => __DIR__ . '/resources/views/',
        'extension' => '.phtml'
    ]
];