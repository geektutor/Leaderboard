<?php
require('../config/connect.php');
require('../config/session.php');
if(isset( $_SESSION['login_user'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM submissions WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../assets/css/style.css">
 <link rel="stylesheet" href="../assets/css/submissions.css">
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="./../assets/img/favicon.png" type="image/x-icon">
 <title>Dashboard - 30 Days Of Code</title>
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
    <img src="../assets/img/profile.png">
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
       <ul class="linksContainer">
        <li class="flx row active">
         <img src="../assets/img/submsn.png">
         <a href="../user">User Dashboard</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/add.png">
         <a href='/admin/task/addnewtask.php'>Add New Tasks</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/allTsk.png">
         <a href="/admin/task">View Tasks</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/add.png">
         <a href="submissions.php">submissions</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/lead.png">
         <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/tweet.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
         <img class="external" style="float: right;" src="../assets/img/external.png" alt="">
        </li>
        <li class="flx row">
         <img src="../assets/img/wa.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
         <img class="external" src="../assets/img/external.png" alt="">
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main>
      <div class="flx row"><h1>Submissions</h1> </div>
      <div class="mainCard">
      <?php
    $error = "";
    if($count > 0){
while($row = $result->fetch_assoc()) {
    if (isset($_POST['submit'])) {
        $u = $_POST['user'];
        $point = $_POST['point'];
        $track = $_POST['track'];
        $level = $_POST['level'];
        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
        if ($feedback == '') {
            $feedback = "Marked";
        }
    $sql = "UPDATE submissions SET points = '$point', feedback = '$feedback' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $us = $row['user'];
        $sql_check = "SELECT * FROM leaderboard WHERE email = '$u' AND track = '$track' AND level = '$level'";
        $result_check = mysqli_query($conn, $sql_check);
        $count_check = mysqli_num_rows($result_check);
        $row_check = mysqli_fetch_array($result_check,MYSQLI_ASSOC);
        $total = intval($point) + intval($row_check['score']);
        $LId = $row_check['id'];
        if ($count_check > 0) {
            $sql_up = "UPDATE leaderboard SET score = '$total' WHERE id = '$LId' ";
            $result_up = mysqli_query($conn, $sql_up);
            // $count_up = mysqli_num_rows($result_up);
        }else{
            $sql_nick = "SELECT * FROM user WHERE email = '$us'";
            $result_nick = mysqli_query($conn, $sql_nick);
            $row_nick = mysqli_fetch_array($result_nick,MYSQLI_ASSOC);
            $nickname = $row_nick['nickname'];
            $sql_up = "INSERT INTO leaderboard(nickname, email, track, level, score) VALUES('$nickname', '$u', '$track', '$level', '$point')";
            $result_up = mysqli_query($conn, $sql_up);
            $count_up = mysqli_num_rows($result_up);
        }
        if($result_up){
            $error = "Submitted Successfully";
            header('refresh: 2; url=./submissions.php?message=success'); 
        }else{
           $error = "Could not update user";
        }
    } else {
        $error = "Could not update sub";
    }
}
?>
<?php if($error !== ''){ ?>
    <div class="notice">
        <?php echo $error?>
    </div>
<?php }?>
      <form method="POST">
        <div class="field flx col">
            <label for="url">URL</label>
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="<?php echo $row['url'];?>" target="_blank"><?php echo $row['url'];?></a></p>
          </div>
          <div class="field flx col">
            <label for="comment">Comments?</label>
            <textarea name="comment" type="text" disabled rows="5" value="<?php echo $row['comments'];?>"></textarea>
          </div>
          <div class="field flx col">
            <label for="point">Point</label>
            <input type="number" name="point" id="point" placeholder="Enter Point for This Submissions" required value="<?php echo $row['points'];?>">
          </div>
          <div class="field flx col">
            <label for="user">User</label>
            <input type="text" name="user" id="user" value="<?php echo $row['user'];?>" hidden>
          </div>
          <div class="field flx col">
          <label for="feedbaack">Feedback?</label>
            <textarea name="feedback" id="feedback" placeholder="Enter Feedback for This Submissions" value="<?php echo $row['feedback'];?>"></textarea>
          </div>
          <button id="submitTask" type="submit" name="submit">Submit task</button>
        </form> 
        <?php 
            }}else{
                echo `<p>No Submissions yet</p>`;
            }
        ?>
      </div >
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer>
   </div>
 </div>
 <script src="../assets/js/app.js"></script>
</body>
</html>
<?php
}else{
    header("location:../sign_in.php"); 
}
?>