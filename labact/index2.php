<?php
require_once __DIR__ . '/session.php';

if (signedInHome() === null) {
    goToPage('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
</head>
<body>
    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</p>

    <?php sessionNotice(); ?>
    <?php logoutControls(); ?>
</body>
</html>