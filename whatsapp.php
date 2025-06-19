<?php
date_default_timezone_set('America/New_York');

// Path to JSON config
$configFile = 'numbers_config.json';
$fallbackNumber = '00987654321'; // fallback: Manager's number

// Check if config file exists
if (!file_exists($configFile)) {
    http_response_code(500);
    echo json_encode(['number' => $fallbackNumber]);
    exit;
}

$config = json_decode(file_get_contents($configFile), true);

// Get current day of week (0 = Sunday, 6 = Saturday)
$days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
$dayKey = $days[(int) date('w')];

// Get numbers for the current day
$numbers = [
    $config[$dayKey . '_1'] ?? $fallbackNumber,
    $config[$dayKey . '_2'] ?? $fallbackNumber
];

// Counter file for current day
$counterFile = "counter_{$dayKey}.txt";

// Initialize counter if needed
if (!file_exists($counterFile)) {
    file_put_contents($counterFile, 0);
}
$count = (int) file_get_contents($counterFile);

// Alternate between two numbers
$index = $count % 2;
$selected = $numbers[$index] ?? $fallbackNumber;

// Update counter
file_put_contents($counterFile, $count + 1);

// Return as JSON
header('Content-Type: application/json');
echo json_encode(['number' => $selected]);
