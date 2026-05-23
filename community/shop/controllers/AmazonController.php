<?php
/**
 * AmazonController
 * Generiert Amazon-Partner-Links (kein Warenkorb)
 */

namespace CommunityShop\Controllers;

use Psr\Http\Message\ServerRequestInterface;

class AmazonController
{
    private Database $db;
    private Amazon $amazon;

    public function __construct(Database $db, Amazon $amazon)
    {
        $this->db = $db;
        $this->amazon = $amazon;
    }

    public function generateLink(int $productId, array $params = []): array
    {
        $product = $this->db->query("SELECT * FROM products WHERE id = ?", [$productId]);
        
        if (!$product) {
            return [
                'status' => 'error',
                'message' => 'Produkt nicht gefunden'
            ];
        }
        
        // Amazon-Link mit Affiliate-Tag generieren
        $amazonLink = $this->amazon->buildAffiliateLink($product);
        
        return [
            'status' => 'success',
            'data' => [
                'product' => $product,
                'amazon_url' => $amazonLink,
                'affiliate_tag' => $params['tag'] ?? 'default',
                'message' => 'Amazon-Partner-Link erfolgreich generiert'
            ]
        ];
    }

    public function redirect(string $amazonUrl): array
    {
        return [
            'status' => 'redirect',
            'headers' => [
                'Location' => $amazonUrl,
                'Status' => '302 Found'
            ]
        ];
    }

    public function getAmazonProduct(string $asin): ?array
    {
        // Amazon-API Abruf oder Daten aus Cache
        // Optional: Daten mit Amazon Product API laden
        
        return null; // Placeholder
    }
}
