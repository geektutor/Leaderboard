<?php
require('../config/connect.php');
require('../config/session.php');
if(isset( $_SESSION['login_user'])){
    $tt = $_SESSION['login_user'];
    $sql = "SELECT track FROM user WHERE email = '$tt'";
    $result = mysqli_query($conn, $sql);
    $row =mysqli_fetch_assoc($result);
    $track = $row['track'];
    // $university = $row['university'];

?>
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="./assets/css/style.css">
 <link rel="stylesheet" href="./assets/css/submit.css">
 <link rel="stylesheet" href="./assets/css/responsive.css">
 <link rel="shortcut icon" href="././assets/img/favicon.png" type="image/x-icon">
 <title>Submit task - 30 Days Of Code</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>#30DaysOfCode</span>
  <div class="techSymb flx row">
   <img src="./assets/img/htm.png">
   <img src="./assets/img/crly.png">
   <img src="./assets/img/prts.png">
   <img src="./assets/img/dsg.png">
  </div>
  <div class="profile flx col">
    <img src="./assets/img/profile.png">
    <ul class="options">
      <li id="logout"><a href="../../logout.php">Logout</a></li>
    </ul>
  </div>
 </header>
 <div class="pageWrapper flx row">
  <nav class="flx col closed" id="navPane">
    <div class="hamBWrapper">
      <div id="hamB" class="closed">   
        <div class="a"></div> 
        <div class="b"></div>
        <div class="c"></div>
      </div>
    </div>
     <div class="flx col content">
      <?php
      global $conn;
      $user_nickname = '';
      $user_score = '';
      $user_track = '';
      $email = $_SESSION['login_user'];
      $sql = "SELECT * FROM user WHERE email='$email' ";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)) {
          $user_nickname = $row['nickname'];
          $user_score = $row['score'];
          $user_track = $row['track'];
          echo '<div class="avatar"><img style=\'width:120px;height:120px;\' src=\'https://robohash.org/'.$user_nickname.$user_track.'\'/></div>';
          echo '<span id="username">'.$user_nickname.'</span>';
          // echo '<span id="username">'.$user_score.'&nbsp; points</div></center>';
      }
      ?>
      <div class="scoresContainer flx row">
        <div class="scoreCard flx col">
         <div class="wLayer"></div>
         <span class="title">Total points:</span>
         <span id="points"><?php echo '<center><div>'.$user_score.'&nbsp; points</div></center>';?></span>
        </div>
        <div class="scoreCard flx col">
         <div class="wLayer"></div>
         <span class="title">Total rank:</span>
           <?php
            global $conn;
            $ranking_sql = "SELECT * FROM user WHERE `isAdmin` = '0' ORDER BY `score` DESC";
            $ranking_result = mysqli_query($conn,$ranking_sql);
            if ($ranking_result) {
                $rank = 1;
                while ($row = mysqli_fetch_assoc($ranking_result)) {
                    if($row['email'] == $email){
                        echo '<span id="rank">'.$rank.'</span>';
                    }else {
                        $rank++;
                    }
                }
                
            }else {
                echo "error fetching from database";
            }
            ?>
        </div>
      </div>
      <ul class="linksContainer">
      <li class="flx row active">
         <img src="./assets/img/submsn.png">
         <a href="index.php">Submissions</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/allTsk.png">
         <a href="view.php">All tasks</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/add.png">
         <a href="submit.php">Submit task</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/cert.png">
         <a href="certification.php">Certificate</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/feedback.png">
         <a href="feedback.php">Feedback</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/lead.png">
         <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/wa.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
         <img class="external" src="./assets/img/external.png" alt="">
        </li>
          <li class="flx row">
         <img src="./assets/img/tweet.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
         <img class="external" style="float: right;" src="./assets/img/external.png" alt="">
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main>
      <div class="flx row"><h1>Submit a task</h1></div>
      <div class="mainCard">
      <?php
      $error = "";
      function check(){	
          global $conn;
          $task_day = mysqli_real_escape_string($conn, $_POST['task_day']);
          $queryURL = "SELECT task_day FROM submissions WHERE user = '".$_SESSION['login_user']."' AND task_day = '$task_day'";
          $resultURL = mysqli_query($conn, $queryURL);
          $countURL = mysqli_num_rows($resultURL);
          if ($countURL > 0) {
              return 1;
          }else{
              return 0;
          }
      }
          if(isset($_POST['submit'])){
              $url = mysqli_real_escape_string($conn, $_POST['url']);
              $task_day = mysqli_real_escape_string($conn, $_POST['task_day']);
              $track = $_SESSION['user_track'];
              $user =  mysqli_real_escape_string($conn, $_SESSION['login_user']);
              $comment =  mysqli_real_escape_string($conn, $_POST['comment']);
              $check = check();
              if(check() == 0){
                  $sql = "INSERT INTO submissions(user, track, url, task_day, comments, sub_date) 
                          VALUES('$user','$track', '$url','$task_day', '$comment', NOW())";
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
      <?php if($error !== ''){ ?>
      <div class="notice">
          <?php 
              echo $error;
              if($submit == 1){
          ?>
          <p>Share on twitter:</p>
          <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcode.xyz%2F&via=ecxunilag&text=<?php echo $task_day;?>%20of%2030%3A%20Check%20out%20my%20solution%20at%3A%20<?php echo $url;?>&hashtags=30DaysOfCode%2C%2030DaysOfDesign%2C%20ecxunilag">
          <button class="flx row"> <img src="./assets/img/tweet2.png"> Tweet</button>
          </a>
          <?php }?>
          </div>
              <?php }?>
       <form method="POST">
          <div class="field flx col">
            <label for="url">URL</label>
            <input type="url" name="url" placeholder="Enter URL" required>
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;">Python - Repl.it Url, Backend - Github repo Url, Frontend - <a href="https://steph-crown.github.io/a-guide-on-hosting/">Follow this guide</a>, UI/UX - Figma/Adobe XD Url, Engineering Design - Google Drive Url</p>
          </div>
          <div class="field flx col">
            <label for="day">Day</label>
            <select name="task_day" value="">
              <option value="Day 000">Day 0</option>
              <option value="Day 001">Day 1</option>
              <option value="Day 002">Day 2</option>
              <option value="Day 003">Day 3</option>
              <option value="Day 004">Day 4</option>
              <option value="Day 005">Day 5</option>
              <option value="Day 006">Day 6</option>
              <option value="Day 007">Day 7</option>
              <option value="Day 008">Day 8</option>
              <option value="Day 009">Day 9</option>
              <option value="Day 010">Day 10</option>
              <option value="Day 011">Day 11</option>
              <option value="Day 012">Day 12</option>
              <option value="Day 013">Day 13</option>
              <option value="Day 014">Day 14</option>
              <option value="Day 015">Day 15</option>
              <option value="Day 016">Day 16</option>
              <option value="Day 017">Day 17</option>
              <option value="Day 018">Day 18</option>
              <option value="Day 019">Day 19</option>
              <option value="Day 020">Day 20</option>
              <option value="Day 021">Day 21</option>
              <option value="Day 022">Day 22</option>
              <option value="Day 023">Day 23</option>
              <option value="Day 024">Day 24</option>
              <option value="Day 025">Day 25</option>
              <option value="Day 026">Day 26</option>
              <option value="Day 027">Day 27</option>
              <option value="Day 028">Day 28</option>
              <option value="Day 029">Day 29</option>
              <option value="Day 030">Day 30</option>
            </select>
          </div>
          <div class="field flx col">
            <label for="comment">Comments?</label>
            <textarea name="comment" type="text" placeholder="Any comments?" rows="5"></textarea>
          </div>
          <button id="submitTask" type="submit" name="submit">Submit task</button>
        </form> 
      </div >
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms & Conditions</a></div></footer> 
   </div>
 </div>
 <script src="./assets/js/app.js"></script>
</body>
</html>
<?php
}else{
  header("location:../../login.php");
}
?>
