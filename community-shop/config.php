<?php
/**
 * Community Shop Configuration
 * @package CommunityShop
 */

return [
    'app' => [
        'name' => 'Community Shop'
        'version' => '1.0.0',
        'timezone' => 'Europe/Berlin',
        'debug' => false,
    ],
    'database' => [
        'type' => 'sqlite',
        'path' => __DIR__ . '/../database/shop.db',
    ],
    'security' => [
        'session_timeout' => 3600,
        'hash_algorithm' => 'bcrypt',
        'max_upload_size' => 5,
        'allowed_extensions' => ['jpg','jpeg','png','gif','pdf','zip'],
    ],
    'features' => [
        'user_registration' => false,
        'captcha_enabled' => true,
        'notifications' => true,
        'affiliates' => true,
    ],
    'logging' => [
        'path' => __DIR__ . '/../logs/',
        'level' => 'info',
    ],
];
