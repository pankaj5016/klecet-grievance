<?php
include 'includes/db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data safely
    $mobile = trim($_POST['mobile']);
    $name = trim($_POST['name']);
    $branch = trim($_POST['branch']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $securityQuestion = trim($_POST['securityQuestion']);
    $securityAnswer = trim($_POST['securityAnswer']);

    // Basic check
    if ($password !== $confirmPassword) {
        $message = "❌ Passwords do not match!";
    } else {
        // Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $role = 'student';
        $status = 'pending';

        // Insert into DB
        $sql = "INSERT INTO users (mobile, name, branch, password_hash, security_question, security_answer, role, status)
                VALUES (:mobile, :name, :branch, :password_hash, :security_question, :security_answer, :role, :status)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':mobile' => $mobile,
                ':name' => $name,
                ':branch' => $branch,
                ':password_hash' => $passwordHash,
                ':security_question' => $securityQuestion,
                ':security_answer' => $securityAnswer,
                ':role' => $role,
                ':status' => $status
            ]);
            $message = "✅ Registration successful! Wait for Principal approval.";
        } catch (PDOException $e) {
            $message = "❌ Error: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | KLECET Grievance Portal</title>
    <link rel="stylesheet" href="style.css" />
    <style>.register {
  background-color: #f4f4f4;
  padding: 60px 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 80vh;
}

.form-container {
  background-color: #fff;
  padding: 40px 30px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  max-width: 400px;
  width: 100%;
  text-align: center;
}

.form-container h2 {
  margin-bottom: 20px;
  color: #003366;
}

.form-container form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 100%;
}

.form-container input,
.form-container select {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
  box-sizing: border-box;
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

@media (max-width: 500px) {
  .form-container {
    padding: 30px 20px;
    max-width: 95%;
  }

  .button-group button {
    flex: 1 1 100%;
  }
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
  user-select: none;
}

.toggle-password:hover {
  color: #003366;
}

</style>
  </head>
  <body>
    <header>
      <div class="container">
        <h1>KLE College of Engineering & Technology, Chikodi</h1>
        <nav class="navbar">
          <div class="nav-left">
            <a href="index.html">Home</a>
            <a href="about.html">About Us</a>
            <a href="contact.html">Contact Us</a>
          </div>
          <div class="nav-right">
            <a href="register.html" class="active">Register</a>
            <a href="login.html">Login</a>
          </div>
        </nav>
      </div>
    </header>

    <section class="register">
      <div class="form-container">
        <h2>Register</h2>
        
        <?php if ($message): ?>
        <p style="color:red;"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="post">

          <label for="mobile">Mobile Number</label>
          <input
            type="tel"
            id="mobile"
            name="mobile"
            placeholder="Enter your mobile number"
            required
          />

          <label for="name">Full Name</label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your name"
            required
          />

          <label for="branch">Select Branch</label>
          <select id="branch" name="branch" required>
            <option value="" disabled selected>Select your branch</option>
            <option>Computer Science</option>
            <option>Mechanical</option>
            <option>Civil</option>
            <option>Electronics</option>
            <option>MBA</option>
            <option>MCA</option>
          </select>

          <label for="password">Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter password"
              required
            />
            <span
              class="toggle-password"
              onclick="togglePassword('password', this)"
              >👁️</span
            >
          </div>

          <label for="confirmPassword">Confirm Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              id="confirmPassword"
              name="confirmPassword"
              placeholder="Confirm password"
              required
            />
            <span
              class="toggle-password"
              onclick="togglePassword('confirmPassword', this)"
              >👁️</span
            >
          </div>

          <label for="securityQuestion">Security Question</label>
          <select id="securityQuestion" name="securityQuestion" required>
            <option value="" disabled selected>
              Select a security question
            </option>
            <option>What is your mother's maiden name?</option>
            <option>What was your first school?</option>
            <option>What is your favorite teacher's name?</option>
            <option>What is your birth city?</option>
          </select>

          <label for="securityAnswer">Security Answer</label>
          <input
            type="text"
            id="securityAnswer"
            name="securityAnswer"
            placeholder="Enter your answer"
            required
          />

          <div class="button-group">
            <button type="submit" class="submit-btn">Submit</button>
            <button
              type="button"
              class="cancel-btn"
              onclick="window.location.href='index.html'"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </section>

    <footer>
      <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
    </footer>

    <script>
function togglePassword(fieldId, icon) {
  const input = document.getElementById(fieldId);
  if (input.type === "password") {
    input.type = "text";
    icon.textContent = '🙈';
  } else {
    input.type = "password";
    icon.textContent = '👁️';
  }
}
</script>

  </body>
</html>
