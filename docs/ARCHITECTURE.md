# 🏗️ Architektur des Community Shop

## 🎯 Systemüberblick

Der Community Shop ist ein PHP-basiertes System zur Sammlung und Bewertung von Amazon-Produkten durch die Community.

## 📐 Architektur-Prinzipien

### MVC Pattern
```
┌─────────────────────────────────────────────┐
│              Presentation (Views)            │
│              Bootstrap Templates            │
│              Blade/PHP Echo                 │
└────────────────────┬────────────────────────┘
                     │
┌────────────────────▼────────────────────────┐
│           Controller Layer                   │
│           - Routing                         │
│           - Input Validation                 │
└────────────────────┬────────────────────────┘
                     │
┌────────────────────▼────────────────────────┐
│           Service Layer                      │
│           - Amazon Parser                     │
│           - Scoring Logic                     │
│           - User Management                   │
└────────────────────┬────────────────────────┘
                     │
┌────────────────────▼────────────────────────┐
│        Repository Layer (Database)           │
│           - PDO Abstraction                   │
└──────────────────────────────────────────────┘
```

### Komponenten

#### 1. Frontend (Views)
- **Technologie**: Bootstrap 5 + Vanilla JS
- **Templates**: PHP Echo oder Blade
- **Responsive**: Mobile-first Design
- **Optimiert**: Ladezeit < 2s

#### 2. API Layer (Controller)
- **Protokoll**: RESTful JSON
- **Versioning**: `/api/v1/...`
- **Middleware**: Validation, Rate Limiting
- **Auth**: JWT oder Session

#### 3. Service Layer
- **Amazon Parser**: URL-Extraktion, Price
- **Scoring**: Vote-Algorithmus
- **Notifications**: Email/Webhooks

#### 4. Datenbank
- **Schema**: Relational (MySQL/PostgreSQL)
- **Migrations**: Versionierte Schema
- **Seeding**: Init-Daten

## 🔌 API Endpunkte

### Products

| Method | Route | Beschreibung |
|-------|-------|--------------|
| GET | `/api/v1/products` | Alle Produkte |
| GET | `/api/v1/products/{id}` | Einzelprodukt |
| POST | `/api/v1/products` | Neues Produkt |
| PUT | `/api/v1/products/{id}` | Update |
| DELETE | `/api/v1/products/{id}` | Löschen |

### Voting

| Method | Route | Beschreibung |
|-------|-------|--------------|
| GET | `/api/v1/products/{id}/score` | Vote Score |
| POST | `/api/v1/products/{id}/vote` | Vote abgeben |

### Categories

| Method | Route | Beschreibung |
|-------|-------|--------------|
| GET | `/api/v1/categories` | Alle Kategorien |
| POST | `/api/v1/categories` | Neue Kategorie |

## 🗄️ Datenmodell

### Tabellen

#### users
- `id` (PK)
- `email` (unique)
- `username`
- `role` (admin/mod/member)
- `created_at`

#### products
- `id` (PK)
- `amazon_url` (unique)
- `title`
- `description`
- `price`
- `image_url`
- `affiliate_id`
- `category_id` (FK)
- `status`
- `created_at`
- `updated_at`

#### votes
- `id` (PK)
- `product_id` (FK)
- `user_id` (FK)
- `type` (upvote/downvote)
- `score`
- `created_at`

#### categories
- `id` (PK)
- `name`
- `description`
- `icon`

### Indexes

```sql
-- Performance Optimierung
CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_votes_product ON votes(product_id);
CREATE INDEX idx_votes_user ON votes(user_id);
CREATE INDEX idx_products_status ON products(status);
```

## 🔒 Sicherheit

### Authentifizierung
- JWT Tokens
- Refresh Tokens
- Rate Limiting (100 req/hour)

### Autorisierung
- Role-based Access Control (RBAC)
- User-permission mapping

### Daten-Privacy
- DSGVO-konform
- Minimale Datenerfassung
- Verschlüsselte Speicherung

### Sicherheit
- Prepared Statements (PDO)
- CSRF Protection
- XSS Prevention
- Input Validation

## 🚀 Deployment

### Environment Variables
```bash
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=community_shop
DB_USERNAME=user
DB_PASSWORD=***
```

### Docker
```dockerfile
FROM php:8.3-fpm
COPY composer.* ./
RUN composer install
COPY . /var/www/html
CMD ["php-fpm"]
```

### GitHub Actions
- Automatisierte Tests
- Security Scanning
- Automated Deploy

## 📊 Monitoring

### Metriken
- Product Freshness Rate
- Daily Active Users
- Vote Distribution
- API Response Time

### Alerts
- Failed Cron Jobs
- Database Errors
- Security Events

## 🧪 Test Strategie

### PHPUnit
```xml
<!-- phpunit.xml -->
<phpunit>
    <testsuites>
        <testsuite name="Unit">
            <directory suffix="Test.php">tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory suffix="Test.php">tests/Feature</directory>
        </testsuite>
    </testsuites>
    <coverage>
        <include>
            <directory suffix=".php">app</directory>
        </include>
    </coverage>
</phpunit>
```

### Test-Coverage Ziel: >80%

## 📈 Skalierung

### Horizontale Skalierung
- Stateless API
- Redis Caching
- Load Balancer

### Datenbank
- Read Replicas
- Partitioning
- Connection Pooling

### CDN
- Static Assets (Bootstrap)
- Images (Product Photos)

## 🔧 Entwicklung

### Workflow
1. Branch erstellen (`feature/...`)
2. Tests schreiben
3. Code review
4. Merge zu main

### Code Quality
- PHP 8.3 (PSR-12)
- PHPStan (Level 5)
- Psalm für Static Analysis
- ESLint für JS

### Commit Messages
```
feat: neue Kategorie-Funktion
fix: Preis-Formatierung korrigieren
docs: README aktualisieren
refactor: Vote-Logik vereinfachen
```

## 📦 Package Management

### Composer.json
```json
{
    "require": {
        "php": ">=8.3",
        "illuminate/support": "^11",
        "guzzlehttp/guzzle": "^7",
        "firebase/php-jwt": "^6"
    },
    "require-dev": {
        "phpunit/phpunit": "^11",
        "phpstan/phpstan": "^2",
        "larastan/larastan": "^3"
    }
}
```

## 🤖 Cron Jobs

```bash
# Preis-Update (täglich 02:00)
0 2 * * * /home/shop/cron/prices-update.sh

# Veraltete Produkte löschen (wöchentlich Sonntag)
0 0 * * 0 /home/shop/cron/cleanup-removed.sh

# Score-Recalculation (stündlich)
0 * * * * /home/shop/cron/score-calculate.sh
```

## 📋 Checkliste für Deployment

- [ ] Database Migrations
- [ ] Cache Clear
- [ ] Environment Variables
- [ ] SSL Certificate
- [ ] Backup Setup
- [ ] Monitoring Alerts
- [ ] Security Scanning
- [ ] Performance Tests

---

**Version**: 0.1.0  
**Last Updated**: 2026-05-24