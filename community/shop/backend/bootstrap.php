<?php
/**
 * Bootstrap-Datei für Community Shop Backend
 * Initialisiert den Autoloader und Konfiguration
 */

// Autoloader laden
require_once __DIR__ . '/../vendor/autoload.php';

// Konfiguration laden
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/routes.php';

// Anwendungscontainer initialisieren
$app = new CommunityShop\Application();

// Middleware pipelining
$app->middleware([
    new CommunityShop\Middleware\Logging(),
    new CommunityShop\Middleware\Cors(),
    new CommunityShop\Middleware\Session(),
]);

// Router konfigurieren
$app->routes([
    'GET  /' => 'HomeController:index',
    'GET  /api/products' => 'ProductController:list',
    'GET  /api/cart' => 'CartController:get',
    'POST /api/cart' => 'CartController:add',
    'POST /api/checkout' => 'CheckoutController:process',
]);

// Application starten
$app->run();
