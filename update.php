<?php include('./config/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Update Account - 30 Days of Code</title>
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
    if(isset($_POST['submit'])){
        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $nick = $_POST['nick'];
        $sql = "UPDATE `user` SET 
       `first_name` = '$first', 
       `last_name` = '$last',
       `nickname` = '$nick'
        WHERE `email` = '$email' ";
       $result = mysqli_query($conn,$sql);
        if($result){
        header('location:sign_in.php?message=update');
        }
        else{
            $error = "Email incorrect";
        }
    }
?>
    <?php if($error !== ''){ ?>
    <div class="notify">
        <?= $error?>
    </div>
    <?php }?>

  <h1 id="home">30 DAYS OF CODE</h1>
  <img src="./assets/img/lbs.png" alt="learnBuildShare"/>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
   <fieldset>
    <legend>Update Acount</legend>
    <div class="field flex col">
     <label for="nick">Nick Name</label>
     <input type="text" name="nick" id="nick" pattern="[A-Za-z0-9]+" required>     
    </div>
    <div class="field flex col">
     <label for="first">First Name</label>
     <input type="text" name="first" id="first" required>     
    </div>
    <div class="field flex col">
     <label for="last">Last Name</label>
     <input type="text" name="last" id="last" required>     
    </div>
    <div class="field flex col">
     <label for="user">Email</label>
     <input type="email" name="email" id="user" required>     
    </div>
   </fieldset>   
   <button type="submit" name="submit" class="flex col">Update Details</button>
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
