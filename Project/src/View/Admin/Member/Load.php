<?php
include '../../../Config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['organizer_id'])) {
    $organizer_id = $_GET['organizer_id'];

    $query = "SELECT * FROM schedule WHERE organizer_id = :organizer_id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':organizer_id', $organizer_id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll();

    $data = array();
    foreach ($result as $row) {
        $data[] = array(
            'id' => $row["schedule_id"],
            'title' => $row["title"],
            'start' => $row["start_event"],
            'end' => $row["end_event"]
        );
    }

    echo json_encode($data);
}
?>
