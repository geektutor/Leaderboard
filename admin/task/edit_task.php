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
 <link rel="stylesheet" href="../../assets/css/submissions.css">
 <link rel="stylesheet" href="../../assets/css/responsive.css">
 <link rel="shortcut icon" href="./../../assets/img/favicon.png" type="image/x-icon">
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
  <div class="techSymb flx row">
   <img src="../../assets/img/htm.png">
   <img src="../../assets/img/crly.png">
   <img src="../../assets/img/prts.png">
   <img src="../../assets/img/dsg.png">
  </div>
  <div class="profile flx col">
    <img src="../../assets/img/profile.png">
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
       <ul class="linksContainer">
        <li class="flx row active">
         <img src="../../assets/img/submsn.png">
         <a href="index.php">Dashboard</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/add.png">
         <a href='/admin/task/addnewtask.php'>Add New Tasks</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/allTsk.png">
         <a href="/admin/task">View Tasks</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/add.png">
         <a href="superadmin.php">Superadmin</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/lead.png">
         <a href="https://30daysofcode.xyz/leaderboard">Leaderboard</a>
        </li>
        <li class="flx row">
         <img src="../../assets/img/tweet.png">
         <a href=" https://twitter.com/intent/tweet?url=https%3A%2F%2F30daysofcodes.xyz&via=codon&text=Hello%2C%20I%20just%20finished%20my%20task%20for%20....&hashtags=30DaysOfCode%2C%20ECX">Tweet</a>
         <img class="external" style="float: right;" src="../../assets/img/external.png" alt="">
        </li>
        <li class="flx row">
         <img src="../../assets/img/wa.png">
         <a href="https://30daysofcode.xyz/whatsapp">Support group</a>
         <img class="external" src="../../assets/img/external.png" alt="">
        </li>
       </ul>
       <span id="email"><?=$_SESSION['login_user'];?></span>
     </div>   
   </nav>
   <div class="mainWrapper flx col" id="mainWrp">
    <main>
      <div class="flx row"><h1>Edit Task</h1> </div>
      <div class="mainCard">
    <?php
    $error = "";
    if (isset($_POST['submit'])) {
        $track = $_POST['track'];
        $level = $_POST['level'];
        $task = mysqli_real_escape_string($conn, $_POST['task']);
        
        $sql = "UPDATE task SET `track` = '$track', `task` = '$task', `level` = '$level' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($conn->query($sql)) {
            $error = "Updated successfully";
        }
    }
    ?>
    <?php if($error !== ''){ ?>
        <div class="notice">
            <?= $error; ?>
        </div>
    <?php }?>
      <form method="POST">
        <div class="field flx col">
            <label for="url">URL</label>
            <p style="font-size: 12px; margin-top: 8px; line-height: 110%; color: #646464;"><a href="<?php echo $row['url'];?>" target="_blank"><?php echo $row['url'];?></a></p>
          </div>
          <div class="field flx col">
            <label for="level">Level</label>
            <select name="level" value="">
              <option value="Beginner">Beginner</option>
              <option value="Intermediate">Intermediate</option>
            </select>
          </div>
          <div class="field flx col">
            <label for="level">Track</label>
            <select name="track" value="">
              <option value="backend">Backend</option>
              <option value="frontend">Frontend</option>
              <option value="mobile">Mobile</option>
              <option value="python">Python</option>
              <option value="ui">UI/UX</option>
            </select>
          </div>
          <div class="field flx col">
          <label for="feedbaack">Task</label>
            <textarea name="task" id="mytextarea" placeholder="Enter the task" rows="7"><?php echo $row['task'];?></textarea>
          </div>
          <button id="submitTask" type="submit" name="submit">Submit task</button>
        </form> 
        <?php 
            }else{
                echo `<p>Nothing yet</p>`;
            }
        ?>
      </div >
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