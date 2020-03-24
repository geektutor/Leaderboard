<?php
  //include db connection
  include "../config/connect.php";


  //array of fetched users 
  //user class for each fetched user
  class User 
  {
    public $nickname;
    public $track;
    public $score;

    function __construct($nickname,$track,$score){
      $this->nickame = $nickname;
      $this->track = $track;
      $this->score = $score;
    }
  }

  //fetch user ranking
  $sql = "SELECT * FROM user ORDER BY `score` DESC";
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['isAdmin']==1) {
        return false;
      }else{
        $nickname = $row['nickname'];
        $track = $row['track'];
        $score = $row['score'];        
        $user = new User($nickname,$track,$score);
        array_push($usersranking,$user);
      }
    }
  }
  echo count($usersranking);
 ?>

<!-- <!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="index.css">
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
              <div class="item">
                <div class="pos">
                  4
                </div>
                <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/men/88.jpg&#39;)"></div>
                <div class="name">
                  Bayo
                </div>
                <div class="score">
                  5980
                </div>
              </div>
              <div class="item">
                <div class="pos">
                  5
                </div>
                <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/women/29.jpg&#39;)"></div>
                <div class="name">
                  Shayo
                </div>
                <div class="score">
                  5978
                </div>
              </div>
              <div class="item">
                <div class="pos">
                  6
                </div>
                <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/women/85.jpg&#39;)"></div>
                <div class="name">
                  Mo
                </div>
                <div class="score">
                  5845
                </div>
              </div>
              <div class="item">
                <div class="pos">
                  7
                </div>
                <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/women/39.jpg&#39;)"></div>
                <div class="name">
                  Cinnamon
                </div>
                <div class="score">
                  5799
                </div>
              </div>
              <div class="item">
                <div class="pos">
                  8
                </div>
                <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/men/77.jpg&#39;)"></div>
                <div class="name">
                  Oma
                </div>
                <div class="score">
                  5756
                </div>
              </div>
              <div class="item">
                <div class="pos">
                  9
                </div>
                <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/women/49.jpg&#39;)"></div>
                <div class="name">
                  Chris
                </div>
                <div class="score">
                  5713
                </div>
              </div>
              <div class="item">
                <div class="pos">
                  10
                </div>
                <div class="pic" style="background-image: url(&#39;https://randomuser.me/api/portraits/women/30.jpg&#39;)"></div>
                <div class="name">
                  Angel
                </div>
                <div class="score">
                  5674
                </div>
              </div>
            </div>
          </div>
    </body>
</html> -->
<?php 
echo '<script>';
echo 'var usersrankings = ' . json_encode($usersranking) . ';';
echo '</script>';
?>