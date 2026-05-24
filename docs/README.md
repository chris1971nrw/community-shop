# 🛒 Community Shop - Dokumentation

## 🎯 Was ist der Community Shop?

Der **Community Shop** ist eine open-source Plattform, die Community-Mitglieder dabei hilft, die besten Amazon-Produkte zu finden und zu bewerten.

## 💡 Kernkonzept

Statt tausende Amazon-Produkte manuell durchzusehen, sammelt die Community die besten Angebote gemeinsam:

- **Vorschlagen**: Jeder Mitglied kann Amazon-Produkte vorschlagen
- **Bewerten**: Community bewertet mit 👍 ⭐ 🛒
- **Entdecken**: Beste Produkte werden automatisch sortiert

## 🔄 Arbeitsablauf

```
1. Mitglied schlägt Amazon-Link vor
   ↓
2. System extrahiert automatisch:
   - Produktname
   - Bild
   - Preis
   - Kategorie
   ↓
3. Community voted (Upvote/Wishlist)
   ↓
4. Score-Modell berechnet Rang
   ↓
5. Beste Produkte werden angezeigt
   ↓
6. Veraltete Angebote werden entfernt
```

## 🎨 Features im Überblick

### 🛍️ Produkt-Katalog
- Automatische Amazon-Extraktion
- Kategorien & Tags
- Preis-Historie
- Bild-Galerie

### 📊 Voting System
- **👍 Upvote**: "Gefällt mir" / "Nützlich"
- **⭐ Favorit**: "Mein Liebling"
- **🛒 Wishlist**: "In den Warenkorb"
- **👎 Downvote**: "Nicht relevant"

### 🤖 Automatisierung
- Preis-Monitoring (täglich)
- Produkt-Freshness Check
- Automatische Cleanup-Jobs
- Email-Benachrichtigungen

### 👥 Community-Features
- Benutzer-System
- Follow-Funktion
- Benachrichtigungen
- Profil-Stats

### 🔌 API für Entwickler
- RESTful Endpunkte
- Produktdaten abrufen
- Voting ausführen
- Preise prüfen

## 🛠️ Technische Architektur

```
┌─────────────────┐
│   Frontend      │ ← Bootstrap 5 Templates
└────────┬────────┘
         │
┌────────▼─────────┐
│   API Layer      │ ← PHP Controllers + Validation
└────────┬─────────┘
         │
┌────────▼─────────┐
│   Service Layer  │ ← Amazon Parser, Scoring
└────────┬─────────┘
         │
┌────────▼─────────┐
│   Database       │ ← Products, Users, Votes
└──────────────────┘
```

## 📊 Datenmodell

### Products
- `amazon_url` (einzigartig)
- `title`, `description`
- `price`, `image_url`
- `affiliate_id`
- `status` (active/inactive/removed)
- `score` (automatisch)

### Users
- `email`, `username`
- `role` (admin/mod/member)
- `upvotes`, `downvotes`

### Votes
- `product_id`, `user_id`
- `type` (upvote/wishlist/etc.)
- `score`

## 🚀 Nutzung

### Als Endnutzer
```
1. Website besuchen
2. Produkte durchstöbern
3. Amazon-Links vorschlagen
4. Community bewerten
5. Beste Produkte kaufen
```

### Als Entwickler
```bash
git clone https://github.com/...
npm install
composer install
php artisan migrate
```

## 📈 Metriken

Das System misst und berichtet über:

- **Community Engagement**: Aktive Benutzer, Votes
- **Produkt-Qualität**: Avg-Price, Conversion
- **API Performance**: Latency, Throughput
- **Community Health**: Retention, Activity

## 🔒 Datenschutz

- **Minimale Daten**: Nur was nötig
- **Transparent**: Privacy Policy
- **Compliant**: DSGVO-ready
- **Opt-in**: Email-Newsletters

## 🌟 Warum Community Shop?

| Traditionell | Community Shop |
|--------------|-----------------|
| Manuelle Suche | Community-getrieben |
| Einzelne Bewertungen | Zusammenbewertung |
| Keine Kategorien | Intelligente Sortierung |
| Statik | Dynamisches Monitoring |
| Einmalig | Kontinuierlich aktuell |

## 📖 Glossar

- **Affiliate-Link**: Link mit Tracking-ID
- **Score**: Community-Wertung (0-100)
- **Vote**: Community-Ausdruck
- **Freshness**: Produkt-Aktualität
- **Conversion**: Empfehlung → Kauf

## 🤝 Beiträge erwünscht

Werde Teil der Community!
- [Fork] https://github.com/...
- [Issue erstellen]
- [PR beitragen]

## 📚 Weiterführende Dokumentation

- [API Dokumentation]
- [Entwickler Guide]
- [Contributing]
- [Changelog]

---

**Version**: 0.1.0 (MVP)
**License**: MIT