<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HOD Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      background-color: #003366;
      color: #fff;
      width: 240px;
      padding: 20px;
      box-sizing: border-box;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.4rem;
    }

    .sidebar-menu {
      list-style-type: none;
      padding: 0;
    }

    .sidebar-menu li {
      margin-bottom: 15px;
    }

    .sidebar-menu a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 10px 14px;
      border-radius: 6px;
      transition: background-color 0.3s;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
      background-color: #0055aa;
    }

    .sidebar-menu a span {
      margin-left: 10px;
    }

    .content {
      flex: 1;
      padding: 20px;
      background-color: #f7f7f7;
    }

    .profile-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      max-width: 500px;
    }

    .profile-card h3 {
      margin-top: 0;
      margin-bottom: 10px;
      color: #003366;
    }

    .profile-item {
      margin-bottom: 8px;
    }

    .section {
      margin-top: 30px;
    }

    .section h3 {
      color: #003366;
    }

    .section p {
      margin: 10px 0;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #003366;
      color: #fff;
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        text-align: center;
      }
      .sidebar-menu {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
      }
      .sidebar-menu li {
        margin: 5px 10px;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar Navigation -->
  <nav class="sidebar">
    <h2>HOD Dashboard</h2>
    <ul class="sidebar-menu">
      <li><a href="#profile">👤 <span>Profile</span></a></li>
      <li><a href="view-dept-employee.html">👥 <span>Department Employees</span></a></li>
      <li><a href="view-dept-student.html">🎓 <span>Department Students</span></a></li>
      <li><a href="view-dept-grivance.html">📑 <span>Department Grievances</span></a></li>
      <li><a href="hod-chage-password.html">🔒 <span>Change Password</span></a></li>
      <li><a href="login.html">🚪 <span>Logout</span></a></li>
    </ul>
  </nav>

  <!-- Main Content -->
  <div class="content">

    <!-- Profile Section -->
    <section id="profile" class="profile-card">
      <h3>My Profile</h3>
      <div class="profile-item"><strong>Name:</strong> Dr. Priya Sharma</div>
      <div class="profile-item"><strong>Mobile:</strong> 9876543210</div>
      <div class="profile-item"><strong>Department:</strong> Computer Science</div>
      <div class="profile-item"><strong>Role:</strong> HOD</div>
    </section>

   

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>
</body>
</html>
