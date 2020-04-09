<?php
  $userRanking = array();
  function getUSerRankings($fetched_array)
  {
    include "../config/connect.php";

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

    if (isset($_GET['filter']) && !empty($_GET['filter'])) {
      //preparing the query parameter
      $filter = $_GET['filter'];
      $filter = explode('+',$filter);
      function myfunction($v1,$v2)
      {
      return $v1 . " " . $v2;
      }
      $filter = array_reduce($filter,"myfunction");
      $filter = trim($filter);


      switch ($filter) {
        case 'General':
          $val = '';
          $sql = "SELECT * FROM user WHERE `isAdmin` = 0 And `university`='$val' ORDER BY `score` DESC LIMIT 20";
          break;

        default:
          $sql = "SELECT * FROM user WHERE `isAdmin` = 0 AND `university` ='$filter' ORDER BY `score` DESC LIMIT 20";
          break;
      }
    }else{
      $val = '';
      $sql = "SELECT * FROM user WHERE `isAdmin` = 0 And `university` = '$val' ORDER BY `score` DESC LIMIT 20";
    }
    $result = mysqli_query($conn,$sql);
    if ($result) {
      echo "worked";
    }
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          $nickname = $row['nickname'];
          $track = $row['track'];
          $score = $row['score'];
          $user = new User($nickname,$track,$score);
          array_push($fetched_array,$user);
      }
    }
    $res =json_encode($fetched_array);
    $file = fopen('results.json','w') or die('error creating file');
    fwrite($file,$res);
  }
  getUSerRankings($userRanking);
 ?>
 <!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
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
        </form>
        <a href="track.php" class="btn btn-warning">Filter By Track</a>
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
