<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$userFile = 'user.json';
$users = json_decode(file_get_contents($userFile), true);
$profile = $_SESSION['profile_name'];
$currentPassword = $_POST['current_password'] ?? '';

$found = false;

foreach ($users as &$user) {
    if ($user['profile_name'] === $profile) {
        $found = true;

        // Passwort prüfen
        if ($user['password'] !== $currentPassword) {
            echo "<h2>❌ Falsches aktuelles Passwort.</h2>";
            echo "<p><a href='settings.php'>⬅️ Zurück zu Einstellungen</a></p>";
            exit;
        }

        // Anzeigename ändern
        if (!empty($_POST['new_username'])) {
            $user['username'] = $_POST['new_username'];
            $_SESSION['username'] = $user['username'];
        }

        // Loginname ändern
        if (!empty($_POST['new_profile_name'])) {
            $user['profile_name'] = $_POST['new_profile_name'];
            $_SESSION['profile_name'] = $user['profile_name'];
        }

        // Neues Passwort setzen
        if (!empty($_POST['new_password'])) {
            $user['password'] = $_POST['new_password'];
        }

        break;
    }
}

if ($found) {
    file_put_contents($userFile, json_encode($users, JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit;
} else {
    echo "<h2>❌ Benutzer nicht gefunden.</h2>";
    echo "<p><a href='settings.php'>⬅️ Zurück zu Einstellungen</a></p>";
}
?>
