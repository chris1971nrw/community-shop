# 🚀 Deployment Guide

## Overview

Dieses Dokument erklärt, wie du den Community Shop auf deinem Server deployest.

---

## 📋 Voraussetzungen

### Server
- **Ubuntu 22.04** oder höher
- **PHP 8.3+** installiert
- **Apache/Nginx** Web Server
- **MySQL 8.x** oder **PostgreSQL 14+**

### Local Setup

```bash
# PHP installieren
sudo apt update
sudo apt install php php-cli php-common \
    php-xml php-mysql php-curl php-mbstring php-zip

# Composer installieren
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Node.js (optional, für assets)
sudo apt install nodejs npm
```

---

## 🚀 Deployment Schritte

### 1. Clone Repository

```bash
cd /var/www
git clone https://github.com/chris1971nrw/community-shop.git
cd community-shop
```

### 2. Laravel Setup

```bash
# Composer installieren
composer install --no-dev --no-interaction

# Environment kopieren
cp .env.example .env

# Database konfigurieren
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=community_shop
DB_USERNAME=forge
DB_PASSWORD=secret

# App Name
APP_NAME='Community Shop'
APP_URL=http://yoursite.com

# Schlüssel generieren
php artisan key:generate
```

### 3. Datenbank Migration

```bash
# Datenbank erstellen
mysql -u root -p -e "CREATE DATABASE community_shop;"

# Migration ausführen
php artisan migrate --force

# Seeding (optional)
php artisan db:seed
```

### 4. Assets Build

```bash
# Vendor laden
composer install

# Frontend build
npm install && npm run build

# Storage symlinks
php artisan storage:link
```

### 5. Permissions

```bash
# Ownership
sudo chown -R www-data:www-data storage bootstrap/cache

# Permissions
sudo find storage -type f -exec chmod 644 {} \;
sudo find storage -type d -exec chmod 755 {} \;
```

---

## 🌐 GitHub Pages (Statische)

### Deployment

```bash
# Statik-HTML
cp index.html /var/www/html/

# .nojekyll
cp .nojekyll /var/www/html/

# Konfig
cp _config.yml /var/www/html/
```

### CI/CD

```yaml
# .github/workflows/deploy.yml
name: Deploy
on:
  push:
    branches: [main]
  workflow_dispatch:
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Deploy to GitHub Pages
        uses: peaceiris/actions-gh-pages@v3
        with:
          github_token: ${{ secrets.GITHUB_TOKEN }}
          publish_dir: ./shop
```

---

## 🔧 Konfiguration

### .env Beispiel

```env
APP_NAME=Community Shop
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://chris1971nrw.github.io/community-shop/

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=community_shop
DB_USERNAME=root
DB_PASSWORD=secret

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

## 🔍 Monitoring

### Server

```bash
# Process
ps aux | grep php

# Logs
tail -f /var/www/community-shop/storage/logs/laravel.log

# PHP Error Log
tail -f /var/log/php/php-error.log
```

### GitHub Actions

- [Workflow Status](https://github.com/chris1971nrw/community-shop/actions)
- [Coverage](https://codecov.io/)
- [Build Status](https://github.com/chris1971nrw/community-shop/actions)

---

## 📊 Metrics

### Performance

- **Page Load:** <2s
- **DB Queries:** <100
- **Memory:** <64MB

### Availability

- **Uptime:** 99.9%
- **Response Time:** <500ms
- **Error Rate:** <0.1%

---

## 🔐 Security

### Best Practices

1. **Environment Variables:**
   - Nie in `.git` speichern
   - `.gitignore` konfigurieren
   - Secrets Manager verwenden

2. **Database:**
   - Starke Passwörter
   - IP-Whitelisting
   - SQL Injection Protection

3. **Web Server:**
   - SSL/TLS (Let's Encrypt)
   - HTTP Strict Transport Security
   - Content Security Policy

4. **File Uploads:**
   - Dateitypen einschränken
   - Größen begrenzen
   - MIME-Typ prüfen

---

## 🔄 Updates

### Minor Updates

```bash
git pull origin main
composer install
npm run build
php artisan migrate
```

### Major Updates

```bash
git pull origin main
php artisan migrate:fresh --seed
npm run build
php artisan cache:clear
```

### Rollback

```bash
git revert HEAD
git reset --hard HEAD~1
git push origin main --force
```

---

## 📝 Troubleshooting

### Common Issues

1. **Composer:**
   ```bash
   composer clear-cache
   composer install --no-dev
   ```

2. **Database:**
   ```bash
   php artisan db:purge
   php artisan db:seed
   ```

3. **Cache:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

4. **Permissions:**
   ```bash
   sudo chown -R www-data:www-data storage bootstrap/cache
   sudo find storage -type f -exec chmod 644 {} \;
   ```

---

## 📚 Weitere Ressourcen

- [Laravel Dokumentation](https://laravel.com/docs)
- [GitHub Pages](https://pages.github.com/)
- [Deployment Best Practices](https://laravel.com/docs/deployment)
- [Security Checklist](./docs/SECURITY.md)

---

**Version:** 0.1.0-dev  
**Last Updated:** 2026-05-24  
**Author:** Community Shop Team  
**License:** MIT
