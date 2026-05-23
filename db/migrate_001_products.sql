-- Migration 001: Basis-Schema
-- Community Shop - Produkte & Voting

CREATE TABLE IF NOT EXISTS `shop_products` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `image` VARCHAR(500) DEFAULT NULL,
  `amazon_price` DECIMAL(10,2) NOT NULL,
  `affiliate_id` VARCHAR(100) NOT NULL,
  `amazon_url` VARCHAR(500) NOT NULL,
  `score` INT DEFAULT 0 NOT NULL,
  
  -- Voting Counter
  `votes_gefall` INT DEFAULT 0 NOT NULL,
  `votes_favorit` INT DEFAULT 0 NOT NULL,
  `votes_kauf` INT DEFAULT 0 NOT NULL,
  
  -- Lifecycle
  `status` ENUM('pending','approved','shop','rejected') DEFAULT 'pending' NOT NULL,
  `clicks` INT DEFAULT 0 NOT NULL,
  `last_interaction` TIMESTAMP NULL DEFAULT NULL,
  
  -- Timestamps
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  
  -- Indexes
  INDEX `idx_status` (`status`),
  INDEX `idx_score` (`score` DESC),
  INDEX `idx_last_interaction` (`last_interaction` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `shop_votes` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `user_id` INT NULL,
  `user_ip` VARCHAR(45) NOT NULL,
  `user_agent` VARCHAR(255) NOT NULL,
  `type` ENUM('gefall','favorit','kauf') NOT NULL,
  
  -- Timestamps
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  
  -- Foreign Key
  FOREIGN KEY (`product_id`) REFERENCES `shop_products`(`id`) ON DELETE CASCADE,
  
  -- Index
  INDEX `idx_product_id` (`product_id`),
  INDEX `idx_user_ip` (`user_id`, `user_ip`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `shop_users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  UNIQUE INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Default Config (OPTIONAL - config table)
CREATE TABLE IF NOT EXISTS `shop_settings` (
  `key` VARCHAR(50) PRIMARY KEY,
  `value` TEXT NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Init Config
INSERT INTO `shop_settings` (`key`, `value`) VALUES
('top_products_count', '3'),
('min_score_to_approve', '100'),
('max_products_in_voting', '20'),
('decay_per_hour', '1');
