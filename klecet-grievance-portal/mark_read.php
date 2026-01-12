<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) exit;

$studentId = $_SESSION['user_id'];
$stmt = $pdo->prepare("UPDATE notifications SET is_read = 1 WHERE student_id = ?");
$stmt->execute([$studentId]);
echo "ok";
