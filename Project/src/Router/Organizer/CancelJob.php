<?php

session_start();
include '../../Config/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['epm_id']) && is_numeric($_GET['epm_id'])) {
        $epm_id = intval($_GET['epm_id']);
        $job_status = 'cancel';

        // Update the job_status for the specified employment record
        $sql = "UPDATE employment SET job_status = :job_status WHERE epm_id = :epm_id AND organizer_id = :organizer_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':job_status', $job_status, PDO::PARAM_STR);
        $stmt->bindParam(':epm_id', $epm_id, PDO::PARAM_INT);
        $stmt->bindParam(':organizer_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the organizer's index page or any other appropriate location
        header("Location: ../../View/Organizer/Index.php");
        exit();
    }
}
