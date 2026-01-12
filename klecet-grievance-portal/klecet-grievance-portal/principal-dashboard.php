<?php
session_start();

// ✅ If not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// ✅ Check role
if ($_SESSION['designation'] !== 'Principal') {
  header("Location: unauthorized.php");
  exit();
}

// ✅ Get name for greeting
$principalName = htmlspecialchars($_SESSION['name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Principal Dashboard | KLECET Grievance Portal</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Header */
    .header {
      background-color: #003366;
      color: #fff;
      padding: 15px 20px;
      text-align: center;
    }

    /* Dashboard layout */
    .dashboard {
      display: flex;
      min-height: 80vh;
    }

    /* Sidebar */
    .sidebar {
      background-color: #f4f4f4;
      padding: 20px;
      width: 240px;
      flex-shrink: 0;
      min-height: 100vh;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .sidebar-menu {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-menu li {
      margin-bottom: 15px;
    }

    .sidebar-menu a {
      text-decoration: none;
      color: #003366;
      font-weight: bold;
      display: flex;
      align-items: center;
      padding: 10px 14px;
      border-radius: 6px;
      transition: background-color 0.3s, color 0.3s;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
      background-color: #003366;
      color: #fff;
    }

    .sidebar-menu a span {
      margin-left: 10px;
      white-space: nowrap;
    }

    /* Main content */
    .content {
      flex-grow: 1;
      padding: 30px;
      background-color: #fff;
    }

    .content h2 {
      color: #003366;
    }

    .content p {
      font-size: 1rem;
      color: #333;
    }

    /* Responsive layout */
    @media (max-width: 768px) {
      .dashboard {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        display: flex;
        overflow-x: auto;
      }

      .sidebar ul {
        display: flex;
        gap: 10px;
      }

      .content {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <header class="header">
    <h1>KLECET Grievance Portal - Principal Dashboard</h1>
  </header>

  <div class="dashboard">
    <nav class="sidebar">
      <ul class="sidebar-menu">
        <li><a href="principal-dashboard.php" class="active">🏠 <span>Home</span></a></li>
        <li><a href="createemployee.php">👤 <span>Create Employee</span></a></li>
        <li><a href="view-employees.php">🗂️ <span>View Employees</span></a></li>
        <li><a href="pending.php">🕑 <span>Pending Approvals</span></a></li>
        <li><a href="all-grievances.php">📑 <span>All Dept Grievances</span></a></li>
        <li><a href="change-password.php">🔒 <span>Change Password</span></a></li>
        <li><a href="logout.php">🚪 <span>Logout</span></a></li>
      </ul>
    </nav>

    <main class="content">
      <h2>Welcome, <?php echo $Darshan Kumar; ?>!</h2>
      <p>Select an option from the menu to manage the Grievance Redressal System.</p>
      <p>💡 Tip: To approve new student registrations, click <strong>Pending Approvals</strong> in the menu.</p>
    </main>
  </div>

  <footer>
    <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
  </footer>
</body>
</html>
