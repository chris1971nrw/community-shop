# 🎯 Score Calculation Model

## 📋 Übersicht

Dieses Dokument beschreibt das **Score Calculation Model** für den Amazon Affiliate Shop. Das Modell bewertet Produkte basierend auf Community-Voten (👍 ⭐ 🛒) und zeigt die Top-Produkte.

---

## 🎯 Ziele

1. **Community-Voten gewichten** (👍 ⭐ 🛒)
2. **Fairness sicherstellen** (verhindern Spam)
3. **Relevanz bewerten** (Zeit & Nutzung)
4. **Top-Produkte identifizieren**
5. **Algorithmus-Transparenz**

---

## 📐 Voting-Typen

### 1. **Upvote (👍)** - Qualität
**Bedeutung:** Das Produkt ist gut, nützlich, empfehlenswert

**Gewicht:** 1.0 Punkte

**Beispiel:**
```
👍 👍 👍 👍 👍 = 5.0 Punkte
```

### 2. **Favorite (⭐)** - Liebling
**Bedeutung:** Das Produkt ist mein Favorit, ich liebe es

**Gewicht:** 1.5 Punkte

**Beispiel:**
```
⭐ ⭐ ⭐ = 4.5 Punkte
```

### 3. **Wishlist (🛒)** - Wishlist
**Bedeutung:** Ich möchte dieses Produkt kaufen, gut zum Vergleich

**Gewicht:** 2.0 Punkte

**Beispiel:**
```
🛒 🛒 🛒 = 6.0 Punkte
```

---

## 🧮 Score-Formel

### Basis-Formel

```
Score = (Upvotes × 1.0) + (Favorites × 1.5) + (Wishlists × 2.0)
```

### Erweiterte Formel (Zeit-basiert)

```
Score = (Upvotes × 1.0 + Favorites × 1.5 + Wishlists × 2.0) / (Log(Anzahl_votes) + 1) × (1 / Zeit_factor)
```

### Spam-Schutz

```
Max_Score_per_Timestamp = 10 Punkte pro Stunde
Min_Zeit_zwischen_Voten = 60 Sekunden
```

---

## 📊 Beispiel

### Produkt A
```
👍 × 10 = 10.0 Punkte
⭐ × 5  = 7.5 Punkte
🛒 × 3  = 6.0 Punkte
───────
Total: 23.5 Punkte
```

### Produkt B
```
👍 × 5 = 5.0 Punkte
⭐ × 10 = 15.0 Punkte
🛒 × 2 = 4.0 Punkte
───────
Total: 24.0 Punkte
```

### Ranking

```
1. Produkt B: 24.0 Punkte ⭐⭐⭐
2. Produkt A: 23.5 Punkte ⭐⭐
```

---

## 🧠 Algorithmus

### Schritt 1: Voten sammeln

```php
public function collectVotes(Product $product): array
{
    $votes = $product->votes()->where('created_at', '>', now()->subHour())->get();
    
    return [
        'upvotes' => $votes->where('type', 'upvote')->count(),
        'favorites' => $votes->where('type', 'favorite')->count(),
        'wishlists' => $votes->where('type', 'wishlist')->count(),
    ];
}
```

### Schritt 2: Score berechnen

```php
public function calculateScore($upvotes, $favorites, $wishlists)
{
    $baseScore = ($upvotes * 1.0) + ($favorites * 1.5) + ($wishlists * 2.0);
    $voteCount = $upvotes + $favorites + $wishlists;
    $timeFactor = now()->diffInMinutes($product->created_at) / 60; // Minuten
    
    // Logarithmische Dämpfung für viele Votes
    $logFactor = log($voteCount + 1, 10);
    
    // Score berechnen
    $score = $baseScore / (($logFactor + 1) * (1 + $timeFactor / 30));
    
    return round($score, 2);
}
```

### Schritt 3: Produkte sortieren

```php
public function getTopProducts(int $limit = 10)
{
    $products = Product::with(['votes' => function($query) {
        $query->where('created_at', '>', now()->subDay());
    }])->get();
    
    $topProducts = [];
    
    foreach ($products as $product) {
        $votes = $product->votes;
        
        $upvotes = collect($votes)->where('type', 'upvote')->count();
        $favorites = collect($votes)->where('type', 'favorite')->count();
        $wishlists = collect($votes)->where('type', 'wishlist')->count();
        
        $score = $this->calculateScore($upvotes, $favorites, $wishlists);
        
        $topProducts[] = [
            'product' => $product,
            'score' => $score,
        ];
    }
    
    // Sortieren nach Score (absteigend)
    usort($topProducts, function($a, $b) {
        return $b['score'] <=> $a['score'];
    });
    
    return $topProducts;
}
```

