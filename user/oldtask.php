<?php
require('../config/connect.php');
require('../config/session.php');
include ('taskday.php');  

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
        <form method="POST" class="flex col" action="tasks.php">
          <legend>Tasks</legend>
          <div class="fields-container flx col">
             <div class="field fix col">
              <select id="day" name="day">
                <?php for($i = $days; $i > 0; $i--): ?>
                  <option value="Day <?=$i; ?>">Day  <?=$i;?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="field flx col">
              <label for="track">Track</label>
              <select name="track" value="">
                <option value="backend">Backend</option>
                <option value="frontend">Frontend</option>
                <option value="mobile">Mobile</option>
                <option value="python">Python</option>
                <option value="ui">UI/UX</option>
              </select>
            </div>

            <div class="field flx col">
              <label for="track">Level</label>
              <select name="level" value="">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
              </select>
            </div>

            <button id="submitTask" type="submit" name="submit">Submit</button>
          </div>
          </form> 
       
     
       </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer>
   </div>
    </div>
    <script src="../assets/js/app.js"></script>
  </body>
</html>
