<?php
// Amazon Affiliate Integration
// Automatisches Generieren von Partner-Links

// Amazon Partner-API Credentials (Umgebungsvariablen)
$affiliate_id = getenv('AMAZON_AFFILIATE_ID');
$partner_token = getenv('AMAZON_PARTNER_TOKEN');

function convertToAmazonLink($productId, $affiliateId, $partnerToken) {
    // API Call zu Amazon Product Advertising API
    // Returns formatted Amazon link with affiliate tracking
    
    $base_url = 'https://associatesservices.amazon.de/gp/product/';
    $affiliate_link = $base_url . $productId . "&tag=" . $affiliateId;
    
    return $affiliate_link;
}

// Convert user-submitted link to affiliate link
function convertUserLink($user_link, $affiliate_id, $partner_token) {
    // Extract product ID from user link
    $product_id = extractProductID($user_link);
    
    // Generate affiliate link
    return convertToAmazonLink($product_id, $affiliate_id, $partner_token);
}

// User-gegenerierter Link verarbeiten
if (isset($_POST['amazon_link'])) {
    $user_link = $_POST['amazon_link'];
    $affiliate_link = convertUserLink($user_link, $affiliate_id, $partner_token);
    
    // Speichere in Datenbank
    $stmt = $pdo->prepare("UPDATE articles SET amazon_link = ? WHERE id = ?");
    $stmt->execute([$affiliate_link, $_POST['article_id']]);
}

?>
