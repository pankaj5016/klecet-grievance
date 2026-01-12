<?php
session_start();
require 'includes/db.php';

// ✅ Allow only Principal
if (!isset($_SESSION['user_id']) || $_SESSION['designation'] !== 'Principal') {
    header("Location: login.php");
    exit;
}

// ✅ Fetch all grievances with student info
$sql = "
    SELECT g.id, g.student_id, g.branch, g.title, g.description, g.status, g.submitted_at, s.name AS student_name, s.usn
    FROM grievances g
    LEFT JOIN students s ON g.student_id = s.id
    ORDER BY g.submitted_at DESC
";
$stmt = $pdo->query($sql);
$grievances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ✅ Handle success message
$msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>All Grievances | Principal Dashboard</title>
<style>
table { width:100%; border-collapse:collapse; margin-top:20px; }
th, td { border:1px solid #ccc; padding:10px; text-align:left; }
th { background:#f0f0f0; }
button { padding:5px 10px; margin:2px; cursor:pointer; }
</style>
</head>
<body>

<h2>All Department Grievances</h2>
<?php if($msg) echo "<p style='color:green;'>$msg</p>"; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>USN</th>
            <th>Branch</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Update Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($grievances as $g): ?>
        <tr>
            <td><?= $g['id'] ?></td>
            <td><?= htmlspecialchars($g['student_name'] ?? 'Unknown') ?></td>
            <td><?= htmlspecialchars($g['usn'] ?? '-') ?></td>
            <td><?= htmlspecialchars($g['branch']) ?></td>
            <td><?= htmlspecialchars($g['title']) ?></td>
            <td><?= htmlspecialchars($g['description']) ?></td>
            <td><?= htmlspecialchars($g['status']) ?></td>
            <td>
                <form method="POST" action="update-grievance.php">
                    <input type="hidden" name="grievance_id" value="<?= $g['id'] ?>">
                    <button type="submit" name="status" value="Pending">Pending</button>
                    <button type="submit" name="status" value="In Progress">In Progress</button>
                    <button type="submit" name="status" value="Resolved">Resolved</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
