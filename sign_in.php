<?php include('./config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Sign in - 30 Days of Code</title>
 <link rel="stylesheet" href="./assets/css/form.css">
 <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
 <meta name="description" content="sign in to 30 days of code">
 <meta property="og:type" content="website">
 <meta name="keywords" content="30 days of code, sign in, log, in, engineering career expo, ECX, ecx, dsc unilag, code, design, competition">
 <meta property="og:url" content="https://30daysofcode.xyz">
 <meta property="og:site_name" content="30 days of code sign in">
 <meta property="og:image" content="./assets/img/favicon.png">
</head>
<body>
    <?php
    $error = "";
    session_start();
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['email']);
        $myPassword = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "SELECT * FROM user WHERE `email` = '$username'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //$active = $row['active'];
        $count = mysqli_num_rows($result);
        $error = "";
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1 && password_verify($myPassword, $row['password'])) {
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
                $_SESSION['university'] = $_SESSION['user_university'];
                header("location: admin/index.php?superadmin=true");
            }elseif ($row['isAdmin'] == 1) {
                //basic admin priviledges
                $_SESSION['isAdmin'] = true;
                $_SESSION['track'] = $_SESSION['user_track'];
                $_SESSION['login_user'] = $username.'_';
                $_SESSION['university'] = $_SESSION['user_university'];
                header("location: admin/index.php");
            }elseif ($row['isAdmin'] == 5) {
                //basic admin priviledges
                $_SESSION['ttt'] = $row['isAdmin'];
                $_SESSION['isAdmin'] = true;
                $_SESSION['track'] = $_SESSION['user_track'];
                $_SESSION['login_user'] = $username.'_';
                $_SESSION['university'] = $_SESSION['user_university'];
                header("location: admin/index.php");
            }else {
                header("location: user/index.php");
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

 <main class="body-content flex col">
  <h1 id="home">30 DAYS OF CODE &amp; DESIGN</h1>
  <img src="./assets/img/lbs.png" alt="learnBuildShare"/>
  <?php
    $ref = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 10, 10);
    $resetPassword = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 15, 15);
    if (@$_GET['message'] == 'success' && $ref == 'signup.php') {
        echo "<div class='notify'>Registration Successful </div>";
    }
    if (@$_GET['message'] == 'update' && $ref == 'update.php') {
        echo "<div class='notify'>Update Successful </div>";
    }
    if (@$_GET['message'] == 'success' && $resetPassword == 'newpassword.php') {
        echo "<div class='notify'>Password reset successful. Kindly log into your account.</div>";
    }
    ?>
    <?php if($error !== ''){ ?>
    <div class="notify" style="color: #991111ae;">
        <?= $error?>
    </div>
    <?php }?>

  <form method="POST">
   <fieldset>
    <legend>Sign in</legend>
    <div class="field flex col">
     <label for="user">Email</label>
     <input type="email" name="email" id="user" required>     
    </div>
    <div class="field flex col">
     <label for="password">Password</label>
     <input type="password" name="password" id="password" required>     
    </div>
   </fieldset>   
   <button type="submit" name="submit" class="flex col">SIGN IN</button>
   <div class="links">
    <p>Forgot <a href="./forgot.php">Password</a>?</p>
   <p>Don't have an account? <a href="./sign_up.php">Sign up</a></p>
   </div>
  </form>
 </main>
 <script>
  document.getElementById("home").addEventListener("click", function(){
   window.location.href = "./index.html"
  })
 </script>
</body>
</html>