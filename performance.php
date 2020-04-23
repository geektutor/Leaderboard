<?php
include './config/connect.php';
//i don't know what i am writing tho, i hope it works sha
    $first ="UPDATE `user` SET `performance` = '0' WHERE `score` > 0";
    $reset = mysqli_query($conn, $first);
    $sql = "SELECT email FROM user";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $particular_user = $row['email'];
            $up = total_score($particular_user);
            update_total($particular_user, $up);
        }
    }


    function total_score($email){   
        global $conn;
        $queryURL = "SELECT `points` FROM submissions WHERE `user` = '$email' ";
        $resultURL = mysqli_query($conn, $queryURL);
        $countURL = mysqli_num_rows($resultURL);
        $total = 0;
        $performance = 0
        if ($countURL > 0) {
            while($row = mysqli_fetch_assoc($resultURL)) {
                $total += $row['points'];
            }
            if ($total > 540) {
                $performance = 5;
            }
            else if ($total > 450) {
                $performance = 4;
            }
            else if ($total > 330) {
                $performance = 3;
            }
            else {
                $performance = 0;
            }
            return $total;
        }else{
            return $total;
        }
    }
    function update_total($email, $total){
        global $conn;
        $query = "UPDATE user SET performance = $performance WHERE `email` = '$email' ";
        $result = mysqli_query($conn, $query);
        if($conn->query($query)){
            return 1;
        }else{
            return 0;
        }
    }
    // $email = $_SESSION['login_user'];
    // $total = total_score($email);
    // $sql = "UPDATE user SET `score` = '$total' WHERE `email` = '$email'";
    // if(mysqli_query($conn, $sql)){
    //     echo 'successful';
    // }
    // else {
    //     echo 'error';
    // }

    // function totalRun($email){
    //     global $conn;
    //     $queryURL = "SELECT `user` FROM user WHERE isAdmin = 0";
    //     $resultURL = mysqli_query($conn, $queryURL);
    //     $countURL = mysqli_num_rows($resultURL);
    //     $total = 0;
    //     if ($countURL > 0)  {
    //         while ($row=$resul->fetch_assoc())  {
    //             total_score($row['user']);
    //         }
    //     }
    // }
    /*
   SELECT email, COUNT(email) FROM user GROUP BY email HAVING COUNT(email) > 1
   
   INSERT INTO `submissions` (`id`, `user`, `track`, `url`, `task_day`, `comments`, `points`, `sub_date`, `feedback`) VALUES (NULL, 'onigemotosin@gmail.com', 'frontend', 'Twitter Points', 'March 28', 'Twitter Points', '5', 'March 28', 'GIVEN');
INSERT INTO `submissions` (`id`, `user`, `track`, `url`, `task_day`, `comments`, `points`, `sub_date`, `feedback`) VALUES (NULL, 'feleolaife@gmail.com', 'frontend', 'Twitter Points', 'March 28', 'Twitter Points', '5', 'March 28', 'GIVEN');
INSERT INTO `submissions` (`id`, `user`, `track`, `url`, `task_day`, `comments`, `points`, `sub_date`, `feedback`) VALUES (NULL, 'hassanatsubomi@gmail.com', 'frontend', 'Twitter Points', 'March 28', 'Twitter Points', '5', 'March 28', 'GIVEN');
INSERT INTO `submissions` (`id`, `user`, `track`, `url`, `task_day`, `comments`, `points`, `sub_date`, `feedback`) VALUES (NULL, 'olotonjoshua@gmail.com', 'python', 'Twitter Points', 'March 28', 'Twitter Points', '5', 'March 28', 'GIVEN');
*/
?>