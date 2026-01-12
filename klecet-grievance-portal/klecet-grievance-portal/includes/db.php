<?php
$host = "localhost";         
$dbname = "grievance_system"; // ✅ Correct DB name
$username = "root";          
$password = "";              

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected";
} catch (PDOException $e) {
    echo "<p style='color:red;'>Connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}
?>
