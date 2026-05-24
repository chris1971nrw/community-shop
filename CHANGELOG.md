# 📜 Changelog

All notable changes to the **Community Shop** project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Phase 1: Landing Page (GitHub Pages Live)
- Phase 2: Core + Community
  - ✅ **2.1: Voting System Core (70%)**
    - ✅ Datenbank-Schema mit Sync-Log
    - ✅ Unified Voting API
    - ✅ VotingWidget Component
    - ✅ Auto-Sync Service
    - ⏳ Score Calculation (In Progress)
  - ⏳ **2.2: Integration** (0%)
  - ⏳ **2.3: Dashboard** (0%)
  - ⏳ **2.4: Affiliate Integration** (0%)
- ⚠️ **Hinweis: Amazon Affiliate (kein E-Commerce)**
- Phase 3: Affiliate Features
- Phase 4: Advanced Features

### Changed
- README.md mit Statusbalken
- Roadmap mit Zeitplan
- Dokumentationen
- Phase 2.1 Voting System Core (70%)
- **Korrektur: Kein Warenkorb (Amazon Affiliate)**

### Removed
- Keine

### Deprecated
- Keine

### Fixed
- ✅ **Korrektur: Kein Warenkorb** (Amazon Affiliate)
- ✅ **Phase 3 umbenannt: E-Commerce → Affiliate Features**
- ✅ **Hinweis: Checkout erfolgt über Amazon**

### Changed
- README.md mit Statusbalken
- Roadmap mit Zeitplan
- Dokumentationen
- Phase 2.1 Voting System Core (70%)

### Removed
- Keine

### Deprecated
- Keine

### Fixed
- ✅ **Korrektur: Kein Warenkorb** (Amazon Affiliate)
- ✅ **Phase 3 umbenannt: E-Commerce → Affiliate Features**
- ✅ **Hinweis: Checkout erfolgt über Amazon**

### Security
- Keine

### Documentation
- ✅ docs/PHASE_2_1_PLAN.md
- ✅ migrations/2026_05_24_000010_create_voting_tables.php
- ✅ app/Services/VotingService.php
- ✅ app/Services/VotingSyncService.php
- ✅ cron/voting-sync-cron.php
- ✅ .github/workflows/voting-ci.yml
- ✅ tests/Feature/VotingTest.php

---

## [0.1.0] - 2026-05-24

### Added
- 🛒 **Initial MVP Release**
- 🌐 GitHub Pages Live (`https://chris1971nrw.github.io/community-shop/`)
- 🎨 Moderne Landing Page mit Bootstrap 5
- 📝 Dokumentationen:
  - [docs/README.md](docs/README.md) - Projekt-Übersicht
  - [docs/ARCHITECTURE.md](docs/ARCHITECTURE.md) - Technische Architektur
  - [docs/FEATURES.md](docs/FEATURES.md) - Feature-Übersicht
  - [docs/VOTING_SYSTEM.md](docs/VOTING_SYSTEM.md) - Voting-Integration
  - [docs/ROADMAP.md](docs/ROADMAP.md) - Roadmap & Zeitplan
- 📚 Wiki Setup
- 📜 Changelog
- ✅ Features:
  - 🛍️ Produkt-Katalog
  - 🗳️ Community Voting (👍/⭐/🛒)
  - 🤖 Automatisches Preis-Monitoring
  - 🔒 DSGVO-konform
- 🛠️ Tech Stack:
  - PHP 8.3+
  - Bootstrap 5
  - MySQL/PostgreSQL
  - RESTful API
  - Git/GitHub
  - Docker-ready

### Changed
- README.md mit Statusbalken
- Roadmap mit Zeitplan
- Dokumentationstruktur
- Feature-Description

### Deprecated
- Keine

### Removed
- Keine

### Fixed
- Keine

### Security
- Keine

---

## [0.0.0] - 2026-05-24

### Added
- 🚀 **Project Init**
- 📝 [README.md](README.md) - Projekt-Übersicht
- 📚 Dokumentation
- 🌐 GitHub Pages Setup
- 📜 Changelog (dieses File)
- 🛡️ License: MIT

---

## 📝 Versionierung

| Version | Release Date | Status |
|--|--|--|
| 0.1.0 | 2026-05-24 | ✅ MVP |
| 0.2.0 | TBA | 🚧 Phase 2 |
| 1.0.0 | TBA | 🏁 Full Launch |

---

## 📢 Ankündigungen

- **2026-05-24**: MVP Release mit GitHub Pages
- **2026-06-01**: Phase 2 Launch (Voting System)
- **2026-07-01**: Phase 3 Launch (E-Commerce)
- **2026-08-01**: Phase 4 Launch (Advanced Features)

---

**Version**: 0.1.0 (MVP)  
**Last Updated**: 2026-05-24
