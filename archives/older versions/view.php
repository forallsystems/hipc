<?php 
/*Configuration Settions */

/*MySQL Settings*/
/*Database Name*/
define('DB_NAME', 'events');

/*Database user*/
define('DB_USER', 'root');

/*Database user password*/
define('DB_PASSWORD', '');

/*Database host*/
define('DB_HOST', 'localhost');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
	die('Could not connect: ' . mysqli_error());
}

$db_selected = mysqli_select_db($link, DB_NAME);

if (!$db_selected) {
	die('Can\'t ' . DB_NAME . ':' . mysqli_error());
}

$sql = "SELECT * FROM event";

$results = mysqli_query($link, $sql);

if(!$results) {
	die('Invalid query: ' . mysqli_error($link));
}

echo '<h3>Users Table</h3>';

while($result = mysqli_fetch_array( $results )){
	echo '<div style="border: 1px solid #e4e4e4; padding: 15px; margin-bottom: 10px;">';
	echo '<p>Event Name: ' . $result['event_name'] . '</p>';
	echo '<p>Type of Event: ' . $result['day_type'] . '</p>';
	echo '<p>Start Date: ' . $result['start_date'] . '</p>';
	echo '<p>Start Time: ' . $result['start_time'] . '</p>';
	echo '<p>End Time: ' . $result['end_time'] . '</p>';
	echo '<p>Event Description: ' . $result['event_description'] . '</p>';
	echo '<p>Event Cost: ' . $result['event_cost'] . '</p>';
	echo '<p>Event Location: ' . $result['event_location'] . '</p>';
	echo '<p>Event Notes: ' . $result['event_notes'] . '</p>';
	echo '</div>';
}

mysqli_close($link);
 ?>


