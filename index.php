<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$rank = $_SESSION['rank'] ?? 'user';
$isOwner = strtolower($rank) === 'owner';
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
            👋 Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>
            <?php if ($isOwner): ?> 👑 <?php endif; ?>
        </h1>
    </header>

    <main>
        <div class="action-box">
            <?php if ($isOwner): ?>
                <form method="GET" action="register.html">
                    <button type="submit">User erstellen</button>
                </form>
            <?php endif; ?>

            <form method="POST" action="logout.php">
                <button type="submit">Logout</button>
            </form>
        </div>
    </main>
</body>
</html>
