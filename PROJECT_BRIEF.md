# Community-Shop Projekt

## Überblick

Ein vollständiges Multi-Agent-System für die Entwicklung eines Community-Shops mit PHP OOP, MVC-Architektur und REST API.

## Projektstruktur

```
shop/
├── openclaw.yaml                    # Agenten-Konfiguration
├── supervisor_prompt.md             # Supervisor-Agent Prompt
├── php_dev_prompt.md                # PHP-Dev-Agent Prompt
├── qa_prompt.md                     # QA-Agent Prompt
├── PROJECT_BRIEF.md                 # Dieses Dokument
├── ARCHITECTURE.md                  # System-Architektur
├── README.md                        # Benutzerdokumentation
├── agents/
│   ├── openclaw.yaml
│   ├── supervisor_prompt.md
│   ├── php_dev_prompt.md
│   ├── qa_prompt.md
│   └── PROJECT_BRIEF.md
└── code/
    ├── public/
    ├── src/
    │   ├── Core/
    │   │   ├── Controller/
    │   │   ├── Model/
    │   │   └── Service/
    │   ├── Controller/
    │   ├── Model/
    │   ├── Service/
    │   └── templates/
    ├── config/
    ├── cron/
    ├── db/
    └── migrations/
```

## Agenten-Rollen

### 1. Supervisor-Agent
- **Rolle**: Autonomer System-Supervisor
- **Ziel**: Planung und Steuerung bis MVP
- **Tools**: filesystem, shell
- **Prompt**: supervisor_prompt.md

### 2. PHP-Dev-Agent
- **Rolle**: Senior PHP Engineer
- **Ziel**: MVC-Implementierung, REST API, Score Engine
- **Tools**: filesystem, shell
- **Prompt**: php_dev_prompt.md

### 3. QA-Agent
- **Rolle**: Code-Reviewer & Tester
- **Ziel**: Qualitätssicherung, Tests, Validierung
- **Tools**: filesystem, shell
- **Prompt**: qa_prompt.md

## Tech Stack

- **Backend**: PHP 8.2+ OOP
- **Architektur**: MVC (Model-View-Controller)
- **Datenbank**: MySQL/MariaDB
- **API**: REST JSON
- **Wartung**: Cron-Jobs
- **Score**: Community-Punktesystem

## Workflow

1. **Supervisor startet**
   - Projekt analysiert
   - Roadmap erstellt
   - Tasks generiert

2. **Dev-Agent implementiert**
   - MVC-Komponenten schreibt
   - REST Endpoints erstellt
   - Score Engine baut

3. **QA-Agent prüft**
   - Code-Qualität
   - php -l Syntax
   - Ordnerstruktur
   - SQL Migrationen

4. **Supervisor koordiniert**
   - QA-Berichte einsehen
   - Dev-Agent Fixes anweisen
   - Nächste Tasks planen

5. **Iterieren bis MVP**
   - Mehrere Zyklen
   - Continuous Integration
   - Qualitätssteigerung

## Features

- **MVC-Architektur**: Sauberer Code, Wiederverwendbarkeit
- **REST API**: JSON Endpoints für Integration
- **Score Engine**: Community-Punktesystem
- **Cron-Jobs**: Automatisierte Wartung
- **Type-Safety**: PHP 8.2+ Features
- **Sicherheit**: CSRF, XSS, SQL-Injection Schutz

## MVP-Ziele

- Vollständige MVC-Struktur
- REST API Endpoints
- Funktionierender Score-Engine
- Cron-Jobs eingerichtet
- Datenbank Migrationen
- Unit-Tests vorhanden
- Dokumentation aktuell

## Nächste Schritte

1. Agenten-Ordner erzeugen
2. Projektstruktur aufbauen
3. Supervisor starten
4. Roadmap erstellen
5. Autonom arbeiten bis MVP
