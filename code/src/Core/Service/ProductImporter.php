<?php

declare(strict_types=1);

namespace Core\Service;

use Core\Model\Product;
use Core\Controller\AmazonScrapper;
use PDO;

/**
 * ProductImporter
 * 
 * Importiert Produkte von Amazon und verwaltet den Import-Queue.
 */
class ProductImporter
{
    private PDO $db;
    private int $maxBatchSize = 100;
    
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    
    /**
     * Queue Produkte für den Import auf
     */
    public function queueProducts(array $amazonLinks): bool
    {
        $stmt = $this->db->prepare('INSERT IGNORE INTO shop_pending_import (amazon_link, created_at) VALUES (:link, NOW())');
        
        foreach ($amazonLinks as $link) {
            $stmt->execute(['link' => $link]);
        }
        
        return true;
    }
    
    /**
     * Bearbeite den Import-Queue
     */
    public function processQueue(int $limit = null): int
    {
        $limit = $limit ?? $this->maxBatchSize;
        
        $stmt = $this->db->prepare('
            SELECT id, amazon_link 
            FROM shop_pending_import 
            WHERE processed_at IS NULL 
            LIMIT :limit
        ');
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $pending = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $imported = 0;
        
        foreach ($pending as $item) {
            try {
                $product = AmazonScrapper::fetchProduct($item['amazon_link']);
                
                if ($product) {
                    $product->setStatus('approved');
                    $this->saveProduct($product);
                    $imported++;
                }
            } catch (\Exception $e) {
                error_log("Product import failed: " . $e->getMessage());
            }
        }
        
        // Markiere als verarbeitet
        if ($imported > 0) {
            $stmt = $this->db->prepare('
                UPDATE shop_pending_import 
                SET processed_at = NOW() 
                WHERE id IN (
                    SELECT id FROM shop_pending_import 
                    WHERE amazon_link IN (
                        SELECT amazon_link FROM shop_pending_import 
                        LIMIT :limit
                    )
                )
            ');
            $stmt->execute(['limit' => $limit]);
        }
        
        return $imported;
    }
    
    /**
     * Speichere Produkt in der Datenbank
     */
    private function saveProduct(Product $product): void
    {
        $stmt = $this->db->prepare('
            INSERT INTO shop_products 
            (name, image, amazon_price, affiliate_id, score, votes_gefall, 
             votes_favorit, votes_kauf, created_at, updated_at, status, clicks, last_interaction)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        
        $stmt->execute([
            $product->getName(),
            $product->getImage(),
            $product->getAmazonPrice(),
            $product->getAffiliateId(),
            $product->getScore(),
            $product->getVotesGefall(),
            $product->getVotesFavorit(),
            $product->getVotesKauf(),
            $product->getCreatedAt(),
            $product->getUpdatedAt(),
            $product->getStatus(),
            $product->getClicks(),
            $product->getLastInteraction(),
        ]);
    }
}