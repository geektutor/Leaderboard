<?php
require('../../config/connect.php');
require('../../config/session.php');
if(isset( $_SESSION['login_user']) && $_SESSION['isAdmin'] == true){
    $id = $_GET['id'];
    $sql = "DELETE * FROM task WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    header("refresh: 2; url=./index.php");
}
?>