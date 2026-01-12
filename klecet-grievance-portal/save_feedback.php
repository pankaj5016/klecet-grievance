<?php
session_start();

// Only GCC can submit feedback
if (!isset($_SESSION['designation']) || $_SESSION['designation'] !== 'GCC') {
    header("Location: login.php");
    exit;
}

// DB Connection
$host = 'localhost';
$db   = 'klecet-grievance';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grievance_id = $_POST['grievance_id'];
    $feedback_text = $_POST['feedback_text'];

    $query = "INSERT INTO feedback (grievance_id, feedback_text) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$grievance_id, $feedback_text]);

    header("Location: gcc_dashboard.php?success=feedback_added");
}
?>
