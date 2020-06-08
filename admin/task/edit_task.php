<?php
require('../../config/connect.php');
require('../../config/session.php');
if(isset( $_SESSION['login_user'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM task WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="../../assets/css/style.css">
 <!-- <link rel="stylesheet" href="../../assets/css/submissions.css"> -->
 <link rel="stylesheet" href="../../assets/css/responsive.css">
 <link rel="shortcut icon" href="./../../assets/img/favicon.png" type="image/x-icon">
 <title>Dashboard - 30 Days Of Code</title>
 <script src="https://cdn.tiny.cloud/1/f81u5amtw2l096zut1bx25hb08gty3ixwrax24i87te4eydg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
      tinymce.init({
        selector: '#mytextarea',
        plugins: 'link',
      });
    </script>
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
  <nav class="flx col" id="navPane">
    <div id="hamburger" class="flx col">
      <div class="a"></div>
      <div class="b"></div>
      <div class="c"></div>
 </div>
     <div class="flx col content">
       <ul class="linksContainer">
        <li class="flx row active">
         <img src="../../assets/img/profileWT.png">
         <a href="index.php">Dashboard</a>
        </li>
        <!-- <li class="flx row">
         <img src="../../assets/img/add.png">
         <a href='/admin/task/addnewtask.php'>Add New Tasks</a>
        </li> -->
        <li class="flx row">
         <img src="../../assets/img/task.png">
         <a href="/admin/task">View Tasks</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/lock.png">
         <a href="superadmin.php">Superadmin</a>
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
    <?php
    $error = "";
    if (isset($_POST['submit'])) {
        $track = $_POST['track'];
        $task = mysqli_real_escape_string($conn, $_POST['task']);
        $sql = "UPDATE task SET `track` = '$track', `task` = '$task' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($conn->query($sql)) {
            $error = "Updated successfully";
            
        }
    }
    ?>

      <form method="POST" class="flx col">
        <legend>Edit Task</legend>
        <?php if($error !== ''){ ?>
          <div class="notice">
              <?= $error; ?>
          </div>
      <?php }?>
      <div class="fields-container flx col">
        <div class="field flx col">
          <label for="url">Current Task Details</label>
          <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;">Day - <?php echo $row['task_day'];?> | Track -  <?php echo $row['track'];?> </p>
        </div>
        
        <div class="field flx col">
          <label for="level">Track</label>
          <select name="track" value="">
          <option value="Backend">Backend</option>
          <option value="Mobile">Mobile</option>
          <option value="ML">Machine Learning</option>
          </select>
        </div>
        <div class="field flx col">
        <label for="feedbaack">Task</label>
          <textarea name="task" id="mytextarea" placeholder="Enter the task" rows="7"><?php echo $row['task'];?></textarea>
        </div>
        <button id="submitTask" type="submit" name="submit">Submit task</button>
      </div>
        </form> 
        <?php 
            }else{
                echo `<p>Nothing yet</p>`;
            }
        ?>
    
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
