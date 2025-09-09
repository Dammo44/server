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

$selected = $_POST['selected_user'] ?? '';
$newUsername = $_POST['new_username'] ?? '';
$newProfile = $_POST['new_profile_name'] ?? '';
$newPassword = $_POST['new_password'] ?? '';

if (!$selected) {
    die("❌ Kein Benutzer ausgewählt.");
}

$users = json_decode(file_get_contents('user.json'), true);
$found = false;

foreach ($users as &$user) {
    if ($user['profile_name'] === $selected) {
        if ($newUsername) $user['username'] = $newUsername;
        if ($newProfile) $user['profile_name'] = $newProfile;
        if ($newPassword) $user['password'] = $newPassword;
        $found = true;
        break;
    }
}

if ($found) {
    file_put_contents('user.json', json_encode($users, JSON_PRETTY_PRINT));
    header("Location: index.php?success=edit_user");
    exit;
} else {
    die("❌ Benutzer nicht gefunden.");
}
