<?php
require('../config/connect.php');
require('../config/session.php');
$msg = '';
if(isset( $_SESSION['login_user']) && $_SESSION['isAdmin'] == true){
    $track = $_SESSION['track'];     
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
         <a href="index.php">Dashboard</a>
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
         <a href="superadmin.php">Superadmin</a>
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
        $sql = "SELECT * FROM submissions WHERE  track = 'python' AND level = 'Beginner' AND task_day > 'Day 7' AND points < 9 AND feedback = 'Marked by AutoGrader V2' ORDER BY points ASC";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        ?>
       <div class="table-responsive">
        <table class="table" style="text-align: left;">
         <thead>
          <tr>
            <th scope="col">S/N</th>
            <th scope="col">Email</th>
            <th scope="col">Level</th>
            <th scope="col">Submission for Day</th>
            <th scope="col">Points</th>
            </tr>
        </thead>
        <tbody>
          <?php          
          if($count > 0){
              $j =1;
              while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
              <td data-label="S/N"><?php echo $j;?></td>
              <td data-label="Email"><a href="view.php?id=<?php echo $row['id'];?>"><?php echo $row['user'];?></a></td>
              <td data-label="Level"><?php echo $row['level'];?></td>
              <td data-label="Submission For Day"><?php echo $row['task_day'];?></td>
              <td data-label="Points"><?php echo $row['points'];?></td>
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
    echo "<script>
        document.write('you do not have access to this page, redirecting to login page ...');
        setTimeout(()=>{
            window.location.href = '../../sign_in.php'
        },2000)
    </script>";
}
?>