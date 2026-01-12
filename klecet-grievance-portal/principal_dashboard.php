<?php
session_start();
require 'includes/db.php'; // $pdo connection

// Ensure only the Principal can access
if (!isset($_SESSION['designation']) || $_SESSION['designation'] !== 'Principal') {
    header("Location: login.php");
    exit;
}

// Fetch principal name from session (or default)
$principalName = 'Prof. DarshanKumar';


// ✅ Fetch ONLY Escalated Grievances (from ALL departments)
$sql = "
    SELECT g.id, g.student_id, g.branch, g.title, g.description, 
           g.status, g.submitted_at, g.attachment, g.previous_status,
           s.name AS student_name, s.usn
    FROM grievances g
    LEFT JOIN students s ON g.student_id = s.id
    WHERE g.previous_status = 'escalated'
    ORDER BY g.escalated_at DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$grievances = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Fetch pending students for approval
$sqlStudents = "SELECT id, name, usn, mobile, branch, status FROM students WHERE status = 'pending'";
$stmtStudents = $pdo->prepare($sqlStudents);
$stmtStudents->execute();
$pendingStudents = $stmtStudents->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Principal Dashboard | KLECET Grievance Portal</title>
<style>
body { font-family: Arial, sans-serif; margin:0; background-color:#f9f9f9; }
.header { background-color:#003366; color:#fff; padding:15px 20px; text-align:center; }
.dashboard { display:flex; min-height:80vh; }
.sidebar { background:#f4f4f4; padding:20px; width:240px; flex-shrink:0; min-height:100vh; 
           box-shadow:2px 0 5px rgba(0,0,0,0.1);}
.sidebar-menu { list-style:none; padding:0; }
.sidebar-menu li { margin-bottom:15px; }
.sidebar-menu a { text-decoration:none; color:#003366; font-weight:bold; display:flex; 
                   align-items:center; padding:10px 14px; border-radius:6px; transition:0.3s; }
.sidebar-menu a:hover, .sidebar-menu a.active { background:#003366; color:#fff; }
.sidebar-menu a span { margin-left:10px; white-space:nowrap; }
.content { flex-grow:1; padding:30px; background:#fff; }
.content h2 { color:#003366; }
table { width:100%; border-collapse:collapse; margin-top:30px; }
table, th, td { border:1px solid #ccc; }
th, td { padding:10px; text-align:left; font-size:14px; }
th { background-color:#f0f0f0; }
.status { padding:4px 8px; border-radius:4px; font-weight:bold; font-size:0.9rem; }
.status.pending { background:#ffcc00; color:#000; }
.status.in-progress { background:#17a2b8; color:#fff; }
.status.resolved { background:#28a745; color:#fff; }
.update-btn { padding:4px 8px; font-size:0.85rem; border:none; border-radius:4px; cursor:pointer; 
              background:#ffc107; color:black; }
.update-btn:hover { background:#e0a800; }
@media(max-width:768px) { 
    .dashboard { flex-direction:column; } 
    .sidebar { width:100%; display:flex; overflow-x:auto; } 
    .sidebar ul { display:flex; gap:10px; } 
    .content { padding:20px; } 
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
      <li><a href="principal_dashboard.php" class="active">🏠 <span>Home</span></a></li>
      <li><a href="createemployee.php">👤 <span>Create Employees</span></a></li>
      <li><a href="view-employees.php">🗂️ <span>View Employees</span></a></li>
      <li><a href="view-students.php">🎓 <span>View Students</span></a></li>
      <li><a href="pendingapproval.php">🕑 <span>Pending Approvals</span></a></li>
      <li><a href="change-password.php">🔒 <span>Change Password</span></a></li>
      <li><a href="logout.php">🚪 <span>Logout</span></a></li>
    </ul>
  </nav>

  <main class="content">
    <h2>Welcome, <?= htmlspecialchars($principalName) ?>!</h2>
    <p>Select an option from the menu to manage the Grievance Redressal System.</p>

    <h3>📄 Escalated Grievances (Only)</h3>

    <?php if (empty($grievances)): ?>
      <p>No escalated grievances found.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>USN</th>
            <th>Student Name</th>
            <th>Branch</th>
            <th>Title</th>
            <th>Description</th>
            <th>Attachment</th>
            <th>Status</th>
            <th>Submitted At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($grievances as $g): ?>
          <tr>
            <td><?= $g['id'] ?></td>
            <td><?= htmlspecialchars($g['usn'] ?? 'Unknown') ?></td>
            <td><?= htmlspecialchars($g['student_name'] ?? 'Unknown') ?></td>
            <td><?= htmlspecialchars($g['branch'] ?? '') ?></td>
            <td><?= htmlspecialchars($g['title']) ?></td>
            <td><?= htmlspecialchars($g['description']) ?></td>

            <td>
              <?php 
              if (!empty($g['attachment'])) {
                  echo "<a href='" . htmlspecialchars($g['attachment']) . "' target='_blank'>View</a>";
              } else {
                  echo "N/A";
              }
              ?>
            </td>

            <td>
              <span class="status <?= strtolower($g['status']) ?>">
                <?= htmlspecialchars(ucwords($g['status'])) ?>
              </span>
            </td>

            <td><?= $g['submitted_at'] ?></td>

            <td>
              <form method="post" action="update-grievance.php">
                <input type="hidden" name="grievance_id" value="<?= $g['id'] ?>">
                <select name="status">
                  <option value="pending" <?= $g['status']=='pending'?'selected':'' ?>>Pending</option>
                  <option value="in-progress" <?= $g['status']=='in-progress'?'selected':'' ?>>In-progress</option>
                  <option value="resolved" <?= $g['status']=='resolved'?'selected':'' ?>>Resolved</option>
                </select>
                <button type="submit" class="update-btn">Update</button>
              </form>
            </td>

          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </main>
</div>

<footer style="text-align:center; padding:15px; background:#003366; color:#fff;">
  <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
</footer>
</body>
</html>
