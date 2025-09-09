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
    <title>👑 Rang löschen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>👑 Rang löschen</h2>

    <form action="delete_rank_action.php" method="POST">
        <fieldset>
            <label for="rank_name">Rang auswählen:</label>
            <select name="rank_name" required>
                <?php foreach ($ranks as $rank): ?>
                    <option value="<?= htmlspecialchars($rank['name']) ?>">
                        <?= htmlspecialchars($rank['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Löschen</button>
        </fieldset>
    </form>
</body>
</html>
