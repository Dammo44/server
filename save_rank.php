<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['rank']) !== 'owner') {
    header("Location: index.php");
    exit;
}

$rankName = trim($_POST['rank_name'] ?? '');
$canCreateUser = isset($_POST['can_create_user']) ? true : false;
$canCreateRank = isset($_POST['can_create_rank']) ? true : false;

if ($rankName === '') {
    die("❌ Ungültiger Rangname.");
}

$file = 'ranks.json';
$ranks = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $ranks = json_decode($json, true) ?? [];
}

// Prüfen ob Rangname schon existiert
foreach ($ranks as $r) {
    if (strtolower($r['name']) === strtolower($rankName)) {
        die("⚠️ Rang '$rankName' existiert bereits.");
    }
}

// Neuen Rang hinzufügen
$ranks[] = [
    'name' => $rankName,
    'can_create_user' => $canCreateUser,
    'can_create_rank' => $canCreateRank
];

file_put_contents($file, json_encode($ranks, JSON_PRETTY_PRINT));
echo "✅ Rang '$rankName' wurde erfolgreich gespeichert.";
