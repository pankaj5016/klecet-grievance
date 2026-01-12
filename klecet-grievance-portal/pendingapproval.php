<?php
session_start();
include 'includes/db.php';

// Only Principal can access
if (!isset($_SESSION['designation']) || $_SESSION['designation'] !== 'Principal') {
    header("Location: login.php");
    exit();
}

// Approve student
if (isset($_GET['approve_id'])) {
    $id = $_GET['approve_id'];
    $stmt = $pdo->prepare("UPDATE students SET status = 'approved' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: pendingapproval.php");
    exit();
}

// Reject student
if (isset($_GET['reject_id'])) {
    $id = $_GET['reject_id'];
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: pendingapproval.php");
    exit();
}

// Fetch pending students
$stmt = $pdo->prepare("SELECT * FROM students WHERE status = 'pending'");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pending Approvals | Principal Dashboard</title>
  <link rel="stylesheet" href="style.css" />

  <style>
    /* Sticky Footer */
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      background: #f7f7f7;
    }
    footer {
      background: #003366;
      color: #fff;
      margin-top: auto;
      padding: 12px 0;
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
    }
    .home-btn:hover {
      background: #002244;
    }

    /* Heading */
    h2 {
      text-align: center;
      margin-top: 10px;
    }

    /* Table Styling */
    .table-container {
      overflow-x: auto;
      margin-top: 20px;
      background: #fff;
      padding: 25px;
      width: 90%;
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }
    table thead {
      background-color: #003366;
      color: #fff;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 12px;
    }
    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    /* Buttons */
    .approve-btn,
    .reject-btn {
      padding: 6px 12px;
      font-size: 0.85rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }
    .approve-btn {
      background-color: #28a745;
      color: #fff;
    }
    .approve-btn:hover {
      background-color: #218838;
    }
    .reject-btn {
      background-color: #dc3545;
      color: #fff;
    }
    .reject-btn:hover {
      background-color: #b21f2d;
    }

    /* Header */
    header {
      background: #003366;
      color: white;
      padding: 15px;
      text-align: center;
    }

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

    <h2>Pending Student Approvals</h2>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Department</th>
            <th>Mobile Number</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($students as $student): ?>
            <tr>
              <td><?= htmlspecialchars($student['name']) ?></td>
              <td><?= htmlspecialchars($student['branch']) ?></td>
              <td><?= htmlspecialchars($student['mobile']) ?></td>
              <td>
                <a href="?approve_id=<?= $student['id'] ?>" class="approve-btn">Approve</a>
                <a href="?reject_id=<?= $student['id'] ?>" class="reject-btn">Reject</a>
              </td>
            </tr>
          <?php endforeach; ?>

          <?php if (empty($students)): ?>
            <tr>
              <td colspan="4" style="text-align:center;">No pending approvals.</td>
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
