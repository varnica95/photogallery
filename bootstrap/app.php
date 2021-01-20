<?php

use App\Core\App;

require __DIR__ . '/../vendor/autoload.php';

$app = new App();

require __DIR__ . '/../routes/web.php';

return $app;



