<?php include('config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - 30DaysOfCode</title>
    <link rel="stylesheet" rel="shortcut icon" type="image/png" href="img/fastreboot_arrow_6026.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="rajstyle.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>
<body>
<?php
        $ref = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 10, 10);
        $resetPassword = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 15, 15);
        if (@$_GET['message'] == 'success' && $ref == 'signup.php') {
            echo "<div class='group'>Registration Successful </div>";
        }
        if (@$_GET['message'] == 'success' && $resetPassword == 'newpassword.php') {
            echo "<div class='group'>Password reset Successful. kindly log into your account.</div>";
        }
        ?>
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
                    $track_sql = "SELECT track, university FROM user WHERE email = '$username'";
                    $result = mysqli_query($conn,$track_sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($track = mysqli_fetch_assoc($result)) {
                            $_SESSION['user_track'] = $track['track'];
                            $_SESSION['user_university'] = $track['university'];

                        }
                    }
                    if ($row['isAdmin'] == 2) {
                        //superAdmin priviledges
                        $_SESSION['isAdmin'] = true;
                        $_SESSION['isSuperAdmin'] = true;
                        $_SESSION['track'] = $_SESSION['user_track'];
                        $_SESSION['login_user'] = $username.'_';
                        header("location: dashboard/admin/index.php?superadmin=true");
                    }elseif ($row['isAdmin'] == 1) {
                        //basic admin priviledges
                        $_SESSION['isAdmin'] = true;
                        $_SESSION['track'] = $_SESSION['user_track'];
                        $_SESSION['login_user'] = $username.'_';
                        $_SESSION['university'] = $_SESSION['user_university'];
                        header("location: dashboard/admin/index.php");
                    }elseif ($row['isAdmin'] == 5) {
                        //basic admin priviledges
                        $_SESSION['ttt'] = $row['isAdmin'];
                        $_SESSION['isAdmin'] = true;
                        $_SESSION['track'] = $_SESSION['user_track'];
                        $_SESSION['login_user'] = $username.'_';
                        $_SESSION['university'] = $_SESSION['user_university'];
                        header("location: dashboard/admin/jkadmin.php");
                    }else {
                        header("location: dashboard/user/index.php");
                    }
                    // if($row['isAdmin'] == 0){
                    //     header("location: dashboard/user/index.php");
                    // }else{
                    //     $_SESSION['isAdmin'] = true;
                    //     $_SESSION['track'] = $_SESSION['user_track'];
                    //     $_SESSION['login_user'] = $username.'_';
                    //     header("location: dashboard/admin/index.php");
                    // }
                }else {
                    $error = "Your Login Name or Password is invalid";
                }
            }
        
        ?>
        <?php if($error !== ''){ ?>
        <div class="group">
            <?= $error?>
        </div>
        <?php }?>

    <form class="login" method="POST">
        <i class="fa fa-universal-access"></i>
        <h2>30 Days Of Code</h2>
        <div class="group">
            <input type="email" name="email" placeholder="Email" required><i class="fa fa-user"></i>
        </div>
        <div class="group">
            <input type="password" name="password" placeholder="Password" required><i class="fa fa-lock"></i>
        </div>
        
        <button type="submit" name="submit" value="submit"><i class="fa fa-send"></i> Login</button>
        <p >Forgot <a href="forget.php">Password</a>?</p>
        <p >Don't have an account ? <a href="signup.php">Signup</a></p>
    </form>
    
</body>
</html>