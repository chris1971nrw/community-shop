# 🎨 GitHub Pages + Laravel Hybrid-Frontend

## 📋 Übersicht

Dieses Dokument beschreibt den **Hybrid-Ansatz**, der **GitHub Pages** (statisches Frontend) mit **Laravel Backend** kombiniert.

---

## 🎯 Ziele

1. **GitHub Pages** für **Demo & Präsentation**
2. **Laravel API** für **Backend-Integration**
3. **API Endpunkte** für **Produktdaten**
4. **VotingWidget** für **Interaktivität**

---

## 📊 Architektur

### GitHub Pages (Statisches Frontend)

```
index.html
├── Navigation (Navbar)
├── Hero Section
├── Produkt-Katalog
│   ├── Loading Spinner
│   ├── Produkte Grid
│   └── VotingWidget
├── Footer
└── API Calls (fetch())
```

### Laravel (Backend & API)

```
Laravel API
├── ProductController
├── VoteController
├── CategoryController
└── API Endpunkte
    ├── GET /api/products
    ├── GET /api/products/{id}
    ├── POST /api/products/{id}/vote
    └── GET /api/categories
```

---

## 🚀 Implementierung

### Schritt 1: Laravel API erstellen

#### 1.1 Laravel Projekt Setup

```bash
cd /home/christoph/.openclaw/workspace-community/shop
composer create-project laravel/laravel community-shop
cd community-shop

# API Route definieren
php artisan make:route api/products
php artisan make:controller Api\ProductController --api
php artisan make:controller Api\VoteController --api
```

#### 1.2 API Controller

```php
// app/Http/Controllers/Api/ProductController.php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Alle Produkte abrufen
     * GET /api/products
     */
    public function index(): JsonResponse
    {
        $products = Product::with(['votes' => function($query) {
            $query->where('created_at', '>', now()->subHour());
        }])->get();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Produkt anzeigen
     * GET /api/products/{id}
     */
    public function show($id): JsonResponse
    {
        $product = Product::with(['votes' => function($query) {
            $query->where('created_at', '>', now()->subHour());
        }])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }
}
```

```php
// app/Http/Controllers/Api/VoteController.php
namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VoteController extends Controller
{
    /**
     * Vote erstellen
     * POST /api/products/{id}/vote
     */
    public function vote(Request $request, Product $product): JsonResponse
    {
        // Prüfen ob User bereits abgestimmt
        if ($product->votedBy($request->user())) {
            return response()->json(['message' => 'Du hast bereits abgestimmt!'], 400);
        }

        // Vote erstellen
        $vote = Vote::create([
            'product_id' => $product->id,
            'user_id' => $request->user()?->id,
            'type' => $request->input('type'), // upvote, favorite, wishlist
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Vote erstellt!',
            'vote' => $vote,
        ], 201);
    }
}
```

#### 1.3 API Routes

```php
// routes/api.php
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\VoteController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products/{id}/vote', [VoteController::class, 'vote']);

// Mit Middleware
Route::middleware('auth:sanctum')->group(function ($route) {
    Route::post('/products/{id}/vote', [VoteController::class, 'vote']);
});
```

---

### Schritt 2: GitHub Pages Frontend erweitern

#### 2.1 index.html mit API Calls

