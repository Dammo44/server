<?php
session_start();

$userFile = 'user.json';
$profile = $_POST['profile_name'] ?? '';
$password = $_POST['password'] ?? '';

$users = json_decode(file_get_contents($userFile), true);

$found = false;
foreach ($users as $user) {
    if ($user['profile_name'] === $profile && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'] ?? $profile;
        $_SESSION['profile_name'] = $user['profile_name'];
        $_SESSION['rank'] = $user['rank'] ?? 'user';
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