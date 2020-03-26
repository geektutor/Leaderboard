<?php include('config/connect.php'); 

        global $conn;
        $query = "SELECT email FROM submissions";
        $count = mysqli_query($conn, $query);
        $array = [];
        var_dump(mysqli_fetch_array($count) );
        foreach (mysqli_fetch_array($count) as $row)
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
                $sql = "UPDATE `user` SET score = $total WHERE email = $row";
                $result = mysqli_query($conn, $sql);
            }
            else{
                return $total;
            }
            $array[] = $row['column'];
        }
    //do the rest, i'm blank 
?>