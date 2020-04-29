<?php
require "./config/connect.php";
require "./config/core.php";

if (logged_in()) {
  if ($_SESSION['isAdmin'] === true) {
    header("location: ./admin/index.php");
  }else {
    header("location: ./user/index.php");
  } 
}else if(!logged_in()) {
  header("location: login.php");
}

?>