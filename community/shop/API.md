# Community Shop API Dokumentation

Basis: https://docs.apiary.io/
Version: 1.0
Base URL: `/api/v1`

## Authentifizierung

Alle API-Aufrufe benötigen keinen Authentication-Key für diese MVP-Version.

## Endpunkte

### Produkte

#### Alle Produkte auflisten
```http
GET /api/v1/products
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "products": [
      {
        "id": 1,
        "name": "Beispiel Produkt",
        "description": "Produktbeschreibung",
        "price": 49.99,
        "amazon_link": "https://amazon.de/dp/B08N5M7S6K"
      }
    ]
  }
}
```

#### Einzelprodukt holen
```http
GET /api/v1/products/{id}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "name": "Beispiel Produkt",
    "description": "Produktbeschreibung",
    "price": 49.99,
    "amazon_link": "https://amazon.de/dp/B08N5M7S6K",
    "image": "url-zum-bild.jpg"
  }
}
```

### Community

#### Mitglied hinzufügen
```http
POST /api/v1/community/members
Content-Type: application/json

{
  "email": "mitglied@beispiel.de",
  "role": "member",
  "status": "active"
}
```

#### Mitglied erhalten
```http
GET /api/v1/community/members/{id}
```

#### Rangliste holen
```http
GET /api/v1/community/rankings
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "rankings": [
      {
        "rank": 1,
        "member": {
          "name": "Max Mustermann",
          "points": 5000
        },
        "achievements": ["Top Seller", "Community Hero"]
      }
    ]
  }
}
```

### Bewertungen

#### Bewertung erstellen
```http
POST /api/v1/products/{productId}/reviews
Content-Type: application/json

{
  "rating": 5,
  "comment": "Tolles Produkt! 👍"
}
```

#### Bewertungen auflisten
```http
GET /api/v1/products/{productId}/reviews
```

## Fehlercodes

| Code | Beschreibung |
|------|--------------|
| `success` | Erfolgreich |
| `not_found` | Ressource nicht gefunden |
| `forbidden` | Keine Berechtigung |
| `error` | Allgemeiner Fehler |

## Beispiel-Aufrufe

### cURL

```bash
# Alle Produkte
curl -X GET 'https://api.community-shop.de/api/v1/products'

# Einzelprodukt
curl -X GET 'https://api.community-shop.de/api/v1/products/1'

# Mitglied hinzufügen
curl -X POST 'https://api.community-shop.de/api/v1/community/members' \
  -H 'Content-Type: application/json' \
  -d '{
    "email": "test@beispiel.de",
    "role": "member"
  }'
```

### JavaScript

```javascript
// Produkte laden
async function loadProducts() {
  const response = await fetch('https://api.community-shop.de/api/v1/products');
  const data = await response.json();
  console.log(data);
}

loadProducts();
```

### Python

```python
import requests

response = requests.get('https://api.community-shop.de/api/v1/products')
data = response.json()
print(data)
```

## Rate Limits

- Standard-Limit: 100 Anträge/Stunde
- Überschreitung: HTTP 429 mit Retry-After Header

## Support

Bei Fragen: support@community-shop.de

## Versionierung

- API v1: `/api/v1`
- Änderungen: Deprecation-Period 6 Monate
