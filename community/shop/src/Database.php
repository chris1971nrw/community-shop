<?php
/**
 * Datenbank-Klasse
 */

namespace CommunityShop;

use PDO;
use PDOException;

class Database
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        try {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['port'],
                $config['database'],
                $config['charset']
            );

            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
        } catch (PDOException $e) {
            throw new \Exception('Datenbank-Konnection fehlgeschlagen: ' . $e->getMessage());
        }
    }

    public function query(string $sql, array $params = []): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    }

    public function execute(string $sql, array $params = []): bool
    {
        return $this->pdo->exec($sql);
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
