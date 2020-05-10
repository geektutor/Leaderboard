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
 <link rel="stylesheet" href="../assets/css/style.css">
 <link rel="stylesheet" href="../assets/css/submit.css">
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
 <title>Feedback - 30 Days Of Code</title>
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
          echo '<div class="avatar flx col"><img src=\'https://robohash.org/'.$user_nickname.$user_track.'\'/ alt="robot avatar"/></div>';
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
    <main>
      <?php
      $error = "";
        if(isset($_POST['submit'])){
        $user =  $_SESSION['login_user'];
        $feedback =  mysqli_real_escape_string($conn, $_POST['feedback']);
        $sql = "INSERT INTO feedback(user, feedback) VALUES('$user','$feedback')";
        if($conn->query($sql)){
            $error = "Submitted Successfully";
            $submit = 1;
        }
        else{
            die('could not enter data: '. $conn->error);
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
          <a href="https://twitter.com/intent/tweet?url=http%3A%2F%2F30daysofcode.xyz&via=ecxunilag&text=I%20just%20completed%20&hashtags=30DaysOfCode%20">
          <button class="flx row"> <img src="../assets/img/tweet2.png"> Tweet</button>
          </a>
          <?php }?>
          </div>
              <?php }?>
       <form method="POST">
       <legend>Submit feedback</legend>
         <div class="fields-container flx col">
         <div class="field flx col">
            <label for="feedback">Anonymous Feedback?</label>
            <textarea name="feedback" type="text" placeholder="Any comments?" rows="8"></textarea>
          </div>
          <button id="submitTask" type="submit" name="submit">Submit Feedback</button>
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
  header("location:../../sign_in.php");
}
?>
