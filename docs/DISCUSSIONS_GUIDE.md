# 💬 GitHub Discussions Guide

## Overview

GitHub Discussions sind ein zentraler Ort für Community-Updates, Fragen und Ankündigungen. Sie sind anders als Issues (Fehlerberichte/Features), da sie eine fortlaufende Konversation unterstützen.

---

## 📂 Discussion-Kategorien

### 1. 📢 Announcements (Ankündigungen)

**Zweck:** Projekt-Updates, neue Features, wichtige Nachrichten

**Labels:**
- `Announcement` - Wichtige Ankündigungen
- `Release` - Neue Releases
- `Milestone` - Meilensteine erreicht

**Beispiel:**
```markdown
## 🚀 Community Shop Update - Mai 2026

**Status:** ✅ LIVE 🎉

**Was ist neu:**
- ✅ YouTube Video Live
- ✅ GitHub Pages Demo
- ✅ Score Calculation Modell
- ✅ Unit Tests geschrieben

**Features:**
- 🛍️ Produkt-Katalog
- 🗳️ Community Voting
- 🤖 Intelligentes Scoring
- 🔒 DSGVO-konform

**Links:**
- GitHub: https://github.com/chris1971nrw/community-shop
- Demo: https://chris1971nrw.github.io/community-shop/
- YouTube: https://www.youtube.com/watch?v=pGYTQDRBVgk
- API Docs: https://github.com/chris1971nrw/community-shop/tree/main/docs/api

**Feedback:**
Habt ihr Fragen oder Feature-Requests? Diskutiert in den Kommentaren! 👇
```

### 2. ❓ Help & Support (Hilfe & Support)

**Zweck:** Community-Mitglieder können Fragen stellen

**Labels:**
- `question` - Fragen
- `help wanted` - Hilfe benötigt
- `documentation` - Dokumentations-Anfrage

**Beispiel:**
```markdown
## ❓ Wie kann ich mein eigenes Voting-Widget bauen?

Ich möchte das Voting-Widget in meiner eigenen Web-App verwenden.

**Setup:**
- PHP 8.3+
- Laravel 11.x
- Bootstrap 5

**Fragen:**
1. Wo finde ich das VotingWidget-Komponente?
2. Wie integriere ich die API?
3. Ist eine Dokumentation vorhanden?

**Hilfe:**
Bitte helft mir mit Anleitungen! 🙏
```

### 3. 💡 Feature Requests (Feature-Vorschläge)

**Zweck:** Community-Mitglieder schlagen neue Features vor

**Labels:**
- `enhancement` - Verbesserungen
- `feature request` - Feature Vorschläge
- `wontfix` - Wird nicht implementiert

**Beispiel:**
```markdown
## 💡 Feature Request: Mobile App

**Beschreibung:**
Ein mobile App für den Community Shop wäre super!

**Funktionalitäten:**
- Produkte durchsuchen
- Voting abgeben
- Preise vergleichen
- Push Notifications für Top-Produkte

**Platform:**
- iOS App
- Android App
- Progressive Web App (PWA)

**Priorität:**
- High (Wichtig)
- Medium (Nützlich)

**Kommentare:**
Diskutiert die Feature-Vorstellung!
```

### 4. 🐛 Bug Reports (Fehlerberichte)

**Zweck:** Bug-Bereitstellung durch Community

**Labels:**
- `bug` - Fehler
- `needs triage` - Zuweisung benötigt
- `duplicate` - Duplikat
- `good first bug` - Für Anfänger

**Beispiel:**
```markdown
## 🐛 Product-Image lädt nicht korrekt

**Beschreibung:**
Das Produktbild für Produkt ID #XXX lädt nicht.

**Schritte zum Reproduzieren:**
1. Gehe zu https://chris1971nrw.github.io/community-shop/
2. Suche nach Produkt "XXX"
3. Produkt-Image zeigt Platzhalter

**Umwelt:**
- Browser: Chrome 120.0
- OS: Windows 11
- PHP Version: 8.3.x

**Screenshot:**
![Bild](./screenshot.png)

**Fix:**
Vielen Dank an @username für den Fix! 🙏
```

