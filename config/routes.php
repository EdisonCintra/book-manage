<?php

use App\Controllers\Notas\DeleteController;
use Core\Routes;

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notas;

use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

(new Routes())

    // Não autenticado
    ->get('/', IndexController::class, GuestMiddleware::class)
    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)
    ->get('/registrar', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/registrar', [RegisterController::class, 'register'], GuestMiddleware::class)

    // Autenticado
    ->get('/logout', LogoutController::class, AuthMiddleware::class)
    ->get('/notas', Notas\IndexController::class, AuthMiddleware::class)
    ->get('/notas/criar', [Notas\CriarController ::class, 'index'], AuthMiddleware::class)
    ->post('/notas/criar', [Notas\CriarController ::class, 'store'], AuthMiddleware::class)

    ->put('/nota', Notas\AtualizarController::class, AuthMiddleware::class)
    ->delete('/nota', DeleteController::class, AuthMiddleware::class)

    ->get('/confirmar', [Notas\VizualizarController ::class, 'confirmar'], AuthMiddleware::class)
    ->post('/mostrar', [Notas\VizualizarController ::class, 'mostrar'], AuthMiddleware::class)
    ->get('/esconder', [Notas\VizualizarController ::class, 'esconder'], AuthMiddleware::class)



    ->run();