<?php
require_once __DIR__ . '/session.php';

$home = signedInHome();

if ($home === null) {
    goToPage('index.php');
}

if ($home !== 'home.php') {
    goToPage($home);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >
</head>
<body style="background-color: blue; min-height: 100vh; padding: 40px 20px;">

    <div
        class="d-flex bg-white"
        style="max-width: 1400px; margin: 0 auto; border-radius: 20px;
               box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;
               min-height: calc(100vh - 80px);"
    >
        <aside
            class="d-flex flex-column p-3"
            style="width: 220px; border-right: 1px solid #eee;"
        >
            <div class="fw-semibold mb-4 d-flex align-items-center">
                <span
                    class="text-white d-inline-flex align-items-center
                           justify-content-center me-2"
                    style="background-color: blue; border-radius: 50%;
                           width: 36px; height: 36px; font-size: 13px;"
                >AD</span>
                Admin
            </div>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="home.php"
                        style="color: #4f7cf6; background-color: #eef2ff;
                               border-radius: 10px; font-weight: 500;"
                    >
                        <i class="bi bi-house me-2"></i>Home
                    </a>
                </li>
            </ul>

            <div class="mt-auto">
                <?php logoutControls(); ?>
            </div>
        </aside>

        <main class="flex-grow-1" style="padding: 24px 32px;">
            <?php sessionNotice(); ?>

            <h4 class="mb-1">Home Page</h4>
            <p class="text-muted">
                Hi <?= htmlspecialchars($_SESSION['username']) ?>,
                you are an <?= htmlspecialchars($_SESSION['role']) ?>.
            </p>
        </main>
    </div>

</body>
</html>