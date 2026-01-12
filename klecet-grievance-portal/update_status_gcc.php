<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['designation']!=='GCC'){
    header("Location: login.php");
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $grievance_id = $_POST['grievance_id'] ?? '';
    $status = $_POST['status'] ?? '';

    if($grievance_id && $status){
        $host='localhost'; $db='klecet-grievance'; $user='root'; $pass=''; $charset='utf8mb4';
        $dsn="mysql:host=$host;dbname=$db;charset=$charset";
        $options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
        $conn=new PDO($dsn,$user,$pass,$options);
        $stmt=$conn->prepare("UPDATE grievances SET status=? WHERE id=?");
        $stmt->execute([$status,$grievance_id]);
    }
}
header("Location: gcc_dashboard.php");
exit;
