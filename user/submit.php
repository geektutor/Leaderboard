  
<?php
require('../config/connect.php');
require('../config/session.php');
if(isset( $_SESSION['login_user'])){
    $tt = $_SESSION['login_user'];
    $sql = "SELECT track FROM user WHERE email = '$tt'";
    $result = mysqli_query($conn, $sql);
    $row =mysqli_fetch_assoc($result);

    $day = strtotime("2020-04-01");
    $currdates = date("Y-m-d");
    $currdate = strtotime($currdates);
    $diff = abs($currdate - $day);
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
    $days +=1;

?>
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../assets/css/style.css">
 <link rel="stylesheet" href="../assets/css/submit.css">
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
 <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0"/>
 <title>Submit task - 30 Days Of Code</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>#30DaysOfCode</span>
  <div class="profile flx col">
    <img src="../assets/img/profile.png">
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
        <li class="flx row">
          <img src="../assets/img/task.png" />
          <a href="task.php">View task</a>
        </li>
        <li class="flx row active">
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
          <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
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
        <?=$_SESSION['login_user'];?>
      </span>
    </div>
  </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main class="flx col">
      <?php
      $error = "";
      function check(){	
          global $conn;
          $url = mysqli_real_escape_string($conn, $_POST['url']);
          $task_day = mysqli_real_escape_string($conn, $_POST['task_day']);
          $track = mysqli_real_escape_string($conn, $_POST['track']);
          $user =  mysqli_real_escape_string($conn, $_SESSION['login_user']);
          $comment =  mysqli_real_escape_string($conn, $_POST['comment']);
          $level = mysqli_real_escape_string($conn, $_POST['level']);
          $cohort = 1;
          $queryURL = "SELECT * FROM submissions WHERE user = '".$_SESSION['login_user']."' AND task_day = '$task_day' AND track = '$track' AND level = '$level'";
          $resultURL = mysqli_query($conn, $queryURL);
          $countURL = mysqli_num_rows($resultURL);
          if ($countURL > 0) {
              return 1;
          }else{
              return 0;
          }
      }
          if(isset($_POST['submit'])){
              $check = check();
              if(check() == 0){
                  $url = mysqli_real_escape_string($conn, $_POST['url']);
                  $task_day = mysqli_real_escape_string($conn, $_POST['task_day']);
                  $track = mysqli_real_escape_string($conn, $_POST['track']);
                  $user =  mysqli_real_escape_string($conn, $_SESSION['login_user']);
                  $user = rtrim($_SESSION['login_user'], '_');
                  $comment =  mysqli_real_escape_string($conn, $_POST['comment']);
                  $level = mysqli_real_escape_string($conn, $_POST['level']);
                  $date = date('Y-m-d');
                  $cohort = 1;
                  $sql = "INSERT INTO submissions(user, track, url, task_day, comments, sub_date, cohort, level) 
                          VALUES('$user','$track', '$url','$task_day', '$comment', '$date', '$cohort', '$level')";
                  if($conn->query($sql)){
                      $error = "Submitted Successfully";
                      $submit = 1;
                  }else{
                  die('could not enter data: '. $conn->error);
                  }
              }else{
                  $error = "You've submitted already, wait for tomorrow's challenge";
                  $submit = 0;
              }
          }
      ?>
         <form method="POST" class="flx col">
        <legend>
          Submit task <span class="day">Day <?= $days; ?></span>
        </legend>
        <?php if($error !== ''){ ?>
          <div class="notice flx col">
              <?php 
                  echo "<p>$error</p>";
                  if ($submit == 1){
              ?>
              <p>
                <br>
                Share on <a style="font-size: 16px;" href="https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcode.xyz%2F&via=ecxunilag&text=<?php echo $task_day;?>%20of%2030%3A%20Check%20out%20my%20solution%20at%3A%20<?php echo $url;?>&hashtags=30DaysOfCode%2C%2030DaysOfDesign%2C%20ecxunilag">Twitter </a>
              </p>
              <?php }?>
            </div>
         <?php }?>
          <div class="fields-container">
            <div class="field flx col">
              <label for="url">URL</label>
              <input type="url" name="url" placeholder="Enter URL" required>
              <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="https://github.com/geektutor/Leaderboard/blob/master/submission_guide.md">Submission Guidelines</a></p>
            </div>
            <div class="field flx col">
              <label for="level">Level</label>
              <select name="level" value="">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
              </select>
            </div>
            <div class="field flx col">
              <label for="level">Track</label>
              <select name="track" value="">
                <option value="backend">Backend</option>
                <option value="frontend">Frontend</option>
                <option value="mobile">Mobile</option>
                <option value="python">Python</option>
                <option value="ui">UI/UX</option>
              </select>
            </div>
            <div class="field flx col">
              <label for="comment">Comments?</label>
              <textarea name="comment" type="text" placeholder="Any comments?" rows="5"></textarea>
            </div>
            <div class="field flx col">
            </div>
            <input type="hidden" name="task_day" value="Day <?= $days; ?>">
            <input type="hidden" name="cohort" value="1">
            <button id="submitTask" type="submit" name="submit">Submit task</button>
          </div>
        </form>
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms & Conditions</a></div></footer> 
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
