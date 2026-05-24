# 🚧 Phase 2.1.3: Integration Plan - Community Shop

## Overview

Dieses Dokument beschreibt den Integrationsplan für den Community Shop in bestehende Systeme: Laravel Backend, Blog Integration, Forum Integration.

## Integration Milestones

### Milestone 1: Laravel Backend Integration
**Status**: ⏳ In Progress

#### Aufgaben
- [ ] API Endpunkte verbinden (Voting, Produkt-Anfragen)
- [ ] Datenbank-Schema synchronisieren
- [ ] Authentifizierung integrieren (Laravel Sanctum)
- [ ] Middleware für Rate Limiting
- [ ] Queue Jobs für Batch-Operationen

#### API Endpunkte

| Method | Endpoint | Beschreibung |
|--------|----------|--------------|
| GET | `/api/products` | Produkte auflisten |
| POST | `/api/products` | Neues Produkt anlegen |
| GET | `/api/products/{id}` | Produkt details |
| PUT | `/api/products/{id}` | Produkt aktualisieren |
| DELETE | `/api/products/{id}` | Produkt löschen |
| GET | `/api/votes/{product_id}` | Votes für Produkt |
| POST | `/api/votes/{product_id}` | Vote abgeben |
| GET | `/api/price/{product_id}` | Preis-Check |

#### Database Migration

```php
// migrations/xxxx_xx_xx_add_community_shop_tables.php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('amazon_url')->unique();
    $table->string('title');
    $table->string('slug')->unique();
    $table->string('description')->nullable();
    $table->string('category')->nullable();
    $table->string('tags')->nullable();
    $table->string('image_url')->nullable();
    $table->decimal('price', 10, 2);
    $table->timestamp('price_at');
    $table->string('status')->default('active');
    $table->decimal('score', 10, 2)->default(0);
    $table->timestamps();
});

Schema::create('votes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
    $table->enum('type', ['like', 'favorite', 'cart']);
    $table->text('ip_address')->nullable();
    $table->timestamps();
});
```

#### Laravel Service Provider

```php
// CommunityShopServiceProvider.php
class CommunityShopServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        
        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'community-shop');
        
        // Controllers
        $this->loadControllers(
            __DIR__.'/../app/Http/Controllers'
        );
    }
    
    public function register()
    {
        // Services
        $this->app->singleton('amazonParser', function ($app) {
            return new AmazonParser($app->db);
        });
        
        $this->app->singleton('scoreCalculator', function ($app) {
            return new ScoreCalculator($app->db);
        });
        
        // Queue
        $this->app->singleton('syncQueue', function ($app) {
            return new SyncQueue($app->queue);
        });
    }
}
```

### Milestone 2: Blog Integration
**Status**: ⏳ Pending

#### Features
- Automatische Blog-Posts für neue Produkte
- Produkt-Kategorien in Blog-Sections
- Comment-System für Community-Feedback
- RSS Feed für Newsletter

#### Blog Template

```blade
<!-- Blog Product Post -->
<article class="blog-post">
    <h2>@yield('title')</h2>
    
    <div class="product-summary">
        @foreach($products as $product)
        <div class="product-card">
            <img src="{{ $product->image_url }}" alt="{{ $product->title }}">
            <h3>{{ $product->title }}</h3>
            <p class="price">@php number_format($product->price, 2) @endphp €</p>
            <p class="score">Score: @php number_format($product->score, 1) @endphp/100</p>
            <a href="{{ $product->amazon_url }}" target="_blank" class="btn btn-primary">
                Auf Amazon kaufen
            </a>
        </div>
        @endforeach
    </div>
</article>
```

### Milestone 3: Forum Integration
**Status**: ⏳ Pending

#### Features
- Produkt-Themen im Forum
- User-Feedback Integration
- Community Discussion Threads
- Moderation Tools

#### Forum Widget

```blade
<!-- Forum Product Widget -->
<div class="forum-widget">
    <h4>Top Produkte dieser Woche</h4>
    
    <table class="forum-products">
        <thead>
            <tr>
                <th>Produkt</th>
                <th>Bewertung</th>
                <th>Amazon Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topProducts as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>
                    <span class="badge">{{ $product->score }} pts</span>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-heart-fill text-danger"></i>
                    <i class="bi bi-cart-fill text-primary"></i>
                </td>
                <td>
                    <a href="{{ $product->amazon_url }}" target="_blank">
                        <i class="bi bi-box"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
```

