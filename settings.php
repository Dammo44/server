<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>⚙️ Einstellungen</h2>

    <form action="update_account.php" method="POST">
        <fieldset>
            <legend>✏️ Account ändern</legend>
            <label>Aktuelles Passwort:</label>
            <input type="password" name="current_password" required>

            <label>Neuer Anzeigename:</label>
            <input type="text" name="new_username">

            <label>Neuer Loginname:</label>
            <input type="text" name="new_profile_name">

            <label>Neues Passwort:</label>
            <input type="password" name="new_password">

            <button type="submit">Änderungen speichern</button>
        </fieldset>
    </form>

    <form action="delete_account.php" method="POST" onsubmit="return confirm('Willst du deinen Account wirklich löschen?');">
        <fieldset>
            <legend>🗑️ Account löschen</legend>
            <button type="submit">Account löschen</button>
        </fieldset>
    </form>

    <p><a href="index.php">⬅️ Zurück</a></p>
</body>
</html>
