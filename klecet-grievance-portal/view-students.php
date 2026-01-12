<?php
session_start();
require 'includes/db.php';

// Allow only Principal
if (!isset($_SESSION['user_id']) || $_SESSION['designation'] !== 'Principal') {
    header("Location: login.php");
    exit;
}

// Fetch ONLY approved students
try {
    $stmt = $pdo->prepare("SELECT name, branch, mobile, status FROM students WHERE status = 'approved' ORDER BY id DESC");
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View Approved Students | Principal Dashboard</title>
  <link rel="stylesheet" href="style.css" />

  <style>

    /* Sticky footer */
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      background: #f7f7f7;
    }
    footer {
      margin-top: auto;
      background: #003366;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }

    /* Home Button */
    .home-btn {
      font-size: 16px;
      background: #003366;
      color: white;
      padding: 6px 14px;
      border-radius: 6px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-left: 15px;
    }
    .home-btn:hover {
      background: #002244;
    }

    /* Table Styles */
    .status {
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: bold;
      font-size: 0.9rem;
    }
    .status.approved { background-color: #28a745; color: #fff; }

    .table-container {
      max-width: 900px;
      margin: 30px auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ccc;
    }

    th {
      background-color: #003366;
      color: white;
      text-align: left;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    /* Center Heading */
    h2 {
      text-align: center;
      margin-top: 10px;
    }

    /* Header */
    header {
      background: #003366;
      color: white;
      padding: 15px;
      text-align: center;
    }

    /* Layout */
    .dashboard {
      padding: 20px;
    }

  </style>
</head>

<body>

  <header>
    <h1>KLECET Grievance Portal - Principal Dashboard</h1>
  </header>

  <div class="dashboard">
    <a href="principal_dashboard.php" class="home-btn">🏠 Home</a>

    <h2>Approved Students</h2>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Branch</th>
            <th>Mobile</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($students): ?>
            <?php foreach ($students as $s): ?>
              <tr>
                <td><?= htmlspecialchars($s['name']) ?></td>
                <td><?= htmlspecialchars($s['branch']) ?></td>
                <td><?= htmlspecialchars($s['mobile']) ?></td>
                <td><span class="status approved">Approved</span></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" style="text-align:center;">No approved students available.</td>
            </tr>
          <?php endif; ?>
        </tbody>

      </table>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
  </footer>

</body>
</html>
