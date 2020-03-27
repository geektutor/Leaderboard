<?php
//i don't know what i am writing tho, i hope it works sha
    function total_score($email){   
        global $conn;
        $queryURL = "SELECT user FROM user WHERE isAdmin = 0 ";
        $resultURL = mysqli_query($conn, $queryURL);
        $countURL = mysqli_num_rows($resultURL);
        if ($countURL > 0) {
            while($row = $result->fetch_assoc()) {
                //run the function
                $something =  FunctionName($row['user']);
                
            }
        }
?>




