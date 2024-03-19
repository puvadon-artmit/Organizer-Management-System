<?php
// กำหนดค่า host, username, password, ชื่อฐานข้อมูล
$host = "localhost";
$username = "root";
$password = "";
$database = "project";

// ทำการเชื่อมต่อฐานข้อมูล
try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; 
}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>