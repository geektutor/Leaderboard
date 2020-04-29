<?php include('config/connect.php'); 
$error_msg ='';
if (isset($_POST['submit'])) {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $track = $_POST['track'];

    $sql = "SELECT * FROM  user WHERE `nickname`='$nickname' AND `email`='$email' AND `track`='$track'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION['password_session'] = $row['email'];
            header('location: newpassword.php');
        }
    }else{
        $error_msg = "Error : no match found";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Vesper+Libre&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - 30DaysOfCode</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="rajstyle.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

</head>
<body>
    <div class="wrap">
    <img class="devImg" src="https://img.icons8.com/officel/80/000000/code.png">
        <form class="signup" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <h2>Let's help</h2>
            <p style="color :red; text-align:center;"><?php echo $error_msg?></p> <br><br>
            <div class="group"><input type="text" name="nickname" placeholder="NickName" required><i class="fa fa-user"></i></div>
            <div class="group"><input type="email" name="email" placeholder="Email" required><i class="fa fa-envelope-open"></i></div>
            
            <select name="track">
                <option value="frontend">Front End</option>
                <option value="backend">Back End</option>
                <option value="android">Mobile</option>
                <option value="ui">UI/UX</option>
                <option value="python">Python</option>
                <option value="design">Engineering Design</option>
            </select>
            <button type="submit" name="submit" value="submit"><i class="fa fa-send"></i>Validate</button>
            <p><a href="signup.php">Sign Up here</a> | <a href="login.php"> Login here </a></p>
        </form>



    </div>
</body>
</html>