<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

function getRankPermissions($rankName) {
    $ranks = json_decode(file_get_contents('ranks.json'), true);
    foreach ($ranks as $r) {
        if (strtolower($r['name']) === strtolower($rankName)) {
            return $r;
        }
    }
    return null;
}

$rank = $_SESSION['rank'] ?? 'user';
$permissions = getRankPermissions($rank);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startseite</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="settings-icon">
        <a href="settings.php" title="Einstellungen">⚙️</a>
    </div>

    <header>
        <h1>
            🔥 Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>
            <?php if (strtolower($rank) === 'owner'): ?> 👑 <?php endif; ?>
        </h1>
    </header>

    <main>
        <?php if (isset($_GET['success'])): ?>
            <p class="success-msg">
                <?php
                switch ($_GET['success']) {
                    case 'edit_user': echo "✅ Benutzer erfolgreich geändert."; break;
                    case 'delete_rank': echo "✅ Rang erfolgreich gelöscht."; break;
                    default: echo "✅ Aktion erfolgreich!";
                }
                ?>
            </p>
        <?php endif; ?>

        <div class="action-box">
            <?php if ($permissions['can_create_user'] ?? false): ?>
                <form method="GET" action="register_form.php">
                    <button type="submit">User erstellen</button>
                </form>
            <?php endif; ?>

            <?php if ($permissions['can_create_rank'] ?? false): ?>
                <form method="GET" action="create_rank.php">
                    <button type="submit">Rank erstellen</button>
                </form>
            <?php endif; ?>

            <?php if ($permissions['can_manage_users'] ?? false): ?>
                <form method="GET" action="edit_user.php">
                    <button type="submit">👑 User ändern</button>
                </form>

                <form method="GET" action="delete_user.php">
                    <button type="submit">👑 User löschen</button>
                </form>
            <?php endif; ?>

            <?php if ($permissions['can_manage_ranks'] ?? false): ?>
                <form method="GET" action="edit_rank.php">
                    <button type="submit">👑 Rang ändern</button>
                </form>

                <form method="GET" action="delete_rank.php">
                    <button type="submit">👑 Rang löschen</button>
                </form>
            <?php endif; ?>

            <form method="POST" action="logout.php">
                <button type="submit">Logout</button>
            </form>
        </div>
    </main>
</body>
</html>
