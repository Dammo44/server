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

// Schutz: Eigener Rang darf nicht gelöscht werden
if (strtolower($rankName) === strtolower($_SESSION['rank'])) {
    die("❌ Du kannst deinen eigenen Rang nicht löschen.");
}

$ranks = json_decode(file_get_contents('ranks.json'), true);
$ranks = array_filter($ranks, fn($r) => strtolower($r['name']) !== strtolower($rankName));

file_put_contents('ranks.json', json_encode(array_values($ranks), JSON_PRETTY_PRINT));
header("Location: index.php?success=delete_rank");
exit;
