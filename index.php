<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Willkommen</title>
</head>
<body>
  <h2>👋 Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
  <p>Rang: <?php echo htmlspecialchars($_SESSION['rank']); ?></p>

  <?php if ($_SESSION['rank'] === 'owner'): ?>
    <a href="add_user.php">🧑‍💻 Benutzer hinzufügen</a><br>
  <?php endif; ?>

  <a href="logout.php">🚪 Logout</a>
</body>
</html>
