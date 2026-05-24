# 🎯 Score Calculation - Voting Score Modell

## Overview

Das Score-Modell bewertet Produkte basierend auf Community-Voting mit den Buttons 👍 (Like) ⭐ (Favorite) 🛒 (Cart).

## Score Formel

```
Score = (Likes × 1) + (Favorites × 2) + (Carts × 3) + (Views × 0.1) - (DaysOld × 0.05)
```

### Gewichtungen

| Vote Type | Gewicht | Bedeutung |
|-----------|---------|-----------|
| 👍 Like | 1 | Produkt gefällt |
| ⭐ Favorite | 2 | Produkt ist besonders |
| 🛒 Cart | 3 | Kaufintention hoch |
| 👁️ Views | 0.1 | Populärität |
| ⏰ Time | -0.05/day | Fading relevance |

## Implementierung

### 1. Database Schema

```sql
-- votes Tabelle
CREATE TABLE votes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    vote_type ENUM('like', 'favorite', 'cart') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- views Tabelle
CREATE TABLE views (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_agent TEXT,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- sync_log Tabelle
CREATE TABLE sync_log (
    id INT PRIMARY KEY AUTO_INCREMENT,
    action VARCHAR(50) NOT NULL,
    product_id INT,
    previous_score DECIMAL(10,2),
    new_score DECIMAL(10,2),
    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 2. Score Calculation Service

```php
// ScoreCalculator.php
class ScoreCalculator {
    private $db;
    
    public function calculate(int $productId): float {
        // Holen aller Votes
        $likes = $this->getVoteCount($productId, 'like');
        $favorites = $this->getVoteCount($productId, 'favorite');
        $carts = $this->getVoteCount($productId, 'cart');
        
        // Views aus der letzten Woche
        $views = $this->getWeeklyViews($productId);
        
        // Produkt-Alter in Tagen
        $daysOld = $this->getProductAgeDays($productId);
        
        // Score berechnen
        $score = ($likes * 1) + 
                  ($favorites * 2) + 
                  ($carts * 3) + 
                  ($views * 0.1) - 
                  ($daysOld * 0.05);
        
        // Rundung auf 2 Dezimalstellen
        return round($score, 2);
    }
    
    private function getVoteCount($productId, $type) {
        // SQL Query...
    }
    
    private function getWeeklyViews($productId) {
        // SQL Query...
    }
}
```

### 3. Auto-Sync Service

```php
class SyncService {
    public function syncProduct($product) {
        // Alte Score holen
        $oldScore = ScoreCalculator::calculate($product->id);
        
        // Score neu berechnen
        $newScore = ScoreCalculator::calculate($product->id);
        
        // Sync-Log schreiben
        $this->logSync($product->id, 'score_update', $oldScore, $newScore);
        
        // Produktdaten aktualisieren
        Product::where('id', $product->id)->update(['score' => $newScore]);
        
        return [
            'product_id' => $product->id,
            'old_score' => $oldScore,
            'new_score' => $newScore,
            'changed_at' => now()
        ];
    }
}
```

## Testing

### Unit Tests

```bash
# Unit Tests schreiben
php artisan test --filter=ScoreCalculator

# Expected Output:
# ✓ ScoreCalculator::it_calculates_score_with_votes
# ✓ ScoreCalculator::it_ignores_votes_older_than_30_days
# ✓ ScoreCalculator::it_considers_recent_views
```

## Next Steps

- [ ] Score-Modell in VotingAPI integrieren
- [ ] Caching für Score-Updates implementieren
- [ ] Monitoring & Alerts für Score-Änderungen
- [ ] A/B Testing für Gewichtungen
