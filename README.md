# Community-Shop - Projekt README

## Überblick

Willkommen zum Community-Shop Projekt! Dies ist ein Multi-Agent-System, das eine PHP-basierte E-Commerce-Plattform mit einer MVC-Architektur, einer REST-API und einer Score-Engine entwickelt.

## Projekt-Status

Das Projekt befindet sich in der Anfangsphase der Entwicklung. Derzeit werden die grundlegende Architektur und die Agentenkonfigurationen eingerichtet.

## Architektur

Das System folgt einer **Model-View-Controller (MVC)**-Architektur, die eine saubere Trennung der Belange gewährleistet und die Entwicklung sowie Wartung erleichtert. Details zur Architektur finden Sie in der [ARCHITECTURE.md](ARCHITECTURE.md)-Datei.

## Features (MVP-Ziele)

- **MVC-Struktur**: Eine vollständige und funktionale MVC-Architektur.
- **REST-API**: Eine Reihe von JSON-basierten Endpunkten zur Interaktion mit dem Shop-Backend.
- **Score-Engine**: Ein System zur Berechnung und Verwaltung von Benutzerpunkten innerhalb der Community.
- **Cron-Jobs**: Automatisierte Hintergrundaufgaben für Wartung, Berichte und andere periodische Prozesse.
- **Datenbank-Migrationen**: Ein robustes System zur Verwaltung von Datenbankänderungen.
- **Grundlegende Authentifizierung und Autorisierung**

## Technologie-Stack

- **Backend**: PHP 8.2+ (OOP)
- **Datenbank**: MySQL / MariaDB
- **Webserver**: Nginx / Apache (nicht Teil des Agenten-Systems, aber für den Betrieb erforderlich)
- **Dependency Management**: Composer

## Installation & Setup (Entwicklung)

1.  **Repository klonen**:
    ```bash
    git clone [REPO_URL] /home/christoph/.openclaw/workspace-community/shop
    ```

2.  **Abhängigkeiten installieren**:
    Navigieren Sie in den `shop/code` Ordner und installieren Sie die PHP-Abhängigkeiten:
    ```bash
    cd /home/christoph/.openclaw/workspace-community/shop/code
    composer install
    ```
    (Hinweis: `composer.json` wird vom Dev-Agent erstellt)

3.  **Datenbank konfigurieren**:
    Erstellen Sie eine Datenbank und konfigurieren Sie die `config/database.php` (wird vom Dev-Agent erstellt).

4.  **Datenbank-Migrationen ausführen**:
    ```bash
    php db/migrate.php
    ```
    (Hinweis: Das Migrationstool wird vom Dev-Agent erstellt)

5.  **Webserver konfigurieren**:
    Richten Sie Ihren Webserver (Nginx/Apache) so ein, dass er auf das `public/` Verzeichnis im `shop/code` Ordner zeigt.

## Verwendung der API

Die REST-API ist über `/api/v1/...` Endpunkte erreichbar. Eine detaillierte API-Dokumentation wird in der `API.md` Datei (wird erstellt) verfügbar sein.

## Cron-Jobs

Die geplanten Aufgaben sind im `cron/` Verzeichnis definiert. Stellen Sie sicher, dass Ihr System-Cron diese Skripte regelmäßig ausführt.

## Agenten-Interaktion

Dieses Projekt wird von einem Multi-Agenten-System entwickelt. Der **Supervisor-Agent** koordiniert den **PHP-Dev-Agent** und den **QA-Agent**. Alle Agenten agieren innerhalb ihrer definierten Rollen und Verantwortlichkeiten.

## Beitrag

Beiträge sind willkommen! Bitte lesen Sie die `CONTRIBUTING.md` (wird erstellt) für Richtlinien.

## Lizenz

Dieses Projekt ist unter der MIT-Lizenz lizenziert. Weitere Details finden Sie in der `LICENSE.md` (wird erstellt) Datei.

## Kontakt

Bei Fragen oder Problemen wenden Sie sich bitte an die Projektbetreuer.
