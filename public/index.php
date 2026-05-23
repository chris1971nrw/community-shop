<?php

/**
 * Frontcontroller für den Community Shop
 * 
 * Routing: /products, /vote, /cart, /admin
 */

// Autoloading
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/../src/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Config Laden
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/settings.php';

// Request Routing
$request = new \StdClass();
$request->uri = $_SERVER['REQUEST_URI'] ?? '/';
$request->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$request->body = file_get_contents('php://input');

// Router
$router = new \Shop\Router($request);
$router->dispatch();
