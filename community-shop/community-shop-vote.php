<?php
// Wöchentliches Abstimmungssystem für Community Shop
// Nutzer können Artikel jeden Freitag abstimmen

session_start();

// Nur jeden Freitag aktiv
$is_friday = date('N') == 5 && date('M') != 'December';

if (!$is_friday) {
    echo "Abstimmung ist aktuell nicht aktiv.";
    exit;
}

// User ID aus Session
$userId = $_SESSION['user_id'] ?? null;

if (isset($_POST['vote'])) {
    $articleId = $_POST['article_id'];
    
    // Neue Woche starten
    $weekStart = date('Y-m-d', strtotime('monday this week'));
    
    // Vote ablegen
    $stmt = $pdo->prepare("INSERT INTO weekly_votes (article_id, week_start_date, vote_count) 
                          VALUES (?, ?, 1)
                          ON CONFLICT(article_id, week_start_date) 
                          DO UPDATE SET vote_count = vote_count + 1");
    $stmt->execute([$articleId, $weekStart]);
    
    echo "Danke für deine Stimme!";
}

// Artikel für diese Woche
$stmt = $pdo->prepare("SELECT * FROM articles WHERE weekly_vote > 0 ORDER BY weekly_vote DESC");
$stmt->execute();
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Abstimmung</title></head>
<body>
<h1>Wöchentliche Abstimmung</h1>
<p>Helfe der Community - stimme auf deine Lieblinge ab!</p>

<form method="POST">
    <?php foreach ($articles as $article): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
            <label><input type="checkbox" name="article_id[<?= $article['id'] ?>]" value="1">
                <?= htmlspecialchars($article['title']) ?>
            </label><br>
            <small><?= htmlspecialchars($article['description']) ?></small>
        </div>
    <?php endforeach; ?>
    <input type="submit" name="vote" value="Abstimmen">
</form>
</body>
</html>
