<?php

namespace Shop\Service;

use Exception;
use Shop\Model\Product;
use Shop\Model\Score;

class ProductImporter
{
    private $amazonScraper;
    private $productRepository;
    private $scoreRepository;
    
    public function __construct(
        AmazonScraper $amazonScraper,
        ProductRepository $productRepository,
        ScoreRepository $scoreRepository
    ) {
        $this->amazonScraper = $amazonScraper;
        $this->productRepository = $productRepository;
        $this->scoreRepository = $scoreRepository;
    }
    
    /**
     * Importiert Produkte aus Amazon
     * 
     * @param array $amazonLinks Array von Amazon-Links
     * @return array Import-Ergebnis
     */
    public function importProducts(array $amazonLinks): array
    {
        $results = [
            'success' => 0,
            'failed' => 0,
            'duplicates' => 0,
            'details' => [],
        ];
        
        foreach ($amazonLinks as $link => $data) {
            try {
                // Extrahiere Produktdaten
                $productData = $this->amazonScraper->extractProductData($link);
                
                // Prüfe auf Duplikate
                if ($this->isDuplicate($productData['asin'])) {
                    $results['duplicates']++;
                    $results['details'][] = [
                        'asin' => $productData['asin'],
                        'status' => 'duplicate',
                        'message' => 'Produkt bereits importiert',
                    ];
                    continue;
                }
                
                // Erstelle Produkt
                $product = new Product();
                $product->name = $productData['name'];
                $product->price = $productData['price'];
                $product->currency = $productData['currency'];
                $product->image = $productData['image'];
                $product->url = $productData['url'];
                $product->asin = $productData['asin'];
                $product->description = "Amazon-Import: {$productData['name']}";
                
                $this->productRepository->save($product);
                
                // Erstelle Initial-Score
                $this->scoreRepository->createDefaultScore($product->id);
                
                $results['success']++;
                $results['details'][] = [
                    'asin' => $productData['asin'],
                    'status' => 'success',
                    'message' => "Produkt importiert: {$productData['name']}",
                ];
                
            } catch (Exception $e) {
                $results['failed']++;
                $results['details'][] = [
                    'link' => $link,
                    'status' => 'failed',
                    'message' => $e->getMessage(),
                ];
            }
        }
        
        return $results;
    }
    
    /**
     * Prüft ob ASIN bereits existiert
     * 
     * @param string $asin
     * @return bool
     */
    private function isDuplicate(string $asin): bool
    {
        // In Produktion: echte Datenbankabfrage
        // return $this->productRepository->findByAsin($asin) !== null;
        return false;
    }
}
