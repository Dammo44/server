<?php
session_start();
function getRankPermissions($rankName) {
    $ranks = json_decode(file_get_contents('ranks.json'), true);
    foreach ($ranks as $r) {
        if (strtolower($r['name']) === strtolower($rankName)) {
            return $r;
        }
    }
    return null;
}

$permissions = getRankPermissions($_SESSION['rank'] ?? 'user');
if (!$permissions['can_manage_ranks']) {
    header("Location: index.php");
    exit;
}

$ranks = json_decode(file_get_contents('ranks.json'), true);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>👑 Rang bearbeiten</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>👑 Rang bearbeiten</h2>

    <form action="edit_rank_action.php" method="POST">
        <fieldset>
            <label for="rank_name">Rang auswählen:</label>
            <select name="rank_name" required>
                <?php foreach ($ranks as $rank): ?>
                    <option value="<?= htmlspecialchars($rank['name']) ?>">
                        <?= htmlspecialchars($rank['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label><input type="checkbox" name="can_create_user" value="1"> 👤 Darf User erstellen</label><br>
            <label><input type="checkbox" name="can_create_rank" value="1"> 🆙 Darf Rang erstellen</label><br>
            <label><input type="checkbox" name="can_manage_users" value="1"> ✏️ Darf User bearbeiten/löschen</label><br>
            <label><input type="checkbox" name="can_manage_ranks" value="1"> 🛠️ Darf Ränge bearbeiten/löschen</label><br>

            <button type="submit">Speichern</button>
        </fieldset>
    </form>
</body>
</html>
