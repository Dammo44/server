<?php
session_start();

// Prüfen, ob Benutzer eingeloggt ist
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>👋 Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Du bist eingeloggt als <strong><?php echo htmlspecialchars($_SESSION['profile_name']); ?></strong></p>
    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
