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
    <title>Einstellungen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>⚙️ Einstellungen</h2>

    <form action="update_account.php" method="POST">
        <fieldset>
            <legend>✏️ Account ändern</legend>

            <label for="current_password">Aktuelles Passwort:</label>
            <input type="password" id="current_password" name="current_password" required>

            <label for="new_username">Neuer Anzeigename:</label>
            <input type="text" id="new_username" name="new_username">

            <label for="new_profile_name">Neuer Loginname:</label>
            <input type="text" id="new_profile_name" name="new_profile_name">

            <label for="new_password">Neues Passwort:</label>
            <input type="password" id="new_password" name="new_password">

            <button type="submit">Änderungen speichern</button>
        </fieldset>
    </form>

    <form action="delete_account.php" method="POST" onsubmit="return confirm('Willst du deinen Account wirklich löschen?');">
        <fieldset>
            <legend>🗑️ Account löschen</legend>
            <button type="submit">Account löschen</button>
        </fieldset>
    </form>

    <p style="text-align:center;"><a href="index.php">⬅️ Zurück zur Startseite</a></p>
</body>
</html>
