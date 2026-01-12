<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CGC Home - Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
    }

    header {
      background-color: #003366;
      color: #fff;
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
      max-width: 1000px;
      margin: 20px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      text-align: center;
    }

    h2 {
      color: #003366;
    }

    p {
      font-size: 1.1rem;
      color: #333;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #003366;
      color: #fff;
      font-size: 0.9rem;
      margin-top: 20px;
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
    <h1>Central Grievance Coordinator Dashboard</h1>
  </header>

  <nav>
    <a href="#">Home</a>
    <a href="cgc-profile.html">My Profile</a>
    <a href="cgc-all-grievances.html">All Department Grievances</a>
    <a href="cgc-change-password.html">Change Password</a>
    <a href="login.html">Logout</a>
  </nav>

  <div class="container">
    <h2>Welcome, [Coordinator Name]!</h2>
    <p>
      This is your dashboard. You can:<br>
      ✔️ View your profile (created by Principal)<br>
      ✔️ See all grievances from all departments<br>
      ✔️ Change your password<br>
      ✔️ Logout securely
    </p>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
