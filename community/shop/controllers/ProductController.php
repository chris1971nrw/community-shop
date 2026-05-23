<?php
/**
 * ProductController
 * Zeigt Produkte mit Amazon-Partner-Links an
 * KEIN Warenkorb - Nur Amazon-Redirects
 */

namespace CommunityShop\Controllers;

use Psr\Http\Message\ServerRequestInterface;

class ProductController
{
    private Database $db;
    private Amazon $amazon;

    public function __construct(Database $db, Amazon $amazon)
    {
        $this->db = $db;
        $this->amazon = $amazon;
    }

    public function list(ServerRequestInterface $request): array
    {
        // Produkte mit Amazon-Links laden
        $products = $this->db->query('SELECT * FROM products ORDER BY name ASC');
        
        return [
            'status' => 'success',
            'data' => [
                'products' => $products,
                'message' => 'Hier sind unsere empfohlenen Produkte von Amazon'
            ]
        ];
    }

    public function get(int $id): array
    {
        $product = $this->db->query("SELECT * FROM products WHERE id = ?", [$id]);
        
        if (!$product) {
            return [
                'status' => 'error',
                'message' => 'Produkt nicht gefunden'
            ];
        }
        
        // Amazon-Link vorbereiten
        $product['amazon_url'] = $this->amazon->getAmazonUrl($product);
        
        return [
            'status' => 'success',
            'data' => $product,
            'message' => 'Hier ist mehr über ' . $product['name'] . ' auf Amazon'
        ];
    }

    public function redirectToAmazon(int $productId): array
    {
        $product = $this->db->query("SELECT * FROM products WHERE id = ?", [$productId]);
        
        if (!$product) {
            return [
                'status' => 'error',
                'message' => 'Produkt nicht gefunden'
            ];
        }
        
        // Amazon-Link generieren
        $amazonUrl = $this->amazon->buildAmazonLink($product);
        
        // Redirect oder JSON Response
        return [
            'status' => 'redirect',
            'data' => [
                'amazon_url' => $amazonUrl,
                'product' => $product
            ],
            'headers' => [
                'Location' => $amazonUrl,
                'Status' => '302 Found'
            ]
        ];
    }
}
