<?php
include './config/connect.php';
//i don't know what i am writing tho, i hope it works sha
    function total_score($email){   
        global $conn;
        $queryURL = "SELECT `points` FROM submissions WHERE `user` = '$email' ";
        $resultURL = mysqli_query($conn, $queryURL);
        $countURL = mysqli_num_rows($resultURL);
        $total = 0;
        if ($countURL > 0) {
            while($row = mysqli_fetch_assoc($resultURL)) {
                $total += $row['points'];
            }
            return $total;
        }else{
            return $total;
        }
    }
    $email = $_SESSION['login_user'];
    $total = total_score($email);
    $sql = "UPDATE user SET `score` = '$total' WHERE `email` = '$email'";
    if(mysqli_query($conn, $sql)){
        echo 'successful';
    }
    else {
        echo 'error';
    }

    function totalRun($email){
        $queryURL = "SELECT `user` FROM user WHERE isAdmin = 0";
        $resultURL = mysqli_query($conn, $queryURL);
        $countURL = mysqli_num_rows($resultURL);
        $total = 0;
        if ($countURL > 0)  {
            while ($row=$resul->fetch_assoc())  {
                total_score($row['user'])
            }
        }
    }
    /*
   SELECT email, COUNT(email) FROM user GROUP BY email HAVING COUNT(email) > 1 */
?>