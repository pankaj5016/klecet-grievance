<?php
session_start();
require 'includes/db.php';

// Ensure only logged-in students can access
if (!isset($_SESSION['user_id']) || $_SESSION['designation'] !== 'Student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$student_name = $_SESSION['name'];
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $branch = trim($_POST['branch']);
    $category = trim($_POST['category']);
    $subcategory = trim($_POST['subcategory']);
    $title = trim($_POST['title_custom'] ?: $_POST['title']);
    $description = trim($_POST['description']);
    $priority = trim($_POST['priority']);
    $issue_date = trim($_POST['issue_date']);

    // File attachment handling
    $file_path = null;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === 0) {
        $file_name = time() . '_' . basename($_FILES['attachment']['name']);
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $file_path = $target_dir . $file_name;
        move_uploaded_file($_FILES['attachment']['tmp_name'], $file_path);
    }

    if ($branch && $category && $title && $description && $priority && $issue_date) {
        $stmt = $pdo->prepare("INSERT INTO grievances (student_id, student_name, branch, category, subcategory, title, description, priority, issue_date, attachment, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
        $stmt->execute([$student_id, $student_name, $branch, $category, $subcategory, $title, $description, $priority, $issue_date, $file_path]);
        $message = "<p class='success'>Grievance submitted successfully!</p>";
    } else {
        $message = "<p class='error'>Please fill in all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Submit Grievance - KLECET</title>
<style>
    body { font-family:'Segoe UI', sans-serif; background:#f0f2f5; margin:0; padding:0; }
    .container { max-width:650px; margin:50px auto; background:#fff; padding:30px 40px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);}
    h2 { text-align:center; color:#003366; margin-bottom:25px; }
    label { display:block; margin-bottom:5px; font-weight:bold; }
    input, select, textarea { width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:6px; font-size:14px; }
    textarea { resize:vertical; }
    button { background:#003366; color:#fff; padding:12px; border:none; border-radius:6px; font-size:16px; width:100%; cursor:pointer; }
    button:hover { background:#00509e; }
    .success { color:green; background:#e6ffed; border:1px solid #b2f2bb; padding:10px; border-radius:6px; margin-bottom:15px; }
    .error { color:red; background:#ffe6e6; border:1px solid #ffb2b2; padding:10px; border-radius:6px; margin-bottom:15px; }
    .flex-row { display:flex; gap:10px; flex-wrap:wrap; }
    .flex-row > div { flex:1; min-width:150px; }
</style>
<script>
function toggleCustomTitle() {
    var titleSelect = document.getElementById('title');
    var customDiv = document.getElementById('customTitleDiv');
    customDiv.style.display = (titleSelect.value === 'Other') ? 'block' : 'none';
}

function updateSubcategories() {
    var category = document.getElementById('category').value;
    var subcatSelect = document.getElementById('subcategory');
    subcatSelect.innerHTML = '';

    var options = { 
        'Hostel Issue': ['Room Issue','Mess Issue','Other'], 
        'Academic Issue': ['Syllabus','Teaching','Exams','Other'], 
        'Exam Related': ['Timetable','Marks','Evaluation','Other'],
        'Faculty Related': ['Behavior','Teaching Quality','Other'],
        'Infrastructure': ['Labs','Classrooms','Other'],
        'Library Issue': ['Books','Facilities','Other'],
        'Other': ['Other']
    };

    if(options[category]) {
        options[category].forEach(function(opt){
            var el = document.createElement('option');
            el.value = opt; el.text = opt;
            subcatSelect.add(el);
        });
    }
}
</script>
</head>
<body>

<div class="container">
    <h2>Submit Grievance</h2>
    <?php echo $message; ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Student Name</label>
        <input type="text" value="<?php echo htmlspecialchars($student_name); ?>" readonly>

        <label>Branch</label>
        <select name="branch" required>
            <option value="">-- Select Branch --</option>
            <option value="CSE">Computer Science</option>
            <option value="ECE">Electronics & Communication</option>
            <option value="ME">Mechanical</option>
            <option value="CV">Civil</option>
            <option value="EEE">Electrical</option>
            <option value="MBA">MBA</option>
            <option value="MCA">MCA</option>
        </select>

        <label>Category</label>
        <select name="category" id="category" required onchange="updateSubcategories()">
            <option value="">-- Select Category --</option>
            <option value="Hostel Issue">Hostel Issue</option>
            <option value="Academic Issue">Academic Issue</option>
            <option value="Exam Related">Exam Related</option>
            <option value="Faculty Related">Faculty Related</option>
            <option value="Infrastructure">Infrastructure</option>
            <option value="Library Issue">Library Issue</option>
            <option value="Other">Other</option>
        </select>

        <label>Subcategory</label>
        <select name="subcategory" id="subcategory" required>
            <option value="">-- Select Subcategory --</option>
        </select>

        <label>Title</label>
        <select name="title" id="title" required onchange="toggleCustomTitle()">
            <option value="">-- Select Title --</option>
            <option value="Room Issue">Room Issue</option>
            <option value="Mess Issue">Mess Issue</option>
            <option value="Teaching Issue">Teaching Issue</option>
            <option value="Other">Other</option>
        </select>

        <div id="customTitleDiv" style="display:none;">
            <label>Custom Title</label>
            <input type="text" name="title_custom" placeholder="Enter custom title">
        </div>

        <label>Description</label>
        <textarea name="description" rows="5" placeholder="Describe your issue" required></textarea>

        <div class="flex-row">
            <div>
                <label>Priority</label>
                <select name="priority" required>
                    <option value="">-- Select Priority --</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <div>
                <label>Issue Date</label>
                <input type="date" name="issue_date" required>
            </div>
        </div>

        <label>Attachment (optional)</label>
        <input type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf">

        <button type="submit">Submit Grievance</button>
    </form>
</div>

</body>
</html>
