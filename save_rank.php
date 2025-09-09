<?php
session_start();
if (!isset($_SESSION['username']) || strtolower($_SESSION['rank']) !== 'owner') {
    header("Location: index.php");
    exit;
}

$rankName = trim($_POST['rank_name'] ?? '');

if ($rankName === '') {
    die("Ungültiger Rangname.");
}

$file = 'ranks.json';
$ranks = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $ranks = json_decode($json, true) ?? [];
}

if (!in_array($rankName, $ranks)) {
    $ranks[] = $rankName;
    file_put_contents($file, json_encode($ranks, JSON_PRETTY_PRINT));
    echo "✅ Rang '$rankName' wurde gespeichert.";
} else {
    echo "⚠️ Rang '$rankName' existiert bereits.";
}
?>
