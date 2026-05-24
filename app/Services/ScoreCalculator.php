<?php

namespace App\Services;

use App\Models\Vote;
use App\Models\View;
use Illuminate\Support\Facades\DB;

class ScoreCalculator
{
    protected $database;
    
    public function __construct($database)
    {
        $this->database = $database;
    }
    
    /**
     * Berechne Score für Produkt
     */
    public function calculate($productId): float
    {
        // Database Transaktion
        return DB::transaction(function () use ($productId) {
            // Hole Votes
            $votes = Vote::where('product_id', $productId)->get();
            
            $likes = Vote::where('product_id', $productId)->where('type', 'like')->count();
            $favorites = Vote::where('product_id', $productId)->where('type', 'favorite')->count();
            $carts = Vote::where('product_id', $productId)->where('type', 'cart')->count();
            
            // Views in der letzten 7 Tage
            $weeklyViews = View::where('product_id', $productId)
                ->where('viewed_at', '>=', now()->subDays(7))
                ->count();
            
            // Produkt-Alter in Tagen
            $daysOld = 0;
            $product = Product::find($productId);
            if ($product) {
                $daysOld = now()->diffInDays($product->created_at);
            }
            
            // Score berechnen
            $score = ($likes * 1) + 
                     ($favorites * 2) + 
                     ($carts * 3) + 
                     ($weeklyViews * 0.1) - 
                     ($daysOld * 0.05);
            
            // Rundung auf 2 Dezimalstellen
            return round($score, 2);
        });
    }
    
    /**
     * Aktualisiere Score direkt in Datenbank
     */
    public function sync($productId)
    {
        return DB::transaction(function () use ($productId) {
            // Alte Score holen
            $oldScore = Product::find($productId)?->score ?? 0;
            
            // Neue Score berechnen
            $newScore = $this->calculate($productId);
            
            // Score aktualisieren
            Product::where('id', $productId)->update(['score' => $newScore]);
            
            return [
                'product_id' => $productId,
                'old_score' => $oldScore,
                'new_score' => $newScore,
                'changed_at' => now()
            ];
        });
    }
    
    /**
     * Berechne Score für alle Produkte
     */
    public function recalculateAll()
    {
        $products = Product::where('status', 'active')->get();
        $updated = 0;
        
        foreach ($products as $product) {
            $score = $this->calculate($product->id);
            
            // Nur wenn Score sich ändert
            if ($score !== $product->score) {
                $product->update(['score' => $score]);
                $updated++;
            }
        }
        
        return [
            'updated' => $updated,
            'total' => $products->count()
        ];
    }
    
    /**
     * Hole Top Produkte
     */
    public function getTopProducts(int $limit = 10)
    {
        return Product::where('status', 'active')
            ->orderBy('score', 'desc')
            ->limit($limit)
            ->get();
    }
}