---

## 🔐 Spam-Schutz

### Rate-Limiting

```php
public function vote(Request $request, Product $product)
{
    // Prüfen ob User bereits abgestimmt hat
    if ($product->votedBy($request->user())) {
        return response()->json(['message' => 'Du hast bereits abgestimmt!'], 400);
    }
    
    // Prüfen ob zu viel gestimmt wurde (Spam)
    $hourlyVotes = Vote::where('user_id', $request->user())
        ->where('product_id', $product->id)
        ->where('created_at', '>', now()->subHour())
        ->count();
    
    if ($hourlyVotes > 10) {
        return response()->json(['message' => 'Zu viele Stimmen! Warte bitte eine Stunde.'], 429);
    }
    
    // Vote erstellen
    Vote::create([
        'product_id' => $product->id,
        'user_id' => $request->user()->id,
        'type' => $request->input('type'),
    ]);
    
    return response()->json(['message' => 'Vote erstellt!'], 201);
}
```

### Zeit-basierte Vergesslung

```php
public function decayVotes()
{
    // Votes älter als 30 Tage reduzieren
    Vote::where('created_at', '<', now()->subDay(30))
        ->update(['score_weight' => $this->decayWeight($this->lastWeight)]);
}
```

---

## 📊 Unit Tests

### Test 1: Basis-Formel

```php
public function testCalculateScore()
{
    $score = $this->calculateScore(10, 5, 3); // 10 upvotes, 5 favorites, 3 wishlists
    $expected = (10 * 1.0) + (5 * 1.5) + (3 * 2.0); // 23.5
    
    $this->assertEquals(round($score, 2), round($expected, 2));
}
```

### Test 2: Spam-Schutz

```php
public function testRateLimit()
{
    $product = Product::factory()->create();
    
    // Simuliere 11 Votes in einer Stunde
    for ($i = 0; $i < 11; $i++) {
        $this->postJson("/api/v1/products/{$product->id}/vote", [
            'type' => 'upvote',
        ])->assertStatus(429);
    }
}
```

### Test 3: Gewichtung

```php
public function testWeighting()
{
    $upvoteScore = $this->calculateScore(1, 0, 0); // 1.0
    $favoriteScore = $this->calculateScore(0, 1, 0); // 1.5
    $wishlistScore = $this->calculateScore(0, 0, 1); // 2.0
    
    $this->assertEquals($upvoteScore, 1.0);
    $this->assertEquals($favoriteScore, 1.5);
    $this->assertEquals($wishlistScore, 2.0);
}
```

---

## 🧪 Integration

### API-Endpunkt

```php
/**
 * @GET /api/v1/products/{id}/score
 * Beschreibung: Score für ein Produkt abrufen
 * Antwort:
 * {
 *   "product_id": 1,
 *   "upvotes": 10,
 *   "favorites": 5,
 *   "wishlists": 3,
 *   "score": 23.5,
 *   "rank": 1
 * }
 */
```

### Response

```json
{
  "product_id": 1,
  "product_name": "HP EliteBook 840 G8",
  "upvotes": 10,
  "favorites": 5,
  "wishlists": 3,
  "score": 23.5,
  "rank": 1
}
```

---

## 🎯 Performance-Optimierung

### Caching

```php
$topProducts = Cache::remember('top_products', 300, function () {
    return $this->getTopProducts(10);
});
```

### Datenbank-Index

```sql
CREATE INDEX idx_votes_created_at ON votes(created_at);
CREATE INDEX idx_votes_user_id ON votes(user_id);
CREATE INDEX idx_votes_product_id ON votes(product_id);
```

---

## 📊 Monitoring

### Metriken

```php
public function getMetrics()
{
    return [
        'total_products' => Product::count(),
        'total_votes' => Vote::count(),
        'average_score' => Vote::avg('score'),
        'top_product' => Product::orderBy('score', 'desc')->first(),
        'spam_attempts' => $this->getSpamAttempts(),
    ];
}
```

### Alerts

```php
if ($spamAttempts > 100) {
    Alert::channel('slack')->info('Spam-Detektion!');
}
```

---

## 🔮 Zukünftige Verbesserungen

1. **Maschinelles Lernen:**
   - Benutzer-Verhaltensanalyse
   - Empfehlungssystem
   - Trend-Erkennung

2. **Social Proof:**
   - "X Personen haben gekauft"
   - "X Personen sind jetzt interessiert"
   - "Trending: Top 10"

3. **Analytics:**
   - Voting-Statistiken
   - User-Engagement
   - Conversion-Tracking

---

**Version:** 0.1.0  
**Last Updated:** 2026-05-24
