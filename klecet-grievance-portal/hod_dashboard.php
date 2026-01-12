<?php
session_start();
require 'includes/db.php';

// Only HOD can access
if (!isset($_SESSION['designation']) || $_SESSION['designation'] != 'HOD') {
    header("Location: index.php");
    exit;
}

$name = $_SESSION['name'] ?? 'Not Set';
$branch = $_SESSION['branch'] ?? 'Not Set';

// Fetch grievances for HOD's department
$stmt = $pdo->prepare("
    SELECT g.id, g.title, g.description, g.status, g.attachment, g.submitted_at, g.student_id,
           s.name AS student_name, s.usn
    FROM grievances g
    LEFT JOIN students s ON g.student_id = s.id
    WHERE g.branch = ?
    ORDER BY g.submitted_at DESC
");
$stmt->execute([$branch]);
$grievances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Summary counts
$total = $pending = $inProgress = $resolved = 0;
foreach ($grievances as $g) {
    $total++;
    switch (strtolower($g['status'])) {
        case 'pending': $pending++; break;
        case 'in-progress': $inProgress++; break;
        case 'resolved': $resolved++; break;
        default: $pending++; break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HOD Dashboard | KLECET Grievance Portal</title>
<style>
body { font-family: Arial,sans-serif; margin:0; background:#f5f5f5; }
.header { background:#003366; color:#fff; padding:15px 20px; text-align:center; }
.dashboard { display:flex; min-height:90vh; }
.sidebar { background:#f4f4f4; padding:20px; width:240px; flex-shrink:0; min-height:100vh; }
.sidebar ul { list-style:none; padding:0; }
.sidebar ul li { margin-bottom:15px; }
.sidebar ul li a { text-decoration:none; color:#003366; font-weight:bold; display:block; padding:10px; border-radius:6px; }
.sidebar ul li a:hover, .sidebar ul li a.active { background:#003366; color:#fff; }

.content { flex-grow:1; padding:30px; background:#fff; }

.summary { display:grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap:16px; margin-bottom:24px; }
.card { background:#fff; border-radius:12px; padding:20px; text-align:center; box-shadow:0 4px 12px rgba(0,0,0,0.05); }
.card:hover { transform: translateY(-5px); box-shadow:0 8px 24px rgba(0,0,0,0.1); transition:0.2s; }
.card h3 { font-size:14px; color:#6b7280; margin-bottom:8px; }
.card p { font-size:22px; font-weight:700; color:#111827; margin:0; }

table { width:100%; border-collapse:collapse; }
th, td { padding:10px; border:1px solid #ccc; text-align:left; font-size:14px; }
th { background:#f0f0f0; }
.status { padding:4px 8px; border-radius:4px; font-weight:bold; font-size:0.85rem; }
.status.pending { background:#ffcc00; color:#000; }
.status.in-progress { background:#17a2b8; color:#fff; }
.status.resolved { background:#28a745; color:#fff; }
.update-btn { padding:4px 8px; font-size:0.85rem; border:none; border-radius:4px; cursor:pointer; background:#ffc107; color:black; }
.update-btn:hover { background:#e0a800; }

@media(max-width:768px){ .dashboard { flex-direction:column; } .sidebar { width:100%; } .content { padding:20px; } }
</style>
</head>
<body>
<header class="header">
    <h1>KLECET Grievance Portal - HOD Dashboard</h1>
</header>

<div class="dashboard">
    <nav class="sidebar">
        <ul>
            <li><a href="#" class="active">🏠 Home</a></li>
            <li><a href="change-password.php">🔒 Change Password</a></li>
            <li><a href="logout.php">🚪 Logout</a></li>
        </ul>
    </nav>

    <main class="content">
        <h2>Welcome, <?= htmlspecialchars($name) ?>!</h2>

        <div class="summary">
            <div class="card"><h3>Total</h3><p><?= $total ?></p></div>
            <div class="card"><h3>Pending</h3><p><?= $pending ?></p></div>
            <div class="card"><h3>In Progress</h3><p><?= $inProgress ?></p></div>
            <div class="card"><h3>Resolved</h3><p><?= $resolved ?></p></div>
        </div>

        <h3>Department Grievances</h3>

        <?php if(empty($grievances)): ?>
            <p>No grievances submitted for your department.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USN</th>
                        <th>Student Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Attachment</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($grievances as $g): ?>
                    <tr>
                        <td><?= $g['id'] ?></td>
                        <td><?= htmlspecialchars($g['usn'] ?? 'Unknown') ?></td>
                        <td><?= htmlspecialchars($g['student_name'] ?? 'Unknown') ?></td>
                        <td><?= htmlspecialchars($g['title']) ?></td>
                        <td><?= htmlspecialchars($g['description']) ?></td>
                        <td>
                        <?php if(!empty($g['attachment'])): ?>
                            <a href="<?= htmlspecialchars($g['attachment']) ?>" target="_blank">View</a>
                        <?php else: ?>N/A<?php endif; ?>
                        </td>
                        <td><span class="status <?= strtolower($g['status']) ?>"><?= ucfirst($g['status']) ?></span></td>
                        <td><?= $g['submitted_at'] ?></td>
                        <td>
                            <form method="post" action="update-grievance.php">
                                <input type="hidden" name="grievance_id" value="<?= $g['id'] ?>">
                                <select name="status">
                                    <option value="pending" <?= $g['status']=='pending'?'selected':'' ?>>Pending</option>
                                    <option value="in-progress" <?= $g['status']=='in-progress'?'selected':'' ?>>In Progress</option>
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
