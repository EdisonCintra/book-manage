<?php

use App\Controllers\DashboardController;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\Notas\NotasCriarController;
use App\Controllers\RegisterController;
use Core\Routes;

(new Routes())

    ->get('/', IndexController::class)

    ->get('/login', [LoginController::class, 'index'])
    ->post('/login', [LoginController::class, 'login'])

    ->get('/dashboard', DashboardController::class)
    ->get('/notas/criar', [NotasCriarController::class, 'index'])
    ->post('/notas/criar', [NotasCriarController::class, 'store'])

    ->get('/logout', LogoutController::class)

    ->get('/registrar', [RegisterController::class, 'index'])
    ->post('/registrar', [RegisterController::class, 'register'])

    ->run();