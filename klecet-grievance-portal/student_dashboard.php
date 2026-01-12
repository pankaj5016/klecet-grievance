<?php
session_start();
require 'includes/db.php'; // $pdo

// Ensure only students can access
if (!isset($_SESSION['designation']) || $_SESSION['designation'] !== 'Student') {
    header("Location: login.php");
    exit();
}

$studentId = $_SESSION['user_id'];
$studentName = $_SESSION['name'];
$studentBranch = $_SESSION['branch'];
$studentStatus = $_SESSION['status'];

// Handle new grievance submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['description'])) {
    $title = $_POST['title'] === 'Other' ? trim($_POST['title_custom']) : trim($_POST['title']);
    $description = trim($_POST['description']);

    $attachmentPath = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === 0) {
        $fileName = time() . '_' . basename($_FILES['attachment']['name']);
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $attachmentPath = $uploadDir . $fileName;
        move_uploaded_file($_FILES['attachment']['tmp_name'], $attachmentPath);
    }

    if ($title && $description) {
        $stmt = $pdo->prepare("INSERT INTO grievances (student_id, branch, title, description, attachment, status, submitted_at) VALUES (?, ?, ?, ?, ?, 'Pending', NOW())");
        if ($stmt->execute([$studentId, $studentBranch, $title, $description, $attachmentPath])) {
            $message = "✅ Grievance submitted successfully.";
        } else {
            $message = "❌ Error submitting grievance.";
        }
    } else {
        $message = "❌ Title and description are required.";
    }
}

// Fetch unread notifications count
$stmt = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE student_id = ? AND is_read = 0");
$stmt->execute([$studentId]);
$unreadCount = $stmt->fetchColumn();

