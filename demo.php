<?php 

define('DB_NAME', 'forms1');
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

$value = $_POST['input1'];
$value2 = $_POST['input2'];

$sql = "INSERT INTO demo (input1, input2) VALUES ('$value', 'value2')";

if(!mysqli_query($link, $sql)) {
	die('Error: ' . mysqli_error());
}

mysqli_close($link);

 ?>