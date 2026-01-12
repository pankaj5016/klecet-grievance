$grievance_id = $_POST['grievance_id'];
$status = $_POST['status'];
$escalated = isset($_POST['escalate']) ? 1 : 0;

$stmt = $conn->prepare("UPDATE grievances SET status=:status, escalated=:escalated WHERE id=:id");
$stmt->execute([
    ':status' => $status,
    ':escalated' => $escalated,
    ':id' => $grievance_id
]);

header("Location: gdc_dashboard.php?msg=updated");
exit;
