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

$rankName = $_POST['rank_name'] ?? '';
if (!$rankName) {
    die("❌ Kein Rang ausgewählt.");
}

$newRank = [
    'name' => $rankName,
    'can_create_user' => isset($_POST['can_create_user']),
    'can_create_rank' => isset($_POST['can_create_rank']),
    'can_manage_users' => isset($_POST['can_manage_users']),
    'can_manage_ranks' => isset($_POST['can_manage_ranks'])
];

$ranks = json_decode(file_get_contents('ranks.json'), true);
foreach ($ranks as &$r) {
    if (strtolower($r['name']) === strtolower($rankName)) {
        $r = $newRank;
        break;
    }
}

file_put_contents('ranks.json', json_encode($ranks, JSON_PRETTY_PRINT));
echo "✅ Rang '$rankName' wurde aktualisiert.";
