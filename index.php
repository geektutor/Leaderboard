<?php
require "./config/connect.php";
require "./config/core.php";

if (logged_in()) {
  if ($_SESSION['isAdmin'] === true) {
    header("location: ./dashboard/admin/index.php");
  }else {
    header("location: ./dashboard/user/index.php");
  } 
}else if(!logged_in()) {
  header("location: login.php");
}

?>