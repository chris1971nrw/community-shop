# 🚧 Phase 2.1.3: Integration

## 📋 Übersicht

Dieses Dokument beschreibt den **Hybrid-Frontend-Ansatz**, der **GitHub Pages** (statisches Frontend) mit **Laravel Backend** kombiniert.

---

## 🎯 Ziele

1. **GitHub Pages** für **Demo & Präsentation**
2. **Laravel API** für **Backend-Integration**
3. **API Endpunkte** für **Produktdaten**
4. **VotingWidget** für **Interaktivität**

---

## 🚀 Schritte

### Schritt 1: Laravel API erstellen

```bash
cd /home/christoph/.openclaw/workspace-community/shop
composer require laravel/sanctum

# API Controller erstellen
php artisan make:controller Api\ProductController --api
php artisan make:controller Api\VoteController --api
php artisan make:controller Api\CategoryController --api

# API Routes definieren
php artisan make:route api/products
php artisan make:route api/products/{id}
php artisan make:route api/votes
```

### Schritt 2: API Controller implementieren

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

### Schritt 3: API Routes definieren

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

### Schritt 4: GitHub Pages Frontend erweitern

```html
<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <title>🛒 Amazon Affiliate Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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

    <!-- Script -->
    <script>
        fetch('/api/products')
            .then(response => response.json())
            .then(products => {
                document.getElementById('loading').style.display = 'none';
                document.getElementById('products').style.display = 'block';
                
                products.forEach(product => {
                    // Produkt rendern
                    console.log(product);
                });
            })
            .catch(error => {
                console.error('Fehler:', error);
            });
    </script>
</body>
</html>
```

---

## 📊 Zusammenfassung

### ✅ GitHub Pages (Statisches Frontend)

**Features:**
- ✅ Responsive Design
- ✅ Voting (statisch)
- ✅ Produkt-Katalog
- ✅ Preis-Monitoring

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

1. **Laravel API erstellen** 🚧
2. **GitHub Pages Frontend erweitern** 📄
3. **API Endpunkte testen** 🔌
4. **Dokumentation aktualisieren** 📝

**Version:** 0.1.0  
**Last Updated:** 2026-05-24
