<?php
require('../config/connect.php');
require('../config/session.php');
$msg = '';
if (isset($_SESSION['isSuperAdmin']) && $_SESSION['isSuperAdmin'] == true) {
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
         <a href="index.php">Dashboard</a>
        </li>
        <li class="flx row">
         <img src="../assets/img/add.png">
         <a href='/admin/task/addnewtask.php'>Add New Tasks</a>
        </li>
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
        </li>
        <li class="flx row">
         <img src="../assets/img/whatsapp.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main class="flx col">
      <form class="mainCard">
      <?php
        $sql = "SELECT * FROM submissions ORDER BY points ASC";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        ?>
        <legend>Submissions</legend>
       <div class="table-responsive">
        <div class="field fix col">
          <input class="" type="text" id="myInput" onkeyup="filterTable()" placeholder="Search for email..">
        </div>
        <table class="table" id="myTable" style="text-align: left;">
         <thead>
          <tr>
            <th scope="col">S/N</th>
            <th scope="col">Email</th>
            <th scope="col">Level</th>
            <th scope="col">Submission for Day</th>
            <th scope="col">Points</th>
            <th scope="col">Delete</th>
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
              <td><a href="delete_It.php?delId=<?=$row['id']?>">Delete</a></td>
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
      </form >
     </main>
     <footer class="flx row"><span class="copyw">Copyright &copy; 30DaysOfCode 2020</span> <div><a href="">Privacy Policy</a><a href="">Terms &amp; Conditions</a></div></footer>
   </div>
 </div>
 <script src="../assets/js/app.js"></script>
<script>
setTimeout(() => {
    $('#success').hide(1000);
}, 2000);

function filterTable() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
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