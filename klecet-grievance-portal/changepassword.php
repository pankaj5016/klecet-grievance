<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['designation']) || $_SESSION['designation'] !== 'Principal') {
    header("Location: login.php");
    exit;
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $old = trim($_POST['old_password']);
    $new = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    $principal_id = $_SESSION['id'];

    // Fetch current password
    $sql = "SELECT password FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $principal_id);
    $stmt->execute();
    $stmt->bind_result($current_password);
    $stmt->fetch();
    $stmt->close();

    // Check old password
    if ($old !== $current_password) {
        $message = "❌ Old password is incorrect!";
    }
    else if ($new !== $confirm) {
        $message = "❌ New passwords do not match!";
    }
    else {
        // Update new password
        $update_sql = "UPDATE employees SET password = ? WHERE id = ?";
        $stmt2 = $conn->prepare($update_sql);
        $stmt2->bind_param("si", $new, $principal_id);

        if ($stmt2->execute()) {
            $message = "✅ Password changed successfully!";
        } else {
            $message = "❌ Failed to update password!";
        }

        $stmt2->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Change Password</title>

  <style>
    body {
      background: #eef2f3;
      font-family: Arial, sans-serif;
    }

    .change-pass-container {
      max-width: 420px;
      margin: 60px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .change-pass-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .message-box {
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 6px;
      font-weight: bold;
      text-align: center;
    }

    .password-toggle {
      position: relative;
    }

    .password-toggle input {
      width: 100%;
      padding: 10px 40px 10px 10px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .toggle-eye {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
    }

    button {
      padding: 10px 15px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 48%;
      font-size: 16px;
      margin-top: 10px;
    }

    .submit-btn {
      background-color: #007bff;
      color: white;
    }

    .cancel-btn {
      background-color: #dc3545;
      color: white;
    }

    form .btn-group {
      display: flex;
      justify-content: space-between;
    }
  </style>
</head>

<body>

  <div class="change-pass-container">
    <h2>Change Password</h2>

    <?php if ($message != '') : ?>
      <div class="message-box" style="background:#ffecec; color:#d8000c;">
        <?= $message ?>
      </div>
    <?php endif; ?>

    <form method="POST">

      <label>Current Password</label>
      <div class="password-toggle">
        <input type="password" name="old_password" id="current-password" required>
        <span class="toggle-eye" onclick="togglePassword('current-password')">👁️</span>
      </div>

      <label>New Password</label>
      <div class="password-toggle">
        <input type="password" name="new_password" id="new-password" required>
        <span class="toggle-eye" onclick="togglePassword('new-password')">👁️</span>
      </div>

      <label>Confirm New Password</label>
      <div class="password-toggle">
        <input type="password" name="confirm_password" id="confirm-password" required>
        <span class="toggle-eye" onclick="togglePassword('confirm-password')">👁️</span>
      </div>

      <div class="btn-group">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="cancel-btn">Cancel</button>
      </div>
    </form>

  </div>

  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      input.type = (input.type === "password") ? "text" : "password";
    }
  </script>

</body>
</html>
