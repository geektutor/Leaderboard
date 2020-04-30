<?php include('./config/connect.php'); 
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
       header('location:sign_in.php?message=success');
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
 <title>Set new password - 30 Days of Code</title>
 <link rel="stylesheet" href="./assets/css/form.css">
 <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
</head>
<body>
 <main class="body-content flex col">
  <h1 id="home">30 DAYS OF CODE & DESIGN</h1>
  <img src="./assets/img/lbs.png" alt="learnBuildShare"/>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
   <fieldset>
    <legend>Set new passowrd</legend>
    <p style="margin-bottom: 25px;">Reset password for: <span id="reset-user" style="font-weight: 600;"><?php echo $_SESSION['password_session']?></span></p>    
    <div class="field flex col">
     <label for="npassword">New password</label>
     <input type="password" name="npassword" id="password" required>     
    </div>
    <div class="field flex col">
     <label for="cnpassword">Confirm password</label>
     <input type="password" name="cnpassword" id="cnpassword" required>     
    </div>
   </fieldset>   
   <button class="flex col">RESET</button> 
  </form>
 </main>
 <script>
  document.getElementById("home").addEventListener("click", function(){
   window.location.href = "./index.html"
  })
 </script>
 <script src="check.js"></script>
</body>
</html>