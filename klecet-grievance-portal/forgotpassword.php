<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password | KLECET Grievance Portal</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .forgot-password-section {
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

.error-message {
  color: red;
  font-size: 0.9rem;
  text-align: left;
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
          <a href="register.html">Register</a>
          <a href="login.html">Login</a>
        </div>
      </nav>
    </div>
  </header>

  <section class="forgot-password-section">
    <div class="form-container">
      <h2>Forgot Password</h2>
      <form id="forgotPasswordForm" action="#" method="post">
        
        <label for="mobile">Mobile Number</label>
        <input type="tel" id="mobile" name="mobile" placeholder="Enter your mobile number" required>

        <label for="securityQuestion">Security Question</label>
        <select id="securityQuestion" name="securityQuestion" required>
          <option value="" disabled selected>Select your security question</option>
          <option>What is your mother's maiden name?</option>
          <option>What was your first school?</option>
          <option>What is your favorite teacher's name?</option>
          <option>What is your birth city?</option>
        </select>

        <label for="securityAnswer">Security Answer</label>
        <input type="text" id="securityAnswer" name="securityAnswer" placeholder="Enter your answer" required>

        <label for="newPassword">New Password</label>
        <div class="password-wrapper">
          <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" required>
          <span class="toggle-password" onclick="togglePassword('newPassword', this)">👁️</span>
        </div>

        <label for="confirmNewPassword">Confirm New Password</label>
        <div class="password-wrapper">
          <input type="password" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm new password" required>
          <span class="toggle-password" onclick="togglePassword('confirmNewPassword', this)">👁️</span>
        </div>

        <div id="errorMessage" class="error-message"></div>

        <div class="button-group">
          <button type="submit" class="submit-btn">Submit</button>
          <button type="button" class="cancel-btn" onclick="window.location.href='login.html'">Cancel</button>
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

    // Placeholder for validation logic
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const answer = document.getElementById('securityAnswer').value.trim();
      const newPassword = document.getElementById('newPassword').value;
      const confirmNewPassword = document.getElementById('confirmNewPassword').value;
      const errorMessage = document.getElementById('errorMessage');

      // Simulated security answer check (replace with server call)
      const correctAnswer = "test";  // Placeholder correct answer

      if (answer.toLowerCase() !== correctAnswer.toLowerCase()) {
        errorMessage.textContent = "Incorrect security answer. Please try again.";
        return;
      }

      if (newPassword !== confirmNewPassword) {
        errorMessage.textContent = "Passwords do not match.";
        return;
      }

      errorMessage.textContent = "";
      alert("Password reset successful! Redirecting to login.");
      window.location.href = "login.html";
    });
  </script>
</body>
</html>
