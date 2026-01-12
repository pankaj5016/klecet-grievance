<?php
session_start();
require 'includes/db.php';

// 🔐 Restrict access to only logged-in students
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch student grievances
$stmt = $pdo->prepare("SELECT grievance_title, grievance_description, status, submitted_at 
                       FROM grievances 
                       WHERE student_id = ? 
                       ORDER BY submitted_at DESC");
$stmt->execute([$user_id]);
$grievances = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Grievances</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
        }
        table {
            margin: auto;
            width: 90%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>
    <h2>My Submitted Grievances</h2>

    <?php if (count($grievances) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grievances as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['grievance_title']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['grievance_description'])); ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                        <td><?php echo date('d-M-Y H:i', strtotime($row['submitted_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center;">You have not submitted any grievances yet.</p>
    <?php endif; ?>
</body>
</html>
