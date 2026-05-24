<?php

declare(strict_types=1);

namespace Core\Controller;

use Core\Controller\AbstractController;
use Core\Model\User;

/**
 * AdminController
 * 
 * Verwaltet den Admin-Bereich
 */
class AdminController extends AbstractController
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * Hauptseiten
     */
    public function __invoke(): string
    {
        // Route zu Admin-Controller
        $route = $_GET['action'] ?? 'dashboard';
        
        switch ($route) {
            case 'dashboard':
                return $this->dashboard();
            case 'users':
                return $this->users();
            case 'shop':
                return $this->shop();
            case 'statistics':
                return $this->statistics();
            case 'orders':
                return $this->orders();
            case 'banUser':
                return $this->banUser();
            case 'resetPoints':
                return $this->resetPoints();
            case 'approveUser':
                return $this->approveUser();
            default:
                return $this->dashboard();
        }
    }
    
    /**
     * Dashboard
     */
    private function dashboard(): string
    {
        return $this->render('admin/dashboard.php', [
            'stats' => $this->app->getStats(),
        ]);
    }
    
    /**
     * Benutzer verwalten
     */
    private function users(): string
    {
        $model = $this->app->getModel();
        $users = $model->getUsers();
        
        return $this->render('admin/user.php', [
            'users' => [
                'users' => $users->getAll(),
            ],
        ]);
    }
    
    /**
     * Shop verwalten
     */
    private function shop(): string
    {
        $model = $this->app->getModel();
        $products = $model->getProducts();
        
        return $this->render('admin/shop.php', [
            'products' => [
                'products' => $products->getAll(),
                'top_products' => $products->getTop(3),
            ],
        ]);
    }
    
    /**
     * Statistiken
     */
    private function statistics(): string
    {
        return $this->render('admin/statistics.php', [
            'stats' => $this->app->getStats(),
        ]);
    }
    
    /**
     * Bestellungen
     */
    private function orders(): string
    {
        $model = $this->app->getModel();
        $orders = $model->getOrders();
        
        return $this->render('admin/orders.php', [
            'orders' => $orders->getAll(),
        ]);
    }
    
    /**
     * Benutzer sperrt
     */
    private function banUser(): string
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            return $this->render('admin/user.php', [
                'users' => [
                    'users' => [],
                ],
            ]);
        }
        
        $model = $this->app->getModel();
        $user = $model->getUser($id);
        
        if (!$user) {
            return $this->render('admin/user.php', [
                'users' => [
                    'users' => [],
                ],
            ]);
        }
        
        $user->ban();
        $model->saveUser($user);
        
        return $this->render('admin/user.php', [
            'users' => [
                'users' => $model->getUsers(),
            ],
        ]);
    }
    
    /**
     * Punkte zurücksetzen
     */
    private function resetPoints(): string
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            return $this->render('admin/user.php', [
                'users' => [
                    'users' => [],
                ],
            ]);
        }
        
        $model = $this->app->getModel();
        $user = $model->getUser($id);
        
        if (!$user) {
            return $this->render('admin/user.php', [
                'users' => [
                    'users' => [],
                ],
            ]);
        }
        
        $user->resetPoints();
        $model->saveUser($user);
        
        return $this->render('admin/user.php', [
            'users' => [
                'users' => $model->getUsers(),
            ],
        ]);
    }
    
    /**
     * Benutzer aktivieren
     */
    private function approveUser(): string
    {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            return $this->render('admin/user.php', [
                'users' => [
                    'users' => [],
                ],
            ]);
        }
        
        $model = $this->app->getModel();
        $user = $model->getUser($id);
        
        if (!$user) {
            return $this->render('admin/user.php', [
                'users' => [
                    'users' => [],
                ],
            ]);
        }
        
        $user->setActive(true);
        $model->saveUser($user);
        
        return $this->render('admin/user.php', [
            'users' => [
                'users' => $model->getUsers(),
            ],
        ]);
    }
}