// Fetch all notifications
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE student_id = ? ORDER BY created_at DESC");
$stmt->execute([$studentId]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch student's grievances
$stmt = $pdo->prepare("SELECT * FROM grievances WHERE student_id = ? ORDER BY submitted_at DESC");
$stmt->execute([$studentId]);
$grievances = $stmt->fetchAll();

// Count statuses
$pending = $inProgress = $resolved = 0;
foreach ($grievances as $g) {
    $s = strtolower($g['status']);
    if ($s == 'pending') $pending++;
    else if ($s == 'in-progress') $inProgress++;
    else if ($s == 'resolved') $resolved++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard | KLECET Grievance Portal</title>

<style>
    
    body {
        background: #f4f7fb;
        font-family: Arial, sans-serif;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        padding: 25px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 6px;
        color: #555;
    }

    input[type="text"], textarea, select {
        width: 100%;
        padding: 12px;
        margin-bottom: 18px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        background: #fafafa;
    }

    textarea {
        height: 130px;
        resize: none;
    }

    button {
        width: 100%;
        padding: 12px;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 17px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #1e4fd1;
    }

    .success {
        padding: 12px;
        background: #d1fae5;
        border-left: 5px solid #10b981;
        margin-bottom: 20px;
        border-radius: 6px;
        color: #065f46;
        font-weight: bold;
    }

body { font-family: Arial, sans-serif; background: #f4f4f4; margin:0; }
.header { background:#003366; color:#fff; padding:15px; text-align:center; position: relative; }
.header h1 { margin: 0; font-size: 20px; }
.header .actions { position:absolute; top:15px; right:20px; }
.header .actions a { color:#fff; margin-left:15px; font-weight:bold; text-decoration:none; }

.container { padding:20px; max-width:1000px; margin:auto; }

.summary { display:flex; gap:20px; margin-bottom:30px; flex-wrap:wrap; }
.card { flex:1; min-width:150px; background:#fff; padding:20px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.06); text-align:center; }

table { width:100%; border-collapse:collapse; background:white; }
th, td { border:1px solid #ccc; padding:10px; }

.feedback-box {
    margin-top:10px;
    padding:10px;
    background:#eef5ff;
    border-radius:8px;
}
.feedback-item {
    background:white;
    padding:8px;
    border-radius:5px;
    margin-top:5px;
}
.notification { background:#fff3cd; border:1px solid #ffeeba; padding:10px; margin-bottom:10px; border-radius:5px; }

#notifModal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999; justify-content:center; align-items:center; }
#notifContent { background:white; width:400px; max-height:70%; overflow-y:auto; border-radius:8px; padding:20px; }
</style>

<script>
function toggleCustomTitle() {
    document.getElementById("customTitleDiv").style.display =
        document.getElementById("title").value === "Other" ? "block" : "none";
}

function openNotif() {
    document.getElementById("notifModal").style.display = "flex";
    const notifCount = document.getElementById("notifCount");
    if(notifCount) notifCount.style.display = 'none';

    fetch("mark_read.php");
}
function closeNotif() {
    document.getElementById("notifModal").style.display = "none";
}
</script>
</head>

<body>

<header class="header">
    <h1>Welcome, <?= htmlspecialchars($studentName) ?> (<?= htmlspecialchars($studentBranch) ?>)</h1>
    <div class="actions">
        <a href="change-password.php">Change Password</a>
        <a href="logout.php">Logout</a>

        <span onclick="openNotif()" style="cursor:pointer; margin-left:15px; font-size:22px;">
            🔔
            <?php if($unreadCount > 0): ?>
            <span id="notifCount"
                style="position:absolute; top:5px; right:5px; background:red; color:white; border-radius:50%; padding:2px 7px; font-size:12px;">
                <?= $unreadCount ?>
            </span>
            <?php endif; ?>
        </span>
    </div>
</header>

<!-- Notification Modal -->
<div id="notifModal">
    <div id="notifContent">
        <h3>Notifications</h3>
        <?php if (empty($notifications)): ?>
            <p>No new notifications.</p>
        <?php else: ?>
            <?php foreach ($notifications as $n): ?>
                <div class="notification">
                    <?= htmlspecialchars($n['message']) ?><br>
                    <small><?= $n['created_at'] ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <button onclick="closeNotif()">Close</button>
    </div>
</div>

<div class="container">

<?php if ($message): ?>
    <p style="color:green;"><?= $message ?></p>
<?php endif; ?>

<div class="summary">
    <div class="card"><h3>Pending</h3><p><?= $pending ?></p></div>
    <div class="card"><h3>In Progress</h3><p><?= $inProgress ?></p></div>
    <div class="card"><h3>Resolved</h3><p><?= $resolved ?></p></div>
</div>

<!-- Submit New Grievance -->
<form method="POST" enctype="multipart/form-data">
    <h3>Submit a New Grievance</h3>

    <label>Title</label>
    <select name="title" id="title" required onchange="toggleCustomTitle()">
        <option value="">Select Title</option>
        <option value="Room Issue">Room Issue</option>
        <option value="Mess Issue">Mess Issue</option>
        <option value="Teaching Issue">Teaching Issue</option>
        <option value="Exam Issue">Exam Issue</option>
        <option value="Library Issue">Library Issue</option>
        <option value="Other">Other</option>
    </select>

    <div id="customTitleDiv" style="display:none;">
        <input type="text" name="title_custom" placeholder="Enter custom title">
    </div>

    <label>Description</label>
    <textarea name="description" rows="5" required></textarea>

    <label>Attachment</label>
    <input type="file" name="attachment">

    <button type="submit">Submit</button>
</form>

<h3>Your Grievances</h3>

<table>
<thead>
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Status</th>
    <th>Submitted</th>
    <th>Feedback</th>
</tr>
</thead>
<tbody>

<?php foreach ($grievances as $g): ?>
<tr>
    <td><?= $g['id'] ?></td>
    <td><?= htmlspecialchars($g['title']) ?></td>
    <td><?= htmlspecialchars($g['description']) ?></td>
    <td><?= htmlspecialchars($g['status']) ?></td>
    <td><?= $g['submitted_at'] ?></td>

    <!-- FETCH FEEDBACK FOR THIS GRIEVANCE -->
    <td>
        <?php
        $fb = $pdo->prepare("SELECT * FROM feedback WHERE grievance_id = ?");
        $fb->execute([$g['id']]);
        $feedback = $fb->fetchAll();
        ?>

        <?php if (!empty($feedback)): ?>
            <div class="feedback-box">
                <strong>Feedback:</strong>
                <?php foreach ($feedback as $f): ?>
                    <div class="feedback-item">
                        <?= htmlspecialchars($f['feedback_text']) ?><br>
                        <small><?= $f['created_at'] ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <i>No feedback yet.</i>
        <?php endif; ?>
    </td>

</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>

</body>
</html>
