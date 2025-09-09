<?php
session_start();
if ($_SESSION['rank'] !== 'owner') {
    echo "❌ Zugriff verweigert.";
    exit;
}

$userFile = 'user.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $profile = $_POST['profile_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $rank = $_POST['rank'] ?? 'user';

    if (!$username || !$profile || !$password) {
        echo "❌ Alle Felder müssen ausgefüllt sein.";
        exit;
    }

    $newUser = [
        "profile_name" => $profile,
        "password" => $password,
        "username" => $username,
        "rank" => $rank
    ];

    $users = file_exists($userFile) ? json_decode(file_get_contents($userFile), true) : [];
    $users[] = $newUser;
    file_put_contents($userFile, json_encode($users, JSON_PRETTY_PRINT));
    echo "✅ Benutzer erfolgreich hinzugefügt.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Benutzer hinzufügen</title>
</head>
<body>
  <h2>🧑‍💻 Neuen Benutzer erstellen</h2>
  <form method="POST">
    <label>Benutzername:</label><input name="username" required><br>
    <label>Profilname:</label><input name="profile_name" required><br>
    <label>Passwort:</label><input type="text" name="password" required><br>
    <label>Rang:</label>
    <select name="rank">
      <option value="user">User</option>
      <option value="mod">Mod</option>
      <option value="owner">Owner</option>
    </select><br>
    <button type="submit">✅ Hinzufügen</button>
  </form>
</body>
</html>
