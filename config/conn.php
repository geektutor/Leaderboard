<?php
$hostname = 'localhost';
$username = 'mushpgwz_leaderboard';
$password = '}.7oX%+TxJT4';
$db_name = 'mushpgwz_leaderboard';

$conn = mysqli_connect($hostname,$username,$password,$db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

?>
