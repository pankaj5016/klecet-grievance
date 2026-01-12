<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Change Password - CGC</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
    }

    header {
      background-color: #003366;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .container {
      max-width: 450px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #003366;
      text-align: center;
      margin-bottom: 25px;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
      color: #003366;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    input[type="password"],
    input[type="text"] {
      width: 100%;
      padding: 12px 40px 12px 12px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .toggle-icon {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
      color: #777;
    }

    .buttons {
      text-align: center;
      margin-top: 20px;
    }

    button {
      padding: 10px 18px;
      margin: 0 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .submit-btn {
      background-color: #003366;
      color: white;
    }

    .cancel-btn {
      background-color: #aaa;
      color: white;
    }

    .submit-btn:hover {
      background-color: #0055aa;
    }

    .cancel-btn:hover {
      background-color: #888;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #003366;
      color: white;
      font-size: 0.9rem;
      margin-top: 30px;
    }
  </style>
</head>
<body>

  <header>
    <h1>Central Grievance Coordinator Dashboard</h1>
  </header>

  <div class="container">
    <h2>Change Password</h2>
    <form>
      <label for="current">Current Password</label>
      <div class="input-group">
        <input type="password" id="current" required>
        <span class="toggle-icon" onclick="togglePassword('current', this)">👁️</span>
      </div>

      <label for="newpass">New Password</label>
      <div class="input-group">
        <input type="password" id="newpass" required>
        <span class="toggle-icon" onclick="togglePassword('newpass', this)">👁️</span>
      </div>

      <label for="confirmpass">Confirm New Password</label>
      <div class="input-group">
        <input type="password" id="confirmpass" required>
        <span class="toggle-icon" onclick="togglePassword('confirmpass', this)">👁️</span>
      </div>

      <div class="buttons">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="cancel-btn">Cancel</button>
      </div>
    </form>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

  <script>
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      if (input.type === 'password') {
        input.type = 'text';
        el.textContent = '🙈';
      } else {
        input.type = 'password';
        el.textContent = '👁️';
      }
    }
  </script>

</body>
</html>
