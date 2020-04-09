<?php include('config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Vesper+Libre&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - 30DaysOfCode</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="rajstyle.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

</head>
<body>
    <div class="wrap">
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
                $university = $_POST['university'];

                function check($email){	
                    global $conn;
                    $queryURL = "SELECT email FROM user WHERE email = '$email'";
                    $resultURL = mysqli_query($conn, $queryURL);
                    $countURL = mysqli_num_rows($resultURL);
                    if ($countURL == 0) {
                        //user doesnt not exist
                        return 1;
                    }else{
                        //user exist
                        return 0;
                    }
                }
                $checkIt = check($email);
                if($checkIt){
                    $sql = "INSERT INTO user(`user_id`, `nickname`, `email`, `password`, `phone`,`track`,`university`) 
                            VALUES('$user_id', '$nick', '$email', '$password', '$phone','$track','$university')";
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
            <div class="group">
                <?= $error?>
            </div>
        <?php }?>

        <img class="devImg" src="https://img.icons8.com/officel/80/000000/code.png">
        <form class="signup" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
            <h2>Sign Up</h2>
            
            <div class="group"><input type="email" placeholder="Email" name="email" required><i class="fa fa-envelope-open"></i></div>
            <div class="group"><input type="text" placeholder="NickName" name="nick" required><i class="fa fa-user"></i></div>
            <div class="group"><input placeholder="Password" required="" name="password" type="password" /><i class="fa fa-lock"></i></div>
            <div class="group"><input name="phone" placeholder="Phone" type="tel" /><i class="fa fa-phone-square"></i></div>
            <select name="track">
                <option value="">Track?</option>
                <option value="frontend">Front End</option>
                <option value="backend">Back End</option>
                <option value="android">Mobile</option>
                <option value="ui">UI/UX</option>
                <option value="python">Python</option>
                <option value="design">Engineering Design</option>
            </select>
            <select name="university">
                <option value="">University?</option>
                <option value="">N/A</option>
                <option value="JKUAT">JKUAT</option>
                <option value="Rongo University">Rongo University</option>
                <option value="University of The Gambia">University of The Gambia</option>
                <option value="University of Ilorin">University of Ilorin</option>
                <option value="University of Eldoret">University of Eldoret</option>
                <option value="ESUT">Enugu State University of Science and Technology</option>
            </select>
            <button type="submit" name="submit" value="submit"><i class="fa fa-send"></i>Submit</button>
            <p>Already a user ? <a href="login.php"> Login here </a></p>
        </form>
    </div>
</body>
</html>