<?php

/**
 * Shop Settings & Konfiguration
 */

return [
    // App Name
    'app_name' => 'Community Shop',
    'app_version' => '1.0.0',
    
    // Voting Scores
    'voting' => [
        'gefall' => 10,      // 👍 Gefällt
        'favorit' => 25,    // ⭐ Favorit
        'kauf' => 5,        // 🛒 Kaufinteresse
        'decay_per_hour' => 1, // Punkteverlust pro Stunde
    ],
    
    // Shop Settings
    'shop' => [
        'top_products_count' => 3, // Anzahl Produkte im Shop
        'min_score_to_approve' => 100, // Mindest-Score für Aufnahme
        'max_products_in_voting' => 20, // Max Produkte gleichzeitig im Voting
    ],
    
    // Cron Settings
    'cron' => [
        'fill_shop_interval' => 3600, // 1 Stunde
        'remove_stale_interval' => 86400, // 24 Stunden
        'check_stale_threshold' => 168, // 7 Tage ohne Interaktion
    ],
    
    // Amazon API
    'amazon' => [
        'api_url' => 'https://webservices.amazon.com/paapi/svc/PAPI',
        'timeout' => 30,
        'user_agent' => 'Community-Shop-Bot/1.0',
    ],
    
    // Cache
    'cache' => [
        'enabled' => true,
        'prefix' => 'shop_',
        'ttl' => 3600,
    ],
    
    // Security
    'security' => [
        'csrf_token_name' => '_shop_csrf',
        'rate_limit' => 100, // Requests pro Minute
        'max_votes_per_ip' => 5,
    ],
];
