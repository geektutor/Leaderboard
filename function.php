<?php include('config/connect.php'); 

        global $conn;
        $query = "SELECT email FROM submissions";
        $count = mysqli_query($conn, $query);
        $array = [];
        foreach ($count as $row)
        {
            $queryURL = "SELECT points FROM submissions WHERE user = $row ";
            $resultURL = mysqli_query($conn, $queryURL);
            $countURL = mysqli_num_rows($resultURL);
            $total = 0;
            if ($countURL > 0) {
                while($row = $resultURL->fetch_assoc()) {
                $total += $row['points'];
            }
                return $total;
            }
            else{
                return $total;
            }
            $array[] = $row['column'];
        }
        $total = total_score($row);
        $sql = "UPDATE `user` SET score = $total WHERE email = $row";
        $result = mysqli_query($conn, $sql);
    //do the rest, i'm blank 
?>