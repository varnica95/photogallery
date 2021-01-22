<?php

use App\Core\App;
use App\Core\Includes\Session;

require __DIR__ . '/../vendor/autoload.php';

Session::start();

$app = new App();

require __DIR__ . '/../routes/web.php';

return $app;



