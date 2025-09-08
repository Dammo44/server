<?php
session_start();

// Prüfen, ob Benutzer eingeloggt ist
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

// Rang prüfen
$rank = $_SESSION['rank'] ?? 'user'; // Fallback zu 'user' falls nicht gesetzt
$isOwner = strtolower($rank) === 'owner';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
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

    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
