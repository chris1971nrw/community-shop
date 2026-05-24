# 💬 Forum Template für Community Shop

## Overview

Dieses Template zeigt, wie du ein Forum mit dem Community Shop integrieren kannst.

---

## 📚 Forum-Kategorien

### 1. 📢 Allgemein

**Unterthemen:**
- Willkommen
- Neuigkeiten
- Ankündigungen
- Feedback

### 2. 🛍️ Produkt-Reviews

**Unterthemen:**
- Gute Produkte
- Schlechte Produkte
- Empfehlungen
- Warnungen

### 3. 💡 Feature-Requests

**Unterthemen:**
- Neue Features
- Verbesserungen
- Bug-Reports
- Ideen

### 4. 🎓 Hilfe & Support

**Unterthemen:**
- FAQ
- Tutorials
- Code-Beispiele
- Hilfe-Gesucht

### 5. 🤝 Community

**Unterthemen:**
- Vorstellung
- Community-Auszeichnungen
- Events
- Collaboration

---

## 📝 Thread Template

```markdown
## Titel: [Thema]

### Beschreibung

Beschreibe das Thema...

### Details

- **Produkt:** [Name]
- **Kategorie:** [Kategorie]
- **Status:** [Status]

### Screenshots

![Screenshot](./screenshot.png)

### Code-Beispiele

```php
// Beispiel-Code
<ProductWidget :product="product" :score="score" />
```

### Links

- [GitHub Issue](https://github.com/chris1971nrw/community-shop/issues)
- [API Documentation](https://github.com/chris1971nrw/community-shop/tree/main/docs/api)

---

Version: 0.1.0-dev
Author: Community Shop Team
Last Updated: 2026-05-24
```

---

## 💬 Diskussions-Thread Template

```markdown
## [Diskussion] Produkt des Monats

**Produkt:** [Name]

**Beschreibung:**
Beschreibe das Produkt...

**Bewertung:**
- Score: XX.X
- Preis: XX.XX €
- Bewertung: ⭐⭐⭐⭐⭐

**Kommentare:**

**@User1:** Ich mag dieses Produkt!
**@User2:** Preis ist hoch, aber Qualität ist gut.
**@Admin:** Danke für eure Kommentare!

**Links:**
- [Amazon Link](https://amazon.de/example)
- [Product Page](https://chris1971nrw.github.io/community-shop/product/1)

**Tags:** #produkt #monatswahl #empfehlung
```

---

## 🐛 Bug-Report Template

```markdown
## 🐛 Bug Report: [Beschreibung]

### Beschreibung

Beschreibe das Problem...

### Schritte zum Reproduzieren

1. Gehe zu [URL]
2. Klicke auf [Element]
3. Siehe Error

### Erwartetes Verhalten

Was soll passieren?

### Tatsächliches Verhalten

Was passiert stattdessen?

### Screenshots

![Screenshot](./screenshot.png)

### Umwelt

- **Browser:** Chrome 120.0
- **OS:** Windows 11 / macOS / Linux
- **PHP Version:** 8.3.x

### Logs

```
{
  "error": "X",
  "message": "Y"
}
```

### Status

- [ ] Neu
- [x] Zugeteilt
- [ ] In Arbeit
- [ ] Gelöst

---

Version: 0.1.0-dev
Author: Community Shop Team
Last Updated: 2026-05-24
```

---

## 🚀 Feature-Request Template

```markdown
## 💡 Feature Request: [Name]

### Beschreibung

Beschreibe das Feature...

### Use Cases

- **Szenario 1:** [Beschreibung]
- **Szenario 2:** [Beschreibung]

### Technische Details

- **Backend:** Laravel Service
- **Frontend:** Vue/Bootstrap
- **Database:** MySQL/PostgreSQL

### Status

- [ ] Geplant
- [x] In Entwicklung
- [ ] Implemented
- [x] Released

### Zeitrahmen

- **Entwicklung:** 1-2 Wochen
- **Testing:** 3-4 Tage
- **Release:** [Datum]

### Alternative Lösungen

- [Option 1]
- [Option 2]

### Kommentare

- @User1: Das ist eine gute Idee!
- @User2: Kann ich das auch machen?

---

Version: 0.1.0-dev
Author: Community Shop Team
Last Updated: 2026-05-24
```

