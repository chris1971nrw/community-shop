# 📝 Blog Template für Community Shop

## Overview

Dieses Template zeigt, wie du den Blog mit dem Community Shop integrieren kannst.

---

## 📄 Blog-Post Template

```markdown
---
title: "Produkt des Monats"
date: "2026-05-24"
author: "Christoph"
category: "Produkte"
tags: ["amazon", "produkt", "monthly"]
status: "published"
---

## Titel

**Produkt des Monats**: [Produktname]

## Einführung

Beschreibe hier das Produkt und warum es ausgewählt wurde.

## Features

### Feature 1

**Beschreibung:**
Kurze Beschreibung der Features.

### Feature 2

**Beschreibung:**
Nächster Feature.

## Bewertung

- **Score**: XX.X
- **Preis**: XX.XX €
- **Bewertung**: ⭐⭐⭐⭐⭐

## Amazon Link

[Link auf Amazon](https://amazon.de/example)

## Fazit

Kurze Zusammenfassung und Empfehlung.

## Tags

{amazon, produkt, monthly}
```

---

## 📄 News-Post Template

```markdown
---
title: "Feature Update: Scoring System"
date: "2026-05-24"
author: "Community Shop Team"
category: "Updates"
tags: ["update", "scoring", "features"]
status: "published"
---

## Feature Update

Wir haben ein neues Scoring-System implementiert!

### Was ist neu?

- [x] Time-Decay
- [x] View Tracking
- [x] Improved Formula

### Details

Beschreibe die Details des Updates.

## Screenshots

![Screenshot](./screenshot.png)

## Links

- [GitHub Issues](https://github.com/chris1971nrw/community-shop/issues)
- [GitHub](https://github.com/chris1971nrw/community-shop)

---

Version: 0.2.0-dev
Author: Community Shop Team
Last Updated: 2026-05-24
```

---

## 📄 Tutorial-Post Template

```markdown
---
title: "So verwendest du das Voting Widget"
date: "2026-05-24"
author: "Christoph"
category: "Tutorial"
tags: ["tutorial", "widget", "voting"]
status: "published"
---

## Tutorial: Voting Widget

In diesem Tutorial lernst du, wie du das Voting Widget verwendest.

## Voraussetzungen

- PHP 8.3+
- Laravel 11.x
- Bootstrap 5

## Schritt 1: Installation

```bash
composer require chris1971nrw/community-shop
```

## Schritt 2: Konfiguration

```php
// config/app.php
'providers' => [
    \App\Providers\VotingServiceProvider::class,
],
```

## Schritt 3: Integration

```blade
< VotingWidget :product="product" :score="score" />
```

## Ergebnis

Beschreibe das Ergebnis.

## Nächste Schritte

- [x] Installation
- [x] Konfiguration
- [ ] Customisierung
- [ ] Testing
```

---

## 📝 Blog-Kategorien

| Kategorie | Description |
|---------|-----------|
| **Produkte** | Produkt-Reviews und Features |
| **Updates** | Feature-Updates und Fixes |
| **Tutorials** | How-to Guides |
| **Community** | Community-Spots und News |
| **Technik** | Technische Details |
| **Ankündigungen** | Wichtige News |

---

## 📊 Blog-Metriken

| Metrik | Ziel | Status |
|---------|--------|-------|--|
| **Artikel** | >20 | ⏳ In Arbeit |
| **Views** | >1000 | ⏳ In Arbeit |
| **Komentar** | >50 | ⏳ In Arbeit |
| **Teilen** | >50 | ⏳ In Arbeit |

---

## 📜 RSS Feed

```xml
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Community Shop Blog</title>
  <link href="https://chris1971nrw.github.io/community-shop/" rel="alternate" type="text/html"/>
  <updated>2026-05-24T15:30:00+02:00</updated>
  <id>https://chris1971nrw.github.io/community-shop/blog</id>
  <author>
    <name>Community Shop Team</name>
  </author>
  <entry>
    <title>Produkt des Monats</title>
    <link href="https://chris1971nrw.github.io/community-shop/blog/2026/05/24/product-of-month/"/>
    <updated>2026-05-24T15:30:00+02:00</updated>
  </entry>
</feed>
```

---

## 🔗 Integration in den Shop

### 1. Blog-Sektion auf Homepage

```blade
<!-- public/index.blade -->
<div class="blog-section">
    <h2>Unser Blog</h2>
    
    <div class="blog-grid">
        @foreach($posts as $post)
        <div class="blog-card">
            <h3><a href="{{ $post->url }}">{{ $post->title }}</a></h3>
            <p>{{ $post->excerpt }}</p>
            <span class="category">{{ $post->category }}</span>
        </div>
        @endforeach
    </div>
</div>
```

### 2. Produktdetail-Blatt

```blade
<!-- app/View/Components/Product.php -->
<div class="product-detail">
    <h2>{{ $product->title }}</h2>
    
    <div class="blog-section">
        <h3>Blog-Artikel</h3>
        @forelse($product->blog_posts as $post)
        <a href="{{ $post->url }}" class="blog-link">
            <h4>{{ $post->title }}</h4>
            <span>{{ $post->created_at }}</span>
        </a>
        @empty
        <p>Noch keine Blog-Artikel.</p>
        @endforelse
    </div>
</div>
```

---

## 📝 Blog-Post erstellen

### 1. Markdown erstellen

```bash
cat > blog/2026-05-24-product-of-month.md << EOF
---
title: "Produkt des Monats"
date: "2026-05-24"
author: "Christoph"
category: "Produkte"
tags: ["amazon", "produkt", "monthly"]
status: "published"
---

## ...
EOF
```

### 2. Upload

```bash
# Upload zu GitHub
git add blog/2026-05-24-product-of-month.md
git commit -m "Blog: Produkt des Monats"
git push
```

### 3. Auto-Generate

```bash
# Blog-Generator (optional)
php artisan blog:generate \
  --title "Produkt des Monats" \
  --category "Produkte" \
  --tags "amazon,produkt" \
  --publish
```

---

**Version:** 0.1.0-dev  
**Last Updated:** 2026-05-24  
**Author:** Community Shop Team  
**License:** MIT
