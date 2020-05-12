<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'leaderboard';

$conn = mysqli_connect($hostname,$username,$password,$db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

?>