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
            print_r($row);
            if ($row['isAdmin'] == 2) {
                //superAdmin priviledges
                $_SESSION['isAdmin'] = true;
                $_SESSION['isSuperAdmin'] = true;
                $_SESSION['track'] = $_SESSION['user_track'];
                $_SESSION['login_user'] = $username.'_';
                header("location: admin/index.php?superadmin=true");
            }elseif ($row['isAdmin'] == 1) {
                //basic admin priviledges
                $_SESSION['isAdmin'] = true;
                $_SESSION['track'] = $_SESSION['user_track'];
                $_SESSION['login_user'] = $username.'_';
                header("location: admin/index.php");
            }else {
                header("location: user/index.php");
            }
           
        }else {
            echo $error = "Your Login Name or Password is invalid";
        }
    }

?>

 <main class="body-content flex col">
  <h1 id="home">30 DAYS OF CODE &amp; DESIGN</h1>
  <img src="./assets/img/lbs.png" alt="learnBuildShare"/>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
   <fieldset>
    <legend>Sign in</legend>
      <?php
    $ref = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 11, 11);
    $resetPassword = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 16, 16);
    if (@$_GET['message'] == 'success' && $ref == 'sign_up.php') {
        echo "<div class='notify'><p>Registration Successful</p></div>";
    }
    if (@$_GET['message'] == 'update' && $ref == 'update.php') {
        echo "<div class='notify'><p>Successful</p></div>";
    }
    if (@$_GET['message'] == 'success' && $resetPassword == 'new_password.php') {
        echo "<div class='notify'><p>Password reset successful. Kindly log into your account.</p></div>";
    }
    ?>
    <?php if($error !== ''){ ?>
    <div class="notify">
     <p>
        <?= $error?>
     </p>
    </div>
    <?php }?>
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
