<?php
session_start();
header('Cache-Control: no-store, private');

function signedInHome()
{
    if (!isset($_SESSION['username'], $_SESSION['role'])) {
        return null;
    }

    $pages = [
        'admin'   => 'home.php',
        'student' => 'home2.php'
    ];

    return $pages[$_SESSION['role']] ?? null;
}

function goToPage($page)
{
    header('Location: ' . $page, true, 303);
    exit;
}

function logoutControls()
{
    ?>
    <form method="post" action="logout.php">
        <input
            type="hidden"
            name="token"
            value="<?= htmlspecialchars($_SESSION['logout_token'], ENT_QUOTES) ?>"
        >

        <button
            type="submit"
            class="nav-link border-0 bg-transparent"
            style="color: #555;"
        >
            <i class="bi bi-box-arrow-left me-2"></i>Logout
        </button>
    </form>
    <?php
}

function sessionNotice()
{
    $showNotice = !empty($_SESSION['show_logout_notice']);
    unset($_SESSION['show_logout_notice']);
    ?>
    <script>
        (() => {
            function showLogoutAlert() {
                window.alert('click the logout');
            }

            function addBackGuard() {
                history.pushState({ logoutGuard: true }, '', location.href);
            }

            if (!history.state?.logoutGuard) {
                addBackGuard();
            }

            window.addEventListener('popstate', () => {
                if (!history.state?.logoutGuard) {
                    addBackGuard();
                }

                showLogoutAlert();
            });

            if (<?= json_encode($showNotice) ?>) {
                showLogoutAlert();
            }

            window.addEventListener('pagehide', () => {
                document.documentElement.hidden = true;
            });

            window.addEventListener('pageshow', (event) => {
                if (event.persisted) {
                    location.reload();
                }
            });
        })();
    </script>
    <?php
}

if (signedInHome() !== null && empty($_SESSION['logout_token'])) {
    $_SESSION['logout_token'] = bin2hex(random_bytes(32));
}