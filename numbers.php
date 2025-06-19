<?php
require 'config.php';
session_start();

// 🔒 Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// ✅ Success message
if (isset($_GET['success'])) {
    echo "<div class='success'>✔️ Numbers successfully updated!</div>";
}

// 📞 Available numbers (fake names and numbers)
$availableNumbers = [
    '00911111111' => 'Alice',
    '00922222222' => 'Bob',
    '00933333333' => 'Charlie',
    '00944444444' => 'Diana',
    '00955555555' => 'Ethan',
    '00966666666' => 'Fiona',
    '00977777777' => 'George',
    '00988888888' => 'Hannah',
    '00999999999' => 'Ivan',
    '00900000000' => 'Julia'
];

// 📁 Load current config
$configFile = 'numbers_config.json';
$data = file_exists($configFile) ? json_decode(file_get_contents($configFile), true) : [];

// 🧱 Set defaults if not present
foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
    $data[$day . '_1'] = $data[$day . '_1'] ?? '';
    $data[$day . '_2'] = $data[$day . '_2'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage WhatsApp Numbers</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f5f7fa;
            padding: 40px;
            color: #333;
        }

        h2 {
            color: #222;
            font-size: 28px;
            margin-bottom: 10px;
        }

        h3 {
            margin-top: 30px;
            font-size: 20px;
            color: #444;
        }

        a {
            color: #3366cc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            background-color: #fff;
            padding: 15px 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            list-style-type: none;
            margin-bottom: 30px;
        }

        li {
            padding: 5px 0;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        select {
            padding: 8px;
            border: 1px solid #bbb;
            border-radius: 4px;
            width: 100%;
            max-width: 300px;
            margin-top: 5px;
        }

        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.06);
            max-width: 600px;
        }

        button,
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3366cc;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #254a99;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-left: 5px solid #28a745;
            margin-bottom: 20px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h2>Manage WhatsApp Numbers</h2>
    <p><a href="logout.php">Logout</a></p>

    <form method="POST" action="save_numbers.php">
        <?php
        $daysOfWeek = [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday'
        ];

        foreach ($daysOfWeek as $key => $label):
        ?>
            <h3><?= $label ?></h3>
            <label>Agent 1:
                <select name="<?= $key ?>_1" required>
                    <?php foreach ($availableNumbers as $number => $name): ?>
                        <option value="<?= $number ?>" <?= $data[$key . '_1'] === $number ? 'selected' : '' ?>>
                            <?= $name ?> (<?= $number ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>

            <label>Agent 2:
                <select name="<?= $key ?>_2" required>
                    <?php foreach ($availableNumbers as $number => $name): ?>
                        <option value="<?= $number ?>" <?= $data[$key . '_2'] === $number ? 'selected' : '' ?>>
                            <?= $name ?> (<?= $number ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br><br>
        <?php endforeach; ?>

        <button type="submit">Save</button>
    </form>
</body>

</html>