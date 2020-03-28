 <?php
$error = "";
    if($count > 0){
        while($row = $result->fetch_assoc()){

            if (isset($_POST['submit'])) {
                $u = $_POST['user'];
                $point = $_POST['point'];
                $feedback = $_POST['feedback'];
                if ($feedback == '') {
                    $feedback = "Marked";
                }

            $sql = "UPDATE submissions SET points = '$point', feedback = '$feedback' WHERE id = {$id}";
            $result = mysqli_query($conn, $sql);
            if($result){
                $sql = "SELECT score FROM user WHERE email = '$u'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $newPoint = $point + intval($row['score']);
                
                $sql = "UPDATE user SET score = '$newPoint' WHERE email = '$u'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $error = "Submitted Successfully";
                    header('location:./index.php?message=success');
                }else{
                   $error = "Could not update user";
                }

            } else {
                $error = "Could not update sub";

            }
        }
            
?>