<?php
/**
 * Session-Klasse
 */

namespace CommunityShop;

class Session
{
    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function getId(): ?string
    {
        return $_SESSION['id'] ?? null;
    }

    public function setUserId(?string $userId): void
    {
        $_SESSION['user_id'] = $userId;
    }

    public function getUserId(): ?string
    {
        return $_SESSION['user_id'] ?? null;
    }

    public function regenerate(): void
    {
        session_regenerate_id(true);
    }

    public function destroy(): void
    {
        session_destroy();
    }
}
