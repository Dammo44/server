<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['rank']) !== 'owner') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rank erstellen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>🆙 Neuen Rang erstellen</h2>

    <form action="save_rank.php" method="POST">
        <fieldset>
            <legend>Rang-Daten</legend>

            <label for="rank_name">Rangname:</label>
            <input type="text" id="rank_name" name="rank_name" required>

            <label>
                <input type="checkbox" name="can_create_user" value="1">
                👤 Darf User erstellen
            </label><br>

            <label>
                <input type="checkbox" name="can_create_rank" value="1">
                🆙 Darf Rang erstellen
            </label><br>

            <button type="submit">Rang speichern</button>
        </fieldset>
    </form>
</body>
</html>
