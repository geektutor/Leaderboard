<?php
include "../config/connect.php";

function register_user($username,$email,$phone)
{
    $username = trim_inputs($username);
    $email = trim_inputs($email);
    $phone = trim_inputs($phone);


}

function trim_inputs($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>