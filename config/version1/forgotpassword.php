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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="signup.css">
    <title>30DaysOfCode  - Sign Up</title>
</head>
<body>
    <div class="contact-us">
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <p style="color :red; text-align:center;"><?php echo $error_msg?></p> <br><br>
        <p><center><b>Forgot Password ?</b> Let's know if you're an actual user</center></p> <br><br>
            <input name="nickname" placeholder="Nickname" required="" type="text" />
            <input name="email" placeholder="Email" type="email" />
            <select name="track">
            <option value="frontend">Front End</option>
            <option value="backend">Back End</option>
            <option value="android">Mobile</option>
            <option value="ui">UI/UX</option>
            <option value="python">Python</option>
            <option value="design">Engineering Design</option>
            </select>
            <button type="submit" name="submit" value="submit">Submit</button>
        </form><br> <br>
        <center><a href="login.php"> Login here </a> |
        <a href="signup.php"> Signup here </a></center>
    </div>
</body>
</html>