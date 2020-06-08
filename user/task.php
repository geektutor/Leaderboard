<?php
require('../config/connect.php');
require('../config/session.php');
include ('taskday.php');
$show = 0; 
if(isset($_POST['submit'])){
    $error = '';
    $show = 1;
    $task_day = mysqli_real_escape_string($conn, $_POST['task_day']);
    $track = mysqli_real_escape_string($conn, $_POST['track']);
    $sql = "SELECT * FROM task WHERE track = '$track' AND `cohort` = '$cohort' ORDER BY task_day DESC";
    $resultTask = mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    <link rel="shortcut icon" href="./../assets/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0"/>
    <title>View task - 30 Days Of Code</title>
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
          <?php
      global $conn;
      $user_nickname = '';
      $user_track = '';
      $email = $_SESSION['login_user'];
      $sql = "SELECT * FROM leaderboard WHERE email='$email' ORDER BY `score` DESC LIMIT 1";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)) {
          $user_nickname = $row['nickname'];
          echo '<img src=\'https://robohash.org/'.$user_nickname.$user_track.'\'/ alt="robot avatar" class="avatar flx col"/>';
          echo '<p class="username">'.$user_nickname.'</p>';
      }
      ?>
          <ul class="linksContainer">
            <li class="flx row">
              <img src="../assets/img/profileWT.png" />
              <a href="index.php">Profile</a>
            </li>
            <li class="flx row active">
              <img src="../assets/img/task.png" />
              <a href="task.php">View task</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/add.png" />
              <a href="submit.php">Submit task</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/submissions.png" />
              <a href="submissions.php">Submissions</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/podium.png" />
              <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/twitter.png" />
              <a href="">Tweet</a>
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
          <span class="email"><?=$_SESSION['login_user'];?></span>
        </div>
      </nav>
      <div class="mainWrapper flx col" id="mainWrp">
        <main class="flx col">
          <form method="POST" class="flx col">
            <legend>
              #20DaysOfCode <span class="day">Day <?= $days; ?></span>
            </legend>
            
            <div class="fields-container">
              <div class="field flx col">
                <label for="track">Track</label>
                <select name="track" value="">
                  <option value="Backend">Backend</option>
                  <option value="Mobile">Mobile</option>
                  <option value="ML">Machine Learning</option>
                </select>
                <input type="hidden" name="task_day" value="<?= $days?>" />
              </div>
              <button id="taskDownload" type="submit" name="submit">
                Check Task
              </button>
              <a href="https://github.com/geektutor/Leaderboard/blob/master/submission_guide.md">What is an accepted submission?</a>
              <br><br>
            </div>
              <?php if($show == 1){ ?>
             <?php
            if($resultTask){
              while($row = mysqli_fetch_assoc($resultTask)) {
                $error = $row['task'];
                $track = $row['track'];
                $day = $row['task_day'];
                echo '<div class="notice flx col">';
                echo '<h1 class="track"> '.$track.' | '.$day.'</h1><br>'; 
                echo '<p>'.$error.'</p></div>';
                $show = 1;
              }
            }else{
                $error =  "No task for the selected option. Check back later.";
                $show = 1;
            }
            ?>
            <?php }?>
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
