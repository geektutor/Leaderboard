<!-- <?php
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
 ?> -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="leaderboard.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap"
      rel="stylesheet"
    />
    <title>30DOC Awards</title>
  </head>
  <body class="flex col"> 
     <div id="startAnimate"></div>
    <main class="flex col">
      <h1 class="txt reg">
        30 Days Of Code <span class="dispM">- FINAL RANKINGS</span>
      </h1>
      <div class="card flex">
        <div class="top3-card">
          <svg
            class="curtain"
            xmlns="http://www.w3.org/2000/svg"
            width="46"
            height="502"
            viewBox="0 0 46 502"
          >
            <defs>
              <style>
                .cls-1 {
                  fill: #ce053e;
                }

                .cls-2 {
                  fill: #aa043b;
                }

                .cls-3 {
                  fill: #f7b208;
                }

                .cls-4 {
                  fill: #ea8b00;
                }
              </style>
            </defs>
            <g
              id="Group_54"
              data-name="Group 54"
              transform="translate(-7489 194)"
            >
              <path
                id="Path_25"
                data-name="Path 25"
                class="cls-1"
                d="M0,0V273.6c1.633.8,1.143.8,1.469.8C16.98,287.2,33.8,178.4,38.857,32c.327-10.4.816-16,1.143-32Z"
                transform="translate(7495 -194)"
              />
              <path
                id="Path_26"
                data-name="Path 26"
                class="cls-2"
                d="M1.352,274.4a3.258,3.258,0,0,0,2.554.8C16.525,273.6,24.036,168.8,28.393,32c.3-10.4.751-16,.9-32H0V273.6C1.5,273.6,1.052,274.4,1.352,274.4Z"
                transform="translate(7489 -194)"
              />
              <path
                id="Path_27"
                data-name="Path 27"
                class="cls-1"
                d="M0,496V292.8c1.567-.8,1.1-.8,1.411-.8C16.3,279.2,26.018,406.4,37.3,464c1.411,7.2.784,16,1.1,32Z"
                transform="translate(7489 -188)"
              />
              <path
                id="Path_28"
                data-name="Path 28"
                class="cls-2"
                d="M28.482,464C19.037,412.8,16.529,306.4,6.2,292.8c-.59-.8-1.181-1.6-1.771-1.6a3.012,3.012,0,0,0-2.361.8c-.3,0-1.033.8-1.328.8L0,299.2V496H29.22C29.073,480,29.81,471.2,28.482,464Z"
                transform="translate(7489 -188)"
              />
              <path
                id="Path_29"
                data-name="Path 29"
                class="cls-3"
                d="M11.138,264H0v40H11.138c1.831,0,3.509-10.4,3.509-20S12.969,264,11.138,264Z"
                transform="translate(7489 -190.526)"
              />
              <path
                id="Path_30"
                data-name="Path 30"
                class="cls-4"
                d="M9.6,284c0-9.6-1.391-20-3.2-20H0v40H6.4C8.209,304,9.6,293.6,9.6,284Z"
                transform="translate(7489 -190.526)"
              />
            </g>
          </svg>
          <svg
            class="curtain rightCurtain"
            id="Group_55"
            data-name="Group 55"
            xmlns="http://www.w3.org/2000/svg"
            width="46"
            height="502"
            viewBox="0 0 46 502"
          >
            <defs>
              <style>
                .cls-1 {
                  fill: #ce053e;
                }

                .cls-2 {
                  fill: #aa043b;
                }

                .cls-3 {
                  fill: #f7b208;
                }

                .cls-4 {
                  fill: #ea8b00;
                }
              </style>
            </defs>
            <path
              id="Path_25"
              data-name="Path 25"
              class="cls-1"
              d="M40,0V273.6c-1.633.8-1.143.8-1.469.8C23.02,287.2,6.2,178.4,1.143,32,.816,21.6.327,16,0,0Z"
              transform="translate(0)"
            />
            <path
              id="Path_26"
              data-name="Path 26"
              class="cls-2"
              d="M27.942,274.4a3.258,3.258,0,0,1-2.554.8C12.769,273.6,5.258,168.8.9,32,.6,21.6.15,16,0,0H29.294V273.6C27.792,273.6,28.242,274.4,27.942,274.4Z"
              transform="translate(16.706)"
            />
            <path
              id="Path_27"
              data-name="Path 27"
              class="cls-1"
              d="M38.4,496V292.8c-1.567-.8-1.1-.8-1.411-.8C22.1,279.2,12.382,406.4,1.1,464-.313,471.2.313,480,0,496Z"
              transform="translate(7.6 6)"
            />
            <path
              id="Path_28"
              data-name="Path 28"
              class="cls-2"
              d="M.812,464C10.257,412.8,12.765,306.4,23.1,292.8c.59-.8,1.181-1.6,1.771-1.6a3.012,3.012,0,0,1,2.361.8c.3,0,1.033.8,1.328.8l.738,6.4V496H.074C.221,480-.517,471.2.812,464Z"
              transform="translate(16.706 6)"
            />
            <path
              id="Path_29"
              data-name="Path 29"
              class="cls-3"
              d="M3.509,264H14.647v40H3.509C1.678,304,0,293.6,0,284S1.678,264,3.509,264Z"
              transform="translate(31.353 3.474)"
            />
            <path
              id="Path_30"
              data-name="Path 30"
              class="cls-4"
              d="M0,284c0-9.6,1.391-20,3.2-20H9.6v40H3.2C1.391,304,0,293.6,0,284Z"
              transform="translate(36.4 3.474)"
            />
          </svg>
          <div class="podium flex">
            <div class="stand-container second flex col">
              <div class="contestant-detail flex col">
                <div class="group flex col">
                  <span class="name fade"></span>
                  <span class="track fade"></span>
                </div>
                <img
                  src="./lb_assets/avatar.png"
                  class="top-avatar class fade"
                  alt="contestant-avatar"
                />
              </div>
              <div class="stand flex col">
                <div class="top"></div>
                <span class="position">2</span>
                <span class="points fade"></span>
              </div>
            </div>
            <div class="stand-container first flex col">
              <div class="contestant-detail flex col">
                <div class="group flex col">
                  <svg
                    class="crown"
                    xmlns="http://www.w3.org/2000/svg"
                    width="36.874"
                    height="31.064"
                    viewBox="0 0 36.874 31.064"
                  >
                    <defs>
                      <style>
                        .a {
                          fill: #ca842a;
                        }
                        .b {
                          fill: #edb20f;
                        }
                        .c {
                          fill: #ffc50b;
                        }
                        .d {
                          opacity: 0.4;
                        }
                        .e {
                          fill: #f6e568;
                        }
                        .f {
                          fill: #a8213b;
                        }
                        .g {
                          fill: #951d38;
                        }
                        .h {
                          fill: #c0355a;
                        }
                        .i {
                          fill: #b72d4c;
                        }
                      </style>
                    </defs>
                    <g transform="translate(-342.212 -312.803)">
                      <g transform="translate(343.92 322.219)">
                        <path
                          class="a"
                          d="M79.953,169.516l-12.489-2.132,9.4,6.722Z"
                          transform="translate(-67.464 -167.384)"
                        />
                        <path
                          class="a"
                          d="M278.623,169.516l12.489-2.132-9.4,6.722Z"
                          transform="translate(-257.657 -167.384)"
                        />
                      </g>
                      <path
                        class="b"
                        d="M99.748,105.126s-8.79,5.174-9.4,4.569c-.673-.672-6.545-11.429-7.39-11.432s-6.59,10.76-7.264,11.432c-.6.605-9.4-4.569-9.4-4.569-1.18.646,6.209,18.99,6.209,18.99a2.658,2.658,0,0,0,2.658,2.658h15.71a2.658,2.658,0,0,0,2.657-2.658S100.928,105.773,99.748,105.126Z"
                        transform="translate(277.615 217.092)"
                      />
                      <g transform="translate(343.792 312.803)">
                        <path
                          class="c"
                          d="M82.964,98.262c-.843,0-6.59,10.76-7.264,11.432-.6.605-9.4-4.569-9.4-4.569-1.18.647,6.209,18.99,6.209,18.99a2.658,2.658,0,0,0,2.658,2.658h7.792V98.262Z"
                          transform="translate(-66.178 -95.71)"
                        />
                        <circle
                          class="c"
                          cx="2.552"
                          cy="2.552"
                          r="2.552"
                          transform="translate(14.17)"
                        />
                      </g>
                      <g class="d" transform="translate(358.269 313.107)">
                        <path
                          class="e"
                          d="M212.157,78.369c-.448-.448.043-1.69.493-2.139s1.534-.874,1.982-.425S212.605,78.818,212.157,78.369Z"
                          transform="translate(-211.98 -75.614)"
                        />
                      </g>
                      <g transform="translate(342.212 320.669)">
                        <circle
                          class="c"
                          cx="1.678"
                          cy="1.678"
                          r="1.678"
                          transform="translate(33.518)"
                        />
                        <path
                          class="c"
                          d="M390,155.616c-.295-.295.029-1.112.324-1.406s1.009-.574,1.3-.28S390.291,155.911,390,155.616Z"
                          transform="translate(-356.159 -153.604)"
                        />
                        <circle class="c" cx="1.678" cy="1.678" r="1.678" />
                      </g>
                      <g class="d" transform="translate(342.413 320.87)">
                        <path
                          class="e"
                          d="M52.4,155.616c-.295-.295.029-1.112.324-1.406s1.009-.574,1.3-.28S52.7,155.911,52.4,155.616Z"
                          transform="translate(-52.288 -153.805)"
                        />
                      </g>
                      <path
                        class="f"
                        d="M208.367,210.3l-2.926,5.185,2.926,5.185,2.925-5.185Z"
                        transform="translate(152.178 116.182)"
                      />
                      <path
                        class="g"
                        d="M205.441,262.514l2.926,5.185,2.925-5.185Z"
                        transform="translate(152.178 69.15)"
                      />
                      <path
                        class="h"
                        d="M208.367,210.3l-2.926,5.185,2.926,5.185Z"
                        transform="translate(152.178 116.182)"
                      />
                      <path
                        class="i"
                        d="M208.367,262.514h-2.926l2.926,5.185Z"
                        transform="translate(152.178 69.15)"
                      />
                    </g>
                  </svg>
                  <span class="name spin"></span>
                  <span class="track fade"></span>
                </div>
                <img
                  src="./lb_assets/avatar.png"
                  class="top-avatar fade"
                  alt="contestant-avatar"
                />
              </div>
              <div class="stand flex col">
                <div class="top"></div>
                <span class="position">1</span>
                <span class="points fade"></span>
              </div>
            </div>
            <div class="stand-container third flex col">
              <div class="contestant-detail flex col">
                <div class="group flex col">
                  <span class="name fade"></span>
                  <span class="track fade"></span>
                </div>
                <img
                  src="./lb_assets/avatar.png"
                  class="top-avatar fade"
                  alt="contestant-avatar"
                />
              </div>
              <div class="stand flex col">
                <div class="top"></div>
                <span class="position">3</span>
                <span class="points fade"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="theRest-card flex col">
          <h2 class="fade">FINAL RANKINGS</h2>
          <form class="flex row filter-form fade" id="filterform">
            <select class="filter-select" name="" id="filter">
              <option id="overall" value="Overall">Overall Rankings</option>
              <option id="frontend" value="Frontend">Frontend</option>
              <option id="backend" value="Backend">Backend</option>
              <option id="design" value="Design">Engineering Design</option>
              <option id="ui" value="UI">UI/UX</option>
              <option id="python" value="Python">Python</option>
              <option id="android" value="Android">Android</option>
            </select>
            <button id="filterBtn" type="submit">
              Filter
            </button>
          </form>
          <div class="theRest fade">

          </div>
        </div>
      </div>    
    </main>
  
    <script src="award.js"></script>
  </body>
</html>
