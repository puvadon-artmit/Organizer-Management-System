<?php
session_start();
include '../../Config/Database.php';

if (!isset($_SESSION['organizer_login'])) {
    header("Location: ../../View/Organizer/Index.php");
    exit();
}

$user_id = $_SESSION['organizer_login'];

$stmt = $conn->prepare("SELECT * FROM organizer WHERE organizer_id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    $_SESSION['error'] = 'ไม่พบผู้ใช้';
    header("Location: ../../View/Login.php");
    exit();
}

$firstname = $row['firstname'];
$lastname = $row['lastname'];
$oz_email = $row['oz_email'];
$profile_ogz = $row['profile_ogz'];





?>