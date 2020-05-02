<?php
require('../config/connect.php');
session_start();
if (!isset($_SESSION['login_user']) || empty($_SESSION['login_user'])) {
  
?>
 <script>
    document.write('You must be logged in first, redirecting to login page ...');
    setTimeout(() => {
        window.location.href = "../../login.php"
    }, 3000);
 </script>
<?php
}else{
  $id = $_GET['id'];
  $sql = "SELECT * FROM submissions WHERE id = '$id'";
  $res = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($res);
  $rw = mysqli_fetch_assoc($res);

  $day = strtotime("2020-04-01");
  $currdates = date("Y-m-d");
  $currdate = strtotime($currdates);
  $diff = abs($currdate - $day);
  $years = floor($diff / (365*60*60*24));
  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
  $days +=1;

    if (isset($_POST['submit'])) {
        global $conn;
        $url = mysqli_real_escape_string($conn, $_POST['url']);
        $level = $_POST['level'];
        $track = $_POST['track'];
        $comment =  mysqli_real_escape_string($conn, $_POST['comment']);
        $edit_sql = "UPDATE submissions SET `track` = '$track', `url`='$url', `comments` = '$comment', `level` = '$level' WHERE id = '$id'";
        // var_dump($edit_sql); die;
        $result = mysqli_query($conn,$edit_sql);
        if ($result) {
            header('location: index.php?editSubmissionReport=success');
        }else {
            header('location: index.php?editSubmissionReport=failed');;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="./assets/css/style.css">
 <link rel="stylesheet" href="./assets/css/submit.css">
 <link rel="stylesheet" href="./assets/css/responsive.css">
 <link rel="shortcut icon" href="././assets/img/favicon.png" type="image/x-icon">
 <title>Edit Submission - 30 Days Of Code</title>
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
      <li id="logout"><a href="../logout.php">Logout</a></li>
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
          <li class="flx row">
         <img src="./assets/img/submsn.png">
         <a href="index.php">Submissions</a>
        </li>
        <li class="flx row">
         <img src="./assets/img/allTsk.png">
         <a href="view.php">All tasks</a>
        </li>
        <li class="flx row active">
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
      <div class="flx row"><h1>Submit a task for Day <?= $days; ?></h1></div>
      <div class="mainCard">
        <form method="POST">
          <div class="field flx col">
            <label for="url">URL</label>
            <input type="url" name="url" placeholder="Enter URL" required value="<?=$rw['url'];?>">
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;">Python - Repl.it Url, Backend - Github repo Url, Frontend - Github repo Url(put link to your Github Pages in the readme), UI/UX - Figma/Adobe XD Url</p>
          </div>
          <div class="field flx col">
            <label for="level">Level</label>
            <select name="level" value="">
              <option value="Beginner" <?php echo ($rw['level'] == 'beginner')? 'selected' : ''; ?>>Beginner</option>
              <option value="Intermediate" <?php echo ($rw['level'] == 'intermediate')? 'selected' : ''; ?>>Intermediate</option>
            </select>
          </div>
          <div class="field flx col">
            <label for="track">Track</label>
            <select class="form-control" name="track">
              <option value="frontend" <?php echo ($rw['track'] == 'frontEnd')? 'selected' : ''; ?>>Frontend</option>
              <option value="backend" <?php echo ($rw['track'] == 'backend')? 'selected' : ''; ?>>Backend</option>
              <option value="mobile" <?php echo ($rw['track'] == 'mobile')? 'selected' : ''; ?>>Mobile</option>
              <option value="python" <?php echo ($rw['track'] == 'python')? 'selected' : ''; ?>>Python</option>
              <option value="ui" <?php echo ($rw['track'] == 'ui')? 'selected' : ''; ?>>UIUX</option>
          </select>
          </div>
          <div class="field flx col">
            <label for="comment">Comments?</label>
            <textarea name="comment" type="text" placeholder="Any comments?" rows="5"><?=$rw['comments']; ?></textarea>
          </div>
          <button id="submitTask" type="submit" name="submit">Submit task</button>
        </form>
      </div >
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer> 
   </div>
 </div>
 <script src="./assets/js/app.js"></script>
</body>
</html>
<?php
}
?>
