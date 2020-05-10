<?php
require('../config/connect.php');
require('../config/session.php');
$day = strtotime("2020-04-01");
$currdates = date("Y-m-d");
$currdate = strtotime($currdates);
$diff = abs($currdate - $day);
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
$days +=1;
$show = 0;  
if(isset($_POST['submit'])){
    $error = '';
    $show = 0;
    $task_day = mysqli_real_escape_string($conn, $_POST['task_day']);
    $track = mysqli_real_escape_string($conn, $_POST['track']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $sql = "SELECT task FROM task WHERE task_day = '$task_day' AND track = '$track' AND level = '$level'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count > 0){
        while($row = mysqli_fetch_assoc($result)) {
           $error = $row['task'];
           $show = 1;
        }
    }else{
        $error =  "No task for the selected option. Check back later.";
        $show = 1;
    }
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
    <title>View task - 30 Days Of Code</title>
  </head>
  <body class="flx col">
    <header class="flx row">
      <span>#30DaysOfCode</span>
      <div class="profile flx col">
        <img src=".../assets/img/profile.png" />
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
          echo '<div class="avatar flx col"><img src=\'https://robohash.org/'.$user_nickname.$user_track.'\'/ alt="robot avatar"/></div>';
          echo '<p class="username">'.$user_nickname.'</p>';
      }
      ?>
          <ul class="linksContainer">
            <li class="flx row">
              <img src="../assets/img/profileWT.png" />
              <a href="profile.php">Profile</a>
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
              <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcode.xyz%2F&via=ecxunilag&text=<?php echo $task_day;?>%20of%2030%3A%20Check%20out%20my%20solution%20at%3A%20<?php echo $url;?>&hashtags=30DaysOfCode%2C%2030DaysOfDesign%2C%20ecxunilag">Tweet</a>
            </li>
            <li class="flx row">
              <img src="../assets/img/whatsapp.png" />
              <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
            </li>
            <li class="flx row">
              <img src="./assets/img/feedback.png" />
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
              Today's task <span class="day">Day <?= $days; ?></span>
            </legend>
            <?php if($show == 1){ ?>
            <div class="notice flx col">
              <h1 class="track"> <?= $track?> | <?= $level?></h1>
              <p>
                <?= $error?>
              </p>
            </div>
            <?php }?>
            <div class="fields-container">
              <div class="field flx col">
                <label for="day">Level</label>
                <select name="level" value="">
                  <option value="Beginner">Beginner</option>
                  <option value="Intermediate">intermediate</option>
                </select>
              </div>
              <div class="field flx col">
                <label for="track">Track</label>
                <select name="track" value="">
                  <option value="frontend">Front End</option>
                  <option value="backend">Back End</option>
                  <option value="mobile">Mobile</option>
                  <option value="ui">UI/UX</option>
                  <option value="python">Python</option>
                </select>
                <input type="hidden" name="task_day" value="" />
              </div>
              <button id="taskDownload" type="submit" name="submit">
                Check Task
              </button>
              <a href="https://github.com/geektutor/Leaderboard/blob/master/submission_guide.md">What is an accepted submission?</a>
            </div>
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