### 5. 📚 Documentation Requests (Dokumentation)

**Zweck:** Bessere Dokumentation vorschlagen

**Labels:**
- `documentation`
- `enhancement`

**Beispiel:**
```markdown
## 📚 Dokumentations-Vorschlag

**Seite:** [API_REFERENCE.md](./docs/api/README.md)

**Aktueller Inhalt:**
```
# API

## GET /api/products
```

**Verbesserungsvorschlag:**
```
## GET /api/products

### Endpoint
`GET /api/products`

### Beschreibung
Holt alle Produkte aus dem System

### Parameter
- `page` (optional) - Seitennummer
- `limit` (optional) - Produkte pro Seite
- `search` (optional) - Produktsuche
- `sort` (optional) - Sortierung

### Beispiel-Antwort
```json
{
  "products": [
    {
      "id": 1,
      "amazon_url": "https://amazon.de/...",
      "title": "Produkt",
      "price": 99.99,
      "score": 8.5
    }
  ],
  "meta": {
    "total": 100,
    "page": 1,
    "limit": 20
  }
}
```

**Code-Beispiel:**
```php
$products = Product::paginate(20);
return response()->json(['products' => $products]);
```

**Status:**
- [x] Dokumentiert
- [ ] Implementiert
- [ ] Geprüft

**Kommentare:**
Diskutiert über die Dokumentation!
```

---

## 🔄 Discussion-Management

### Automatische Erstellung

**Trigger:**
- Bei neuen Releases → `Announcement` Discussion
- Bei Meilenstein-Erreichen → `Milestone` Discussion
- Bei neuen Features → `Announcement` Discussion
- Bei Community-Feedback → `Help & Support` Discussion

### Automatische Antworten

**Beispiel:**
```markdown
## ❓ Wie kann ich helfen?

Danke für deine Frage! Hier sind einige Möglichkeiten, wie du beitragen kannst:

1. **Issues**: [Erstelle einen Issue](../issues/new)
2. **PRs**: [Klicke 'Fork' oben rechts](../pulls)
3. **Dokumentation**: [Verbessere die Docs](./docs/CONTRIBUTING.md)
4. **Tests**: [Schreibe Tests](./tests/README.md)

**Code Style:**
- PSR-12
- PHPDoc
- Kommentare schreiben

**Teste deine Änderungen:**
```bash
composer test
php artisan test:browsers
```

**Contributor:**
Danke für deinen Beitrag! 🙌

