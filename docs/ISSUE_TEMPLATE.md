# 📋 Issue Templates für GitHub

## Bug Report Template

```markdown
---
name: Bug report
about: Erstelle einen Bericht für ein Bug
labels: 'bug, needs triage'
---

## 🐛 Bugbeschreibung

**Beschreibe das Bug:**
Ein Fehler tritt auf wenn...

**Schritte zum Reproduzieren:**
1. Gehe zu '...'
2. Klicke auf '...'
3. Scrollt bis '...'
4. Siehe Error: '...'

**Erwartetes Verhalten:**
Was soll passieren?

**Tatsächliches Verhalten:**
Was passiert stattdessen?

**Screenshots:**
![Screenshot](./screenshot.png)

**Umwelt:**
- Browser: [z.B. Chrome, Firefox]
- OS: [z.B. Windows 11, macOS, Linux]
- PHP Version: [z.B. 8.3.x]
- Laravel Version: [z.B. 11.x]

**Hinweis:**
- Fügt Reproduktions-Schritte hinzu
- Gib die Umgebungs-Informationen an
- Füge Screenshots hinzu (falls möglich)

---

## Contribute Template

```markdown
---
name: Contribute
about: Wie du zum Projekt beitragen kannst
labels: 'question, help wanted'
---

## 🤝 Wie kannst du beitragen?

**Art der Beitragung:**
- [ ] Bug-Report
- [ ] Feature-Vorschlag
- [ ] Code-Review
- [ ] Dokumentation
- [ ] Testing

**Deine Idee:**
Beschreibe deine Idee für die Verbesserung...

**Technische Details:**
- Framework: Laravel 11.x
- PHP: 8.3+
- Database: MySQL/PostgreSQL

**Beispiele:**
- Code-Snippets
- Design-Vorschläge
- API-Endpunkte

**Zeitrahmen:**
- Kurzfristig (<1h)
- Mittelfristig (1-2h)
- Langfristig (>2h)

---

## Feature Request Template

```markdown
---
name: Feature Request
about: Vorschläge für neue Features
labels: 'enhancement, feature request'
---

## ✨ Feature Beschreibung

**Titel:**
Kürze die Beschreibung...

**Ziel:**
Was löst dieses Feature?

**Nutzer-Szenario:**
Beschreibe den Use Case...

**Technische Umsetzung:**
- Database Schema
- API Endpunkte
- Frontend Components
- Testing Strategy

**Alternativen:**
Welche Lösungen wurden geprüft?

**Priorität:**
- High (Kritisch)
- Medium (Wichtig)
- Low (Nützlich)

---

## Documentation Template

```markdown
---
name: Documentation
about: Dokumentation verbessern
labels: 'documentation'
---

## 📝 Dokumentations-Vorschlag

**Seite:**
- [ ] README.md
- [ ] ARCHITECTURE.md
- [ ] API_REFERENCE.md
- [ ] DEPLOYMENT.md

**Aktueller Inhalt:**
```
<aktuelle Inhalte>
```

**Verbesserungsvorschlag:**
```
<verbesserte Inhalte>
```

**Zusätzliche Informationen:**
- Screenshots
- Code-Beispiele
- Videos/Tutorials

---

## Performance Issue Template

```markdown
---
name: Performance Issue
about: Performance-Probleme melden
labels: 'performance, needs triage'
---

## 🚀 Performance-Beschreibung

**Symptome:**
- Ladezeit: X Sekunden
- Memory Usage: X MB
- Database Queries: X ms

**Schritte zum Reproduzieren:**
1. Gehe zu '...'
2. Lade Seite '...'
3. Beobachte Performance Metrics

**Performance Metrics:**
```json
{
  "pageLoadTime": "5.2s",
  "databaseQueries": 150,
  "memoryUsage": "120MB"
}
```

**Optimierungsvorschläge:**
- Caching hinzufügen
- Index optimieren
- Query optimieren
- CDN nutzen

---

## Security Issue Template

```markdown
**WICHTIG:** Bitte melde Sicherheitsprobleme über [HackerOne](https://hackerone.com/) oder direkt an security@chris1971nrw.com.

**Nicht hier melden:**
- XSS in der Dokumentation
- Unsichere Protokolle in Beispielen
- Offensichtliche Sicherheitslücken

**Falls du ein Sicherheitsproblem findest:**
1. Berichte direkt an security@chris1971nrw.com
2. Gib genug Informationen für Reproduktion
3. Beschreibe den Schweregrad

**Sichere Meldung:**
```
**Titel:** Sicherheitsproblem bei X
**Schweregrad:** Critical / High / Medium / Low
**Beschreibung:** Sicherheitsproblem...
**Schadenspotenzial:** X
**Lösungsvorschlag:** X

**Privatsphäre:**
- Keine PII
- Keine Credentials
- Keine sensible Daten
```
```

## Config Issue Template

```markdown
---
name: Configuration Issue
about: Konfigurationsprobleme
labels: 'config, needs triage'
---

## ⚙️ Konfigurations-Problem

**Fehlerbeschreibung:**
Beschreibe das Problem...

**Kontext:**
- Laravel Version: X.X.X
- PHP Version: X.X.X
- OS: X.X

**Konfiguration:**
```yaml
# config/app.php
'app_name' => 'Community Shop',
'locale' => 'de',
'timezone' => 'Europe/Berlin',
```

**Fehlermeldung:**
```
{
  "error": "Config not found",
  "message": "X"
}
```

**Lösungsvorschlag:**
- X
- Y
- Z

---

## Deployment Guide Template

```markdown
---
name: Deployment Guide
about: Deployment-Hilfe
labels: 'deployment, needs triage'
---

## 🚀 Deployment-Probleme

**Umwelt:**
- Server: X (Ubuntu 22.04, etc.)
- Web Server: Apache/Nginx
- Database: MySQL/PostgreSQL
- PHP: 8.3+

**Schritte zum Reproduzieren:**
1. Deploy auf Server
2. Fehler tritt auf

**Fehlermeldung:**
```
{
  "error": "X",
  "message": "Y"
}
```

**Lösungsvorschläge:**
- X
- Y
- Z

```
