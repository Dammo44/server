<?php
session_start();

// Nur Owner dürfen zugreifen
if (!isset($_SESSION['rank']) || strtolower($_SESSION['rank']) !== 'owner') {
    header("Location: index.php");
    exit;
}

// Wenn Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $profile_name = $_POST['profile_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    $rank = $_POST['rank'] ?? 'user';

    if (!$username || !$profile_name || !$password || !$confirm) {
        $error = "Bitte alle Felder ausfüllen.";
    } elseif ($password !== $confirm) {
        $error = "Passwörter stimmen nicht überein.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $newUser = [
            "profile_name" => $profile_name,
            "password" => $hashed,
            "username" => $username,
            "rank" => $rank
        ];

        $file = 'user.json';
        $users = json_decode(file_get_contents($file), true);
        $users[] = $newUser;
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzer hinzufügen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>🧑‍💻 Neuen Benutzer erstellen</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="username" required>

        <label>Profilname:</label>
        <input type="text" name="profile_name" required>

        <label>Passwort:</label>
        <input type="password" name="password" required>

        <label>Passwort erneut:</label>
        <input type="password" name="confirm" required>

        <label>Rang:</label>
        <select name="rank">
            <option value="user">user</option>
            <option value="mod">mod</option>
            <option value="owner">owner</option>
        </select>

        <button type="submit">✅ Benutzer speichern</button>
    </form>
</body>
</html>