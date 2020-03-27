<?php include('config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="signup.css">
    <title>30DaysOfCode  - Login</title>
</head>
<body>
    <div class="contact-us">
    <?php
        $ref = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 10, 10);
        $resetPassword = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 15, 15);
        if (@$_GET['message'] == 'success' && $ref == 'signup.php') {
            echo "<div class='msg alert-success alert-dismissable'>Registration Successful </div>";
        }
        if (@$_GET['message'] == 'success' && $resetPassword == 'newpassword.php') {
            echo "<div class='msg alert-success alert-dismissable'>Password reset Successful. kindly log into your account.</div>";
        }
        ?>
        <?php
            $error = "";
            session_start();
            if (isset($_POST['submit'])) {
                $username = mysqli_real_escape_string($conn, $_POST['email']);
                $myPassword = mysqli_real_escape_string($conn, $_POST['password']);
                $sql = "SELECT * FROM user WHERE `email` = '$username' AND `password` = '$myPassword'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                //$active = $row['active'];
                $count = mysqli_num_rows($result);
                $error = "";
              // If result matched $myusername and $mypassword, table row must be 1 row
                if($count == 1) {
                    $_SESSION['login_user'] = $username;
                    $track_sql = "SELECT track FROM user WHERE email = '$username'";
                    $result = mysqli_query($conn,$track_sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($track = mysqli_fetch_assoc($result)) {
                            $_SESSION['user_track'] = $track['track'];
                        }
                    }
                    if($row['isAdmin'] == 0){
                        header("location: dashboard/user/index.php");
                    }else{
                        $_SESSION['isAdmin'] = true;
                        $_SESSION['track'] = $_SESSION['user_track'];
                        $_SESSION['login_user'] = $username.'_';
                        header("location: dashboard/admin/index.php");
                    }
                }else {
                    $error = "Your Login Name or Password is invalid";
                }
            }
        
        ?>
        <?php if($error !== ''){ ?>
        <div class="alert alert-primary alert-dismissable">
            <?= $error?>
        </div>
        <?php }?>
        <form method="POST">
          <input name="email" placeholder="email" required="" type="email" value="" />
          <input name="password" placeholder="password" type="password" value="" required/>
          <button type="submit" name="submit" value="submit">Login</button>
        </form><br>
        <p>Not already a user ? <a href="signup.php"> Signup here </a></p>
        <a href="./forgotpassword.php">Forgot Password ?</a>
      </div>
</body>
</html>