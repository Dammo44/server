<?php
session_start();

// Pfad zur JSON-Datei
$userFile = 'user.json';

// Eingaben aus dem Formular
$profile = $_POST['profile_name'] ?? '';
$password = $_POST['password'] ?? '';

// JSON laden und dekodieren
$users = json_decode(file_get_contents($userFile), true);

// Benutzer prüfen
$found = false;
foreach ($users as $user) {
    if ($user['profile_name'] === $profile && $user['password'] === $password) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['profile_name'] = $user['profile_name'];
        $_SESSION['rank'] = $user['rank'];
        $found = true;
        break;
    }
}

if ($found) {
    header("Location: index.php");
    exit;
} else {
    echo "<h2>❌ Login fehlgeschlagen</h2>";
    echo "<p><a href='login.html'>Zurück zum Login</a></p>";
}
?>
