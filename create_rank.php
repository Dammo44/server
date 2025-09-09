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

            <button type="submit">Rang speichern</button>
        </fieldset>
    </form>
</body>
</html>
