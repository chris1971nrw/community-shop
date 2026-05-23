<?php
/**
 * CheckoutController
 * Verarbeitet Bestellabwicklungen
 */

namespace CommunityShop\Controllers;

use Psr\Http\Message\ServerRequestInterface;

class CheckoutController
{
    private Database $db;
    private Email $email;

    public function __construct(Database $db, Email $email)
    {
        $this->db = $db;
        $this->email = $email;
    }

    public function process(ServerRequestInterface $request): array
    {
        $userId = $request->getAttribute('userId');
        $cart = $this->getCart($userId);
        
        if (empty($cart)) {
            return [
                'status' => 'error',
                'message' => 'Warenkorb ist leer'
            ];
        }

        // Bestellung erstellen
        $orderId = $this->createOrder($userId, $cart);
        
        // Bestellungen speichern
        $this->saveOrderItems($orderId, $cart);
        
        // Punkte gutschreiben
        $this->addPoints($userId);
        
        // E-Mail versenden
        $this->email->sendOrderConfirmation($userId, $orderId);
        
        // Warenkorb löschen
        $this->clearCart($userId);
        
        return [
            'status' => 'success',
            'data' => [
                'order_id' => $orderId,
                'total' => $this->calculateTotal($cart),
                'message' => 'Bestellung erfolgreich aufgegeben!'
            ]
        ];
    }

    private function getCart(int $userId): array
    {
        return $this->db->query("SELECT * FROM cart WHERE user_id = ?", [$userId]);
    }

    private function createOrder(int $userId, array $cart): string
    {
        $orderId = 'ORD-' . uniqid();
        $this->db->query("INSERT INTO orders (user_id, order_number, status, total) VALUES (?, ?, ?, ?)", 
            [$userId, $orderId, 'processing', 0]);
        return $orderId;
    }

    private function saveOrderItems(string $orderId, array $cart): void
    {
        foreach ($cart as $item) {
            $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)",
                [$orderId, $item['product_id'], $item['quantity'], $item['price']]);
        }
    }

    private function addPoints(int $userId): void
    {
        $points = 100; // Standardpunktgutschrift
        $this->db->query("UPDATE users SET points = points + ? WHERE id = ?", [$points, $userId]);
    }

    private function calculateTotal(array $cart): float
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    private function clearCart(int $userId): void
    {
        $this->db->query("DELETE FROM cart WHERE user_id = ?", [$userId]);
    }
}
