# Community Shop Wiki

Ein Wissensspeicher für das Community-Shop-Projekt.

---

## 🎯 Community Shop

Ein community-gesteuerter Shop für Amazon-Produkte.

### 📋 Überblick

- **Ziel**: Sammeln und Bewerten von Amazon-Produkten durch Community-Voting
- **Target**: MVP innerhalb 2-3 Tage
- **Status**: Phase 1 ✅ / Phase 2 ⏳

### 🛠️ Architektur

```
┌─ Frontend (Bootstrap 5)
├─ API Layer (PHP Controllers)
├─ Service Layer (Amazon Parser)
└─ Database (MySQL/PostgreSQL)
```

### 📂 Repository

[GitHub Repository](https://github.com/chris1971nrw/community-shop)

### 📊 Roadmap

#### Phase 1: Setup ✅

- [x] Projektinitialisierung
- [x] GitHub Pages
- [x] Dokumentationen
- [x] README (Landing Page)
- [x] ARCHITECTURE.md
- [x] API Design

#### Phase 2: Core Development ⏳

- [ ] Datenbank-Schema
- [ ] API Endpunkte implementieren
- [ ] Amazon Parser entwickeln
- [ ] Voting System
- [ ] Tests & CI/CD
- [ ] Deployment Prep

#### Phase 3: Features 🚧

- [ ] User Management
- [ ] Kategorien-System
- [ ] Warenkorb
- [ ] Admin Panel
- [ ] Mobile Responsive
- [ ] Analytics Dashboard

---

## 🔧 Tools & Konfiguration

### Entwicklung

```bash
php artisan serve
php artisan test
php artisan migrate
```

### Docker

```bash
docker-compose up -d
docker-compose run --rm php composer install
```

### Deployment

```bash
git push origin main
# Automatisches Deploy via GitHub Actions
```

---

## 📝 Meeting Notes

### 2026-05-24

- **Projektstart**: Community Shop MVP
- **Ziel**: MVP in 2-3 Tagen
- **Status**: Phase 1 abgeschlossen ✅
- **GitHub Pages**: Live! 🌐

---

## 🔗 Links

- [GitHub Repository](https://github.com/chris1971nrw/community-shop)
- [GitHub Pages](https://github.com/chris1971nrw/community-shop)
- [Dokumentation](./docs/README.md)
- [API Reference](./api/README.md)

---

**_Last Updated: 2026-05-24_**