**Badges:**
- GitHub: [![Contributors](https://img.shields.io/github/contributors/chris1971nrw/community-shop)](...)
- Issues: [![Issues](https://img.shields.io/github/issues/chris1971nrw/community-shop)](...)
- PRs: [![PRs](https://img.shields.io/github/issues-pr/chris1971nrw/community-shop)](...)
```

### Diskussion Moderation

**Guidelines:**
1. **Sei respektvoll**
2. **Keine Hate Speech**
3. **Konstruktive Kritik**
4. **Datenschutz beachten** (keine PII)

**Verstoße:**
- Spam → `spam` Label
- Off-Topic → `off-topic` Label
- Unfreundlich → `rude` Label

**Lösung:**
- Warnung → 1st Warning
- Verstoß → Issue Report
- Schlimm → GitHub Block

---

## 📅 Discussion-Schedule

| Tag | Zeit | Topic |
|-----|------|-------|
| Monday | 10:00 | 📢 Weekly Update |
| Wednesday | 14:00 | ❓ FAQ Discussion |
| Friday | 16:00 | 💡 Feature Request |

**Automatisch:**
- Weekly Update → Montag 10:00 Uhr
- FAQ Discussion → Mittwoch 14:00 Uhr
- Feature Request → Freitag 16:00 Uhr

---

## 🤖 Automatische Discussions

### Cron-Jobs für Discussions

```yaml
# .github/workflows/discussions.yml
name: Discussions

on:
  schedule:
    - cron: '0 10 * * 1'    # Montag 10:00 Uhr
    - cron: '0 14 * * 3'    # Mittwoch 14:00 Uhr
    - cron: '0 16 * * 5'    # Freitag 16:00 Uhr

jobs:
  update:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Create Weekly Update Discussion
        run: |
          ./scripts/create-discussion.sh "weekly-update" \
            --title "Community Shop Weekly Digest - ${DATE}" \
            --content "$(cat scripts/weekly-update-template.md)" \
            --repo "chris1971nrw/community-shop"
```

### Template für automatische Discussions

```bash
#!/bin/bash

create_discussion() {
    local title="$1"
    local content="$2"
    local category="$3"
    
    # Erstelle Discussion
    gh issue create \
        --label "$category" \
        --title "$title" \
        --body "$content"
}

# Beispielauforderungen
# create_discussion "Weekly Update" "$(cat weekly-template.md)" "Announcement"
# create_discussion "FAQ Discussion" "$(cat faq-template.md)" "Question"
```

---

## 📝 Template Repository

Erstelle Templates für häufige Discussions:

```markdown
## 📄 Announcement Template

```markdown
## 🚀 {{TITLE}}

**Status:** ✅ LIVE 🎉

**Datum:** {{DATE}}

**Veröffentlichung:**
- GitHub: https://github.com/chris1971nrw/community-shop
- Demo: https://chris1971nrw.github.io/community-shop/

**Was ist neu:**
{{CHANGES}}

**Features:**
{{FEATURES}}

**Links:**
- GitHub: https://github.com/chris1971nrw/community-shop
- Demo: https://chris1971nrw.github.io/community-shop/
- API Docs: https://github.com/chris1971nrw/community-shop/tree/main/docs/api

**Kommentare:**
Habt ihr Fragen oder Feedback? 👇
```

## 📄 FAQ Template

```markdown
## ❓ {{QUESTION}}

**Beschreibung:**
{{DESCRIPTION}}

**Antwort:**
{{ANSWER}}

**Verwandte Diskussionen:**
- [Verwandte Discussion](./...)
- [Verwandtes Issue](../issues/...)

**Weiterführende Links:**
{{LINKS}}
```

## 📄 Feature Request Template

```markdown
## 💡 {{FEATURE-NAME}}

**Beschreibung:**
{{DESCRIPTION}}

**Use Cases:**
{{USE_CASES}}

**Technische Details:**
{{TECH_SPECS}}

**Status:**
- [ ] Geplant
- [x] In Entwicklung
- [ ] Implemented
- [x] Released

**Priorität:**
- High (Kritisch)
- Medium (Wichtig)
- Low (Nützlich)

**Kommentare:**
Diskutiert die Feature-Vorstellung!
```
```

---

## 📊 Discussion-Metriken

| Diskussion | Views | Reactions | Comments |
|-----------|-------|-----------|----------|
| Announcements | X | X | X |
| Help & Support | X | X | X |
| Feature Requests | X | X | X |
| Bug Reports | X | X | X |
| Documentation | X | X | X |

**Analyse:**
- Welche Topics haben die meisten Views?
- Welche Fragen kommen am häufigsten?
- Welche Features werden am meisten gewünscht?
- Welche Bugs treten am häufigsten auf?

**Optimierung:**
- Häufige Fragen → FAQ hinzufügen
- Häufige Bugs → Fix-Priorität erhöhen
- Beliebte Features → Roadmap aufnehmen

---

## 🔄 Migration von Issues zu Discussions

**Beispiel:**
- Issue: "Wie nutze ich die API?" → Migration zu `Help & Support` Discussion
- Issue: "Neues Feature: Mobile App" → Migration zu `Feature Requests` Discussion
- Issue: "API Error 404" → Migration zu `Bug Reports` Discussion

**Automatische Migration:**
```yaml
# .github/workflows/migrate-to-discussions.yml
name: Migrate Issues to Discussions

on:
  issues:
    types: [opened]

jobs:
  migrate:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Create Matching Discussion
        run: |
          # Analyze Issue Title
          # Find Matching Discussion Template
          # Create Discussion
          # Close Issue
```

---

**Last Updated:** 2026-05-24  
**Version:** 0.1.0-dev  
**Author:** Community Shop Team  
**License:** MIT
