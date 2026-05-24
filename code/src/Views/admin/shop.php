<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Management - Community Shop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .action-btn { margin: 2px; padding: 5px 10px; text-decoration: none; }
        .approve { background-color: #4CAF50; color: white; }
        .remove { background-color: #f44336; color: white; }
        .top-products { margin-top: 20px; padding: 20px; background-color: #f9f9f9; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .product-card { border: 1px solid #ddd; padding: 15px; text-align: center; }
        .product-image { width: 200px; height: 200px; object-fit: cover; margin-bottom: 10px; }
        .badge { padding: 3px 8px; border-radius: 3px; font-size: 0.8em; }
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-approved { background-color: #28a745; color: white; }
        .badge-rejected { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <h1>🛒 Shop Management</h1>
    
    <div class="top-products">
        <h2>⭐ Top 3 Produkte</h2>
        <?php foreach ($products['top_products'] as $product): ?>
            <div class="product-card">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><strong>Score:</strong> <?= $product['score'] ?></p>
                <span class="badge badge-approved"><?= $product['status'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    
    <h2>📦 Alle Produkte</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Amazon Preis</th>
            <th>Score</th>
            <th>Status</th>
            <th>Aktionen</th>
        </tr>
        <?php foreach ($products['products'] as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td>€<?= number_format($product['amazon_price'], 2) ?></td>
                <td><?= $product['score'] ?></td>
                <td>
                    <span class="badge badge-<?= $product['status'] ?>">
                        <?= ucfirst($product['status']) ?>
                    </span>
                </td>
                <td>
                    <a href="?action=approve&id=<?= $product['id'] ?>" class="action-btn approve">✔️ Approve</a>
                    <a href="?action=remove&id=<?= $product['id'] ?>" class="action-btn remove">❌ Remove</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>