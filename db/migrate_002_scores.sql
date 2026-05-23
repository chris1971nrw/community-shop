-- Migration 002: Score Berechnung Vistas
-- View für Score-Übersicht

CREATE OR REPLACE VIEW `shop_product_scores` AS
SELECT 
  p.id,
  p.name,
  p.image,
  p.amazon_price,
  p.affiliate_id,
  p.amazon_url,
  p.score,
  p.votes_gefall,
  p.votes_favorit,
  p.votes_kauf,
  p.clicks,
  p.status,
  p.created_at,
  p.updated_at,
  
  -- Gesamt-Score berechnen
  (p.votes_gefall * 10 + p.votes_favorit * 25 + p.votes_kauf * 5) as calculated_score,
  
  -- Gesamt-Stimmen
  (p.votes_gefall + p.votes_favorit + p.votes_kauf) as total_votes,
  
  -- Durchschnittlicher Score
  CASE 
    WHEN (p.votes_gefall + p.votes_favorit + p.votes_kauf) > 0 
    THEN (p.score / (p.votes_gefall + p.votes_favorit + p.votes_kauf))
    ELSE 0
  END as avg_score_per_vote,
  
  -- Zuletzt interagiert (NULL = nie)
  p.last_interaction
  
FROM `shop_products` p
WHERE p.status IN ('pending', 'approved', 'shop');

-- View für Top-Produkte im Shop
CREATE OR REPLACE VIEW `shop_top_products` AS
SELECT 
  p.id,
  p.name,
  p.image,
  p.amazon_price,
  p.votes_gefall,
  p.votes_favorit,
  p.votes_kauf,
  p.score,
  p.clicks,
  p.status
FROM `shop_products` p
WHERE p.status = 'shop'
ORDER BY p.score DESC, p.clicks DESC
LIMIT 3;

-- View für schwache Produkte (Entfernungskandidaten)
CREATE OR REPLACE VIEW `shop_weak_products` AS
SELECT 
  p.id,
  p.name,
  p.score,
  p.total_votes,
  p.last_interaction,
  
  -- Tage seit letzter Interaktion
  TIMESTAMPDIFF(DAY, p.last_interaction, NOW()) as days_since_interaction,
  
  -- Score pro Vote
  COALESCE(p.score / NULLIF(p.total_votes, 0), 0) as score_per_vote
FROM `shop_products` p
WHERE p.status IN ('pending', 'approved')
AND (p.last_interaction IS NULL 
     OR TIMESTAMPDIFF(HOUR, p.last_interaction, NOW()) > 168)
AND p.score < 50;
