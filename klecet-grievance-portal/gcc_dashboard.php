<?php
session_start();

// Include PDO database connection
$host = 'localhost';
$db   = 'klecet-grievance';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Only allow GCC
if (!isset($_SESSION['user_id']) || $_SESSION['designation'] !== 'GCC') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'] ?? 'GCC User';

// Fetch grievances
$query = "
    SELECT 
        g.id, 
        g.student_id,
        s.name AS student_name,
        s.branch,
        g.title,
        g.description,
        g.status,
        g.created_at
    FROM grievances g
    JOIN students s ON g.student_id = s.id
    WHERE g.previous_status = 'forwarded'
    ORDER BY g.created_at DESC
";

try {
    $stmt = $conn->query($query);
    $grievances = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Database query failed: " . $e->getMessage();
}

// Dashboard counts
$total_grievances = count($grievances ?? []);
$pending_count = $resolved_count = $progress_count = 0;

if (!empty($grievances)) {
    foreach ($grievances as $row) {
        $status_db = strtolower(trim($row['status']));
        switch($status_db){
            case 'pending': $pending_count++; break;
            case 'resolved': $resolved_count++; break;
            case 'in-progress': $progress_count++; break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GCC Dashboard - KLECET Grievance System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* SAME CSS AS BEFORE (No changes) */
:root{--primary-color:#003366;--secondary-color:#0055aa;--accent-color:#0077cc;--light-color:#f7f7f7;--dark-color:#333;--success-color:#28a745;--warning-color:#ffc107;--danger-color:#dc3545;--sidebar-width:260px;--transition-speed:0.3s;}
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;}
body{display:flex;min-height:100vh;background:#f5f7f9;color:#333;}
.sidebar{background:linear-gradient(to bottom,var(--primary-color),var(--secondary-color));color:#fff;width:var(--sidebar-width);padding:20px 0;position:fixed;height:100vh;overflow-y:auto;display:flex;flex-direction:column;}
.brand{text-align:center;padding:15px 20px;border-bottom:1px solid rgba(255,255,255,0.1);margin-bottom:20px;}
.brand h2{font-size:1.4rem;margin-bottom:5px;}
.brand p{font-size:0.85rem;opacity:0.8;}
.sidebar-menu{list-style:none;padding:0;flex-grow:1;}
.sidebar-menu li{margin-bottom:8px;}
.sidebar-menu a{text-decoration:none;color:#fff;display:flex;align-items:center;padding:12px 20px;border-radius:0 30px 30px 0;}
.sidebar-footer{padding:15px 20px;text-align:center;opacity:0.7;}
.content{flex:1;padding:25px;margin-left:var(--sidebar-width);}
.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;padding-bottom:15px;border-bottom:1px solid #e0e0e0;}
.dashboard-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;margin-bottom:30px;}
.card{background:white;border-radius:15px;padding:20px;box-shadow:0 5px 20px rgba(0,0,0,0.08);}
.section{background:white;border-radius:15px;padding:25px;box-shadow:0 5px 20px rgba(0,0,0,0.08);margin-bottom:30px;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{padding:12px 15px;border-bottom:1px solid #eaeaea;}
.status{padding:5px 12px;border-radius:20px;font-size:0.85rem;font-weight:500;}
.status-pending{background:#fff3cd;color:#856404;}
.status-in-progress{background:#cce5ff;color:#004085;}
.status-resolved{background:#d4edda;color:#155724;}
.update-status{padding:5px 8px;background:#0077cc;color:#fff;border:none;border-radius:5px;cursor:pointer;}
</style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div class="brand">
        <h2>GCC Dashboard</h2>
        <p>KLECET Grievance System</p>
    </div>
    <ul class="sidebar-menu">
        <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
    <div class="sidebar-footer">KLECET Chikodi © 2025</div>
</nav>

<div class="content">
    <div class="header">
        <h1>Grievance Central Coordinator Dashboard</h1>
        <div class="user-info">
            <div class="user-avatar"><?php echo substr($name,0,1); ?></div>
            <span><?php echo htmlspecialchars($name); ?></span>
        </div>
    </div>

    <!-- Dashboard Counts -->
    <div class="dashboard-cards">
        <div class="card"><h3>Total: <?php echo $total_grievances; ?></h3></div>
        <div class="card"><h3>Pending: <?php echo $pending_count; ?></h3></div>
        <div class="card"><h3>In Progress: <?php echo $progress_count; ?></h3></div>
        <div class="card"><h3>Resolved: <?php echo $resolved_count; ?></h3></div>
    </div>

    <!-- Table -->
    <section class="section">
        <h2>Forwarded Grievances</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Branch</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($grievances as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['branch']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo substr($row['description'],0,50) . "..."; ?></td>

                    <td>
                        <span class="status 
                            <?php 
                                if($row['status']=='pending') echo 'status-pending';
                                elseif($row['status']=='in-progress') echo 'status-in-progress';
                                else echo 'status-resolved';
                            ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </td>

                    <td><?php echo $row['created_at']; ?></td>

                    <td>
                        <!-- Status Form -->
                        <form method="POST" action="update_status_gcc.php">
                            <input type="hidden" name="grievance_id" value="<?php echo $row['id']; ?>">
                            <select name="status">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="resolved">Resolved</option>
                            </select>
                            <button class="update-status">Update</button>
                        </form>

                        <br>

                        <!-- Feedback Button -->
                        <button class="update-status" style="background:#28a745"
                            onclick="openFeedbackForm(<?php echo $row['id']; ?>)">
                            Feedback
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </section>
</div>

<!-- FEEDBACK POPUP -->
<div id="feedbackModal" style="
    display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    
    <div style="background:white; padding:20px; width:400px; border-radius:10px;">
        <h2>Send Feedback</h2>

        <form method="POST" action="save_feedback.php">
            <input type="hidden" id="feedbackGrievanceID" name="grievance_id">

            <textarea name="feedback_text" rows="5" required
                style="width:100%; padding:10px;"></textarea>

            <br><br>

            <button type="submit" class="update-status">Submit</button>
            <button type="button" class="update-status" style="background:#dc3545"
                onclick="closeFeedbackForm()">Cancel</button>
        </form>
    </div>
</div>

<script>
function openFeedbackForm(id){
    document.getElementById('feedbackModal').style.display = 'flex';
    document.getElementById('feedbackGrievanceID').value = id;
}

function closeFeedbackForm(){
    document.getElementById('feedbackModal').style.display = 'none';
}
</script>

</body>
</html>
