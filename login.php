<?php
require 'config.php';
session_start();

// ⚠️ Prevent browser caching
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 🔐 Login validation
if (isset($_POST['username'], $_POST['password'])) {
    if ($_POST['username'] === USERNAME && $_POST['password'] === PASSWORD) {
        $_SESSION['logged_in'] = true;
        $_SESSION['last_activity'] = time();
        header('Location: numbers.php');
        exit;
    } else {
        $error = "Incorrect username or password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #e3ecf7, #f9fbfd);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #222;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3366cc;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #254a99;
        }

        .error {
            color: #b00020;
            text-align: center;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        .timeout-msg {
            color: orange;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>🔐 Login</h2>

        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <?php if (isset($_GET['timeout'])): ?>
            <p class="timeout-msg">Your session has expired due to inactivity. Please log in again.</p>
        <?php endif; ?>

        <form method="POST">
            <label>Username:
                <input type="text" name="username" required>
            </label>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <button type="submit">Log In</button>
        </form>
    </div>
</body>

</html>