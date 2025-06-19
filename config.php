<?php

// 🔐 Admin credentials
define('USERNAME', 'admin');
define('PASSWORD', 'admin@1234');

// ⏱️ Maximum inactivity time: 5 minutes
define('INACTIVITY_LIMIT', 300); // 300 seconds = 5 minutes

// 🕒 Check inactivity and force auto logout
if (
    isset($_SESSION['logged_in'], $_SESSION['last_activity']) &&
    time() - $_SESSION['last_activity'] > INACTIVITY_LIMIT
) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit;
}
