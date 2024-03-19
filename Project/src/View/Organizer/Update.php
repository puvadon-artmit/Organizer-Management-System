<?php

//update.php
include "../../Config/Database.php";

$connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);

if(isset($_POST["schedule_id"]))
{
 $query = "
 UPDATE schedule 
 SET title=:title, start_event=:start_event, end_event=:end_event, organizer_id=:organizer_id 
 WHERE schedule_id=:schedule_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':organizer_id' => $_POST['organizer_id'],
   ':schedule_id'   => $_POST['schedule_id']
  )
 );
}

?>
