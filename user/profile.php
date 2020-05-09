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
    <title>30 Days Of Code dashboard</title>
  </head>
  <body class="flx col">
    <header class="flx row">
      <span>#30DaysOfCode</span>
      <div class="profile flx col">
        <img src="./assets/img/profile.png" />
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
         <div class="banner flx col">
         <button class="whiteBtn flx row cnt" onclick="rdr(this)">       
          <a href=""> Update profile </a>
          <script>
           function rdr(elm){
            window.location.href = elm.children[0].href
           }
           </script>
         </button>
         <div class="profile-details flx col">
          <div class="avatar">
           <img src="" alt="robot avatar">
          </div>
          <p class="name">Akinjobi Sodiq</p>
          <p class="user">Geektutor</p> 
         </div>
         </div>
          <div class="scores-card flx row">
           <div class="group flx col cnt frontend">
            <img src="../assets/img/medal.png" alt="">
            <p class="rank">20</p>
            <p class="track">frontend</p>
            <p class="level">intermediate</p>
            <p class="points">200 points</p>
           </div>
           <div class="group flx col cnt backend">
            <img src="../assets/img/medal.png" alt="">
            <p class="rank">20</p>
            <p class="track">backend</p>
            <p class="level">intermediate</p>
            <p class="points">200 points</p>
           </div>
           <div class="group flx col cnt python">
            <img src="../assets/img/medal.png" alt="">
            <p class="rank">20</p>
            <p class="track">python</p>
            <p class="level">intermediate</p>
            <p class="points">200 points</p>
           </div>
           <div class="group flx col cnt mobile">
            <img src="../assets/img/medal.png" alt="">
            <p class="rank">20</p>
            <p class="track">mobile</p>
            <p class="level">intermediate</p>
            <p class="points">200 points</p>
           </div>
           <div class="group flx col cnt ui">
            <img src="../assets/img/medal.png" alt="">
            <p class="rank">20</p>
            <p class="track">ui/ux</p>
            <p class="level">intermediate</p>
            <p class="points">200 points</p>
           </div>
         </div>
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
