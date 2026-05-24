<?php

declare(strict_types=1);

/**
 * Statische Router-Konfiguration
 */

// Basispfad
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', BASE_PATH . '/public');
define('APP_PATH', BASE_PATH . '/src');

// Konstanten für Pfad-Referenzen
define('VENDOR_PATH', BASE_PATH . '/vendor');
define('CACHE_PATH', BASE_PATH . '/cache');
define('TEMP_PATH', BASE_PATH . '/temp');

// Konfiguration
require_once BASE_PATH . '/src/Core/config.php';

// Datenbank verbinden
$pdo = createDatabaseConnection();

// Model anwenden
$model = new Model($pdo);

// Route aufrufen
$request = new Request();
$controller = $request->getController();

// Controller aufrufen
if ($controller) {
    $controller->handleRequest($request);
} else {
    // Standard: Index
    $app = new Application($model, $request);
    echo $app->render('index.php');
}

/**
 * Route Resolver
 */
function resolveRoute(string $path): ?string
{
    // Pfad normalisieren
    $path = rtrim($path, '/') . '/';
    
    // Admin-Bereich
    if (strpos($path, '/admin/') === 0) {
        return 'admin/' . substr($path, 7);
    }
    
    // API-Bereich
    if (strpos($path, '/api/') === 0) {
        return 'api/' . substr($path, 5);
    }
    
    // Standard: public/index.php
    return '/index.php';
}

/**
 * Controller Resolver
 */
function resolveController(string $action): ?string
{
    switch ($action) {
        case 'admin/dashboard':
        case 'admin':
            return 'Core\Controller\AdminController';
            
        case 'admin/users':
        case 'admin/shop':
        case 'admin/orders':
        case 'admin/statistics':
            return 'Core\Controller\AdminController';
            
        case 'admin/approveUser':
        case 'admin/banUser':
        case 'admin/resetPoints':
        case 'admin/removeProduct':
        case 'admin/approveProduct':
            return 'Core\Controller\AdminController';
            
        case 'admin/banUser&id=':
        case 'admin/resetPoints&id=':
        case 'admin/approveUser&id=':
            return 'Core\Controller\AdminController';
    }
    
    return null;
}

/**
 * Model Resolver
 */
function resolveModel(string $type): object
{
    $models = [
        'product' => 'Core\Model\Product',
        'user' => 'Core\Model\User',
        'order' => 'Core\Model\Order',
    ];
    
    return new $models[$type]($pdo);
}