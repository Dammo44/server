<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['rank']) !== 'owner') {
    header("Location: index.php");
    exit;
}

$ranks = [];
if (file_exists('ranks.json')) {
    $json = file_get_contents('ranks.json');
    $ranks = json_decode($json, true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Benutzer erstellen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>➕ Neuen Benutzer erstellen</h2>

    <form action="register.php" method="POST">
        <fieldset>
            <legend>Benutzerdaten</legend>

            <label for="profile_name">Profilname:</label>
            <input type="text" id="profile_name" name="profile_name" required>

            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required>

            <label for="username">Anzeigename:</label>
            <input type="text" id="username" name="username" required>

            <label for="rank">Rang:</label>
            <select id="rank" name="rank" required>
                <?php foreach ($ranks as $rank): ?>
                    <option value="<?= htmlspecialchars($rank) ?>"><?= htmlspecialchars($rank) ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Benutzer hinzufügen</button>
        </fieldset>
    </form>
</body>
</html>
