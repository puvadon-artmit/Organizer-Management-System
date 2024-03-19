<?php
include "../../Config/Database.php";
session_start();

try {
    $connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$organizer_id = $_SESSION['user_id'];

if(isset($_POST["title"], $_POST["start"], $_POST["end"]) && !empty($_POST["title"])) {
    $query = "
    INSERT INTO schedule 
    (title, start_event, end_event, organizer_id) 
    VALUES (:title, :start_event, :end_event, :organizer_id)
    ";
    $statement = $connect->prepare($query);
    if($statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end'],
            ':organizer_id' => $organizer_id
        )
    )) {
        echo "Data added successfully.";
    } else {
        echo "Error adding data: " . print_r($statement->errorInfo(), true);
    }
}
?>
