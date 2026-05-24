# 📡 API Reference - Community Shop

## Overview

Die Community Shop REST API ermöglicht es Entwicklern, Produkte zu verwalten, Votes abzugeben und Score zu berechnen.

**Basis-URL:** `https://chris1971nrw.github.io/community-shop/api`

**Authentifizierung:** Bearer Token / API Key

---

## 📡 Endpunkte

### Products (Produkte)

#### `GET /api/products` - Alle Produkte

```bash
curl -X GET https://chris1971nrw.github.io/community-shop/api/products
```

**Response:**

```json
{
  "products": [
    {
      "id": 1,
      "amazon_url": "https://amazon.de/example",
      "title": "Test Produkt",
      "price": 99.99,
      "score": 8.5,
      "status": "active"
    }
  ],
  "meta": {
    "total": 100,
    "page": 1,
    "limit": 20
  }
}
```

**Parameter:**
- `page` (optional) - Seitennummer (default: 1)
- `limit` (optional) - Produkte pro Seite (default: 20)
- `search` (optional) - Produktsuche
- `sort` (optional) - Sortierung (asc/desc)

---

#### `GET /api/products/{id}` - Einzelnes Produkt

```bash
curl -X GET https://chris1971nrw.github.io/community-shop/api/products/1
```

**Response:**

```json
{
  "id": 1,
  "amazon_url": "https://amazon.de/example",
  "title": "Test Produkt",
  "description": "Produktbeschreibung...",
  "price": 99.99,
  "score": 8.5,
  "status": "active",
  "created_at": "2026-05-24",
  "updated_at": "2026-05-24"
}
```

---

#### `POST /api/products` - Neues Produkt

```bash
curl -X POST https://chris1971nrw.github.io/community-shop/api/products \
  -H "Content-Type: application/json" \
  -d '{
    "amazon_url": "https://amazon.de/example",
    "title": "Neues Produkt",
    "description": "Beschreibung",
    "price": 99.99,
    "status": "active"
  }'
```

**Response:**

```json
{
  "id": 2,
  "amazon_url": "https://amazon.de/example",
  "title": "Neues Produkt",
  "description": "Beschreibung",
  "price": 99.99,
  "score": 0,
  "status": "active",
  "created_at": "2026-05-24T15:30:00Z",
  "updated_at": "2026-05-24T15:30:00Z"
}
```

---

### Voting (Abstimmung)

#### `POST /api/votes/{product_id}` - Vote abgeben

```bash
curl -X POST https://chris1971nrw.github.io/community-shop/api/votes/1 \
  -H "Content-Type: application/json" \
  -d '{
    "type": "like"
  }'
```

**Response:**

```json
{
  "vote": {
    "id": 1,
    "product_id": 1,
    "type": "like",
    "ip_address": "127.0.0.1",
    "created_at": "2026-05-24T15:30:00Z"
  },
  "score": {
    "old_score": 0,
    "new_score": 1,
    "changed_at": "2026-05-24T15:30:00Z"
  }
}
```

---

#### `GET /api/votes/{product_id}` - Votes für Produkt

```bash
curl -X GET https://chris1971nrw.github.io/community-shop/api/votes/1
```

**Response:**

```json
{
  "votes": [
    {
      "id": 1,
      "type": "like",
      "created_at": "2026-05-24T15:30:00Z"
    },
    {
      "id": 2,
      "type": "favorite",
      "created_at": "2026-05-24T15:30:00Z"
    }
  ],
  "total": 2,
  "like": 1,
  "favorite": 1,
  "cart": 0
}
```

---

### Score (Score Berechnung)

#### `GET /api/score/{product_id}` - Score holen

```bash
curl -X GET https://chris1971nrw.github.io/community-shop/api/score/1
```

**Response:**

```json
{
  "product_id": 1,
  "score": 8.5,
  "formula": {
    "likes": 1,
    "favorites": 2,
    "carts": 3,
    "views": 0.1,
    "time_decay": 0.05
  }
}
```

---

#### `POST /api/score/calculate` - Score berechnen

