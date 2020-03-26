<?php include('config/connect.php'); 

        global $conn;
        $query = "SELECT email FROM submissions";
        $count = mysqli_query($conn, $query);
        $countRows = mysqli_num_rows($count);
        var_dump($countRows);
        if ($countRows > 0) {
            $queryURL = "SELECT points FROM submissions WHERE user = $row ";
            $resultURL = mysqli_query($conn, $queryURL);
            $countURL = mysqli_num_rows($resultURL);
            $total = 0;
            if ($countURL > 0) {
                while($row = $resultURL->fetch_assoc()) {
                $total += $row['points'];
            }
                return $total;
                $sql = "UPDATE `user` SET score = $total WHERE email = $row";
                $result = mysqli_query($conn, $sql);
            }
            else{
                return $total;
            }   
        }
            
    //do the rest, i'm blank 
?>