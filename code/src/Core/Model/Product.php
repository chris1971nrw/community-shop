<?php

declare(strict_types=1);

namespace Core\Model;

use PDO;

/**
 * Product Model
 * 
 * Verwaltet Produkt-Daten und Punkt-System
 */
class Product
{
    private PDO $db;
    
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    
    public function getDatabase(): PDO
    {
        return $this->db;
    }
    
    /**
     * Get all products
     */
    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM shop_products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get product by ID
     */
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM shop_products WHERE id = ?');
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get leaderboard
     */
    public function getLeaderboard(int $limit = 10): array
    {
        $stmt = $this->db->prepare('
            SELECT id, name, score, votes_general, votes_favorit, votes_kauf, last_interaction
            FROM shop_products 
            ORDER BY score DESC 
            LIMIT ?
        ');
        $stmt->execute([$limit]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get sorted products
     */
    public function getSorted(string $sortBy): array
    {
        $stmt = $this->db->prepare('SELECT * FROM shop_products ORDER BY ' . $sortBy);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get random products
     */
    public function getRandomProducts(int $count = 3): array
    {
        $stmt = $this->db->prepare('SELECT * FROM shop_products ORDER BY RANDOM() LIMIT ?');
        $stmt->execute([$count]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get top products
     */
    public function getTopProducts(int $count = 3): array
    {
        $stmt = $this->db->prepare('SELECT * FROM shop_products ORDER BY score DESC LIMIT ?');
        $stmt->execute([$count]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get products with pagination
     */
    public function getPaginated(int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;
        
        $stmt = $this->db->prepare('
            SELECT * FROM shop_products 
            ORDER BY score DESC 
            LIMIT ? OFFSET ?
        ');
        $stmt->execute([$limit, $offset]);
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get total count
        $countStmt = $this->db->query('SELECT COUNT(*) as count FROM shop_products');
        $total = $countStmt->fetch()['count'];
        
        return [
            'products' => $products,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
        ];
    }
    
    /**
     * Get top 3 products
     */
    public function getTop3(): array
    {
        $stmt = $this->db->prepare('
            SELECT id, name, score, votes_general, votes_favorit, votes_kauf, last_interaction
            FROM shop_products 
            ORDER BY score DESC 
            LIMIT 3
        ');
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get product by ID
     */
    public function getProduct(int $id): ?array
    {
        return $this->getById($id);
    }
    
    /**
     * Add votes to product
     */
    public function addVotes(string $type, int $score): array
    {
        // Implementiere Punkte-Logik
        // ...
        
        return [];
    }
}