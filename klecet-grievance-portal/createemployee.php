<?php
session_start();
require 'includes/db.php'; // ✅ This defines $pdo (PDO connection)

// ✅ Allow only Principal access
if (!isset($_SESSION['designation']) || $_SESSION['designation'] !== 'Principal') {
    header("Location: login.php");
    exit;
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $mobile = trim($_POST['mobile']);
    $designation = trim($_POST['role']);
    $branch = trim($_POST['department']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        $message = "❌ Passwords do not match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // ✅ Insert new employee
            $stmt = $pdo->prepare("
                INSERT INTO employees (name, mobile, designation, branch, password)
                VALUES (:name, :mobile, :designation, :branch, :password)
            ");
            $stmt->execute([
                ':name' => $name,
                ':mobile' => $mobile,
                ':designation' => $designation,
                ':branch' => $branch,
                ':password' => $hashedPassword
            ]);

            $message = "✅ Employee created successfully!";
        } catch (PDOException $e) {
            $message = "❌ Database Error: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Employee | Principal Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin:0;
      background-color:#f9f9f9;
    }
    .header {
      background-color:#003366;
      color:#fff;
      padding:15px 20px;
      text-align:center;
    }
    .dashboard {
      display:flex;
      justify-content:center;
      padding:40px 20px;
    }
    .form-container {
      background-color:#fff;
      padding:40px 30px;
      border-radius:10px;
      box-shadow:0 4px 10px rgba(0,0,0,0.1);
      max-width:500px;
      width:100%;
      text-align:center;
    }
    .form-container h2 {
      margin-bottom:20px;
      color:#003366;
    }
    form {
      display:flex;
      flex-direction:column;
      gap:15px;
      text-align:left;
    }
    input, select {
      width:100%;
      padding:10px 12px;
      border:1px solid #ccc;
      border-radius:5px;
      font-size:1rem;
    }
    .password-wrapper {
      position:relative;
    }
    .password-wrapper input {
      width:100%;
      padding-right:40px;
    }
    .toggle-password {
      position:absolute;
      right:10px;
      top:50%;
      transform:translateY(-50%);
      cursor:pointer;
      font-size:1.2rem;
      color:#666;
      user-select:none;
    }
    .toggle-password:hover { color:#003366; }
    .button-group {
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      justify-content:flex-end;
    }
    .button-group button {
      flex:1 1 45%;
      padding:10px 12px;
      font-size:1rem;
      border-radius:5px;
      border:none;
      cursor:pointer;
      transition:0.3s;
    }
    .submit-btn { background-color:#003366; color:#fff; }
    .submit-btn:hover { background-color:#002244; }
    .cancel-btn { background-color:#ccc; color:#333; }
    .cancel-btn:hover { background-color:#999; }
    .message { text-align:center; margin-bottom:15px; font-weight:bold; }
  </style>
</head>
<body>
  <header class="header">
    <h1>KLECET Grievance Portal - Principal Dashboard</h1>
  </header>

  <div class="dashboard">
    <div class="form-container">
      <h2>Create New Employee</h2>
      <?php if($message): ?>
        <p class="message"><?= $message ?></p>
      <?php endif; ?>
      <form action="" method="post">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter full name" required/>

        <label for="mobile">Mobile Number</label>
        <input type="tel" id="mobile" name="mobile" placeholder="Enter mobile number" required/>

        <label for="role">Designation / Role</label>
        <select id="role" name="role" required>
          <option value="">-- Select Role --</option>
          <option value="Principal">Principal</option>
          <option value="GCC">GCC</option>
          <option value="HOD">HOD</option>
          <option value="GDC">GDC</option>
          <option value="Student">Student</option>
        </select>

        <label for="department">Department</label>
        <select id="department" name="department">
          <option value="" selected>None / Central</option>
          <option>Computer Science</option>
          <option>Mechanical</option>
          <option>Civil</option>
          <option>Electronics</option>
          <option>MBA</option>
          <option>MCA</option>
        </select>

        <label for="password">Password</label>
        <div class="password-wrapper">
          <input type="password" id="password" name="password" placeholder="Enter password" required/>
          <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span>
        </div>

        <label for="confirmPassword">Confirm Password</label>
        <div class="password-wrapper">
          <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required/>
          <span class="toggle-password" onclick="togglePassword('confirmPassword', this)">👁️</span>
        </div>

        <div class="button-group">
          <button type="submit" class="submit-btn">Submit</button>
          <button type="button" class="cancel-btn" onclick="window.location.href='principal_dashboard.php'">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <footer style="text-align:center; padding:15px; background:#003366; color:#fff;">
    <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
  </footer>

  <script>
    function togglePassword(fieldId, icon) {
      const input = document.getElementById(fieldId);
      if (input.type === "password") {
        input.type = "text";
        icon.textContent = "🙈";
      } else {
        input.type = "password";
        icon.textContent = "👁️";
      }
    }
  </script>
</body>
</html>
