<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer Management - Community Shop</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .action-btn { margin: 2px; padding: 5px 10px; text-decoration: none; }
        .approve { background-color: #4CAF50; color: white; }
        .ban { background-color: #f44336; color: white; }
        .reset { background-color: #2196F3; color: white; }
        .user-points { color: #2196F3; font-weight: bold; }
    </style>
</head>
<body>
    <h1>👥 Benutzer Management</h1>
    
    <div style="margin-bottom: 20px;">
        <a href="?action=approveUser">Aktivieren</a> | 
        <a href="?action=banUser">Sperrt</a> | 
        <a href="?action=resetPoints">Punkte zurücksetzen</a>
    </div>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Benutzer</th>
            <th>Email</th>
            <th>Punkte</th>
            <th>Status</th>
            <th>Aktionen</th>
        </tr>
        <?php foreach ($users['users'] as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td class="user-points"><?= $user['points'] ?> Punkte</td>
                <td>
                    <span class="badge badge-<?= $user['active'] ? 'active' : 'pending' ?>">
                        <?= $user['active'] ? 'Aktiv' : 'In Wartung' ?>
                    </span>
                </td>
                <td>
                    <?php if ($user['active']): ?>
                        <a href="?action=banUser&id=<?= $user['id'] ?>" class="action-btn ban">🚫 Sperrt</a>
                        <a href="?action=resetPoints&id=<?= $user['id'] ?>" class="action-btn reset">↻ Reset</a>
                    <?php else: ?>
                        <a href="?action=approveUser&id=<?= $user['id'] ?>" class="action-btn approve">✅ Aktivieren</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>