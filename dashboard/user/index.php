<?php
require('../../config/connect.php');
require('../../config/session.php');
if(isset( $_SESSION['login_user'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="./assets/css/style.css">
 <link rel="stylesheet" href="./assets/css/submissions.css">
 <link rel="stylesheet" href="./assets/css/responsive.css">
 <title>Submissions - 30 Days Of Code</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>#30DaysOfCode</span>
  <div class="techSymb flx row">
   <img src="https://github.com/nerdyphil/Leaderboard/raw/master/dashboard/user/assets/img/htm.png">
   <img src="https://github.com/nerdyphil/Leaderboard/raw/master/dashboard/user/assets/img/crly.png">
   <img src="https://github.com/nerdyphil/Leaderboard/raw/master/dashboard/user/assets/img/prts.png">
   <img src="https://github.com/nerdyphil/Leaderboard/raw/master/dashboard/user/assets/img/dsg.png">
  </div>
  <div class="profile flx col">
    <img src="https://github.com/nerdyphil/Leaderboard/raw/master/dashboard/user/assets/img/profile.png">
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
         <img src="./assets/img/lead.png">
         <a href="https://30daysofcode.xyz/dashboard/leaderboard.php">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/tweet.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
         <img class="external" style="float: right;" src="./assets/img/external.png" alt="">
        </li>
        <li class="flx row">
         <img src="./assets/img/wa.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
         <img class="external" src="./assets/img/external.png" alt="">
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main>
      <div class="flx row"><h1>Submissions</h1> <a id="newBtn" href="submit.php">Add new</a> </div>
      <div class="mainCard">
      <?php
      if (isset($_GET['editSubmissionReport']) && !empty($_GET['editSubmissionReport'])) {
          $report = $_GET['editSubmissionReport'];
          if ($report == 'success') {
              echo "<div id='report' class='alert alert-success'>Submission edit successful</div>";
          }elseif ($report == 'failure') {
          echo "<div id='report' class='alert alert-danger'>Submission edit failed</div>";
          }else{
              echo "error";
              session_destroy();
              header('location: ../../index.php');
          }
      }
      ?>
      <?php
      $u = $_SESSION['login_user'];
      $sql = "SELECT * FROM submissions WHERE user = '$u'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);
      
     ?>
       <div class="table-responsive">
        <table class="table" style="text-align: left;">
         <thead>
          <tr>
            <th scope="col">Day</th>
            <th scope="col">Url</th>
            <th scope="col">Points</th>
            <th scope="col">Reviews</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
          if($count > 0){
              $j =1;
              while($row = $result->fetch_assoc()) {
          ?>
          <tr>
              <td><?php echo $row['task_day'];?></td>
              <td><?php echo $row['url'];?></td>
              <td><?php echo $row['points'];?></td>
              <td><?php echo $row['feedback'];?></td>
              <td><?php
                    if (empty($row['feedback'])) {
                        echo "<a href='editsubmission.php?user=".$_SESSION['login_user'].'&day='.$row['task_day']."'>Edit submission</a>";
                    }
              ?></td>

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
