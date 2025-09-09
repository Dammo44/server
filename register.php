<?php
session_start();

// Kick: Nicht eingeloggt → zurück zur Startseite
if (!isset($_SESSION['username']) || strtolower($_SESSION['rank']) !== 'owner') {
    header("Location: index.php");
    exit;
}

$userFile = 'user.json';

// Eingaben aus dem Formular
$newUser = [
    'profile_name' => $_POST['profile_name'] ?? '',
    'password' => $_POST['password'] ?? '',
    'username' => $_POST['username'] ?? '',
    'rank' => $_POST['rank'] ?? 'user'
];

// Validierung
if (!$newUser['profile_name'] || !$newUser['password'] || !$newUser['username']) {
    echo "<h2>❌ Bitte alle Felder ausfüllen.</h2>";
    exit;
}

// Bestehende Benutzer laden
$users = json_decode(file_get_contents($userFile), true);

// Prüfen, ob Profilname schon existiert
foreach ($users as $user) {
    if ($user['profile_name'] === $newUser['profile_name']) {
        echo "<h2>⚠️ Profilname bereits vergeben.</h2>";
        exit;
    }
}

// Neuen Benutzer hinzufügen
$users[] = $newUser;
file_put_contents($userFile, json_encode($users, JSON_PRETTY_PRINT));

echo "<h2>✅ Benutzer erfolgreich hinzugefügt!</h2>";
echo "<p><a href='index.php'>Zurück zur Startseite</a></p>";
?>
