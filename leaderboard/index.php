<?php
include "../config/connect.php";
$userRanking = [];
//user class for each fetched user
class User
{
    public $nickname;
    public $track;
    public $level;
    public $score;

    function __construct($nickname,$track,$level,$score){
    $this->nickname = $nickname;
    $this->track = $track;
    $this->level = $level;
    $this->score = $score;
    }
}
function makeSQL($track,$level){
  if (($level == 'beginner' || $level == 'intermediate') and ($track !== 'general' and $level !== 'general')) {
    $sql = "SELECT * FROM leaderboard WHERE `track` = '$track' AND `level`='$level' ORDER BY `score` DESC LIMIT 20";
  }elseif ($track == 'general' and $level !== 'general') {
    $sql = "SELECT * FROM leaderboard WHERE `level`='$level' ORDER BY `score` DESC LIMIT 20";
  }elseif ($level == 'general' and $track !== 'general') {
    $sql = "SELECT * FROM leaderboard WHERE `track` = '$track' ORDER BY `score` DESC LIMIT 20";
  }else {
    $sql = "SELECT * FROM leaderboard ORDER BY `score` DESC LIMIT 20";
  }

  return $sql;
}
//categories for filter 
if (isset($_GET['track']) and isset($_GET['level'])) {
    $track = $_GET['track'];
     $level = $_GET['level'];    
    
     if ($track == 'backend' || $track == 'frontend' || $track == 'mobile' || $track == 'python' || $track == 'ui') {
       $sql = makeSQL($track,$level);
     }elseif($track == 'general'){
       $sql = makeSQL('general',$level);
     }else {
       $sql = makeSQL('general','general');
     }
     
}else{
  $sql = makeSQL('general','general');
}
$result = mysqli_query($conn,$sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $nickname = $row['nickname'];
        $track = $row['track'];
        $level = $row['level'];
        $score = $row['score'];
        $user = new User($nickname,$track,$level,$score);
        array_push($userRanking,$user);
    }
}else{
    die('error fetching rankings please try again later');
}
$res =json_encode($userRanking);
    $file = fopen('results.json','w') or die('error creating file');
    fwrite($file,$res);

 ?>
 <!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" href="./index.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link rel="shortcut icon" href="https://30daysofcode.xyz/favicon.png" type="image/x-icon">
    </head>
    <body>
      <div class="filter">
        <form id="filterform" action="#" method="GET">
        <select name="track" id="track" class="form-control">
            <?php
            include "../config/connect.php";
            $sql = "SELECT DISTINCT `track` FROM user";
            $result = mysqli_query($conn,$sql);
            if ($result && mysqli_num_rows($result) > 0) {
              echo "<option value='general' id='trackNull'>General</option>";
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['track']."' id='".$row['track']."'>".$row['track']."</option>";
              }
            }
             ?>
          </select>
          <select name="level" id="level" class="form-control">
          <option value="general" id="levelNull">General</option>
           <option value="beginner" id="beginner">Beginner</option>
           <option value="intermediate" id="intermediate">Intermediate</option>
          </select>
          <button type="submit" class="btn btn-warning">Filter</button>          
        </form>
      </div>
      <div class="center">
        <div class="top3">
          <div class="two item">
            <div class="pos">
              
            </div>
            <div class="pic" style="background-image: url()"></div>
            <div class="name">
              
            </div>
            <div class="track"></div>
            <div class="score">
              
            </div>
          </div>
          <div class="one item">
            <div class="pos">
              
            </div>
            <div class="pic" style="background-image: url()"></div>
            <div class="name">
             
            </div>
            <div class="track"></div>
            <div class="score">
              
            </div>
          </div>
          <div class="three item">
            <div class="pos">
              
            </div>
            <div class="pic" style="background-image: url()"></div>
            <div class="name">
           
            </div>
            <div class="track"></div>
            <div class="score">
              
            </div>
          </div>
        </div>
          <div class="list others">
          </div>
        </div>
      <script src="leaderboard1.js"></script>
    </body>
</html>
