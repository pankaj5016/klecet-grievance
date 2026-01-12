<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Change Password - Student Dashboard</title>
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

    nav {
      background-color: #0055aa;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      padding: 14px 20px;
      display: block;
      transition: background-color 0.3s;
    }

    nav a:hover {
      background-color: #003366;
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
      margin-top: 0;
    }

    label {
      display: block;
      font-weight: bold;
      margin: 15px 0 5px;
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

    @media (max-width: 600px) {
      nav {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>KLECET Grievance Redressal Portal</h1>
  </header>

  <nav>
    <a href="#">Home</a>
    <a href="#">My Profile</a>
    <a href="#">Submit Grievance</a>
    <a href="#">View My Grievances</a>
    <a href="#">Change Password</a>
    <a href="#">Logout</a>
  </nav>

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
