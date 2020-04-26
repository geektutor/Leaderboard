<?php
require('../../config/connect.php');
require('../../config/session.php');
if(isset( $_SESSION['login_user'])){
    $tt = $_SESSION['login_user'];
    $sql = "SELECT track FROM user WHERE email = '$tt'";
    $result = mysqli_query($conn, $sql);
    $row =mysqli_fetch_assoc($result);
    $track = $row['track'];
?>
<?php  
            if (isset($_POST['submit'])){
              $type = $_POST['type'];
              $first = $_POST['first'];
              $last = $_POST['last'];
              $track = $_POST['track'];
              $certify = 1;
              $response = file_get_contents("http://30days.autocaps.xyz/generate/?type={type}&first_name={first}&last_name={last}&track={track}");
              $file_name = basename($response);              
            }
          ?>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="./assets/css/style.css">
 <link rel="stylesheet" href="./assets/css/submit.css">
 <link rel="stylesheet" href="./assets/css/responsive.css">
 <title>Certification - 30 Days Of Code</title>
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
          $performance = $row['score'];
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
      <div> 
     <div class="mainCard">
      <form method="POST">
          <div class="field flx col">
          <?php
            $user = $_SESSION['login_user'];
            $sql = "SELECT DISTINCT `sub_date` FROM submissions WHERE `user` = {user}";
            $result = mysqli_query($conn,$sql);
    if ($result) {
                if(mysqli_num_rows($result) <= 15){ ?>
                    <p>You're not eligible to be certified</p>
                <?php }else { ?>
                    <p style='font-size: 1em; margin-top: 8px; line-height: 110%; color: #646464;'>
                      Congratulations, on your completion of the 30 days of code challenge.
                    </p>
              <div class="mainCard">
              <a href="<?php echo $response;?>"><button>Download Certificate</button></a>
         </div>
          </div>
          <input type="hidden" name="track" id="track" value="<?php echo $user_track; ?>">
          <div class="field flx col">
            <label for="firstname">First Name</label>
            <input type="name" name="first" id="first" placeholder="First Name" required>
          </div>
          <div class="field flx col">
            <label for="lastname">Last Name</label>
            <input type="name" name="last" id="last" placeholder="Last Name" required>
          </div>
          <div class="field flx col">
            <label for="day">Type?</label>
            <select name="type" id="type" value="">
              <option value="1">Certificate of Participation</option>
              <option value="<?php echo $performance; ?>">Certificate of Performance</option>
            </select>
          </div>
          <button id="submitTask" type="submit" name="submit" value="submit">Receive Certificate</button>
                    
            <?php   }
              }
                ?>
        </form>
        </div>
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer> 
   </div>
 </div>
 <script src="./assets/js/app.js"></script>
<script src="../scripts/jquery-3.4.1.js"></script>
<script type="text/javascript">
  function check(event) {
      event.preventDefault();
      var track = document.getElementById('track').value;
      var first = document.getElementById('first').value;
      var last = document.getElementById('last').value;
      var type = document.getElementById('type').value;

      $.ajax({
          url: 'http://30days.autocaps.xyz/generate/',
          data: 'type='+type+'&first_name='+first+'&last_name='+last+'&track='+track,
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
  header("location:../../login.php");
}
?>
