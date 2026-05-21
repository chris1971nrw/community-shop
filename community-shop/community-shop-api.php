<?php
// API Endpoint für Artikel-Liste
// JSON Response für Frontend

header('Content-Type: application/json');

// Artikel aus Datenbank laden
$stmt = $pdo->query("SELECT id, title, description, amazon_link, weekly_vote, week_start FROM articles WHERE weekly_vote > 0 ORDER BY weekly_vote DESC");
$articles = $stmt->fetchAll();

// API Response
echo json_encode([
    'success' => true,
    'articles' => $articles,
    'timestamp' => date('c'),
    'affiliate_program' => 'Amazon Partners',
    'total_articles' => count($articles)
]);
?>
