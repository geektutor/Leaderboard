<?php
require('../config/connect.php');
require('../config/session.php');
if(isset( $_SESSION['login_user']) && $_SESSION['isAdmin'] == true){
    if (isset($_POST['submit'])) {
        $track = $_POST['track'];
        $level = $_POST['level'];
        header("location: submissions.php?track=$track&level=$level");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../assets/css/style.css">
 <link rel="stylesheet" href="../assets/css/profile.css">
 <link rel="stylesheet" href="../assets/css/submissions.css">
 <link rel="stylesheet" href="../assets/css/responsive.css">
 <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
 <title>Dashboard - 30 Days Of Code</title>
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
  <nav class="flx col" id="navPane">
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
        <li class="flx row">
         <img src="../assets/img/add.png">
         <a href='task/addnewtask.php'>Add New Tasks</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/task.png">
         <a href="task/index.php">View Tasks</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/lock.png">
         <a href="superadmin.php">Super Admin</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/podium.png">
         <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/twitter.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
         <img class="external" style="float: right;" src="../assets/img/external.png" alt="">
        </li>
        <li class="flx row">
         <img src="../assets/img/whatsapp.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
         <img class="external" src="../assets/img/external.png" alt="">
        </li>
       </ul>
       <span class="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main>
      <div class="flx row"><h1>Submissions</h1> </div>
      <div class="mainCard">
       <!--  <form method="POST">
            <div class="field flx col">
              <label for="track">Track</label>
              <select name="track" value="">
                <option value="backend">Backend</option>
                <option value="frontend">Frontend</option>
                <option value="mobile">Mobile</option>
                <option value="python">Python</option>
                <option value="ui">UI/UX</option>
              </select>
            </div>
    <main class="flx col">
      <form method="POST">
        <legend>Submissions</legend>
    <div class="flx col fields-container">
    <div class="field flx col">
            <label for="track">Track</label>
            <select name="track" value="">
              <option value="backend">Backend</option>
              <option value="frontend">Frontend</option>
              <option value="mobile">Mobile</option>
              <option value="python">Python</option>
              <option value="ui">UI/UX</option>
            </select>
          </div>

            <div class="field flx col">
              <label for="track">Level</label>
              <select name="level" value="">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
              </select>
            </div>
            <button id="submitTask" type="submit" name="submit">Submit</button>
          </form>  -->
        <div class="scores-card flx row">
           <?php
            global $conn;
            // $tracks = [
              
            // ];
            $tracks = [
             'Begineer' => [
              'frontend' => 'Beginner', 
              'backend' => 'Beginner', 
              'mobile' => 'Beginner', 
              'python' => 'Beginner', 
              'ui' => 'Beginner' 
              ],
              'Intermediate'=> [
              'frontend' => 'Intermediate', 
              'backend' => 'Intermediate',
              'mobile' => 'Intermediate',
              'python' => 'Intermediate',
              'ui' => 'Intermediate'
              ]
            ];
            foreach ($tracks as $track) {
              foreach ($track as $key => $value) {
                $track_submission = "SELECT * FROM submissions WHERE track = '$key' AND level = '$value' AND points = 0";
                $result = mysqli_query($conn, $track_submission);
                $count = mysqli_num_rows($result);
                echo '<div class="group field flx col cnt '.$key.'">';
                echo '<img src="../assets/img/medal.png" alt="">';
                echo '<p class="track">'.$key.'</p>';
                echo '<p class="track">'.$value.'</p>';
                echo '<p class="points">Unmarked: '.$count++.'</p>';
                echo '<a href=submissions.php?track='.$key.'&level='.$value.'><p class=level>Check</p></a>';
                echo '</div>';
              }
            }
           
            ?>
          <!--   <div class="group flx col cnt python">
              <img src="../assets/img/medal.png" alt="">
              <p class="rank">Helo</p>
              <p class="track">Python</p>
              <p class="level">Intermediate</p>
              <p class="points">150</p>
            </div> -->
          
         </div>
          <button id="submitTask" type="submit" name="submit">Submit</button>
    </div>
        </form> 
     
      
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer>
   </div>
 </div>
 <script src="../assets/js/app.js"></script>
<script>
setTimeout(() => {
    $('#success').hide(1000);
}, 2000);
</script>
</body>
</html>
<?php
}else{
    header("location:../../sign_in.php"); 
}
?>