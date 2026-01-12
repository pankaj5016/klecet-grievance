<?php
session_start();
include 'includes/db.php'; // Ensure this defines $pdo

if (!isset($_SESSION['user_id']) || $_SESSION['designation'] !== 'Principal') {
    header("Location: login.php");
    exit;
}

try {
    $stmt = $pdo->query("SELECT id, name, mobile, designation, branch FROM employees ORDER BY id DESC");
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("❌ Query error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Employees | Principal Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .table-container {
      max-width: 900px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
    }
    th {
      background-color: #003366;
      color: #fff;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    h2 {
      text-align: center;
      color: #003366;
    }
  </style>
</head>
<body>
  <header class="header">
    <h1>KLECET Grievance Portal - Principal Dashboard</h1>
  </header>

  <div class="dashboard">
    <main class="content">
      <div class="table-container">
        <h2>All Employees</h2>
        <?php if ($employees): ?>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Designation</th>
                <th>Branch</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($employees as $row): ?>
                <tr>
                  <td><?= htmlspecialchars($row['id']) ?></td>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= htmlspecialchars($row['mobile']) ?></td>
                  <td><?= htmlspecialchars($row['designation'] ?? '') ?></td>
                  <td><?= htmlspecialchars($row['branch'] ?? '') ?></td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>No employees found.</p>
        <?php endif; ?>
      </div>
    </main>
  </div>

  <footer>
    <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
  </footer>
</body>
</html>
