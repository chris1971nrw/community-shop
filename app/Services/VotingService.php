<?php

namespace App\Services;

use App\Models\Vote;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class VotingService
{
    public function __construct($database)
    {
        $this->database = $database;
    }
    
    /**
     * Abgabe eines Votes
     */
    public function vote($productId, $type): array
    {
        return DB::transaction(function () use ($productId, $type) {
            // Prüfe, ob Product existiert
            $product = Product::find($productId);
            
            if (!$product) {
                throw new \Exception("Product not found: {$productId}");
            }
            
            // Prüfe Vote-Typ
            $validTypes = ['like', 'favorite', 'cart'];
            if (!in_array($type, $validTypes)) {
                throw new \Exception("Invalid vote type: {$type}");
            }
            
            // Lösche alte Vote für dieses User-IP und Product
            Vote::where('product_id', $productId)
                ->where('ip_address', request()->ip())
                ->delete();
            
            // Neue Vote erstellen
            $vote = Vote::create([
                'product_id' => $productId,
                'type' => $type,
                'ip_address' => request()->ip(),
            ]);
            
            // Score aktualisieren
            $scoreCalculator = app(ScoreCalculator::class);
            $syncResult = $scoreCalculator->sync($productId);
            
            return [
                'vote' => $vote,
                'sync' => $syncResult
            ];
        });
    }
    
    /**
     * Hole alle Votes für ein Produkt
     */
    public function getVotes($productId): array
    {
        $votes = Vote::where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();
        
        return $votes;
    }
    
    /**
     * Hole Vote-Count für ein Produkt
     */
    public function getVoteCount($productId): array
    {
        $product = Product::find($productId);
        
        if (!$product) {
            return [];
        }
        
        $votes = Vote::where('product_id', $productId)->count();
        
        return [
            'product_id' => $productId,
            'total' => $votes,
            'like' => Vote::where('product_id', $productId)->where('type', 'like')->count(),
            'favorite' => Vote::where('product_id', $productId)->where('type', 'favorite')->count(),
            'cart' => Vote::where('product_id', $productId)->where('type', 'cart')->count(),
        ];
    }
    
    /**
     * Prüfe ob Vote-IP bereits abgestimmt
     */
    public function hasVoted($productId): bool
    {
        return Vote::where('product_id', $productId)
            ->where('ip_address', request()->ip())
            ->exists();
    }
}
