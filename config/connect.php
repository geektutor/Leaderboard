<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$db_name = 'leaderboard';

$db_connect = mysqli_connect($hostname,$username,$password,$db_name);

if (!$db_connect) {
    die(mysqli_connect_error());
}else {
    //Check if table exists
    $table_checker = 'SELECT ID FROM Users';
    $table_checker_result = mysqli_query($db_connect,$table_checker);

    if (empty($table_checker_result)) {
        //Table doesn't exist. create table
        $sql = "CREATE TABLE USers (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(50) NOT NULL,
            phoneNumber INT(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            user_password VARCHAR(100) NOT NULL,
            track VARCHAR(100) NOT NULL,
            score INT(100) NOT NULL DEFAULT '0',
            reg_date TIMESTAMP
            )";
            
            if (mysqli_query($db_connect, $sql)) {
                echo "Table MyGuests created successfully";
            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }       
    } 
    mysqli_close($db_connect);
}
?>