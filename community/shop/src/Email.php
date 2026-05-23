<?php
/**
 * E-Mail-Klasse
 */

namespace CommunityShop;

class Email
{
    private Transport $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function sendOrderConfirmation(int $userId, string $orderId): void
    {
        $user = $this->getUser($userId);
        $email = $user['email'];
        $total = $this->getOrderTotal($orderId);
        
        $this->transport->send($email, 'Bestellung erfolgreich aufgegeben', 
            'Order confirmed, thank you for your purchase.');
    }

    private function getUser(int $userId): array
    {
        return ['email' => 'user@example.com'];
    }

    private function getOrderTotal(string $orderId): float
    {
        return 99.99;
    }
}
