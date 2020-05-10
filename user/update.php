<?php
require('../config/connect.php');
require('../config/session.php');
if(isset( $_SESSION['login_user'])){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/profile.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
    <title>30 Days Of Code Dashboard</title>
  </head>
  <body class="flx col">
    <header class="flx row">
      <span>#30DaysOfCode</span>
      <div class="profile flx col">
        <img src="../assets/img/profile.png" />
        <ul class="options">
          <li id="logout"><a href="../../logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    <div class="pageWrapper flx row">
      <nav class="flx col" id="navPane">
        <div id="hamburger" class="flx col">
          <div class="a"></div>
          <div class="b"></div>
          <div class="c"></div>
        </div>
        <div class="flx col content">
          <ul class="linksContainer">
            <li class="flx row">
              <img src="../assets/img/profileWT.png" />
              <a href="#">Profile</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/task.png" />
              <a href="task.php">View task</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/add.png" />
              <a href="submit.php">Submit task</a>
            </li>
            <li class="flx row active">
              <img src="../assets/img/submissions.png" />
              <a href="submissions.php">Submissions</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/podium.png" />
              <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/twitter.png" />
              <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcode.xyz%2F&via=ecxunilag&text=<?php echo $task_day;?>%20of%2030%3A%20Check%20out%20my%20solution%20at%3A%20<?php echo $url;?>&hashtags=30DaysOfCode%2C%2030DaysOfDesign%2C%20ecxunilag">Tweet</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/whatsapp.png" />
              <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/feedback.png" />
              <a href="feedback.php">Feedback</a>
            </li>
          </ul>
          <span class="email">
            <?=$_SESSION['login_user'];?></span>
        </div>
      </nav>
      <div class="mainWrapper flx col" id="mainWrp">
        <main class="flx col">
         <div class="banner flx col">
         <button class="whiteBtn flx row cnt" onclick="rdr(this)">       
          <a href="index.php"> View Profile </a>
          <script>
           function rdr(elm){
            window.location.href = elm.children[0].href
           }
           </script>
         </button>
         <div class="profile-details flx col">
         <?php
          global $conn;
          $user_nickname = '';
          $user_track = '';
          $email = $_SESSION['login_user'];
          $sql = "SELECT * FROM user WHERE email='$email' ORDER BY `score` DESC LIMIT 1";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)) {
              $user_nickname = $row['nickname'];
              $first = $row['first'];
              $last = $row['last'];
              echo '<img src=\'https://robohash.org/'.$user_nickname.'\'/ alt="robot avatar" class="avatar"/>';
              echo '<p class="name">'.$first. $last.'</p>';
              echo '<p class="user">'.$user_nickname.'</p>';
          }
          ?>
         </div>
         </div>
          
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
        header('location:update.php?message=update');
        }
        else{
            $error = "Email incorrect";
        }
    }
?>
 <?php
    $ref = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 11, 11);
    $resetPassword = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 16, 16);
    $upd = substr(@$_SERVER['HTTP_REFERER'],strlen(@$_SERVER['HTTP_REFERER']) - 9, 9);
    if (@$_GET['message'] == 'update' && $upd == 'update.php') {
        echo "<div class='notify'><p>Successful</p></div>";
    }
    ?>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
   <fieldset>
    <legend>Update Acount</legend>
    <?php if($error !== ''){ ?>
    <div class="notify">
        <?= $error?>
    </div>
    <?php }?>
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
  </form>           
         
        </main>
        <footer class="flx row">
          <span class="copyw">Copyright &copy; 30DaysOfCode 2020</span>
          <div>
            <a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a>
          </div>
        </footer>
      </div>
    </div>
    <script src="../assets/js/app.js"></script>
  </body>
</html>
<?php
}else{
    header("location:../sign_in.php"); 
}
?>