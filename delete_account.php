<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$userFile = 'user.json';
$users = json_decode(file_get_contents($userFile), true);
$profile = $_SESSION['profile_name'];

// Benutzer entfernen
$users = array_filter($users, fn($u) => $u['profile_name'] !== $profile);

// Datei aktualisieren
file_put_contents($userFile, json_encode(array_values($users), JSON_PRETTY_PRINT));

// Session beenden
session_destroy();
header("Location: login.html");
exit;
?>
