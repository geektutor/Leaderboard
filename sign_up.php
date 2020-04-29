<?php include('./config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Sign up - 30 Days of Code</title>
 <link rel="stylesheet" href="./assets/css/form.css">
 <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
 <meta name="description" content="sign up for 30 days of code">
 <meta property="og:type" content="website">
 <meta name="keywords" content="30 days of code, sign up, create account, engineering career expo, ECX, ecx, dsc unilag, code, design, competition">
 <meta property="og:url" content="https://30daysofcode.xyz">
 <meta property="og:site_name" content="30 days of code sign up">
 <meta property="og:image" content="./assets/img/favicon.png">
</head>
<body>
 <main class="body-content flex col">
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
        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'];

        function check($email){	
            global $conn;
            $queryURL = "SELECT email FROM user WHERE email = '$email'";
            $resultURL = mysqli_query($conn, $queryURL);
            $countURL = mysqli_num_rows($resultURL);
            if ($countURL == 0) {
                return 1;
            }else{
                return 0;
            }
        }
        $checkIt = check($email);
        if($checkIt){
            $sql = "INSERT INTO user(`user_id`, `first_name`, `last_name`, `nickname`, `email`, `password`, `phone`) 
                    VALUES('$user_id', '$first', '$last', '$nick', '$email', '$password', '$phone')";
            if($conn->query($sql)){
            header("location:sign_up.php?message=success");
            }else{
            die('could not enter data: '. $conn->error);
            }
        }else{
            $error = "User already exist";
        }
    }
    ?>
    <?php if($error !== ''){ ?>
    <div class="notify">
        <?= $error?>
    </div>
    <?php }?>


  <h1 id="home">30 DAYS OF CODE &amp; DESIGN</h1>
  <img src="./assets/img/lbs.png" alt="learnBuildShare"/>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
   <fieldset>
    <legend>Sign up</legend>
    <div class="field flex col">
     <label for="first">First Name</label>
     <input type="text" name="first" id="first" required>     
    </div>
    <div class="field flex col">
     <label for="last">Second Name</label>
     <input type="text" name="last" id="last" required>     
    </div>
    <div class="field flex col">
     <label for="user">Email</label>
     <input type="email" name="email" id="user" required>     
    </div>
    <div class="field flex col">
     <label for="nick">Nickname</label>
     <input type="text" name="nick" id="nick" required>     
    </div>
    <div class="field flex col">
     <label for="password">Password</label>
     <input type="password" name="password" id="password" required>     
    </div>
    <div class="field flex col">
     <label for="phone">Phone</label>
     <input type="tel" name="phone" id="phone" required>     
    </div>
    <input type="hidden" name="cohort">
   </fieldset>   
   <button type="submit" name="submit" class="flex col">SIGN UP</button>
   <div class="links">
   <p>Already a user? <a href="./sign_in.php">Sign in</a></p>
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