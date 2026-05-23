<?php
/**
 * HomeController
 * Zeigt die Hauptseite der Community Shop an
 */

namespace CommunityShop\Controllers;

use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function index(ServerRequestInterface $request): array
    {
        return [
            'status' => 'success',
            'data' => [
                'welcome' => 'Willkommen im Community Shop!',
                'features' => [
                    'Warenkorb' => true,
                    'Community' => true,
                    'Punkte-System' => true,
                    'Sicherheit' => true,
                ],
                'products' => []
            ]
        ];
    }
}
