# 🛠️ Setup Guide

## 🚀 Schnelleinstieg

### 1. Klonen

```bash
git clone https://github.com/chris1971nrw/community-shop.git
cd community-shop
```

### 2. Dependencies installieren

```bash
composer install
```

### 3. Environment konfigurieren

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Datenbank migrieren

```bash
php artisan migrate
```

### 5. Starten

```bash
php artisan serve --port=8000
```

## 🐳 Docker

```bash
docker-compose up -d
docker-compose exec php php artisan serve
```

## 📚 Nächstes

- [Wiki Home](./Home.md) - Übersicht
- [Wiki Roadmap](./Roadmap.md) - Projektplanung
- [API Documentation](../../api/README.md) - REST API

---

**Version**: 0.1.0 (MVP)  
**Last Updated**: 2026-05-24
