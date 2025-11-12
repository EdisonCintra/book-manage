<?php

$url = $_GET['url'] ?? '';

switch ($url) {
    case 'login':
        require 'controllers/login.controller.php';
        break;

    case 'registrar':
        require 'controllers/registrar.controller.php';
        break;

    case 'logout':
    require 'controllers/logout.controller.php';
    break;

    default:
        require 'controllers/index.controller.php';
        break;
}
