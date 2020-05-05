<?php
  require('../config/connect.php');
  require('../config/session.php');
  $error = "";
  function check(){	
      global $conn;
      $task_day = $_GET['task_day'];
      $track = $_GET['track'];
      $user = mysqli_real_escape_string($conn, $_GET['user']);
      $level = $_GET['level'];
      $cohort = 1;
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
      $task_day = $_GET['task_day'];
      $track = $_GET['track'];
      $user =  $_GET['user'];
      $points = $_GET['points'];
      $points = intval($points);
      $level = $_GET['level'];
      $date = date('Y-m-d');
      $url = '';
      $cohort = 1;
      $sql = "INSERT INTO submissions(user, track, url, task_day, points, sub_date, cohort, level) 
              VALUES('$user','$track', '$url', '$task_day', '$points', '$date', '$cohort', '$level')";
      if($conn->query($sql)){
        print "Saved";
      }else{
      die('could not enter data: '. $conn->error);
      }
  }else{
        print "You've submitted today's task already";
      
  }
          