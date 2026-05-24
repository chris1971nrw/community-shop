<?php

declare(strict_types=1);

namespace Core\Controller\Admin;

use Core\Controller\AbstractController;
use Core\Model\User;

/**
 * UserController (Admin)
 * 
 * Verwaltet Benutzer
 */
class UserController extends AbstractController
{
    public function index(): array
    {
        // Hole alle Benutzer
        $users = $this->getModel()->getUsers();
        
        return [
            'users' => $users,
            'pending_users' => $users->getPendingUsers(),
            'active_users' => $users->getActiveUsers(),
        ];
    }
    
    public function approveUser(int $id): array
    {
        $user = $this->getModel()->getUser($id);
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Benutzer nicht gefunden',
            ];
        }
        
        // Aktiviere Benutzer
        $user->setActive(true);
        $this->getModel()->saveUser($user);
        
        return [
            'success' => true,
            'message' => 'Benutzer wurde aktiviert',
            'user' => $user->toArray(),
        ];
    }
    
    public function banUser(int $id, string $reason): array
    {
        $user = $this->getModel()->getUser($id);
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Benutzer nicht gefunden',
            ];
        }
        
        // Sperrt Benutzer
        $user->ban();
        $this->getModel()->saveUser($user);
        
        return [
            'success' => true,
            'message' => 'Benutzer wurde gesperrt',
            'reason' => $reason,
        ];
    }
    
    public function resetUserPoints(int $id): array
    {
        $user = $this->getModel()->getUser($id);
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Benutzer nicht gefunden',
            ];
        }
        
        // Setzt Punkte auf 0
        $user->resetPoints();
        $this->getModel()->saveUser($user);
        
        return [
            'success' => true,
            'message' => 'Punkte wurden zurückgesetzt',
            'user' => $user->toArray(),
        ];
    }
}