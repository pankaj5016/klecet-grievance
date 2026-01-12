<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$errorMsg = '';
$successMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = trim($_POST['current_password']);
    $new = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    if ($current && $new && $confirm) {
        if ($new !== $confirm) {
            $errorMsg = "❌ New password and confirm password do not match.";
        } else {
            $userId = $_SESSION['user_id'];
            $designation = $_SESSION['designation'] ?? '';

            // Select correct table
            $table = strtolower($designation) === 'student' ? 'students' : 'employees';

            // Fetch current password
            $stmt = $pdo->prepare("SELECT password FROM $table WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($current, $user['password'])) {
                // Update password
                $hashed = password_hash($new, PASSWORD_DEFAULT);
                $update = $pdo->prepare("UPDATE $table SET password = :pass WHERE id = :id");
                $update->execute([':pass' => $hashed, ':id' => $userId]);

                $successMsg = "✅ Password changed successfully!";
            } else {
                $errorMsg = "❌ Current password is incorrect.";
            }
        }
    } else {
        $errorMsg = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password - KLECET</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 360px;
            max-width: 95%;
            text-align: center;
        }
        h2 { color: #003366; margin-bottom: 25px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; color: #333; text-align: left; }
        input { width: 100%; padding: 12px 15px; margin-bottom: 18px; border-radius: 8px; border: 1px solid #ccc; font-size: 14px; }
        input:focus { border-color: #003366; outline: none; }
        .password-wrapper { position: relative; }
        .toggle-password { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 18px; color: #888; }
        button { width: 100%; padding: 14px; background: #003366; color: #fff; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: 0.3s; }
        button:hover { background: #00509e; }
        .message { font-size: 14px; padding: 10px; border-radius: 6px; margin-bottom: 15px; }
        .error { background: #ffd2d2; color: #d8000c; }
        .success { background: #d4edda; color: #155724; }
    </style>
    <script>
        function togglePassword(id, iconId) {
            const passField = document.getElementById(id);
            const icon = document.getElementById(iconId);
            if (passField.type === "password") {
                passField.type = "text";
                icon.textContent = "🙈";
            } else {
                passField.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>

        <?php if ($errorMsg) echo "<div class='message error'>$errorMsg</div>"; ?>
        <?php if ($successMsg) echo "<div class='message success'>$successMsg</div>"; ?>

        <form method="POST">
            <label>Current Password:</label>
            <div class="password-wrapper">
                <input type="password" name="current_password" id="current_password" required>
                <span class="toggle-password" id="toggleCurrent" onclick="togglePassword('current_password','toggleCurrent')">👁️</span>
            </div>

            <label>New Password:</label>
            <div class="password-wrapper">
                <input type="password" name="new_password" id="new_password" required>
                <span class="toggle-password" id="toggleNew" onclick="togglePassword('new_password','toggleNew')">👁️</span>
            </div>

            <label>Confirm New Password:</label>
            <div class="password-wrapper">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <span class="toggle-password" id="toggleConfirm" onclick="togglePassword('confirm_password','toggleConfirm')">👁️</span>
            </div>

            <button type="submit">Update Password</button>
        </form>
    </div>
</body>
</html>
