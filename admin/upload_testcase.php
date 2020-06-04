<?php
require('../config/connect.php');
require('../config/session.php');
include ('../user/taskday.php');
if(isset( $_SESSION['login_user'])){
   
?> 
<!DOCTYPE html>
<html lang="en">          
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../assets/css/style.css">
 <!-- <link rel="stylesheet" href="../assets/css/submissions.css"> -->
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="./../assets/img/favicon.png" type="image/x-icon">
 <title>Dashboard - 30 Days Of Code</title>
 <script src="https://cdn.tiny.cloud/1/f81u5amtw2l096zut1bx25hb08gty3ixwrax24i87te4eydg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
</head>
<body class="flx col">
 <header class="flx row">
  <span>#30DaysOfCode</span>
  <div class="profile flx col">
    <img src="../assets/img/profile.png">
    <ul class="options">
      <li id="logout"><a href="../logout.php">Logout</a></li>
    </ul>
  </div>
 </header>
 <div class="pageWrapper flx row">
  <nav class="flx col closed" id="navPane">
    <div id="hamburger" class="flx col">
      <div class="a"></div>
      <div class="b"></div>
      <div class="c"></div>
 </div>
     <div class="flx col content">
       <ul class="linksContainer">
        <li class="flx row active">
         <img src="../assets/img/profileWT.png">
         <a href="../user">User Dashboard</a>
        </li>
        <!-- <li class="flx row">
         <img src="../assets/img/add.png">
         <a href='/admin/task/addnewtask.php'>Add New Tasks</a>
        </li> -->
        <li class="flx row">
         <img src="../assets/img/task.png">
         <a href="/admin/task">View Tasks</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/lock.png">
         <a href="superadmin.php">Superadmin</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/podium.png">
         <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/twitter.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
         <img class="external" style="float: right;" src="../../assets/img/external.png" alt="">
        </li>
        <li class="flx row">
         <img src="../assets/img/whatsapp.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
         <img class="external" src="../../assets/img/external.png" alt="">
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main class="flx col">
        <?php
      $error = "";
      if (isset($_POST['submit'])) {
          $day = $_POST['day'];
          $track = $_POST['track'];
          $level = $_POST['level'];
          $task = mysqli_real_escape_string($conn, $_POST['task']);
          $sql = "INSERT INTO task(task_day, track, task, level) VALUES('$day', '$track', '$task', '$level')";
          $result = mysqli_query($conn, $sql);
          if ($result) {
              $error = "Task uploaded successfully";
          }else{
              echo "Task has not uploaded";
          }
      }
      ?>
      <form id="form" class="flx col" enctype="multipart/form-data" onsubmit="upload(event)">
        <legend>Upload test case</legend>
        <?php if($error !== ''){ ?>
          <div class="notice">
              <?= $error; ?>
          </div>
      <?php }?>
      <div class="flx col fields-container">
          <div id="stats"></div>
          <div class="field flx col">
            <label for="level">Level</label>
            <select name="level" id="level" value="">
              <option value="beginner">Beginner</option>
              <option value="intermediate">Intermediate</option>
            </select>
          </div>
          <div class="field flx col">
            <label for="track">Track</label>
            <input type="text" id="track" name="track" value="python" readonly>
          </div>
          <div class="field flx col">
            <label for="file">Upload file</label>
            <input type="file" id="file" name="file">
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;">Make sure you upload the correct file</p>
          </div>
          <div class="field flx col">
            <input type="text" name="task_view" value="Day <?= $days; ?>" disabled>
          </div>
          <div class="field flx col">
            <label for="password">Password</label>
            <input type="password" name="password" value="" placeholder="Enter your password">
          </div>
          <input type="hidden" id="task_day" name="task_day" value="Day <?= $days; ?>">
          <input type="hidden" id="name" name="name" value="<?= $_SESSION['login_user']; ?>">
          <input type="hidden" name="cohort" value="<?=$cohort;?>">
          <button id="submitTask" type="submit" name="submit">Submit task</button>
      </div>
        </form> 
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer>
   </div>
 </div>
 <script src="../../assets/js/app.js"></script>
<script>
setTimeout(() => {
    $('#success').hide(1000);
}, 2000);
</script>
<script src="../user/assets/js/jquery-3.4.1.js"></script>
 <script type="text/javascript">
   function upload(event) {
        event.preventDefault();
        var level = document.getElementById('level').value;
        var file = document.getElementById('file').value;
        var track = document.getElementById('track').value;
        var name = document.getElementById('name').value;
        var task_day = document.getElementById('task_day').value;
        var password = document.getElementById('password').value;
        var cohort = 1;
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

        var form_data = new FormData($('#form')[0]);
        console.log(form_data);
        
        $.ajax({
            url: 'https://autograder30days.herokuapp.com/test-upload/',
            data: form_data,
            contentType: false,
            processData: false,
            type: "POST",
            success: function(data) {
              $('#stats').html("Test case successfully saved");
            },
            error: function() {}
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