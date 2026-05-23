<?php
/**
 * Routing-Konfiguration
 * ANGEPAST: Nur Amazon-Partner-Links (kein Warenkorb)
 */

return [
    'controllers' => [
        'factories' => [
            'HomeController' => __DIR__ . '/../controllers/HomeController.php',
            'ProductController' => __DIR__ . '/../controllers/ProductController.php',
            'AmazonController' => __DIR__ . '/../controllers/AmazonController.php',
            'CommunityController' => __DIR__ . '/../controllers/CommunityController.php',
        ],
    ],
    'routes' => [
        'web' => [
            'type' => 'web',
            'prefix' => '/',
            'controllers' => [
                'Home' => __DIR__ . '/../controllers/HomeController.php',
                'Products' => __DIR__ . '/../controllers/ProductController.php',
                'Amazon' => __DIR__ . '/../controllers/AmazonController.php',
                'Community' => __DIR__ . '/../controllers/CommunityController.php',
            ],
        ],
    ],
    'amazon' => [
        'api_version' => 'v11',
        'associator_id' => getenv('AMAZON_ASSOCIATOR_ID'),
        'tag' => getenv('AMAZON_TAG') . '.xsi',
        'domain' => 'www.amazon.de',
    ],
];
