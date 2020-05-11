 
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
<!DOCTYPE html>
<html>
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
        <!-- PYTHON AUTOGRADER -->
        <form style="display: none;" method="POST" class="flx col python"  id="form" enctype="multipart/form-data" onsubmit="upload(event)">
          <legend>
            Python Autograder <span class="day">Day <?= $days; ?></span>
          </legend>
          <div class="notice flx col">
          <div id="stats2"></div>
            <div id="stats"></div>
          </div>
          <div class="fields-container">
		 <div class="field flx col">
	    	<label for="track">Track</label>
		<select id="track" name="track" value="">
                <option value="backend">Backend</option>
                <option value="frontend">Frontend</option>
                <option value="mobile">Mobile</option>
                <option value="python" selected>Python</option>
                <option value="ui">UI/UX</option>
              </select>
	    </div>
            <div class="field flx col">
              <label for="url">URL</label>
              <input id="theurl" type="url" name="url" placeholder="Enter URL" required>
              <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="https://github.com/geektutor/Leaderboard/blob/master/submission_guide.md">Submission Guidelines</a></p>
            </div>
            <div class="field flx col">
              <label for="level">Level</label>
              <select id="level" name="level" value="">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
              </select>
              <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="pyint.php">Submit for Intermediate Here</a></p>
            </div>
            <div class="field flx col">
              <label for="file">Upload file</label>
              <input id="file" type="file" name="file" required>
              <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;">Make sure you upload the correct file</p>
            </div>
            <div class="field flx col">
              <label for="comment">Comments?</label>
              <textarea id="comment" name="comment" type="text" placeholder="Any comments?" rows="5"></textarea>
            </div>
            <div class="field flx col">
            </div>
            <input type="hidden" id="task_day" name="task_day" value="Day <?= $days; ?>">
            <input type="hidden" id="name" name="name" value="<?= $_SESSION['login_user']; ?>">
          <input type="hidden" name="cohort" value="1">
          <button id="submitTask" type="submit" name="submit">Submit task</button>
          <button id="save" style="display: none;" onclick="show(event)">Save Result</button>
          </div>
        </form>

        <!-- OTHER TRACKS -->
        <form class="flx col main" enctype="multipart/form-data" onsubmit="handleSubmission(event)">
          <legend>
            Submit task <span class="day">Day <?= $days; ?></span>
            <div id="stats"></div>
          </legend>
<!--             <div class="notice flx col">
              
            </div> -->
          <div class="fields-container">
		 <div class="field flx col">
	    	<label for="track">Track</label>
		<select id="track" name="track" value="">
                <option value="backend">Backend</option>
                <option value="frontend">Frontend</option>
                <option value="mobile">Mobile</option>
                <option value="python">Python</option>
                <option value="ui">UI/UX</option>
              </select>
	    </div>
            <div class="field flx col">
              <label for="url">URL</label>
              <input id="url" type="url" name="url" placeholder="Enter URL" required>
              <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="https://github.com/geektutor/Leaderboard/blob/master/submission_guide.md">Submission Guidelines</a></p>
            </div>
            <div class="field flx col">
              <label for="level">Level</label>
              <select id="level" name="level" value="">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
              </select>
            </div>
            <div class="field flx col">
              <label for="comment">Comments?</label>
              <textarea id="comment" name="comment" type="text" placeholder="Any comments?" rows="5"></textarea>
            </div>
            <div class="field flx col">
            </div>
            <input type="hidden" id="task_day" name="task_day" value="Day <?= $days; ?>">
            <input type="hidden" id="name" name="name" value="<?= $_SESSION['login_user']; ?>">
            <input type="hidden" id="cohort" name="cohort" value="1">
            <button style="display: none;" class="submit" id="upload" type="submit" name="psubmit">Submit task</button>
            <button id="submitTask" type="submit" name="submit">Save</button>
          </div>
        </form>
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer> 
   </div>
 </div>
 <script src="../assets/js/app.js"></script>
 <script src="../assets/js/jquery-3.4.1.js"></script>
<script type="text/javascript">
  $('#track').change(function(){
    if (this.value == 'python'){
      $(".python").show();
      $(".main").hide();
    }else{
      $('.main').show();
      $('.python').hide();
    }
  });

  
  var points;
  function handleSubmission(event) {
    event.preventDefault()
    var urls = document.getElementById('url').value;
    var level = document.getElementById('level').value;
    var comment = document.getElementById('comment').value;
    var name = document.getElementById('name').value;
    var cohort = 1;
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var points;
	  var n = 1;
    var track = document.getElementById('track').value;
    var task_day = document.getElementById('task_day').value;
    var form_data = new FormData($('.main')[0]);

    $.ajax({
        url: 'py_submit.php',
        data: 'user='+name+'&track='+track+'&task_day='+task_day+'&points='+points+'&sub_date='+date+'&cohort='+cohort+'&level='+level+'&url='+urls+'&comment='+comment+'&n='+n,
        contentType: false,
        processData: false,
        type: "GET",
        success: function(data) {
          $('#stats').html(data);
          $('.notice').html('<p><br>Share on <a style="font-size: 16px;" href="https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcode.xyz%2F&via=ecxunilag&text=Day <?= $days;?>%20of%2030%3A%20Check%20out%20my%20solution%20at%3A%20'+urls+'&hashtags=30DaysOfCode%2C%2030DaysOfDesign%2C%20ecxunilag">Twitter </a></p>')

        },
        error: function() {}
    });

    
  }

  function upload(event) {
    event.preventDefault();
    // var urls = document.getElementById('theurl').value;
    var form_data = new FormData($('#form')[0]);
    var level = document.getElementById('level').value;

    if (level == 'Beginner') {
      $.ajax({
        url: 'https://autograder30days.herokuapp.com/',
        data: form_data,
        contentType: false,
        processData: false,
        type: "POST",
        success: function(data) {
          var ReturnedData = data;
          var user = ReturnedData.name;
          points = ReturnedData.score;
            $('#stats').html("Welcome " + user + ", you have scored " + points);
            $('#save').show()
        },
        error: function() {}
      });
    } else {
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
            $('#save').show()
        },
        error: function() {}
    });
    }
    
  }
  function show(event) {
    var urls = document.getElementById('theurl').value;
    var level = document.getElementById('level').value;
    var comment = document.getElementById('comment').value;
    var name = document.getElementById('name').value;
    var cohort = 1;
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var track = document.getElementById('track').value;
    var task_day = document.getElementById('task_day').value;
    var cohort = 1;

    event.preventDefault();
    $.ajax({
      url: 'py_submit.php',
      data: 'user='+name+'&track='+track+'&task_day='+task_day+'&points='+points+'&sub_date='+date+'&cohort='+cohort+'&level='+level+'&url='+urls+'&comment='+comment,
      type: "GET",
      success: function(data) {
        $('#stats2').html(data);
        // $('#stats').html("Saved");

      },
      error: function() {}
    })
  }

  
</script>
</body>
</html>
<?php
}else{
  header("location:../sign_in.php");
}
?>
