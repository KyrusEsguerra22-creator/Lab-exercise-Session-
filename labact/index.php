<?php
require_once __DIR__ . '/session.php';

$home = signedInHome();

if ($home !== null) {
    $_SESSION['show_logout_notice'] = true;
    goToPage($home);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['pass'] ?? '';
    $role = null;

    if ($username === 'jason' && $password === 'admin') {
        $role = 'admin';
    } elseif ($username === 'kyrus' && $password === '123') {
        $role = 'student';
    }

    if ($role !== null) {
        session_regenerate_id(true);

        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        goToPage(signedInHome());
    }

    $error = 'Wrong username or password!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body>
    <form
        method="post"
        action="index.php"
        style="max-width: 400px; margin: 20vh auto; padding: 20px;
               border: 1px solid #ddd; border-radius: 8px;
               box-shadow: 0 6px 10px rgba(0,0,0,0.1);"
    >
        <h3 class="text-center mb-4">Login</h3>

        <?php if ($error !== ''): ?>
            <p class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <div class="mb-3">
            <label for="usernameInput" class="form-label">Username</label>
            <input
                type="text"
                class="form-control"
                id="usernameInput"
                name="username"
                autocomplete="username"
                required
            >
        </div>

        <div class="mb-3">
            <label for="passwordInput" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="passwordInput"
                name="pass"
                autocomplete="current-password"
                required
            >
        </div>

        <div class="mb-3 d-grid">
            <input type="submit" name="sub" class="btn btn-primary" value="Login">
        </div>
    </form>

    <script>
        window.addEventListener('pageshow', (event) => {
            if (event.persisted) {
                location.reload();
            }
        });
    </script>
</body>
</html>