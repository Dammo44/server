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
    <header>
        <div class="header-left">
            <h1>
                👋 Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>
                <?php if ($isOwner): ?> 👑 <?php endif; ?>
            </h1>
        </div>
        <div class="header-right">
            <a href="settings.php" title="Einstellungen">⚙️</a>
        </div>
    </header>

    <main>
        <?php if ($isOwner): ?>
            <form method="GET" action="register.html">
                <button type="submit">User erstellen</button>
            </form>
        <?php endif; ?>

        <form method="POST" action="logout.php">
            <button type="submit">Logout</button>
        </form>
    </main>
</body>
</html>
