<?php
require('../../config/connect.php');
require('../../config/session.php');
include ('../../user/taskday.php');

if(isset( $_SESSION['login_user']) && $_SESSION['isAdmin'] == true){
  $track = $_GET['track'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../../assets/css/style.css">
 <link rel="stylesheet" href="../../assets/css/submissions.css">
 <link rel="stylesheet" href="../../assets/css/responsive.css">
 <link rel="shortcut icon" href="../../assets/img/favicon.png" type="image/x-icon">
 <title>Dashboard - 30 Days Of Code</title>
</head>
<body class="flx col">
 <header class="flx row">
  <span>#30DaysOfCode</span>
  <div class="profile flx col">
    <img src="../../assets/img/profile.png">
    <ul class="options">
      <li id="logout"><a href="../../logout.php">Logout</a></li>
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
         <img src="../../assets/img/profileWT.png">
         <a href="../../user">User Dashboard</a>
        </li>
        <!-- <li class="flx row">
         <img src="../../assets/img/add.png">
         <a href='/task/addnewtask.php'>Add New Tasks</a>
        </li> -->
        <li class="flx row">
         <img src="../../assets/img/task.png">
         <a href="/task">View Tasks</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/lock.png">
         <a href="../superadmin.php">Superadmin</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/podium.png">
         <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/twitter.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/whatsapp.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main class="flx col">
      <form class="mainCard">
        <legend>Tasks <a id="newBtn" href="addnewtask.php">Add new</a></legend>
      <?php
        $current = date('Y-m-d');
        $sql = "SELECT * FROM task WHERE `track` = '$track' AND `cohort` = '$cohort' ORDER BY task_day";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
    ?>
       <div class="table-responsive">
        <table class="table" style="text-align: left;">
         <thead>
          <tr>
            <th scope="col">S/N</th>
            <th scope="col">Day</th>
            <th scope="col">Track</th>
            <th scope="col">Task</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
          <?php          
          if($count > 0){
              $j =0;
              while($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
              <td data-label="S/N"><?php echo $j;?></td>
              <td data-label="Day"><?= $row['task_day']; ?></td>
              <td data-label="Track"><?= $row['track'];?></td>
              <td data-label="Task"><?= $row['task'];?></td>
              <td data-label="Action"><a href="edit_task.php?id=<?=$row['id']?>">Edit</a> | <a href="delete.php?id=<?=$row['id']?>">Delete</a></td>
          </tr>
          <?php 
              $j++;
              }}else{
                  echo `<p>No tasks yet</p>`;
              }
          ?>
        </tbody>
        </table>
      </div>
      </form >
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
</body>
</html>
<?php
}else{
    header("location:../../sign_in.php"); 
}
?>