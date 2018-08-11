<?php
$host = "localhost";
$user = "root";
$pwd = "pede7424";
$db = "ganesh";

$con = mysqli_connect($host, $user, $pwd, $db);
if (mysqli_connect_errno()) {
	echo "Failed to connect to the database: " . mysqli_connect_error();
}
?>