<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Community Shop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; }
        .stat-card h3 { margin: 0 0 10px 0; font-size: 2em; }
        .stat-card p { margin: 0; opacity: 0.9; }
        .nav-links { margin-bottom: 20px; }
        .nav-links a { margin-right: 20px; text-decoration: none; color: #667eea; }
    </style>
</head>
<body>
    <h1>📊 Admin Dashboard</h1>
    
    <div class="nav-links">
        <a href="?action=users">👥 Benutzer</a>
        <a href="?action=shop">🛒 Shop</a>
        <a href="?action=orders">📦 Bestellungen</a>
        <a href="?action=statistics">📈 Statistiken</a>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3><?= $stats['users'] ?></h3>
            <p>Registrierte Benutzer</p>
        </div>
        <div class="stat-card">
            <h3><?= $stats['users'] - $stats['banned'] ?></h3>
            <p>Aktive Benutzer</p>
        </div>
        <div class="stat-card">
            <h3><?= $stats['products'] ?></h3>
            <p>Produkte im Shop</p>
        </div>
        <div class="stat-card">
            <h3><?= $stats['orders'] ?></h3>
            <p>Bestellungen</p>
        </div>
        <div class="stat-card">
            <h3><?= $stats['revenue'] ?> €</h3>
            <p>Umsatz</p>
        </div>
        <div class="stat-card">
            <h3><?= $stats['points'] ?></h3>
            <p>Verteilte Punkte</p>
        </div>
    </div>
</body>
</html>