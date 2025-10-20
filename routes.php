<?php

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$basePath = '/book-manage';
$controller = str_replace($basePath, '', $path);

$controller = trim($controller, '/');

if (!$controller) $controller = 'index';

if (!file_exists("controllers/{$controller}.controller.php")) {
    abort(404);
}

require "controllers/{$controller}.controller.php";
