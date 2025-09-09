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
    <title>👑 User löschen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>👑 Benutzer löschen</h2>

    <form action="delete_user_action.php" method="POST">
        <fieldset>
            <label for="profile_name">Benutzer auswählen:</label>
            <select name="profile_name" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['profile_name']) ?>">
                        <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['profile_name']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Löschen</button>
        </fieldset>
    </form>
</body>
</html>
