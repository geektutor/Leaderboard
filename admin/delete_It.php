<?php  
	require('../config/connect.php');
	require('../config/session.php');

	$id = $_GET['delId'];

	$select = "DELETE FROM submissions WHERE id = '$id'";
	$query = mysqli_query($conn, $select) or die();
	header("location:superadmin.php");
