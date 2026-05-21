#!/bin/bash
# Community Shop Installations-Script

# Konfiguration
PROJECT_NAME="community-shop"
DATA_DIR="/var/www/community-shop/data"
LOG_FILE="/var/log/community-shop.log"

echo "=== Community Shop Installation ==="

# Verzeichnis erstellen
mkdir -p "$DATA_DIR"

# SQLite Datenbank initialisieren
cat > "$DATA_DIR/shop.db" <<'SQL'
-- Datenbank-Struktur wird von SQL-Datei geladen
SQL

# PHP Dateien kopieren
cp community-shop-admin.php /var/www/html/admin/
cp community-shop-frontend.html /var/www/html/shop/
cp community-shop-api.php /var/www/html/api/
cp community-shop-vote.php /var/www/html/vote/
cp community-shop-affiliate.php /var/www/html/affiliate/

# Konfigurationsdateien
cp memory/community-shop-1.0.sql "$DATA_DIR/schema.sql"

# Permissions setzen
chmod 755 /var/www/html/admin/
chmod 644 /var/www/html/*.php /var/www/html/*.html

echo "Installation abgeschlossen!"
echo "Zugriff: http://deinedomain.com/shop/"
echo "Admin: http://deinedomain.com/admin/"
