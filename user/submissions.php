<?php
require('../config/connect.php');
require('../config/session.php');
include ('taskday.php');
if(isset( $_SESSION['login_user'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../assets/css/style.css">
 <link rel="stylesheet" href="../assets/css/submissions.css">
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
 <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0"/>
 <title>Submissions - 30 Days Of Code</title>
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
      <?php
      if (isset($_GET['editSubmissionReport']) && !empty($_GET['editSubmissionReport'])) {
          $report = $_GET['editSubmissionReport'];
          if ($report == 'success') {
              echo "<div id='report' class='notice'>Submission edit successful</div>";
          }elseif ($report == 'failure') {
          echo "<div id='report' class='notice'>Submission edit failed</div>";
          }else{
              echo "error";
              session_destroy();
              header('location: ../../index.php');
          }
      }
      ?>
      <?php
      $u = $_SESSION['login_user'];
      $u = rtrim($u, '_');
      $sql = "SELECT * FROM submissions WHERE `user` = '$u' AND `cohort` = '$cohort' ";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      
     ?>    
     <form>
      <legend>
        Submit task  <a id="newBtn" href="./submit.php">Add new</a>
      </legend>
      <div class="table-responsive">
        <table class="table" style="text-align: left;">
         <thead>
          <tr>
            <th scope="col">Day</th>
            <th scope="col">Url</th>
            <th scope="col">Points</th>
            <th scope="col">Action</th>
            <th scope="col">Feedback</th>
            <th scope="col">Track</th>
          </tr>
        </thead>
        <tbody>
          <?php          
          if($count > 0){
              $j =1;
              while($row = $result->fetch_assoc()) {
          ?>
          <tr>
              <td data-label="DAY">&nbsp;<?php echo $row['task_day'];?></td>
              <td data-label="URL">&nbsp;<a href="<?php echo $row['url'];?>">View Link</a></td>
              <td data-label="POINTS">&nbsp;<?php echo $row['points'];?></td>
              <?php if ($row['points'] == 0) {?>
              <td data-label="ACTION">&nbsp;<a href="editsubmission.php?id=<?=$row['id']?>">Edit</a></td>
              <?php }else{?>
              <td data-label="ACTION">N/A</td>
              <?php } ?>
              <td data-label="FEEDBACK">&nbsp;<?php echo $row['feedback'];?></td>
              <td data-label="TRACK">&nbsp;<?php echo $row['track'];?></td>
          </tr>
          <?php 
              $j++;
              }}else{
                  echo `<p>No Submissions yet</p>`;
              }
          ?>
        </tbody>
        </table>
      </div>
     </form>  
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer>
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
