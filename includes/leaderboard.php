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
  }
  getUSerRankings($userRanking);
 ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../public/css/index.css">
    </head>
    <body>
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
            <div class="score">
              50
            </div>
          </div>
        </div>
          <div class="list">
          </div>
        </div>

      <script src="../public/js/jquery-2.2.3.min.js"></script>
      <script>
      $.ajax({
        url : "./results.json",
        success : function(result) {
          //result);
          updateRankings(result);
        },
      })
      function updateRankings(ranks) {
        //update first position
        var first = ranks[0];
        $('div.one .name').text(first.nickname);
        $('div.one .pic').css({"background-image": `url(https://robohash.org/${first.nickname+first.track})`});
        $('div.one .score').text(first.score);

        //update second Position
        var second = ranks[1];
        $('div.two .name').text(second.nickname);
        $('div.two .pic').css({"background-image": `url(https://robohash.org/${second.nickname+second.track})`});
        $('div.two .score').text(second.score);

        //update third position
        var third = ranks[2];
        $('div.three .name').text(third.nickname);
        $('div.three .pic').css({"background-image": `url(https://robohash.org/${third.nickname+third.track})`});
        $('div.three .score').text(third.score);

        //update the rest
        var starter = 4
        for (let i = 3; i < ranks.length; i++) {
          var markup =`
          <div class="item">
              <div class="pos">
                ${starter}
              </div>
              <div class="pic" style="background-image: url(https://robohash.org/${ranks[i].nickname+ranks[i].track})"></div>
              <div class="name">
                ${ranks[i].nickname}
              </div>
              <div class="score">
                ${ranks[i].score}
              </div>
            </div>`;
          $('div.list').append(markup);
          starter++
        }
      }

      </script>
    </body>
</html>
