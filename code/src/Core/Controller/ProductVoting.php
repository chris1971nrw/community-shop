<?php

declare(strict_types=1);

namespace Core\Controller;

use Core\Model\Product;
use PDO;

/**
 * ProductVoting API
 * 
 * Endpoint für Punkt-Stimmen API
 */
class ProductVoting extends AbstractController
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * Handle API request
     */
    public function handleRequest(string $path): string
    {
        $params = $this->getParams();
        
        // Route-Resolver
        switch ($path) {
            case '/api/vote/product/:id/':
                return $this->voteProduct();
                
            case '/api/vote/product/:id/:type/':
                return $this->voteProductType($params['type']);
                
            case '/api/products/leaderboard/':
                return $this->getLeaderboard();
                
            case '/api/products/random/':
                return $this->getRandomProducts();
                
            case '/api/products/sorts/:type/':
                return $this->getSortedProducts($params['type']);
                
            default:
                return json_encode(['error' => 'Not found']);
        }
    }
    
    /**
     * Handle Product Vote
     */
    private function voteProduct(): string
    {
        $id = $this->extractId();
        
        if (!$id) {
            return json_encode(['error' => 'Invalid product ID']);
        }
        
        $product = $this->getModel()->getProduct($id);
        
        if (!$product) {
            return json_encode(['error' => 'Product not found']);
        }
        
        // Check User Permissions
        if (!$this->app->isAuthorized($id)) {
            return json_encode([
                'error' => 'Not authorized',
                'code' => 403,
            ]);
        }
        
        // Handle Vote
        $votingType = $_POST['type'] ?? 'general';
        $score = (int) ($_POST['score'] ?? 0);
        
        // Handle Voting Logic
        $product = $this->handleVote($product, $votingType, $score);
        
        return json_encode([
            'success' => true,
            'product' => $product->toArray(),
        ]);
    }
    
    /**
     * Handle Product Vote by Type
     */
    private function voteProductType(string $type): string
    {
        $id = $this->extractId();
        
        if (!$id) {
            return json_encode(['error' => 'Invalid product ID']);
        }
        
        $product = $this->getModel()->getProduct($id);
        
        if (!$product) {
            return json_encode(['error' => 'Product not found']);
        }
        
        // Handle Voting Logic
        $votingType = $type;
        $score = (int) ($_POST['score'] ?? 0);
        
        $product = $this->handleVote($product, $votingType, $score);
        
        return json_encode([
            'success' => true,
            'product' => $product->toArray(),
        ]);
    }
    
    /**
     * Handle Vote
     */
    private function handleVote(Product $product, string $type, int $score): Product
    {
        // Check Rate Limit
        if ($this->checkRateLimit()) {
            return $product;
        }
        
        // Check Max Votes per IP
        if ($this->checkMaxVotes($product)) {
            return $product;
        }
        
        // Add Votes
        $product->addVotes($type, $score);
        
        // Update Product in Database
        $this->getModel()->saveProduct($product);
        
        return $product;
    }
    
    /**
     * Check Rate Limit
     */
    private function checkRateLimit(): bool
    {
        // Implementiere Rate Limiting Logik
        // ...
        
        return false;
    }
    
    /**
     * Check Max Votes per IP
     */
    private function checkMaxVotes(Product $product): bool
    {
        // Implementiere Max Votes Logik
        // ...
        
        return false;
    }
    
    /**
     * Get Leaderboard
     */
    private function getLeaderboard(): string
    {
        $limit = (int) ($_GET['limit'] ?? 10);
        
        $products = $this->getModel()->getProducts();
        $leaderboard = $products->getLeaderboard($limit);
        
        return json_encode($leaderboard);
    }
    
    /**
     * Get Random Products
     */
    private function getRandomProducts(): string
    {
        $count = (int) ($_GET['count'] ?? 3);
        
        $products = $this->getModel()->getProducts();
        $random = $products->getRandomProducts($count);
        
        return json_encode($random);
    }
    
    /**
     * Get Sorted Products
     */
    private function getSortedProducts(string $type): string
    {
        $sortBy = $type;
        
        $products = $this->getModel()->getProducts();
        $sorted = $products->getSorted($sortBy);
        
        return json_encode($sorted);
    }
    
    /**
     * Get Product ID from Path
     */
    private function extractId(): ?int
    {
        // Extract ID from path
        preg_match('/\/(\d+)\//', $this->path, $matches);
        
        return $matches[1] ?? null;
    }
    
    /**
     * Get Params
     */
    private function getParams(): array
    {
        $params = [];
        
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $params[$key] = $value;
            }
        }
        
        return $params;
    }
}