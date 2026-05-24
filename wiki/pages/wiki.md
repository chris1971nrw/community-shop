# Community Shop Wiki

## 🎯 Was ist der Community Shop?

Ein community-gesteuerter Shop, der Amazon-Produkte sammelt, bewertet und vorstellt.

---

## 📋 Projekt-Status

| Phase | Status |
|-------|--------|
| Phase 1: Setup | ✅ Abgeschlossen |
| Phase 2: Core | ⏳ In Arbeit |
| GitHub Pages | ✅ Live 🌐 |

---

## 🛠️ Tech Stack

- **Backend**: PHP 8.3+
- **Frontend**: Bootstrap 5
- **Datenbank**: MySQL/PostgreSQL
- **API**: RESTful JSON
- **CI/CD**: GitHub Actions

---

## 📁 Projektstruktur

```
community-shop/
├── code/              # Application Code
│   ├── router.php
│   └── src/
│       ├── Core/
│       │   ├── Controller/
│       │   ├── Model/
│       │   └── Service/
│       └── Views/
├── db/                # Database & Migrations
├── docs/              # Documentation
├── wiki/              # Wiki Inhalte
└── README.md
```

---

## 🎯 Features

- ✅ Amazon-Link Extraktion
- ✅ Community Voting (👍 ⭐ 🛒)
- ✅ Automatisches Scoring
- ✅ Preis-Monitoring
- ⏳ User System
- ⏳ Kategorien
- ⏳ Warenkorb

---

## 🚀 Roadmap

### Q3 2026

- [x] MVP Initialisierung
- [x] GitHub Pages Setup
- [ ] Datenbank-Design
- [ ] API Endpunkte
- [ ] Amazon Parser
- [ ] Voting System

### Q4 2026

- [ ] Fullstack MVP
- [ ] User Authentication
- [ ] Payment Integration
- [ ] Admin Panel

### 2027 H1

- [ ] Mobile App
- [ ] Analytics
- [ ] Social Sharing
- [ ] Enterprise Features

---

## 🔧 Entwicklung

### Starten

```bash
php artisan serve --port=8000
```

### Migrations

```bash
php artisan migrate
```

### Tests

```bash
php artisan test
```

### Code Quality

```bash
composer install
vendor/bin/phpstan analyse
vendor/bin/phpunit
```

---

## 📊 Datenmodell

### users

```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(50) NOT NULL,
    role ENUM('admin', 'moderator', 'member') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### products

```sql
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    amazon_url VARCHAR(500) UNIQUE NOT NULL,
    title VARCHAR(255),
    description TEXT,
    price DECIMAL(10,2),
    image_url VARCHAR(500),
    affiliate_id VARCHAR(100),
    category_id INT,
    status ENUM('active', 'inactive', 'removed') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### votes

```sql
CREATE TABLE votes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    type ENUM('upvote', 'downvote', 'wishlist') NOT NULL,
    score DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_product (user_id, product_id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

---

## 🔌 API Endpunkte

### Products

| Method | Endpoint | Beschreibung |
|-------|----------|------|
| GET | `/api/v1/products` | Produktliste |
| GET | `/api/v1/products/{id}` | Einzelprodukt |
| POST | `/api/v1/products` | Neues Produkt |
| PUT | `/api/v1/products/{id}` | Update |
| DELETE | `/api/v1/products/{id}` | Löschen |

### Voting

| Method | Endpoint | Beschreibung |
|-------|----------|------|
| GET | `/api/v1/products/{id}/score` | Vote Score |
| POST | `/api/v1/products/{id}/vote` | Vote abgeben |

---

## 🔒 Sicherheit

- JWT Authentifizierung
- Rate Limiting (100 req/hour)
- CSRF Protection
- Input Validation
- Prepared Statements (PDO)

---

## 📚 Dokumentation

- [README.md](../../README.md) - Übersicht
- [ARCHITECTURE.md](../../docs/ARCHITECTURE.md) - Technische Details
- [API.md](../../api/README.md) - API Reference
- [DEPLOYMENT.md](../../docs/DEPLOYMENT.md) - Deployment Guide

---

## 🤝 Community

### Beiträge erwünscht!

- [Issues erstellen](../../issues)
- [Pull Requests](../../pulls)
- [Dokumentation verbessern](../../docs/)

### Guidelines

- Code Style: PSR-12
- Testing: PHPUnit
- Documentation: Markdown
- Issues: Label & Milestone

---

**Version**: 0.1.0 (MVP)  
**Last Updated**: 2026-05-24  
**License**: MIT
