# System-Architektur

## MVC-Pattern

```
src/
├── Core/
│   ├── Application.php          # Bootstrap
│   ├── Router.php               # Routing
│   ├── Database.php             # DB Connection
│   └── Config.php               # Konfiguration
├── Controllers/
│   ├── ApiController.php        # API Endpoints
│   ├── ScoreController.php      # Score Engine
│   └── UserApiController.php    # User Management
├── Models/
│   ├── User.php                 # User Model
│   ├── Score.php                # Score Model
│   ├── Item.php                 # Shop Item
│   └── Transaction.php          # Transaktion
├── Services/
│   ├── ScoreService.php         # Score Logik
│   ├── AuthService.php          # Auth
│   └── EmailService.php         # E-Mail Service
└── Templates/
    ├── layouts/
    │   └── base.php             # Basis-Layout
    └── pages/
        ├── index.php            # Startseite
        ├── score.php            # Score Anzeige
        └── api.php              # API Response
```

## REST API Design

### Endpoints

```
GET    /api/v1/score            # Score anzeigen
POST   /api/v1/score            # Score berechnen
GET    /api/v1/users            # User Liste
GET    /api/v1/users/{id}       # User Details
POST   /api/v1/transactions     # Transaktion
GET    /api/v1/transactions     # Transaktionsliste
```

### Response Format

```json
{
    "success": true,
    "data": {
        "score": 1500,
        "points": [
            {"name": "Bonus", "value": 500},
            {"name": "Aktion", "value": 1000}
        ]
    },
    "message": "Score erfolgreich berechnet"
}
```

## Database Schema

### Tabellen

```sql
-- Users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100) UNIQUE,
    role ENUM('user', 'moderator', 'admin'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Scores
CREATE TABLE scores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    transaction_id INT,
    amount INT,
    description VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (transaction_id) REFERENCES transactions(id)
);

-- Transactions
CREATE TABLE transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    type VARCHAR(50),
    amount DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bonuses (Score Engine)
CREATE TABLE bonuses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE,
    value INT,
    description TEXT
);

-- Actions (Score Engine)
CREATE TABLE actions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE,
    value INT,
    points INT,
    description TEXT
);
```

## Cron-Jobs

### Zeitpläne

```
0 * * * *                     # Jede Stunde
0 0 * * *                     # Täglich um Mitternacht
0 0 1 * *                     # Alle Tage um 1 Uhr
0 */6 * * *                   # Alle 6 Stunden
```

### Jobs

- **Backup**: Datenbank-Backup (täglich)
- **Score Berechnung**: Score Engine (stündlich)
- **Cleanup**: Alte Daten löschen (täglich)
- **Log Rotation**: Log-Rotation (täglich)
- **Cache Clear**: Cache leeren (täglich)

## Sicherheitsmaßnahmen

```
✅ Prepared Statements (PDO)
✅ CSRF Protection (Token)
✅ XSS Prevention (htmlspecialchars)
✅ Input Sanitization
✅ Rate Limiting (API)
✅ CORS Konfiguration
✅ Password Hashing (bcrypt)
✅ Session Security
```

## Performance

```
✅ Query Optimization
✅ Indexe
✅ Caching (Redis/Memcached)
✅ Lazy Loading
✅ Eager Loading
✅ Connection Pooling
```

## Fehlerbehandlung

```php
// Custom Exceptions
class ShopException extends Exception {}
class ScoreException extends ShopException {}
class TransactionException extends ShopException {}

// Error Handler
try {
    // Code
} catch (Exception $e) {
    $logger->error($e->getMessage());
    throw new ShopException("Ein Fehler ist aufgetreten");
}
```
