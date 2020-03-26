<?php include('config/connect.php'); 
//i don't know what i am writing tho, i hope it works sha
    function total_score($email){   
        global $conn;
        $queryURL = "SELECT points FROM submissions WHERE user = $email ";
        $resultURL = mysqli_query($conn, $queryURL);
        $countURL = mysqli_num_rows($resultURL);
        $total = 0;
        if ($countURL > 0) {
            while($row = $resultURL->fetch_assoc()) {
                $total += $row['points'];
            }
            $email = $_SESSION['login_user'];
            $total = total_score($email);
            $sql = "UPDATE `user` SET score = $total WHERE email = $email"
            return $total;
        }else{
            return $total;
        }
    }
    
    if ($conn->query($sql)){
        header("location: login.php?message=sucess");
    }
    //do the rest, i'm blank
?>




