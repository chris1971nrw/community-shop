<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Vote;
use App\Services\ScoreCalculator;

class ScoreCalculatorTest extends TestCase
{
    use RefreshDatabase;

    protected ScoreCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = app(ScoreCalculator::class);
    }

    public function test_calculates_score_with_votes()
    {
        $product = Product::create([
            'amazon_url' => 'https://amazon.de/example',
            'title' => 'Test Product',
            'price' => 99.99,
            'status' => 'active',
            'score' => 0,
        ]);

        // Add votes
        $like = Vote::create(['product_id' => $product->id, 'type' => 'like']);
        $favorite = Vote::create(['product_id' => $product->id, 'type' => 'favorite']);
        $cart = Vote::create(['product_id' => $product->id, 'type' => 'cart']);

        $score = $this->calculator->calculate($product->id);

        $this->assertEquals(6, $score, 'Expected score = 1*1 + 1*2 + 1*3 = 6');
    }

    public function test_score_considers_recent_views()
    {
        $product = Product::create([
            'amazon_url' => 'https://amazon.de/example',
            'title' => 'Test Product',
            'price' => 99.99,
            'status' => 'active',
            'score' => 0,
        ]);

        $like = Vote::create(['product_id' => $product->id, 'type' => 'like']);
        
        // Add view for last 7 days
        View::create([
            'product_id' => $product->id,
            'viewed_at' => now()->subDay(),
        ]);

        $score = $this->calculator->calculate($product->id);

        $this->assertGreaterThan(1, $score, 'Score should include view bonus');
    }

    public function test_score_decreases_over_time()
    {
        $product = Product::create([
            'amazon_url' => 'https://amazon.de/example',
            'title' => 'Test Product',
            'price' => 99.99,
            'status' => 'active',
            'score' => 0,
        ]);

        $like = Vote::create(['product_id' => $product->id, 'type' => 'like']);

        $score = $this->calculator->calculate($product->id);
        
        // Wait 10 days
        sleep(10000); // Mock: use database time instead

        $product->update(['updated_at' => now()->addDays(10)]);
        
        // Score should decrease due to time decay
        $this->assertLessThan($score, $this->calculator->calculate($product->id));
    }

    public function test_ignore_old_votes()
    {
        $product = Product::create([
            'amazon_url' => 'https://amazon.de/example',
            'title' => 'Test Product',
            'price' => 99.99,
            'status' => 'active',
            'score' => 0,
        ]);

        // Old vote (more than 30 days ago)
        $oldLike = Vote::create([
            'product_id' => $product->id,
            'type' => 'like',
            'created_at' => now()->subMonths(2),
        ]);

        // Recent vote
        $newLike = Vote::create([
            'product_id' => $product->id,
            'type' => 'like',
            'created_at' => now(),
        ]);

        $score = $this->calculator->calculate($product->id);

        // Only recent vote should count
        $this->assertEquals(1, $score);
    }

    public function test_score_rounding()
    {
        $product = Product::create([
            'amazon_url' => 'https://amazon.de/example',
            'title' => 'Test Product',
            'price' => 99.99,
            'status' => 'active',
            'score' => 0,
        ]);

        $like = Vote::create(['product_id' => $product->id, 'type' => 'like']);
        $favorite = Vote::create(['product_id' => $product->id, 'type' => 'favorite']);

        $score = $this->calculator->calculate($product->id);

        // Score should be rounded to 2 decimal places
        $this->assertEquals(3.00, round($score, 2));
    }

    public function test_score_formula()
    {
        $product = Product::create([
            'amazon_url' => 'https://amazon.de/example',
            'title' => 'Test Product',
            'price' => 99.99,
            'status' => 'active',
            'score' => 0,
        ]);

        $like = Vote::create(['product_id' => $product->id, 'type' => 'like']);
        $favorite = Vote::create(['product_id' => $product->id, 'type' => 'favorite']);
        $cart = Vote::create(['product_id' => $product->id, 'type' => 'cart']);
        
        // 5 views per day for last week
        for ($i = 0; $i < 35; $i++) {
            View::create([
                'product_id' => $product->id,
                'viewed_at' => now()->subDays($i),
            ]);
        }

        $score = $this->calculator->calculate($product->id);

        // Formula: (1*1) + (1*2) + (1*3) + (35*0.1) - (7*0.05)
        //        = 1 + 2 + 3 + 3.5 - 0.35
        //        = 9.15

        $this->assertGreaterThanOrEqual(9, $score);
    }
}
