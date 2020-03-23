<?php
require "./config/connect.php";
require "./config/core.php";

if (logged_in()) {
  header("location: ./includes/leaderboard.php");
}else if(!logged_in()) {
  header("location: ./includes/signup.php");
}

?>