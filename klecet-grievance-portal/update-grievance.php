<?php
session_start();
require 'includes/db.php';

// Only HOD or Principal can update
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['designation'], ['HOD','Principal'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $grievanceId = intval($_POST['grievance_id']);
    $statusInput = strtolower(trim($_POST['status'])); // Normalize to lowercase

    // Allowed database values
    $validStatuses = ["pending", "in-progress", "resolved"];

    if (!in_array($statusInput, $validStatuses)) {
        die("❌ Invalid status input received: " . htmlspecialchars($statusInput));
    }

    try {
        // 1️⃣ Update grievance status
        $stmt = $pdo->prepare("UPDATE grievances SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $statusInput, ':id' => $grievanceId]);

        // 2️⃣ Fetch student_id for this grievance
        $stmt = $pdo->prepare("SELECT student_id FROM grievances WHERE id = :id");
        $stmt->execute([':id' => $grievanceId]);
        $studentId = $stmt->fetchColumn();

        if ($studentId) {
            // 3️⃣ Insert notification
            $message = "Your grievance #$grievanceId status changed to " . ucfirst($statusInput);
            $stmt = $pdo->prepare("INSERT INTO notifications (student_id, grievance_id, message) VALUES (:student_id, :grievance_id, :message)");
            $stmt->execute([
                ':student_id' => $studentId,
                ':grievance_id' => $grievanceId,
                ':message' => $message
            ]);
        }

        // Redirect based on role
        $redirect = ($_SESSION['designation'] === 'HOD') ? "hod_dashboard.php" : "principal_dashboard.php";
        header("Location: $redirect?msg=Status+updated+successfully");
        exit;

    } catch (PDOException $e) {
        die("❌ Update Error: " . $e->getMessage());
    }

} else {
    // If accessed directly, redirect to appropriate dashboard
    $redirect = ($_SESSION['designation'] === 'HOD') ? "hod_dashboard.php" : "principal_dashboard.php";
    header("Location: $redirect");
    exit;
}
?>
