<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Department Grievance Coordinator Dashboard</title>
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
      max-width: 900px;
      margin: 30px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      text-align: center;
    }

    h2 {
      color: #003366;
    }

    p {
      color: #333;
      font-size: 1.1rem;
      line-height: 1.6;
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
    <h1>Department Grievance Coordinator Dashboard</h1>
  </header>

  <nav>
    <a href="#">Home</a>
    <a href="dgc-profile.html">My Profile</a>
    <a href="dgc-department-grivance.html">Department Grievances</a>
    <a href="dgc-chage-password.html">Change Password</a>
    <a href="login.html">Logout</a>
  </nav>

  <div class="container">
    <h2>Welcome, [Coordinator Name]</h2>
    <p>
      ✔️ You are logged in as the <strong>Department Grievance Coordinator</strong> for <strong>[Department Name]</strong>.<br><br>
      👉 View your profile (readonly, created by Principal).<br>
      👉 Check and manage grievances for your department only.<br>
      👉 Change your password.<br>
      👉 Logout securely.
    </p>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