```bash
curl -X POST https://chris1971nrw.github.io/community-shop/api/score/calculate \
  -H "Content-Type: application/json" \
  -d '{
    "product_ids": [1, 2, 3]
  }'
```

**Response:**

```json
{
  "scores": [
    {
      "product_id": 1,
      "score": 8.5,
      "likes": 10,
      "favorites": 5,
      "carts": 3
    }
  ]
}
```

---

### Price (Preis-Check)

#### `GET /api/price/{product_id}` - Preis prüfen

```bash
curl -X GET https://chris1971nrw.github.io/community-shop/api/price/1
```

**Response:**

```json
{
  "product_id": 1,
  "current_price": 99.99,
  "price_at": "2026-05-24T15:30:00Z",
  "previous_price": 109.99,
  "price_changed": true
}
```

---

## 🔐 Authentifizierung

### Bearer Token

```bash
curl -X GET https://chris1971nrw.github.io/community-shop/api/products \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### API Key

```bash
curl -X GET https://chris1971nrw.github.io/community-shop/api/products \
  -H "X-API-Key: YOUR_API_KEY"
```

### Token Generieren

```bash
curl -X POST https://chris1971nrw.github.io/community-shop/api/auth/token \
  -H "Content-Type: application/json" \
  -d '{
    "email": "user@example.com",
    "password": "secret"
  }'
```

**Response:**

```json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NrIiwicGFzc190b2tlbiI6dHJ1ZX0",
  "expires_at": "2026-05-24T16:30:00Z"
}
```

---

## 📝 Fehlerbehandlung

### Response Codes

| Code | Status | Beschreibung |
|------|--------|-------------|
| 200 | OK | Erfolg |
| 201 | Created | Ressource erstellt |
| 204 | No Content | Erfolg, keine Antwort |
| 400 | Bad Request | Ungültige Anfrage |
| 401 | Unauthorized | Keine Authentifizierung |
| 403 | Forbidden | Zugriff verweigert |
| 404 | Not Found | Ressource nicht gefunden |
| 422 | Unprocessable Entity | Validierungsfehler |
| 500 | Internal Server Error | Serverfehler |

### Response Format

```json
{
  "message": "Fehlermeldung",
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Feld 'email' ist erforderlich",
    "details": [
      {
        "field": "email",
        "rule": "required",
        "message": "Feld 'email' ist erforderlich"
      }
    ]
  }
}
```

---

## 📊 Rate Limiting

### Limits

- **Standard:** 60 requests/minute
- **Authenticated:** 1000 requests/minute
- **Admin:** 5000 requests/minute

### Headers

```http
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 50
X-RateLimit-Reset: 1234567890
```

### Rate Limit Exceeded

```json
{
  "message": "Rate limit reached",
  "error": {
    "code": "RATE_LIMIT_EXCEEDED",
    "message": "60 requests/minute limit reached",
    "retry_after": 60
  }
}
```

---

## 📚 Best Practices

### 1. Pagination

Immer paginierte Ergebnisse verwenden:

```bash
GET /api/products?page=1&limit=20
```

### 2. Caching

Score-Cache verwenden:

```php
$score = Cache::remember('score_' . $productId, 3600, function () {
    return $this->calculateScore($productId);
});
```

### 3. Error Handling

Fehler robust behandeln:

```php
try {
    $response = Http::get('api/products');
    return $response->json();
} catch (\Exception $e) {
    Log::error($e->getMessage());
    return response()->json(['message' => 'Error'], 500);
}
```

### 4. Request Validation

Always validate requests:

```php
$request->validate([
    'email' => 'required|email|max:255',
    'password' => 'required|min:8'
]);
```

---

## 📖 Weiterführende Dokumentation

- [Voting System](./docs/VOTING_SYSTEM.md)
- [Score Calculation](./docs/SCORE_CALCULATION.md)
- [Deployment](./docs/DEPLOYMENT.md)
- [Features](./docs/FEATURES.md)

---

**Version:** 0.1.0-dev  
**Last Updated:** 2026-05-24  
**Author:** Community Shop Team  
**License:** MIT
