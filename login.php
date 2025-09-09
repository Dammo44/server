<?php
session_start();

$userFile = 'user.json';
$profile = trim($_POST['profile_name'] ?? '');
$password = $_POST['password'] ?? '';

if (!$profile || !$password) {
    showError("Bitte alle Felder ausfüllen.");
    exit;
}

if (!file_exists($userFile)) {
    showError("Benutzerdaten nicht gefunden.");
    exit;
}

$content = file_get_contents($userFile);
$users = json_decode($content, true);

if (!is_array($users)) {
    showError("Benutzerdaten sind beschädigt.");
    exit;
}

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

showError("❌ Login fehlgeschlagen. Benutzername oder Passwort ist falsch.");
exit;

function showError($msg) {
    echo "<!DOCTYPE html>
    <html lang='de'>
    <head><meta charset='UTF-8'><title>Fehler</title></head>
    <body><h2 style='color:red;'>$msg</h2><a href='login.html'>🔙 Zurück</a></body>
    </html>";
}
?>
