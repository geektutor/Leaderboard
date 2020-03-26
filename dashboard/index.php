<?php

  $userRanking = [];
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

    //fetch user ranking
    $sql = "SELECT * FROM user WHERE `isAdmin` = 0 ORDER BY `score` DESC LIMIT 20";
    $result = mysqli_query($conn,$sql);
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
    header('location : leaderboard.php');
  }
  getUSerRankings($userRanking);
 ?>