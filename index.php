<?php
session_start();

// Prüfen, ob Benutzer eingeloggt ist
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

// Rang prüfen
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
    <h1>
        👋 Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>
        <?php if ($isOwner): ?>
            👑
        <?php endif; ?>
    </h1>

    <p>Du bist eingeloggt als <strong><?php echo htmlspecialchars($_SESSION['profile_name']); ?></strong></p>
    <p>Rang: <strong><?php echo htmlspecialchars($rank); ?></strong></p>

    <?php if ($isOwner): ?>
        <form method="GET" action="register.html">
            <button type="submit">User erstellen</button>
        </form>
    <?php endif; ?>

    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
