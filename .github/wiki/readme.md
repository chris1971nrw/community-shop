# Community Shop

## 🎯 Was ist das?

Ein community-gesteuerter Shop für Amazon-Produkte, der automatisch Produkte sammelt, bewertet und vorstellt.

---

## 🚀 Features

- 🛍️ **Amazon Integration**: Produkte automatisch extrahieren
- 🗳️ **Community Voting**: 👍 Upvote / ⭐ Favorit / 🛒 Wishlist
- 📊 **Score Modell**: Transparente Bewertungen
- 🔄 **Automatisierung**: Preis-Monitoring & Produkt-Erneuerung
- 💼 **PHP Backend**: MVC-Architektur, REST-API
- 📱 **Responsive Design**: Bootstrap 5

---

## 📋 Projektstatus

| Bereich | Status |
|---------|--|
| MVP | 🟡 In Entwicklung |
| GitHub Pages | ✅ Live 🌐 |
| Documentation | ✅ Complete |
| Database | ⏳ Nächste Phase |

---

## 🛠️ Tech Stack

```yaml
Backend: PHP 8.3+
Frontend: Bootstrap 5
Datenbank: MySQL/PostgreSQL
API: RESTful JSON
CI/CD: GitHub Actions
Monitoring: Prometheus/Grafana
```

---

## 📁 Repository Struktur

```
community-shop/
├── code/              # Application Logic
│   ├── router.php
│   └── src/
│       ├── Controller/
│       ├── Model/
│       └── Service/
├── db/                # Database & Migrations
├── docs/              # Documentation
├── wiki/              # Lokales Wiki
└── .github/
    └── wiki/          # GitHub Wiki Source
```

---

## 🎯 Roadmap

### Phase 1: ✅ Abgeschlossen

- [x] Projektinitialisierung
- [x] GitHub Pages Setup
- [x] Dokumentationen
- [x] Wiki Einrichtung
- [x] Erste Commit & Push

### Phase 2: ⏳ Nächste Schritte

- [ ] Datenbank-Schema definieren
- [ ] API Endpunkte implementieren
- [ ] Amazon Parser entwickeln
- [ ] Voting System
- [ ] Tests & PHPUnit
- [ ] CI/CD Pipeline

### Phase 3: 🚧 Zukünftige Features

- [ ] User Management
- [ ] Kategorien-System
- [ ] Warenkorb
- [ ] Admin Panel
- [ ] Payment Integration
- [ ] Analytics Dashboard

---

## 📚 Dokumentation

- [README.md](../../README.md) - Projekt-Übersicht
- [ARCHITECTURE.md](../../docs/ARCHITECTURE.md) - Technische Details
- [API.md](../../api/README.md) - REST API Reference
- [DEPLOYMENT.md](../../docs/DEPLOYMENT.md) - Deployment Guide

---

## 🚀 Schnelleinstieg

### Lokal starten

```bash
# 1. Clone Repository
git clone https://github.com/chris1971nrw/community-shop.git
cd community-shop

# 2. Dependencies
composer install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Datenbank
php artisan migrate

# 5. Starten
php artisan serve --port=8000
```

### Docker

```bash
docker-compose up -d
docker-compose exec php php artisan serve
```

---

## 📊 Datenmodell

### Haupttabellen

```sql
-- users (Community Mitglieder)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(50) NOT NULL,
    role ENUM('admin', 'moderator', 'member') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- products (Amazon-Extrakte)
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

-- votes (Community Voting)
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

### Products API

| Method | Endpoint | Beschreibung |
|-------|--|------|
| GET | `/api/v1/products` | Alle Produkte |
| GET | `/api/v1/products/{id}` | Einzelprodukt |
| POST | `/api/v1/products` | Neues Produkt |
| PUT | `/api/v1/products/{id}` | Update |
| DELETE | `/api/v1/products/{id}` | Löschen |

### Voting API

| Method | Endpoint | Beschreibung |
|-------|--|------|
| GET | `/api/v1/products/{id}/score` | Vote Score |
| POST | `/api/v1/products/{id}/vote` | Vote abgeben |

---

## 🔒 Sicherheit

- JWT Authentifizierung
- Rate Limiting (100 req/hour)
- CSRF Protection
- Input Validation
- Prepared Statements (PDO)
- XSS Prevention

---

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

---

## 🤝 Community

### Beiträge erwünscht!

- 🐛 **Issues erstellen** für Bugs oder Feature-Requests
- 💻 **Pull Requests** willkommen
- 📝 **Dokumentation verbessern**
- 🎨 **Design Vorschläge**

### Guidelines

- Code Style: PSR-12
- Testing: PHPUnit (≥80% Coverage)
- Documentation: Markdown
- Issues: Label & Milestone
- PRs: Code Review vor Merge

---

## 📝 Meeting Notes

### 2026-05-24

- **Projektstart**: Community Shop MVP
- **Ziel**: MVP in 2-3 Tagen
- **GitHub Pages**: ✅ Live 🌐
- **Wiki**: ✅ Local & GitHub
- **Status**: Phase 1 abgeschlossen

---

## 🔗 Externe Links

- [GitHub Repository](https://github.com/chris1971nrw/community-shop)
- [GitHub Pages](https://github.com/chris1971nrw/community-shop)
- [API Reference](../../api/README.md)
- [Dokumentation](../../docs/README.md)

---

**Version**: 0.1.0 (MVP)  
**Last Updated**: 2026-05-24  
**License**: MIT
