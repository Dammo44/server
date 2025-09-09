<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

$rank = $_SESSION['rank'] ?? 'user';
$isOwner = strtolower($rank) === 'owner';
?>

<!-- ... HTML oben ... -->

<main>
    <div class="action-box">
        <?php if ($isOwner): ?>
            <form method="GET" action="create_rank.php">
                <button type="submit">Rank erstellen</button>
            </form>
        <?php endif; ?>

        <?php if ($isOwner): ?>
            <form method="GET" action="register_form.php">
                <button type="submit">User erstellen</button>
            </form>
        <?php endif; ?>

        <form method="POST" action="logout.php">
            <button type="submit">Logout</button>
        </form>
    </div>
</main>
