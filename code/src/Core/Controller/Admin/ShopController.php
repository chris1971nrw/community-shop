<?php

declare(strict_types=1);

namespace Core\Controller\Admin;

use Core\Controller\AbstractController;
use Core\Model\Product;

/**
 * ShopController (Admin)
 * 
 * Verwaltet Produkte im Shop
 */
class ShopController extends AbstractController
{
    public function index(): array
    {
        // Hole alle Produkte
        $products = $this->getModel()->getProducts();
        
        return [
            'products' => $products,
            'top_products' => $products->getTopProducts(3),
        ];
    }
    
    public function approveProduct(int $id): array
    {
        $product = $this->getModel()->getProduct($id);
        
        if (!$product) {
            return [
                'success' => false,
                'message' => 'Produkt nicht gefunden',
            ];
        }
        
        // Setze Produkt auf "approved"
        $product->setStatus('approved');
        $this->getModel()->saveProduct($product);
        
        return [
            'success' => true,
            'message' => 'Produkt wurde für den Shop genehmigt',
            'product' => $product->toArray(),
        ];
    }
    
    public function removeProduct(int $id): array
    {
        $product = $this->getModel()->getProduct($id);
        
        if (!$product) {
            return [
                'success' => false,
                'message' => 'Produkt nicht gefunden',
            ];
        }
        
        // Lösche Produkt aus Shop
        $this->getModel()->deleteProduct($id);
        
        return [
            'success' => true,
            'message' => 'Produkt wurde aus dem Shop entfernt',
        ];
    }
}