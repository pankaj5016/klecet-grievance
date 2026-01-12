<?php
include 'includes/db.php';

$message = ""; // Initialize message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usn = trim($_POST['usn']);
    $name = trim($_POST['name']);
    $mobile = trim($_POST['mobile']);
    $branch = trim($_POST['branch']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $securityQuestion = trim($_POST['securityQuestion']);
    $securityAnswer = trim($_POST['securityAnswer']);
    $status = 'pending';

    if ($password !== $confirmPassword) {
        $message = "❌ Password and Confirm Password do not match.";
    } else {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO students 
                (usn, name, mobile, branch, password, security_question, security_answer, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$usn, $name, $mobile, $branch, $hashedPassword, $securityQuestion, $securityAnswer, $status]);

            $message = "✅ Registration successful. Awaiting Principal approval.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = "⚠️ This USN or mobile number is already registered.";
            } else {
                $message = "❌ Error: " . $e->getMessage();
            }
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
<style>
/* --- Reset & Layout --- */
* { box-sizing: border-box; margin: 0; padding: 0; }
body, html { height: 100%; font-family: Arial, sans-serif; display: flex; flex-direction: column; }

/* --- Header --- */
header {
    background-color: #003366;
    color: #fff;
    padding: 15px 20px;
    text-align: center;
}
header h1 {
    font-size: 1.6rem;
    margin-bottom: 10px;
}
.navbar {
    display: flex;
    justify-content: center; /* center the link */
}
.navbar a {
    color: #fff;
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 4px;
    transition: background 0.3s;
}
.navbar a:hover,
.navbar a.active { background-color: #002244; }

/* --- Main Section --- */
.register {
    flex: 1 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #f4f4f4;
}

.form-container {
    background-color: #fff;
    padding: 20px 15px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    max-width: 350px;
    width: 100%;
    text-align: center;
}

.form-container h2 {
    margin-bottom: 15px;
    color: #003366;
    font-size: 1.5rem;
}

.form-container form { display: flex; flex-direction: column; gap: 8px; }

.form-container input,
.form-container select {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 0.95rem;
}

.button-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.button-group button {
    flex: 1 1 45%;
    padding: 8px 10px;
    border-radius: 5px;
    border: none;
    font-size: 0.95rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.submit-btn { background-color: #003366; color: #fff; }
.submit-btn:hover { background-color: #002244; }
.cancel-btn { background-color: #ccc; color: #333; }
.cancel-btn:hover { background-color: #999; }

.password-wrapper { position: relative; }
.password-wrapper input { width: 100%; padding-right: 35px; }
.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.1rem;
    color: #666;
    user-select: none;
}
.toggle-password:hover { color: #003366; }

/* --- Footer Sticky --- */
footer { flex-shrink: 0; text-align: center; padding: 12px 0; background-color: #003366; color: #fff; font-size: 0.9rem; }

/* --- Responsive --- */
@media (max-width: 500px) {
    .form-container { padding: 15px 10px; max-width: 95%; }
    .button-group button { flex: 1 1 100%; }
    header h1 { font-size: 1.3rem; }
}
</style>
</head>
<body>
<header>
  <h1>KLECET Grievance Portal</h1>
  <nav class="navbar">
    <a href="index.php" class="active">Home</a>
  </nav>
</header>

<section class="register">
  <div class="form-container">
    <h2>Register</h2>
    <?php if ($message): ?>
      <p style="color:red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post">
      <label for="usn">USN</label>
      <input type="text" id="usn" name="usn" placeholder="Enter your USN" required />

      <label for="mobile">Mobile Number</label>
      <input type="tel" id="mobile" name="mobile" placeholder="Enter your mobile number" required />

      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required />

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
        <input type="password" id="password" name="password" placeholder="Enter password" required />
        <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span>
      </div>

      <label for="confirmPassword">Confirm Password</label>
      <div class="password-wrapper">
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required />
        <span class="toggle-password" onclick="togglePassword('confirmPassword', this)">👁️</span>
      </div>

      <label for="securityQuestion">Security Question</label>
      <select id="securityQuestion" name="securityQuestion" required>
        <option value="" disabled selected>Select a security question</option>
        <option>What is your mother's maiden name?</option>
        <option>What was your first school?</option>
        <option>What is your favorite teacher's name?</option>
        <option>What is your birth city?</option>
      </select>

      <label for="securityAnswer">Security Answer</label>
      <input type="text" id="securityAnswer" name="securityAnswer" placeholder="Enter your answer" required />

      <div class="button-group">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="button" class="cancel-btn" onclick="window.location.href='index.html'">Cancel</button>
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
