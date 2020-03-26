<?php include('config/connect.php'); ?>
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
        <?php
            $error = '';
            function keys(){	
                global $conn;
                // generate a 6 digit unique shortcode
                $tokens = substr(md5(uniqid(rand(), true)),0,6);
                //check if the shortcode has being assigned to another url...if yes....regenerate another unique code 
                $query = "SELECT * FROM user WHERE `user_id` = '".$tokens."' ";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);
                if ($count > 0) {
                    keys();
                }else{
                    return $tokens;
                }
            }
            if(isset($_POST['submit'])){
                $user_id = keys();
                $nick = $_POST['nick'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $track = $_POST['track'];

                function check($email){	
                    global $conn;
                    $queryURL = "SELECT email FROM `user` WHERE user = '$email'";
                    $resultURL = mysqli_query($conn, $queryURL);
                    // $countURL = mysqli_num_rows($resultURL);
                    if ($resultURL) {
                        return 0;
                    }else{
                        return 1;
                    }
                }
                $checkIt = check($email);
                if($checkIt == 1){
                    $sql = "INSERT INTO user(`user_id`, `nickname`, `email`, `password`, `phone`,`track`) 
                            VALUES('$user_id', '$nick', '$email', '$password', '$phone','$track')";
                    if($conn->query($sql)){
                    header("location:login.php?message=success");
                    }else{
                    die('could not enter data: '. $conn->error);
                    }
                }else{
                    $error = "User already exist";
                }
            }
        ?>
        <?php if($error !== ''){ ?>
            <div class="alert alert-primary alert-dismissable">
                <?= $error?>
            </div>
        <?php }?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
          <input name="nick" placeholder="Nickname" required="" type="text" />
          <input name="email" placeholder="Email" type="email" />
          <input placeholder="Password" required="" name="password" type="password" />
          <input name="phone" placeholder="Phone" type="tel" />
          <select name="track">
            <option value="frontend">Front End</option>
            <option value="backend">Back End</option>
            <option value="android">Mobile</option>
            <option value="ui">UI/UX</option>
            <option value="python">Python</option>
            <option value="design">Engineering Design</option>
          </select>
          <button type="submit" name="submit" value="submit">SIGN UP</button>
        </form><br>
        <p>Already a user ? <a href="login.php"> Login here </a></p>
      </div>
</body>
</html>