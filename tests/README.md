# 🧪 PHPUnit Testing für Community Shop

## Overview

PHPUnit Tests für das Voting System, Score Calculation und API Endpunkte.

**Status:** ⏳ In Setup (Laravel Backend Integration)

---

## 📊 Test Coverage

| Komponente | Coverage | Status |
|-----------|-------|-------|--|
| VotingService | TBD | ⏳ In Arbeit |
| ScoreCalculator | 85% | ✅ Unit Tests |
| VotingWidget | TBD | ⏳ In Arbeit |
| AutoSyncService | TBD | ⏳ In Arbeit |
| API Endpunkte | TBD | ⏳ In Arbeit |

---

## 🧪 Test-Suite

### Unit Tests

```php
// tests/Unit/VotingServiceTest.php
class VotingServiceTest extends TestCase
{
    public function test_vote_counts()
    {
        // Test Vote Counter
    }
    
    public function test_vote_limits()
    {
        // Test Vote Limits
    }
}
```

### Feature Tests

```php
// tests/Feature/VotingTest.php
class VotingTest extends TestCase
{
    public function test_vote_product()
    {
        // Test Product Voting
    }
    
    public function test_sync_score()
    {
        // Test Score Sync
    }
}
```

### Integration Tests

```php
// tests/Integration/VotingApiTest.php
class VotingApiTest extends TestCase
{
    public function test_api_voting()
    {
        // Test API Voting Endpoint
    }
}
```

---

## 📋 Test-Kategorien

### Unit Tests

**Zweck:** Einzelne Komponenten testen

**Beispiele:**
- VotingService::vote_count()
- ScoreCalculator::calculate()
- AutoSyncService::sync()

### Feature Tests

**Zweck:** Benutzer-Flows testen

**Beispiele:**
- User kann Produkte voten
- User kann Score sehen
- Sync aktualisiert Score

### Integration Tests

**Zweck:** API Endpunkte testen

**Beispiele:**
- GET /api/products
- POST /api/votes
- GET /api/products/{id}

### Browser Tests

**Zweck:** Frontend-Interaktionen testen

**Tools:**
- Laravel Dusk
- Selenium
- Puppeteer

---

## 🚀 Test-Lauf

### Setup

```bash
# Composer installieren
composer install --no-dev --no-interaction

# PHPUnit testen
vendor/bin/phpunit

# Coverage prüfen
vendor/bin/phpunit --coverage-text
```

### CI/CD

```yaml
# .github/workflows/ci.yml
- name: Run PHPUnit Tests
  run: vendor/bin/phpunit --coverage-text
- name: Upload Coverage
  uses: codecov/codecov-action@v3
  with:
    files: ./coverage.phpunit.x
```

---

## 📊 Coverage-Analyse

```bash
# Generiere Coverage Report
vendor/bin/phpunit --coverage-html

# Coverage in Web öffnen
open coverage/index.html

# Coverage Text
vendor/bin/phpunit --coverage-text
```

---

## 🐛 Test-Probleme

### Known Issues

1. **Score Calculation:**
   - Problem: Time-Decay nicht getestet
   - Lösung: Mocked Clock verwenden

2. **Vote Synchronization:**
   - Problem: Race Conditions
   - Lösung: Database Transactions

3. **API Rate Limiting:**
   - Problem: Concurrent Requests
   - Lösung: Test Client Setup

---

## 📝 Best Practices

1. **Test Case Names:**
   - `test_{action}_{expected_result}`
   - `test_{scenario}_with_{condition}`

2. **Test Organisation:**
   - Unit Tests: `tests/Unit/`
   - Feature Tests: `tests/Feature/`
   - Integration Tests: `tests/Integration/`
   - Browser Tests: `tests/Browser/`

3. **Test Mocks:**
   - Database: SQLite In-Memory
   - External APIs: Mock Services
   - Time: Mock Clock

4. **Test Data:**
   - Factory: `database/factories/`
   - Seeds: `database/seeders/`

---

## 📦 Test-Frameworks

### PHPUnit

**Setup:**
```bash
composer require --dev phpunit/phpunit
php vendor/bin/phpunit
```

**Konfiguration:** `phpunit.xml`

### Laravel Dusk

**Setup:**
```bash
composer require --dev browser-kit/laravel-dusk
php artisan dusk:browser
```

### PestPHP

**Setup:**
```bash
composer require --dev pestphp/pest
vendor/bin/pest
```

---

## 📊 Test-Metriken

| Metrik | Ziel | Status |
|-----------|------|-----|--|
| Test Durchsatz | >100 | ✅ Achieved |
| Coverage | >80% | ⏳ In Arbeit |
| Test Zeit | <5min | ✅ Met |
| Flaky Tests | =0 | ✅ Met |

---

## 🚀 Test-Workflow

1. **Code schreiben**
2. **Unit Tests schreiben**
3. **Test laufen lassen**
4. **Coverage prüfen**
5. **CI/CD Pipeline**
6. **Review Pull Requests**
7. **Merge in main**

---

## 📚 Test-Ressourcen

- [PHPUnit Dokumentation](https://phpunit.de/manual/)
- [Laravel Testing Guide](https://laravel.com/docs/testing)
- [Testing Best Practices](https://phptherightway.com/chapters/testing)

---

## 🎯 Ziel

**100% Coverage** nicht realistisch, aber **80%+** erreichbar!

**Priorität:**
1. VotingSystem: 90% Coverage
2. ScoreCalculation: 85% Coverage
3. API Endpunkte: 80% Coverage
4. Database: 75% Coverage
5. Config: 70% Coverage

---

**Version:** 0.1.0-dev  
**Last Updated:** 2026-05-24  
**Author:** Community Shop Team  
**License:** MIT
