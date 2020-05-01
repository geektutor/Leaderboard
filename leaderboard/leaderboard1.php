<?php
include "../config/connect.php";
$userRanking = [];
//user class for each fetched user
class User
{
    public $nickname;
    public $track;
    public $score;

    function __construct($nickname,$track,$score){
    $this->nickname = $nickname;
    $this->track = $track;
    $this->score = $score;
    }
}

//categories for filter 
if (isset($_GET['track']) and isset($_GET['level'])) {
    $track = $_GET['track'];
    $level = $_GET['level'];    
    $sql = "SELECT * FROM leaderboards WHERE `track`='$track' AND `level` = '$level' ORDER BY `score` DESC LIMIT 20";
}
elseif (isset($_GET['track']) and !isset($_GET['level'])) {
    $track = $_GET['track'];    
    $sql = "SELECT * FROM leaderboards WHERE `track`='$track' ORDER BY `score` DESC LIMIT 20";
}
elseif (!isset($_GET['track']) and isset($_GET['level'])) {
    $level = $_GET['level'];    
    $sql = "SELECT * FROM leaderboards WHERE AND `level` = '$level' ORDER BY score DESC LIMIT 20";
}
else {    
    $sql = "SELECT * FROM leaderboards ORDER BY `score` DESC LIMIT 20";
}

echo $sql;
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
        <form id="filterform">
          <select name="" id="filter" class="form-control">
            <?php
            include "../config/connect.php";
            $sql = "SELECT DISTINCT `university` FROM user";
            $result = mysqli_query($conn,$sql);
            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $row['university'] == ''?$row['university'] = 'General' : true;
                echo "<option value='".$row['university']."' id='".$row['university']."'>".$row['university']."</option>";
              }
            }
             ?>
          </select>
          <button type="submit" class="btn btn-warning">Filter</button>          
          <a href="track.php" class="btn btn-warning">Filter By Track</a>
        </form>
      </div>
      <div class="center">
        <div class="top3">
          <div class="two item">
            <div class="pos">
              2
            </div>
            <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/men/44.jpg&#39;)"></div>
            <div class="name">
              Ifihan Olusheye
            </div>
            <div class="track">empty</div>
            <div class="score">
              30
            </div>
          </div>
          <div class="one item">
            <div class="pos">
              1
            </div>
            <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/men/31.jpg&#39;)"></div>
            <div class="name">
              Geektutor
            </div>
            <div class="track"></div>
            <div class="score">
              10
            </div>
          </div>
          <div class="three item">
            <div class="pos">
              3
            </div>
            <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/women/91.jpg&#39;)"></div>
            <div class="name">
              Akin Aguda
            </div>
            <div class="track"></div>
            <div class="score">
              50
            </div>
          </div>
        </div>
          <div class="list others">
          </div>
        </div>
      <script src="leaderboard.js"></script>
    </body>
</html>
