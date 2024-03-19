<?php
session_start();


try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['admin_login'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "User not found";
    exit();
}

$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$profile_img = $row['profile_img'];



?>