<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Dashboard - KLECET Grievance Portal</title>
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
      margin-top: 0;
    }

    .profile-card {
      max-width: 400px;
      margin: 20px auto;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }

    .profile-card img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #003366;
      margin-bottom: 15px;
    }

    .profile-card p {
      margin: 8px 0;
      font-size: 1rem;
      color: #333;
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
    <a href="">My Profile</a>
    <a href="student-sumbit-grivance.html">Submit Grievance</a>
    <a href="student-view-grivance.html">View My Grievances</a>
    <a href="student-chage-password.html">Change Password</a>
    <a href="login.html">Logout</a>
  </nav>

  <div class="container">
    <h2>Welcome, [Student Name]</h2>
    <p>You are logged in as a student. Here you can submit grievances, track their status, and manage your account.</p>

    <div class="profile-card">
      <img src="img/student-photo.jpg" alt="Student Photo">
      <p><strong>Name:</strong> [Student Name]</p>
      <p><strong>Mobile:</strong> [Mobile Number]</p>
      <p><strong>Branch:</strong> [Branch Name]</p>
      <p><strong>Role:</strong> Student</p>
    </div>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
