<?php
// Community Shop Admin Panel
// Einfaches PHP-Admin-Interface

session_start();

// Login check
if (!isset($_SESSION['admin_logged_in'])) {
    die("Zugriff verweigert - nicht autorisiert");
}

// Artikel hinzufügen
if (isset($_POST['add_article'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $amazon_link = filter_var($_POST['amazon_link'], FILTER_SANITIZE_URL);
    
    $stmt = $pdo->prepare("INSERT INTO articles (title, description, amazon_link) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $amazon_link]);
    echo "Artikel hinzugefügt!";
}

// Alle Artikel anzeigen
$stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Community Shop Admin</title></head>
<body>
<h1>Community Shop Admin</h1>

<!-- Formular für neuen Artikel -->
<form method="POST" style="margin: 20px 0;">
    <input name="title" placeholder="Titel" required><br>
    <textarea name="description" placeholder="Beschreibung" required></textarea><br>
    <input name="amazon_link" placeholder="Amazon Link" required><br>
    <input type="submit" name="add_article" value="Artikel hinzufügen">
</form>

<h2>Bestehende Artikel</h2>
<?php foreach ($articles as $article): ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
        <strong><?= htmlspecialchars($article['title']) ?></strong><br>
        <?= htmlspecialchars($article['description']) ?><br>
        <a href="<?= htmlspecialchars($article['amazon_link']) ?>">Amazon Link</a><br>
        <small><?= htmlspecialchars($article['created_at']) ?></small>
    </div>
<?php endforeach; ?>
</body>
</html>