### Milestone 4: Analytics Integration
**Status**: ⏳ Pending

#### Features
- Google Analytics Integration
- Conversion Tracking
- User Behavior Tracking
- Performance Monitoring

#### Analytics Code

```javascript
// analytics.js
// Google Analytics
(function(i,s,o,g,r,a,m){
    i['GoogleAnalyticsObject']=r;
    i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments);
    };
    i[r].l=1*new Date();
    a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];
    a.async=1;
    a.src=g;
    m.parentNode.insertBefore(a,m);
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview');

// Track Voting
function trackVote(voteType, productId) {
    ga('send', 'event', {
        'eventCategory': 'Voting',
        'eventAction': voteType,
        'eventLabel': productId,
        'value': 1
    });
}

// Track Amazon Click
function trackAmazonClick(url) {
    ga('send', 'event', {
        'eventCategory': 'Affiliate',
        'eventAction': 'click',
        'eventLabel': url,
        'value': 1
    });
}
```

### Milestone 5: Mobile Responsive
**Status**: ⏳ Pending

#### Features
- Touch-Friendly Interface
- Offline-Caching (PWA)
- Push Notifications
- Mobile-Specific Features

#### PWA Manifest

```json
{
  "name": "Community Shop",
  "short_name": "Shop",
  "description": "Open-Source Amazon Affiliate Shop",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#2563eb",
  "icons": [
    {
      "src": "/icons/icon-72x72.png",
      "sizes": "72x72",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-120x120.png",
      "sizes": "120x120",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-152x152.png",
      "sizes": "152x152",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ]
}
```

## Timeline

### Week 1: Laravel Backend
- [ ] Setup Laravel Project
- [ ] Database Migration
- [ ] API Endpunkte implementieren
- [ ] Testing

### Week 2: Blog Integration
- [ ] Blog-System wählen (WordPress, Strapi)
- [ ] Widget-Entwicklung
- [ ] API Integration

### Week 3: Forum Integration
- [ ] Forum-Plugin entwickeln
- [ ] Widget-Integration
- [ ] Moderation-Tools

### Week 4: Analytics
- [ ] Google Analytics Setup
- [ ] Conversion Tracking
- [ ] Performance Monitoring

## Testing Strategy

### Unit Tests
```bash
composer test
```

### Integration Tests
```bash
composer test:integration
```

### Browser Tests
```bash
php artisan test:browsers
```

### Performance Tests
```bash
php artisan test:performance
```

## Rollback Plan

### Emergency Rollback
```bash
git revert HEAD~5
git reset --hard HEAD~5
git push origin main --force
```

### Data Migration Rollback
```sql
-- Backup before migration
CREATE TABLE products_backup AS SELECT * FROM products;

-- Rollback migration
TRUNCATE products;
INSERT INTO products SELECT * FROM products_backup;
```

## Success Metrics

### Week 1 Goals
- ✅ Laravel Backend operational
- ✅ API Endpunkte functional
- ✅ Unit Tests passing (80%+)
- ✅ Documentation completed

### Week 2 Goals
- ✅ Blog Integration complete
- ✅ Widget functional
- ✅ Blog-Posts live

### Week 3 Goals
- ✅ Forum Integration complete
- ✅ Community Engagement erhöht
- ✅ Moderation Tools operational

### Week 4 Goals
- ✅ Analytics Integration complete
- ✅ Performance Optimized
- ✅ Launch Ready

## Next Steps

1. **Review Plan**: Team-Feedback einholen
2. **Adjust Timeline**: Realistische Meilensteine
3. **Start Development**: Week 1 beginnen
4. **Daily Standups**: Fortschritt tracken
5. **Weekly Reviews**: Anpassungen vornehmen

---

**Created**: 2026-05-24  
**Last Updated**: 2026-05-24  
**Version**: 0.2.0-dev  
**Author**: Community Shop Team
