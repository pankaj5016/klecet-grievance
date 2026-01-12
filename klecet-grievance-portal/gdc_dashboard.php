<?php
session_start();
require_once 'includes/db.php'; // $pdo PDO connection

// Only GDC access
if (!isset($_SESSION['user_id']) || strtoupper($_SESSION['designation']) !== 'GDC') {
    header("Location: login.php");
    exit;
}

$branch = $_SESSION['branch'] ?? 'Not Set';
$coordinatorName = $_SESSION['name'] ?? 'Coordinator';
$coordinator_id = (int)$_SESSION['user_id'];

// Handle status updates
if (isset($_POST['update_status'], $_POST['grievance_id'], $_POST['new_status'], $_POST['action_reason'])) {
    $grievance_id = (int)$_POST['grievance_id'];
    $new_status = trim($_POST['new_status']);
    $reason = trim($_POST['action_reason']);

    try {
        $pdo->beginTransaction();

        if ($new_status === 'forwarded') {
            // Forward to GCC
            $stmtGCC = $pdo->prepare("SELECT id FROM employees WHERE designation = 'GCC' LIMIT 1");
            $stmtGCC->execute();
            $gcc = $stmtGCC->fetch(PDO::FETCH_ASSOC);
            $assigned_to = $gcc['id'] ?? null;

            $stmt = $pdo->prepare("
                UPDATE grievances
                SET status='pending', assigned_to=:assigned_to, previous_status='forwarded',
                    action_reason=:reason, forwarded_at=NOW()
                WHERE id=:id AND branch=:branch
            ");
            $stmt->execute([
                ':assigned_to'=>$assigned_to,
                ':reason'=>$reason,
                ':id'=>$grievance_id,
                ':branch'=>$branch
            ]);

            $stmtNotif = $pdo->prepare("
                INSERT INTO notifications (student_id, grievance_id, message)
                SELECT student_id, id, CONCAT('Your grievance has been forwarded to GCC. Reason: ', :reason)
                FROM grievances WHERE id=:id
            ");
            $stmtNotif->execute([':reason'=>$reason, ':id'=>$grievance_id]);

        } elseif ($new_status === 'escalated') {
            // Escalate to HOD or fallback Principal
            $stmtHOD = $pdo->prepare("SELECT id FROM employees WHERE designation='HOD' AND branch=:branch LIMIT 1");
            $stmtHOD->execute([':branch'=>$branch]);
            $hod = $stmtHOD->fetch(PDO::FETCH_ASSOC);

            if ($hod && !empty($hod['id'])) {
                $assigned_to = $hod['id'];
            } else {
                $stmtPrincipal = $pdo->prepare("SELECT id FROM employees WHERE designation='Principal' LIMIT 1");
                $stmtPrincipal->execute();
                $principal = $stmtPrincipal->fetch(PDO::FETCH_ASSOC);
                $assigned_to = $principal['id'] ?? null;
            }

            $stmt = $pdo->prepare("
                UPDATE grievances
                SET status='pending', assigned_to=:assigned_to, previous_status='escalated',
                    action_reason=:reason, escalated_at=NOW()
                WHERE id=:id AND branch=:branch
            ");
            $stmt->execute([
                ':assigned_to'=>$assigned_to,
                ':reason'=>$reason,
                ':id'=>$grievance_id,
                ':branch'=>$branch
            ]);

            $stmtNotif = $pdo->prepare("
                INSERT INTO notifications (student_id, grievance_id, message)
                SELECT student_id, id, CONCAT('Your grievance has been escalated. Reason: ', :reason)
                FROM grievances WHERE id=:id
            ");
            $stmtNotif->execute([':reason'=>$reason, ':id'=>$grievance_id]);

        } else {
            // Normal status update
            $stmt = $pdo->prepare("
                UPDATE grievances
                SET status=:status, assigned_to=:assigned_to, action_reason=:reason
                WHERE id=:id AND branch=:branch
            ");
            $stmt->execute([
                ':status'=>$new_status,
                ':assigned_to'=>$coordinator_id,
                ':reason'=>$reason,
                ':id'=>$grievance_id,
                ':branch'=>$branch
            ]);

            $stmtNotif = $pdo->prepare("
                INSERT INTO notifications (student_id, grievance_id, message)
                SELECT student_id, id, CONCAT('Your grievance status has been updated to ', :status)
                FROM grievances WHERE id=:id
            ");
            $stmtNotif->execute([':status'=>$new_status, ':id'=>$grievance_id]);
        }

        $pdo->commit();
    } catch (PDOException $ex) {
        $pdo->rollBack();
        error_log("GDC status update error: ".$ex->getMessage());
        $_SESSION['gdc_error'] = "Unable to update grievance. Please try again.";
    }

    header("Location: gdc_dashboard.php");
    exit;
}

// Fetch dashboard stats
$pendingCount = $inProgressCount = $resolvedCount = $forwardedCount = $escalatedCount = $totalGrievances = 0;
$grievances = [];

try {
    $stmt = $pdo->prepare("SELECT status, COUNT(*) as count FROM grievances WHERE branch=:branch GROUP BY status");
    $stmt->execute([':branch'=>$branch]);
    $statusCounts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $pendingCount = $statusCounts['pending'] ?? 0;
    $inProgressCount = $statusCounts['in progress'] ?? 0;
    $resolvedCount = $statusCounts['resolved'] ?? 0;
    $forwardedCount = $statusCounts['forwarded'] ?? 0;
    $escalatedCount = $statusCounts['escalated'] ?? 0;
    $totalGrievances = $pendingCount + $inProgressCount + $resolvedCount + $forwardedCount + $escalatedCount;

    // Fetch grievances for this GDC
    $stmt = $pdo->prepare("
        SELECT g.*, s.name AS student_name
        FROM grievances g
        JOIN students s ON g.student_id = s.id
        WHERE g.branch=:branch
          AND (g.assigned_to=:assigned_to OR g.assigned_to IS NULL)
        ORDER BY g.submitted_at DESC
    ");
    $stmt->execute([':branch'=>$branch, ':assigned_to'=>$coordinator_id]);
    $grievances = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("GDC fetch error: ".$e->getMessage());
    $error = "Database error: ".$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>GDC Dashboard | KLECET</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
body { background:#f4f7f8; color:#333; }
header { background:#0d6efd; color:#fff; padding:20px; text-align:center; }
header h1 { margin-bottom:5px; }
header p { font-size:14px; }
nav { background:#fff; display:flex; justify-content:center; gap:10px; padding:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
nav a { text-decoration:none; color:#333; padding:10px 15px; border-radius:5px; transition:0.3s; display:flex; align-items:center; gap:5px; }
nav a.active, nav a:hover { background:#0d6efd; color:#fff; }
.container { max-width:1200px; margin:20px auto; padding:0 15px; }
.dashboard-cards { display:grid; grid-template-columns: repeat(auto-fit,minmax(150px,1fr)); gap:15px; margin-bottom:20px; }
.card { background:#fff; padding:15px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.1); text-align:center; }
.card-icon { font-size:24px; margin-bottom:10px; color:#0d6efd; }
.card-value { font-size:22px; font-weight:bold; }
.card-text { font-size:14px; color:#666; }
.grievance-section { background:#fff; padding:20px; border-radius:10px; margin-bottom:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
table { width:100%; border-collapse:collapse; margin-top:15px; }
table th, table td { border:1px solid #ddd; padding:8px; text-align:left; }
table th { background:#0d6efd; color:#fff; }
.status { padding:3px 8px; border-radius:5px; color:#fff; font-size:12px; display:inline-block; }
.status-pending { background:#ffc107; }
.status-in-progress { background:#0d6efd; }
.status-resolved { background:#198754; }
.status-forwarded { background:#6c757d; }
.status-escalated { background:#dc3545; }
.form-vertical { display:flex; gap:6px; flex-direction:column; }
.input-small { padding:6px 8px; font-size:13px; }
.button-small { padding:6px 8px; font-size:13px; cursor:pointer; border-radius:4px; border:0; background:#0d6efd; color:#fff; }
</style>
</head>
<body>

<header>
    <h1>KLECET GDC Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($coordinatorName); ?> | Department: <?php echo htmlspecialchars($branch); ?></p>
</header>

<nav>
    <a href="#home" class="active"><i class="fas fa-home"></i> Home</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>

<div class="container">
    <div class="dashboard-cards">
        <div class="card"><div class="card-icon"><i class="fas fa-clipboard-list"></i></div><div class="card-value"><?php echo $totalGrievances; ?></div><div class="card-text">Total Grievances</div></div>
        <div class="card"><div class="card-icon"><i class="fas fa-clock"></i></div><div class="card-value"><?php echo $pendingCount; ?></div><div class="card-text">Pending</div></div>
        <div class="card"><div class="card-icon"><i class="fas fa-tasks"></i></div><div class="card-value"><?php echo $inProgressCount; ?></div><div class="card-text">In Progress</div></div>
        <div class="card"><div class="card-icon"><i class="fas fa-check-circle"></i></div><div class="card-value"><?php echo $resolvedCount; ?></div><div class="card-text">Resolved</div></div>
        <div class="card"><div class="card-icon"><i class="fas fa-share"></i></div><div class="card-value"><?php echo $forwardedCount; ?></div><div class="card-text">Forwarded</div></div>
        <div class="card"><div class="card-icon"><i class="fas fa-exclamation-triangle"></i></div><div class="card-value"><?php echo $escalatedCount; ?></div><div class="card-text">Escalated</div></div>
    </div>

    <section class="grievance-section">
        <h2>Grievances for <?php echo htmlspecialchars($branch); ?> Department</h2>
        <?php if(!empty($_SESSION['gdc_error'])): ?>
            <div style="background:#f8d7da;color:#842029;padding:10px;border-radius:6px;margin-bottom:10px;">
                <?php echo htmlspecialchars($_SESSION['gdc_error']); unset($_SESSION['gdc_error']); ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($grievances)): ?>
                <?php foreach ($grievances as $g): ?>
                    <tr>
                        <td><?php echo (int)$g['id']; ?></td>
                        <td><?php echo htmlspecialchars($g['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($g['title']); ?></td>
                        <td><?php echo htmlspecialchars(substr($g['description'],0,60)); ?>...</td>
                        <td><span class="status status-<?php echo str_replace(' ','-',strtolower($g['status'])); ?>"><?php echo htmlspecialchars($g['status']); ?></span></td>
                        <td><?php echo htmlspecialchars($g['submitted_at']); ?></td>
                        <td>
                            <form method="post" class="form-vertical">
                                <select name="new_status" class="input-small" required>
                                    <option value="">Select Action</option>
                                    <option value="pending">Pending</option>
                                    <option value="in progress">In Progress</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="forwarded">Forward</option>
                                    <option value="escalated">Escalate</option>
                                </select>
                                <input type="text" name="action_reason" class="input-small" placeholder="Reason for action" required>
                                <input type="hidden" name="grievance_id" value="<?php echo (int)$g['id']; ?>">
                                <button type="submit" name="update_status" class="button-small">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;">No grievances found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
</div>
</body>
</html>
