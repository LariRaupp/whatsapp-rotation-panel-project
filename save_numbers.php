<?php
require 'config.php';
session_start();

// 🔒 Ensure the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
$data = [];

// Validate all fields dynamically
foreach ($days as $day) {
    if (!isset($_POST["{$day}_1"], $_POST["{$day}_2"])) {
        echo "Error: All fields are required.";
        exit;
    }

    $data["{$day}_1"] = $_POST["{$day}_1"];
    $data["{$day}_2"] = $_POST["{$day}_2"];
}

// Save to JSON file
file_put_contents('numbers_config.json', json_encode($data, JSON_PRETTY_PRINT));

// Redirect with success message
header('Location: numbers.php?success=1');
exit;
