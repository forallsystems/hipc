<?php 

define('DB_NAME', 'events');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if(!$link) {
	die('Could not connect: ' . mysqli_error());
}

$db_selected = mysqli_select_db($link, DB_NAME);

if (!$db_selected) {
	die('Can\'t ' . DB_NAME . ':' . mysqli_error());
}

echo "connected";

$event_name = $_POST['event_name'];
$day_type = $_POST['day_type'];
$start_date = $_POST['start_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$event_description = $_POST['event_description'];
$event_cost = $_POST['event_cost'];
$event_location = $_POST['event_location'];
$event_notes = $_POST['event_notes'];

$sql = "INSERT INTO event (event_name, day_type, start_date, start_time, end_time, event_description, event_cost, event_location, event_notes) 
		VALUES ('$event_name', '$day_type', '$start_date', '$start_time', '$end_time', '$event_description', '$event_cost', '$event_location', '$event_notes')"; 
if(!mysqli_query($link, $sql)) {
	die('Error: ' . mysqli_error());
}

mysqli_close($link);

 ?>