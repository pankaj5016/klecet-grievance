<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Change Password - HOD Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f7f7f7;
    }

    header {
      background-color: #003366;
      color: #fff;
      padding: 15px;
      text-align: center;
    }

    .container {
      max-width: 400px;
      margin: 30px auto;
      background-color: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #003366;
      margin-top: 0;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #003366;
    }

    .password-field {
      position: relative;
      margin-bottom: 15px;
    }

    .password-field input {
      width: 100%;
      padding: 10px 40px 10px 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .toggle-visibility {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 1.2rem;
      color: #777;
    }

    button {
      padding: 10px 20px;
      background-color: #003366;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0055aa;
    }

    .btn-cancel {
      background-color: #aaa;
    }

    .btn-cancel:hover {
      background-color: #888;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #003366;
      color: #fff;
      font-size: 0.9rem;
    }

  </style>
</head>
<body>

  <header>
    <h1>HOD Dashboard</h1>
  </header>

  <div class="container">
    <h2>Change Password</h2>
    <form>
      <label for="current-password">Current Password</label>
      <div class="password-field">
        <input type="password" id="current-password" required>
        <span class="toggle-visibility" onclick="togglePassword('current-password', this)">👁️</span>
      </div>

      <label for="new-password">New Password</label>
      <div class="password-field">
        <input type="password" id="new-password" required>
        <span class="toggle-visibility" onclick="togglePassword('new-password', this)">👁️</span>
      </div>

      <label for="confirm-password">Confirm New Password</label>
      <div class="password-field">
        <input type="password" id="confirm-password" required>
        <span class="toggle-visibility" onclick="togglePassword('confirm-password', this)">👁️</span>
      </div>

      <button type="submit">Submit</button>
      <button type="reset" class="btn-cancel">Cancel</button>
    </form>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
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
