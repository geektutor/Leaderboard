<?php
//i don't know what i am writing tho, i hope it works sha
    function total_score($email){   
        global $conn;
        $queryURL = "SELECT points FROM submissions WHERE email = $email ";
        $resultURL = mysqli_query($conn, $queryURL);
        $countURL = mysqli_num_rows($resultURL);
        $total = 0;
        if ($countURL > 0) {
            while($row = $result->fetch_assoc()) {
                $total += $row['points'];
            }
            return $total;
        }else{
            return $total;
        }
    }
    $email = $_SESSION['login_user'];
    $total = total_score($email);
    $sql = "UPDATE `user` SET score = $total WHERE user = $email"
    $result = mysqli_query($conn, $sql);

    //do the rest, i'm blank
?>




