<?php

use Core\Routes;
use App\Controllers\IndexController;
use App\Controllers\LoginController;


(new Routes())


    ->get('/', IndexController::class)

    ->get('/login', [LoginController::class, 'index'])

    ->post('/login', [LoginController::class, 'login'])

    ->run();




$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$controller = basename($path);


if ($controller == 'index.php' || $controller == 'public' || $controller == basename(getcwd()) || empty($controller)) {
    $controller = 'index';
}

if ( ! file_exists(base_path("controllers/{$controller}.controller.php"))) {
    abort(404);
}

require base_path("controllers/{$controller}.controller.php");