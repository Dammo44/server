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

$profileName = $_POST['profile_name'] ?? '';
if (!$profileName) {
    die("❌ Kein Benutzer ausgewählt.");
}

$users = json_decode(file_get_contents('user.json'), true);
$users = array_filter($users, fn($u) => $u['profile_name'] !== $profileName);

file_put_contents('user.json', json_encode(array_values($users), JSON_PRETTY_PRINT));
echo "✅ Benutzer '$profileName' wurde gelöscht.";
