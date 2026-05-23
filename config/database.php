<?php

/**
 * Database Configuration
 * 
 * MySQL Verbindung für den Shop
 */

return [
    'driver' => 'pdo_mysql',
    'host' => getenv('DB_HOST') ?: 'localhost',
    'dbname' => getenv('DB_NAME') ?: 'community_shop',
    'username' => getenv('DB_USER') ?: 'shop_user',
    'password' => getenv('DB_PASS') ?: '',
    'charset' => 'utf8mb4',
    'prefix' => 'shop_',
    
    // Tabellen
    'products' => [
        'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
        'name' => 'VARCHAR(255)',
        'image' => 'VARCHAR(500)',
        'amazon_price' => 'DECIMAL(10,2)',
        'affiliate_id' => 'VARCHAR(100)',
        'score' => 'INT DEFAULT 0',
        'votes_gefall' => 'INT DEFAULT 0',
        'votes_favorit' => 'INT DEFAULT 0',
        'votes_kauf' => 'INT DEFAULT 0',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        'status' => 'ENUM(\'pending\',\'approved\',\'rejected\')',
        'clicks' => 'INT DEFAULT 0',
        'last_interaction' => 'TIMESTAMP NULL'
    ],
    
    'votes' => [
        'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
        'product_id' => 'INT NOT NULL',
        'user_id' => 'INT NULL',
        'type' => 'ENUM(\'gefall\',\'favorit\',\'kauf\')',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'ip_address' => 'VARCHAR(45)',
        'FOREIGN KEY (product_id) REFERENCES products(id)'
    ],
    
    'users' => [
        'id' => 'INT PRIMARY KEY AUTO_INCREMENT',
        'username' => 'VARCHAR(100)',
        'email' => 'VARCHAR(255)',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
    ]
];
