<?php

// Подключение автозагрузчика Composer
require_once __DIR__ . "/vendor/autoload.php";

(new App\Controller\FrontController())->run();