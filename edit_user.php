<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

function getRankPermissions($rankName) {
    $ranks = json_decode(file_get_contents('ranks.json'), true);
    foreach ($ranks as $r) {
        if (strtolower($r['name']) === strtolower($rankName)) {
            return $r;
        }
    }
    return null;
}

$permissions = getRankPermissions($_SESSION['rank']);
if (!$permissions['can_manage_users']) {
    header("Location: index.php");
    exit;
}

$users = json_decode(file_get_contents('user.json'), true);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>User ändern</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>👑 Benutzer bearbeiten</h2>

    <form action="save_user_edit.php" method="POST">
        <fieldset>
            <legend>Benutzer auswählen & ändern</legend>

            <label for="selected_user">Benutzer:</label>
            <select name="selected_user" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['profile_name']) ?>">
                        <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['profile_name']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Neuer Anzeigename:</label>
            <input type="text" name="new_username">

            <label>Neuer Profilname:</label>
            <input type="text" name="new_profile_name">

            <label>Neues Passwort:</label>
            <input type="text" name="new_password">

            <button type="submit">Änderungen speichern</button>
        </fieldset>
    </form>
</body>
</html>
