<?php
/**
 * CartController
 * Handelt Warenkorb-Anfragen
 */

namespace CommunityShop\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class CartController
{
    private Database $db;
    private Session $session;

    public function __construct(Database $db, Session $session)
    {
        $this->db = $db;
        $this->session = $session;
    }

    public function get(ServerRequestInterface $request): array
    {
        $userId = $request->getAttribute('userId');
        $cart = $this->db->query("SELECT * FROM cart WHERE user_id = ?", [$userId]);
        
        return [
            'status' => 'success',
            'data' => [
                'items' => $cart,
                'total' => $this->calculateTotal($cart)
            ]
        ];
    }

    public function add(ServerRequestInterface $request): array
    {
        $userId = $request->getAttribute('userId');
        $productId = $request->getParam('productId');
        $quantity = $request->getParam('quantity', 1);
        
        $this->db->query("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)", 
            [$userId, $productId, $quantity]);
        
        return [
            'status' => 'success',
            'data' => ['message' => 'Produkt zum Warenkorb hinzugefügt']
        ];
    }

    public function calculateTotal(array $cartItems): float
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
