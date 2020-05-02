<?php
 session_start(); 
 require('connect.php');
 $user_check = $_SESSION['login_user']; 
 $ses_sql = mysqli_query($conn,"SELECT email, id FROM user WHERE email = '$user_check'"); 
 $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC); 
 $login_session = $row['id']; if(!isset($_SESSION['login_user'])){
      if ($_SERVER['HOST_NAME'] == 'localhost' || $_SERVER['HOST_NAME'] == 'Localhost') {
        header("location:".$_SERVER['HOST_NAME']."leaderboard/login.php"); 
      }
      header("location:".$_SERVER['HOST_NAME']."/sign_in.php"); 
      } ?>