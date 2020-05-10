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
 <link rel="shortcut icon" href="./../assets/img/favicon.png" type="image/x-icon">
 <title>Submit task - 30 Days Of Code</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>#30DaysOfCode</span>
  <div class="techSymb flx row">
   <img src="../assets/img/htm.png">
   <img src="../assets/img/crly.png">
   <img src="../assets/img/prts.png">
   <img src="../assets/img/dsg.png">
  </div>
  <div class="profile flx col">
    <img src=".../assets/img/profile.png">
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
      $sql = "SELECT * FROM leaderboard WHERE email='$email' ORDER BY `score` DESC LIMIT 1";
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
            $ranking_sql = "SELECT * FROM leaderboard ORDER BY `score` DESC";
            $ranking_result = mysqli_query($conn,$ranking_sql);
            if ($ranking_result) {
                $rank = 1;
                while ($row = mysqli_fetch_assoc($ranking_result)) {
                    if($row['email'] == $email){
                        echo '<span id="rank">'.$rank.'</span>';
                      break; 
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
         <img src="../assets/img/submsn.png">
         <a href="submissions.php">Submissions</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/allTsk.png">
         <a href="view.php">View tasks</a>
        </li>
        <li class="flx row active">
         <img src="../assets/img/add.png">
         <a href="submit.php">Submit task</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/cert.png">
         <a href="certification.php">Certificate</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/feedback.png">
         <a href="feedback.php">Feedback</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/lead.png">
         <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/wa.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
         <img class="external" src="../assets/img/external.png" alt="">
        </li>
          <li class="flx row">
         <img src="../assets/img/tweet.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
         <img class="external" style="float: right;" src="../assets/img/external.png" alt="">
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main>
      <div class="flx row"><h1>Python Autograder</h1></div>
      <div class="mainCard">
      <div class="notice"> Ensure you fill this form correctly. </div>
       <div id="stats2"></div>
       <form id="form" enctype="multipart/form-data" onsubmit="upload(event)">
          <div id="stats"></div>
          <div class="field flx col">
            <label for="url">URL</label>
            <input type="text" id="theurl" name="url" value="" placeholder="Enter URL">
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="https://github.com/geektutor/Leaderboard/blob/master/submission_guide.md">Submission Guidelines</a></p>
          </div>
          <div class="field flx col">
            <label for="level">Level</label>
            <select name="level" id="level" value="">
              <option value="Intermediate">Intermediate</option>
            </select>
            <p style="font-size: 13px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="python.php">Submit for Beginner Here</a></p>
          </div>
          <div class="field flx col">
            <label for="track">Track</label>
            <input type="text" id="track" name="track" value="python" readonly>
          </div>
          <div class="field flx col">
            <label for="file">Upload file</label>
            <input type="file" id="file" name="file" required>
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;">Make sure you upload the correct file</p>
          </div>
           <div class="field flx col">
            <label for="comment">Comments?</label>
            <textarea name="comment" id="comment" type="text" placeholder="Any comments?" rows="5"></textarea>
          </div>
          <div class="field flx col">
            <input type="text" id="task_day" name="task_day" value="Day 9" readonly>
          </div>
          <input type="hidden" id="name" name="name" value="<?= $_SESSION['login_user']; ?>">
          <input type="hidden" name="cohort" value="1">
          <button id="submitTask" type="submit" name="submit">Submit task</button>
          <button onclick="show(event)">Save Result</button>
        </form> 
      </div >
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer> 
   </div>
 </div>
 <script src="../assets/js/app.js"></script>
 <script src="assets/js/jquery-3.4.1.js"></script>
 <script type="text/javascript">
  var level = document.getElementById('level').value;
  var file = document.getElementById('file').value;
  var track = document.getElementById('track').value;
  var name = document.getElementById('name').value;
  var task_day = document.getElementById('task_day').value;
  var urls = document.getElementById('theurl').value;
  var comment = document.getElementById('comment').value;
  var cohort = 1;
  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  var points;
  function upload(event) {
    event.preventDefault();
    var urls = document.getElementById('theurl').value;
    var form_data = new FormData($('#form')[0]);
    
    $.ajax({
        url: 'https://autograder30int.herokuapp.com/',
        data: form_data,
        contentType: false,
        processData: false,
        type: "POST",
        success: function(data) {
          var ReturnedData = data;
          var user = ReturnedData.name;
          points = ReturnedData.score;
            $('#stats').html("Welcome " + user + ", you have scored " + points);
        },
        error: function() {}
    });
  }
  function show(event) {
    var urls = document.getElementById('theurl').value;
    var task_day = document.getElementById('task_day').value;
    var comment = document.getElementById('comment').value;
    event.preventDefault();
    $.ajax({
      url: 'py_submit.php',
      data: 'user='+name+'&track='+track+'&task_day='+task_day+'&points='+points+'&sub_date='+date+'&cohort='+cohort+'&level='+level+'&url='+urls+'&comment='+comment,
      type: "GET",
      success: function(data) {
        $('#stats2').html(data);
        $('#stats').html("Saved");

      },
      error: function() {}
    })
  }
 </script>
</body>
</html>
<?php
}else{
  header("location:../login.php");
}
?>
