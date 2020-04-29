<?php include('config/connect.php'); 
 session_start();
 //echo  $_SESSION['password_session'];
if (!isset($_SESSION['password_session']) || empty($_SESSION['password_session'])) {
    header('location:index.php');
}
if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $email = $_SESSION['password_session'];
    $sql = "UPDATE `user` SET `password` = '$password' WHERE `email`='$email'";
    $result = mysqli_query($conn,$sql);
    if ($result) {
       header('location:login.php?message=success');
    }else{
        echo "error updating password. Try again later";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="rajstyle.css">
    <title>Forgot Password - 30DaysOfCode</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>
<body>
    <div class="wrap">
        <p>Input new password for user with email : <?php echo $_SESSION['password_session']?></p>
        <form class="signup" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
          <input id="password" class="group" placeholder="New password" required="" name="password" type="password" />
          <input id="cpassword" class="group" placeholder="Confirm new password" required="" type="password" />
          <p id="response"></p><br>
          <button type="submit" name="submit" id="btn" value="submit">Change Password</button>
        </form><br>
        <p>Already a user? <a href="login.php"> Login here </a></p>
      </div>
      <script src="check.js"></script>
</body>
</html>