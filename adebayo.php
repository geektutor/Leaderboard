<?php
include 'config/connect.php';

//GETS ALL THE USER
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
	while ($row = $result->fetch_assoc()) {
		$users[] = $row; 
	}
}
//Reset the scores in the leaderboard table to 0
$query = "SELECT * FROM leaderboard";
$res = mysqli_query($conn, $query);
$count = mysqli_num_rows($res);
if ($count > 0) {
	while($row = $res->fetch_assoc()){
		$ids[] = $row['id'];
	}
	foreach ($ids as $id) {
	 	$query = "UPDATE leaderboard SET score = 0 WHERE id = $id";
		$res = mysqli_query($conn, $query);
	}
} 
//For each user, populate the scores 
foreach ($users as $user) {
	$em = $user['email'];
	$nickname = $user['nickname'];
	$sql = "SELECT * FROM submissions WHERE user = '$em'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	$submissions = [];
	if ($count > 0) {
		while ($row = $result->fetch_assoc()) {
			$submissions[] = $row;
		}
	}

	foreach ($submissions as $submission) {
		$email = $submission['user'];
		$level = $submission['level'];
		$track = $submission['track'];
		$points = $submission['points'];
		$sql = "SELECT * FROM leaderboard WHERE email = '$email' AND track = '$track' AND level = '$level'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);

		if ($count > 0) {
			$total = intval($row['score']) + intval($points);
			$sql = "UPDATE leaderboard SET score = $total WHERE email = '$email' AND track = '$track' AND level = '$level'";
			$result = mysqli_query($conn, $sql);
		}else{
			$sql = "INSERT INTO leaderboard(nickname, email, track, level, score) VALUES('$nickname', '$email', '$track', '$level', '$points')";
            $result = mysqli_query($conn, $sql);
		}
	}
}
