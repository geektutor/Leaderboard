<?php
require('../config/connect.php');
require('../config/session.php');
if(isset( $_SESSION['login_user'])){
    $tt = $_SESSION['login_user'];
    $sql = "SELECT * FROM user WHERE email = '$tt'";
    $result = mysqli_query($conn, $sql);
    $certify = 0;
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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0"/>
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
              <a href="#">Tweet</a>
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
              $first = $row['first_name'];
              $last = $row['last_name'];
              echo '<img src=\'https://robohash.org/'.$user_nickname.'\'/ alt="robot avatar" class="avatar"/>';
              echo '<p class="name">'.$first. $last.'</p>';
              echo '<p class="user">'.$user_nickname.'</p>';
          }
          ?>
         </div>
         </div>
          <div class="scores-card flx row">
           <?php
            global $conn;
            $ranking_sql = "SELECT * FROM leaderboard ORDER BY `score` DESC";
            $ranking_result = mysqli_query($conn,$ranking_sql);
            if ($ranking_result) {
                $rank = 1;
                while ($row = mysqli_fetch_assoc($ranking_result)) {
                    if($row['email'] == $email & $row['score'] > 220){
                        $track = $row['track'];
                        $score = $row['score'];
                        $level = $row['level'];
                        echo '<div class="group flx col cnt '.$track.'">';
                        echo '<img src="../assets/img/medal.png" alt="">';
                        echo '<p class="rank">'.$rank.'</p>';
                        echo '<p class="track">'.$track.'</>';
                        echo '<p class="level">'.$level.'</p>';
                        echo '<p class="points">'.$score.' points</p>';
                        echo '</div>';
                        $track = strtoupper($track);
                        echo '<form method="POST">
   <fieldset>
    <legend>Certificate Generator</legend>
    <div class="field flex col">
     <label for="first">First Name</label>
      <input type="name" name="first" id="first" placeholder="First Name" value="<?php echo $first; ?>" required disabled>
     </div> 
     <div class="field flex col">
     <label for="last">Last Name</label>
      <input type="name" name="last" id="last" placeholder="Last Name" value="<?php echo $last; ?>" required disabled>
     </div>
    <div class="field flex col">
     <label for="user">Track</label>
      <input type="name" name="track" id="track" value="<?php echo $track; ?>" required disabled>
    </div>
       <div class="field flex col">
     <label for="user">Level</label>
      <input type="name" name="level" id="level" value="<?php echo $level; ?>" required disabled>
    </div>
   </fieldset>
  <button id="submitTask" type="submit" name="submit" value="submit">Receive Certificate</button>          
          </form>';
                    }else {
                        $rank++;
                    }
                }
                
            }else {
                echo "error fetching from database";
            }
            ?>
             </div> 
        <?php  
            if (isset($_POST['submit'])){
              $certify = 0;
              $sentence = "http://try30daysofcode.pythonanywhere.com/generate/?first_name={$first}&last_name={$last}&track={$track}&level={$level}";
              $stripped = str_replace(' ', '', $sentence);
              if ($stripped) {
                $certify = 1;
              } else {
                echo "Certificate does not exists.";
              }
            }
          ?>

   <?php if ($certify == 1){ ?>
        <div class="notify"><a href="javascript:void(0)" onclick="location.href='<?php echo $stripped;?>'" target="_blank"><button>Download Certificate</button></a></div>
  <?php } ?>
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
<script src="../assets/js/jquery-3.4.1.js"></script>
<script type="text/javascript">
  function check(event) {
      event.preventDefault();
      var track = document.getElementById('track').value;
      var first = document.getElementById('first').value;
      var last = document.getElementById('last').value;
      var level = document.getElementById('level').value;

      $.ajax({
          url: 'http://try30daysofcode.pythonanywhere.com/generate/',
          data: 'first_name='+first+'&last_name='+last+'&track='+track+'&level='+level,
          type: "GET",
          success: function(data) {
             $('#stats').html(data);
          },
          error: function() {
             $('#stats').html();
          }
      });
      
  }
</script>
  </body>
</html>
<?php
}else{
    header("location:../sign_in.php"); 
}
?>