---

## 📊 Forum-Metriken

| Metrik | Ziel | Status |
|-----------|-------|-------|--|
| **Threads** | >50 | ⏳ In Arbeit |
| **Posts** | >200 | ⏳ In Arbeit |
| **Komentar** | >1000 | ⏳ In Arbeit |
| **Moderation** | <1% | ✅ Met |

---

## 🔧 Forum-Integration

### 1. Forum auf Homepage

```blade
<!-- public/index.blade -->
<div class="forum-section">
    <h2>Community Forum</h2>
    
    <div class="forum-nav">
        <a href="/forum" class="active">Forum</a>
        <a href="/blog">Blog</a>
    </div>
    
    <div class="forum-list">
        @foreach($threads as $thread)
        <div class="thread">
            <h3><a href="{{ $thread->url }}">{{ $thread->title }}</a></h3>
            <p>{{ $thread->description }}</p>
            <span class="replies">{{ $thread->replies_count }} Kommentare</span>
            <span class="last-reply">{{ $thread->last_reply }}</span>
        </div>
        @endforeach
    </div>
</div>
```

### 2. Produkt-Forum

```blade
<!-- app/View/Components/ProductForum.php -->
<div class="product-forum">
    <h2>{{ $product->title }} Forum</h2>
    
    <div class="forum-posts">
        @foreach($product->forum_posts as $post)
        <div class="forum-post">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
            <span class="score">{{ $post->score }}</span>
            <span class="votes">{{ $post->votes_count }} Votes</span>
            <a href="{{ $post->amazon_url }}" class="amazon-link">
                <i class="bi bi-box"></i> Amazon
            </a>
        </div>
        @endforeach
    </div>
</div>
```

---

## 📝 Moderation-Guidelines

### 1. Respektvoll bleiben

- Keine Hate Speech
- Keine persönliche Angriffe
- Konstruktive Kritik

### 2. Datenschutz

- Keine PII teilen
- Keine Credentials
- Keine sensible Daten

### 3. Inhalte

- Keine Werbung
- Keine Spam
- Keine illegale Inhalte

### 4. Reporting

- Inappropriate Content melden
- Mod-Team kontaktieren
- Keine Selbst-Moderation

---

## 🎯 Forum-Workflow

1. **User erstellt Thread**
2. **Moderation prüft**
3. **Thread publiziert**
4. **User diskutiert**
5. **Moderation monitoriert**
6. **Inappropriate Inhalte entfernen**

---

## 🔔 Notifications

### User-Notifications

- **Neue Antwort** auf Thread
- **Erwähnung** im Thread
- **Feature Request** aktualisiert
- **Thread** abgeschlossen

### Moderation-Notifications

- **Neuer Thread** (Review nötig)
- **Inappropriate Content**
- **User Warnung**
- **Spam-Erkennung**

---

## 📱 Mobile-Friendly

### Forum-Design

```css
/* Forum responsive */
@media (max-width: 768px) {
    .forum-nav {
        flex-direction: column;
    }
    
    .forum-list {
        overflow-x: auto;
    }
    
    .forum-post {
        font-size: 0.9rem;
    }
}
```

---

## 📜 Forum-Policy

### 1. Regeln

1. Sei respektvoll
2. Bleib im Topic
3. Keine Spam
4. Datenschutz
5. Keine Werbung

### 2. Verstöße

- **1. Verstoß:** Warnung
- **2. Verstoß:** Timeout (24h)
- **3. Verstoß:** Timeout (48h)
- **4. Verstoß:** Bann (7 Tage)
- **5. Verstoß:** Dauerbann

### 3. Appeals

- **Timeout:** Nach 1h appeal möglich
- **Bann:** Nach 24h appeal möglich
- **Email:** forum@shop.example.com

---

**Version:** 0.1.0-dev  
**Last Updated:** 2026-05-24  
**Author:** Community Shop Team  
**License:** MIT
