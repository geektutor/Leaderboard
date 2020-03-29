<?php
require('config/connect.php');
// require('../../config/session.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - 30 Days Of Code</title>
        <link href="dashboard/dist/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <div id="">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">TASKS</h1>
                       <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>-->
                        
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Select Task</div>
                            <div class="card-body">
                                <?php
                                    if(isset($_POST['submit'])){
                                        $task_day = mysqli_real_escape_string($conn, $_POST['task_day']);
                                        $track = mysqli_real_escape_string($conn, $_POST['track']);
                                       
                                        $sql = "SELECT url FROM task WHERE day = '$task_day' AND track = '$track'";
                                        $result = mysqli_query($conn,$sql);
                                            while($row = mysqli_fetch_assoc($result)) {
                                                header("location:{$row['url']}");
                                        }
                                    }
                            ?>
                                <form method="POST">
                                    <div class="form-group">
                                      <label for="day">Day?</label>
                                      <select name="task_day" class="form-control" aria-describedby="emailHelp" value="">
                                      <option value="day0">Day 0</option>
                                      <option value="day1">Day 1</option>
                                      <option value="day2">Day 2</option>
                                      <option value="day3">Day 3</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="day">Track</label>
                                      <select name="track" class="form-control" aria-describedby="emailHelp" value="">
                                        <option value="frontend">Front End</option>
                                        <option value="backend">Back End</option>
                                        <option value="android">Mobile</option>
                                        <option value="ui">UI/UX</option>
                                        <option value="python">Python</option>
                                        <option value="design">Engineering Design</option>
                                    </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">View Task</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 30DayOfCode 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../dist/js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    </body>
</html>

