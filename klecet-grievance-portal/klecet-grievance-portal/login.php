<?php
session_start();
include 'includes/db.php';

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Safe defaults
  $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
  $designation = isset($_POST['designation']) ? trim($_POST['designation']) : '';
  $password = isset($_POST['password']) ? trim($_POST['password']) : '';

  if ($mobile && $designation && $password) {
    try {
      $stmt = $pdo->prepare("SELECT * FROM users WHERE mobile = ? AND designation = ?");
      $stmt->execute([$mobile, $designation]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user) {
        if ($user['status'] !== 'approved') {
          $errorMsg = "Your account is not yet approved by Principal.";
       } elseif (password_verify($password, $user['password'])) {
          // Plain text password match (for demo only!)
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['name'] = $user['name'];      // consistent everywhere!
          $_SESSION['designation'] = $user['designation'];

          // Redirect based on designation
          if ($designation === 'Principal') {
            header("Location: principal-dashboard.php");
            exit();
          } elseif (strpos($designation, 'HOD') !== false) {
            header("Location: hod-dashboard.php");
            exit();
          } elseif (strpos($designation, 'Coordinator') !== false) {
            header("Location: coordinator-dashboard.php");
            exit();
          } elseif (strpos($designation, 'Student') !== false) {
            header("Location: student-dashboard.php");
            exit();
          } else {
            $errorMsg = "Unknown designation. Please try again.";
          }
        } else {
          $errorMsg = "Invalid password.";
        }
      } else {
        $errorMsg = "Invalid mobile number or designation.";
      }
    } catch (PDOException $e) {
      $errorMsg = "Database error: " . $e->getMessage();
    }
  } else {
    $errorMsg = "Please fill in all fields.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | KLECET Grievance Portal</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Your existing CSS */
    .login {
      background-color: #f4f4f4;
      padding: 60px 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }
    .login-container {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }
    .login-container h2 {
      margin-bottom: 20px;
      color: #003366;
    }
    .login-container form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      width: 100%;
    }
    .login-container input,
    .login-container select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
      box-sizing: border-box;
    }
    .password-wrapper {
      position: relative;
    }
    .password-wrapper input {
      width: 100%;
      padding-right: 40px;
    }
    .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 1.2rem;
      color: #666;
    }
    .toggle-password:hover {
      color: #003366;
    }
    .button-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    .button-group button {
      flex: 1 1 45%;
      padding: 10px 12px;
      font-size: 1rem;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
      box-sizing: border-box;
    }
    .submit-btn {
      background-color: #003366;
      color: #fff;
    }
    .submit-btn:hover {
      background-color: #002244;
    }
    .cancel-btn {
      background-color: #ccc;
      color: #333;
    }
    .cancel-btn:hover {
      background-color: #999;
    }
    .forgot-password,
    .signup-link {
      margin-top: 10px;
      font-size: 0.9rem;
    }
    .forgot-password a,
    .signup-link a {
      color: #003366;
      text-decoration: none;
    }
    .forgot-password a:hover,
    .signup-link a:hover {
      text-decoration: underline;
    }
    .error-message {
      color: red;
      margin-bottom: 15px;
    }
    @media (max-width: 500px) {
      .login-container {
        padding: 30px 20px;
        max-width: 95%;
      }
      .button-group button {
        flex: 1 1 100%;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>KLE College of Engineering & Technology, Chikodi</h1>
      <nav class="navbar">
        <div class="nav-left">
          <a href="index.php">Home</a>
          <a href="about.php">About Us</a>
          <a href="contact.php">Contact Us</a>
        </div>
        <div class="nav-right">
          <a href="register.php">Register</a>
          <a href="login.php" class="active">Login</a>
        </div>
      </nav>
    </div>
  </header>

  <section class="login">
    <div class="login-container">
      <h2>Login</h2>
      <?php if (!empty($errorMsg)): ?>
        <p class="error-message"><?php echo htmlspecialchars($errorMsg); ?></p>
      <?php endif; ?>

      <form method="post" action="login.php">
        <label for="mobile">Mobile Number</label>
        <input
          type="tel"
          id="mobile"
          name="mobile"
          placeholder="Enter your mobile number"
          required
          value="<?php echo htmlspecialchars($mobile ?? ''); ?>"
        />

        <label for="designation">Select Your Designation</label>
        <select id="designation" name="designation" required>
          <option value="" disabled <?php echo empty($designation) ? 'selected' : ''; ?>>Select your role</option>
          <option <?php if($designation==='Principal') echo 'selected'; ?>>Principal</option>
          <option <?php if($designation==='Grievance Central Coordinator') echo 'selected'; ?>>Grievance Central Coordinator</option>
          <optgroup label="HODs">
            <option <?php if($designation==='HOD - Computer Science') echo 'selected'; ?>>HOD - Computer Science</option>
            <option <?php if($designation==='HOD - Mechanical') echo 'selected'; ?>>HOD - Mechanical</option>
            <option <?php if($designation==='HOD - Civil') echo 'selected'; ?>>HOD - Civil</option>
            <option <?php if($designation==='HOD - Electronics') echo 'selected'; ?>>HOD - Electronics</option>
            <option <?php if($designation==='HOD - MBA') echo 'selected'; ?>>HOD - MBA</option>
            <option <?php if($designation==='HOD - MCA') echo 'selected'; ?>>HOD - MCA</option>
          </optgroup>
          <optgroup label="Department Coordinators">
            <option <?php if($designation==='Coordinator - Computer Science') echo 'selected'; ?>>Coordinator - Computer Science</option>
            <option <?php if($designation==='Coordinator - Mechanical') echo 'selected'; ?>>Coordinator - Mechanical</option>
            <option <?php if($designation==='Coordinator - Civil') echo 'selected'; ?>>Coordinator - Civil</option>
            <option <?php if($designation==='Coordinator - Electronics') echo 'selected'; ?>>Coordinator - Electronics</option>
            <option <?php if($designation==='Coordinator - MBA') echo 'selected'; ?>>Coordinator - MBA</option>
            <option <?php if($designation==='Coordinator - MCA') echo 'selected'; ?>>Coordinator - MCA</option>
          </optgroup>
          <optgroup label="Students">
            <option <?php if($designation==='Student - Computer Science') echo 'selected'; ?>>Student - Computer Science</option>
            <option <?php if($designation==='Student - Mechanical') echo 'selected'; ?>>Student - Mechanical</option>
            <option <?php if($designation==='Student - Civil') echo 'selected'; ?>>Student - Civil</option>
            <option <?php if($designation==='Student - Electronics') echo 'selected'; ?>>Student - Electronics</option>
            <option <?php if($designation==='Student - MBA') echo 'selected'; ?>>Student - MBA</option>
            <option <?php if($designation==='Student - MCA') echo 'selected'; ?>>Student - MCA</option>
          </optgroup>
        </select>

        <label for="password">Password</label>
        <div class="password-wrapper">
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter your password"
            required
          />
          <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>

        <div class="button-group">
          <button type="submit" class="submit-btn">Login</button>
          <button type="button" class="cancel-btn" onclick="window.location.href='index.php'">Cancel</button>
        </div>

        <p class="forgot-password">
          <a href="forgot_password.php">Forgot Password?</a>
        </p>

        <p class="signup-link">
          Don't have an account? <a href="register.php">Register here</a>.
        </p>
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
  </footer>

  <script>
    function togglePassword() {
      const pwd = document.getElementById("password");
      pwd.type = pwd.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
