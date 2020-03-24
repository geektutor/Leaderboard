<?php include('config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="signup.css">
    <title>Leaderboard  - Login</title>
</head>
<body>
    <div class="contact-us">
        <?php
            session_start();
            if (isset($_POST['submit'])) {
                $username = mysqli_real_escape_string($conn, $_POST['email']);
                $myPassword = mysqli_real_escape_string($conn, $_POST['password']);
                $sql = "SELECT * FROM user WHERE `email` = '$username' AND `password` = '$myPassword'";
        
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $active = $row['active'];
                $count = mysqli_num_rows($result);
              // If result matched $myusername and $mypassword, table row must be 1 row
                if($count == 1) {
                    $_SESSION['login_user'] = $username;
                    header("location: dashboard/dist/index.html");
                }else {
                $error = "Your Login Name or Password is invalid";
                }
            }
        
        ?>
        <form method="POST">
          <input name="email" placeholder="email" required="" type="email" value="" />
          <input name="password" placeholder="password" type="password" value="" required/>
          <button type="submit" name="submit" value="submit">Login</button>
        </form>
      </div>
</body>
</html>