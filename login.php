<?php
session_start();

$userFile = 'user.json';

// Eingaben abholen und trimmen
$profile = trim($_POST['profile_name'] ?? '');
$password = $_POST['password'] ?? '';

// Validierung
if (!$profile || !$password) {
    showError("Bitte alle Felder ausfüllen.");
    exit;
}

// Datei laden
if (!file_exists($userFile)) {
    showError("Benutzerdaten nicht gefunden.");
    exit;
}

$users = json_decode(file_get_contents($userFile), true);
if (!is_array($users)) {
    showError("Benutzerdaten sind beschädigt.");
    exit;
}

// Benutzer suchen
foreach ($users as $user) {
    if (
        isset($user['profile_name'], $user['password']) &&
        $user['profile_name'] === $profile &&
        password_verify($password, $user['password'])
    ) {
        $_SESSION['username'] = $user['username'] ?? $profile;
        $_SESSION['profile_name'] = $user['profile_name'];
        $_SESSION['rank'] = $user['rank'] ?? 'user';
        header("Location: index.php");
        exit;
    }
}

// Wenn kein Benutzer gefunden wurde
showError("❌ Login fehlgeschlagen. Benutzername oder Passwort ist falsch.");
exit;

// Fehleranzeige-Funktion
function showError($message) {
    echo "<!DOCTYPE html>
    <html lang='de'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Login Fehler</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <h2>🔐 Login</h2>
        <p style='color:red;'>".htmlspecialchars($message)."</p>
        <a href='login.html'>🔙 Zurück zum Login</a>
    </body>
    </html>";
}
?>