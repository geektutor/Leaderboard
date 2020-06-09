<?php
  require('../config/connect.php');
  require('../config/session.php');
  $error = "";
  function check(){	
      global $conn;
      $task_day = $_POST['task_day'];
      $track = $_POST['track'];
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $level = $_POST['level'];
      $cohort = $_POST['cohort'];
      $queryURL = "SELECT * FROM submissions WHERE user = '$user' AND task_day = '$task_day' AND track = '$track' AND level = '$level'";
      $resultURL = mysqli_query($conn, $queryURL);
      $countURL = mysqli_num_rows($resultURL);
      if ($countURL > 0) {
          return 1;
      }else{
          return 0;
      }
  }
          
  $check = check();
  if(check() == 0){
	  if(isset($_POST['n'])){
		  $feedback = ''; 
	  }
      $task_day = $_POST['task_day'];
      $track = $_POST['track'];
      $user =  $_POST['user'];
      $points = $_POST['points'];
      $points = intval($points);
      $level = $_POST['level'];
      $date = date('Y-m-d');
      $url = $_POST['url'];
      $comment = $_POST['comment'];
      $cohort = $_POST['cohort'];
      $sql = "INSERT INTO submissions(user, track, url, task_day, comments, points, sub_date, cohort, level, feedback) 
              VALUES('$user','$track', '$url', '$task_day', '$comment', '$points', '$date', '$cohort', '$level', '$feedback')";
      if($conn->query($sql)){
        print "Saved";
      }else{
      die('could not enter data: '. $conn->error);
      }
  }else{
        print "You've submitted today's task already";
      
  }