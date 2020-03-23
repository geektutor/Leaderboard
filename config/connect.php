<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'leaderboard';

$db_connect = mysqli_connect($hostname,$username,$password,$db_name);

if (!$db_connect) {
    die(mysqli_connect_error());
}
?>