```html
<!-- index.html -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🛒 Amazon Affiliate Shop</title>
    <meta name="description" content="Amazon Affiliate Shop mit Community-Voting">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #64748b;
            --accent: #f59e0b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }
        .navbar { background: linear-gradient(135deg, var(--primary), #7c3aed); backdrop-filter: blur(10px); padding: 1rem 0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; color: white !important; }
        .hero { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white; padding: 5rem 0; position: relative; overflow: hidden; }
        .hero h1 { font-size: 3rem; font-weight: 800; margin-bottom: 1.5rem; }
        .hero p { font-size: 1.25rem; color: #cbd5e1; margin-bottom: 2rem; }
        .features { padding: 5rem 0; background: var(--card-bg); }
        .feature-card { background: white; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2rem; margin-bottom: 2rem; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .feature-icon { font-size: 2.5rem; margin-bottom: 1rem; }
        .product-grid { padding: 2rem 0; }
        .product-card { background: var(--card-bg); border: 1px solid #e2e8f0; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .product-image { width: 100%; height: 200px; object-fit: contain; margin-bottom: 1rem; }
        .product-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; }
        .product-price { font-size: 1.5rem; font-weight: 700; color: var(--primary); margin-bottom: 1rem; }
        .product-description { color: var(--text-muted); margin-bottom: 1rem; }
        .voting-buttons { display: flex; gap: 0.5rem; }
        .voting-btn { background: none; border: none; cursor: pointer; font-size: 1.5rem; transition: all 0.3s ease; }
        .voting-btn:hover { transform: scale(1.2); }
        .voting-btn.liked { color: var(--accent); }
        .voting-btn.favorited { color: var(--primary); }
        .loading { text-align: center; padding: 3rem; }
        .spinner-border { width: 3rem; height: 3rem; }
        @media (max-width: 768px) { .hero h1 { font-size: 2rem; } }
    </style>
</head>
<body>
    <!-- Loading Spinner -->
    <div id="loading">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-3">Produkte werden geladen...</p>
    </div>

    <!-- Produkte Container -->
    <div id="products" class="product-grid" style="display: none;"></div>

    <!-- Fehler-Container -->
    <div id="error" style="display: none; padding: 2rem; text-align: center;">
        <div class="alert alert-danger">
            <strong>❌ Fehler</strong>
            <p id="error-message"></p>
            <a href="https://github.com/chris1971nrw/community-shop" class="btn btn-primary mt-2">
                GitHub Repository
            </a>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">🛒 Amazon Affiliate Shop</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="#products">Produkte</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#about">Über uns</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="https://github.com/chris1971nrw/community-shop">
                        <i class="bi bi-github me-1"></i>GitHub
                    </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container hero-content">
            <h1>🛒 Amazon Affiliate Shop</h1>
            <p>Entdecke die besten Produkte, die von der Community ausgewählt wurden. Bewerte mit 👍 ⭐ 🛒.</p>
            <div class="mt-4">
                <a href="#products" class="btn btn-light btn-lg fw-bold">
                    <i class="bi bi-search me-2"></i>Produkte entdecken
                </a>
            </div>
        </div>
    </section>

    <!-- Produkte Section -->
    <section id="products" class="container product-grid">
        <!-- Produkte werden hier geladen -->
    </section>

    <!-- VotingWidget (React/JSX) -->
    <script src="https://cdn.jsdelivr.net/npm/react@18.2.0/umd/react.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-dom@18.2.0/umd/react-dom.production.min.js"></script>
    <script>
        // VotingWidget Component
        const VotingWidget = ({ product }) => {
            const [voted, setVoted] = React.useState(false);

            const handleVote = async (type) => {
                if (!voted) {
                    try {
                        const response = await fetch(`/api/products/${product.id}/vote`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                            },
                            body: JSON.stringify({ type }),
                        });

                        if (response.ok) {
                            setVoted(true);
                            // Voting-Logik
                        }
                    } catch (error) {
                        console.error('Voting-Fehler:', error);
                    }
                }
            };

            return (
                <div class="voting-buttons">
                    <button
                        class="voting-btn"
                        onClick={() => handleVote('upvote')}
                        style={voted ? { color: '#10b981' } : {}}
                    >
                        👍
                    </button>
                    <button
                        class="voting-btn"
                        onClick={() => handleVote('favorite')}
                        style={voted ? { color: '#3b82f6' } : {}}
                    >
                        ⭐
                    </button>
                    <button
                        class="voting-btn"
                        onClick={() => handleVote('wishlist')}
                        style={voted ? { color: '#f59e0b' } : {}}
                    >
                        🛒
                    </button>
                </div>
            );
        };

        // Produkte laden
        async function loadProducts() {
            try {
                const response = await fetch('/api/products');
                const data = await response.json();

                if (data.success) {
                    const products = data.data;

                    const productHTML = products.map(product => {
                        return `
                            <div class="product-card">
                                <img src="${product.image}" alt="${product.name}" class="product-image">
                                <h3 class="product-title">${product.name}</h3>
                                <p class="product-price">€${product.price.toFixed(2)}</p>
                                <p class="product-description">${product.description.substring(0, 100)}...</p>
                                <div class="voting-buttons">
                                    <button class="voting-btn" onclick="vote(${product.id}, 'upvote')">👍</button>
                                    <button class="voting-btn" onclick="vote(${product.id}, 'favorite')">⭐</button>
                                    <button class="voting-btn" onclick="vote(${product.id}, 'wishlist')">🛒</button>
                                </div>
                            </div>
                        `;
                    }).join('');

                    document.getElementById('products').innerHTML = productHTML;
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('products').style.display = 'block';
                }
            } catch (error) {
                console.error('Fehler beim Laden der Produkte:', error);
                document.getElementById('loading').style.display = 'none';
                document.getElementById('error').style.display = 'block';
                document.getElementById('error-message').textContent = error.message;
            }
        }

        // Voting Funktion
        function vote(productId, type) {
            fetch(`/api/products/${productId}/vote`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                },
                body: JSON.stringify({ type }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Vote erfolgreich!', data);
                }
            })
            .catch(error => {
                console.error('Voting-Fehler:', error);
            });
        }

        // Produkte laden
        loadProducts();
    </script>
</body>
</html>
```

---

### Schritt 3: Laravel Backend Setup

#### 3.1 Laravel Project Structure

```bash
community-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ProductController.php
│   │   │   ├── VoteController.php
│   │   │   └── Api/
│   │   │       ├── ProductController.php
│   │   │       └── VoteController.php
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Vote.php
│   │   └── User.php
│   └── Services/
│       ├── VotingService.php
│       └── VotingSyncService.php
├── database/
│   ├── migrations/
│   │   └── create_products_table.php
│   │   └── create_votes_table.php
│   └── seeders/
│       └── ProductSeeder.php
├── routes/
│   ├── api.php
│   └── web.php
├── config/
│   └── cors.php
├── .env
└── composer.json
```

#### 3.2 Laravel API Endpunkte

```php
// routes/api.php
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\VoteController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::middleware('auth:sanctum')->group(function ($route) {
    Route::post('/products/{id}/vote', [VoteController::class, 'vote']);
});
```

---

## 📋 Zusammenfassung

### ✅ GitHub Pages (Statisches Frontend)

**Features:**
- ✅ Responsive Design
- ✅ Voting (statisch)
- ✅ Produkt-Katalog
- ✅ Preis-Monitoring
- ✅ Demo & Präsentation

**API Integration:**
- ✅ API Calls (fetch())
- ✅ React VotingWidget
- ✅ Loading Spinner
- ✅ Fehlerbehandlung

---

### ✅ Laravel (Backend-Integration)

**Features:**
- ✅ Datenbank-Integration
- ✅ API Endpunkte
- ✅ Authentifizierung
- ✅ Voting Logik

**API Endpunkte:**
- ✅ GET /api/products
- ✅ GET /api/products/{id}
- ✅ POST /api/products/{id}/vote

---

## 🚀 Nächste Schritte

1. **Laravel API erstellen**
2. **GitHub Pages Frontend erweitern**
3. **API Endpunkte testen**
4. **Dokumentation aktualisieren**

**Version:** 0.1.0  
**Last Updated:** 2026-05-24
