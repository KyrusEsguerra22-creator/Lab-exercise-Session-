<?php
require_once __DIR__ . '/session.php';

$home = signedInHome();

if ($home === null) {
    goToPage('index.php');
}

$token = $_POST['token'] ?? null;

if (
    $_SERVER['REQUEST_METHOD'] !== 'POST'
    || !is_string($token)
    || !hash_equals($_SESSION['logout_token'], $token)
) {
    $_SESSION['show_logout_notice'] = true;
    goToPage($home);
}

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $cookie = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 3600,
        $cookie['path'],
        $cookie['domain'],
        $cookie['secure'],
        $cookie['httponly']
    );
}

session_destroy();
goToPage('index.php');