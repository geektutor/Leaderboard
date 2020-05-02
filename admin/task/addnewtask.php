<?php
require('../../config/connect.php');
require('../../config/session.php');
if(isset( $_SESSION['login_user'])){
    $day = strtotime("2020-04-01");
    $currdates = date("Y-m-d");
    $currdate = strtotime($currdates);
    $diff = abs($currdate - $day);
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
    $days +=1;
  
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
        <link href="../../error/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" href="././assets/img/favicon.png" type="image/x-icon">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">30DaysOfCode.xyz</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class='nav-link' href='index.php'>View Tasks</a>
                            <a class='nav-link' href='addnewtask.php'>Add New Task</a>
                            <a class='nav-link' href='../superadmin.php'>Super Admin</a>
                            <a class='nav-link' href='https://30daysofcode.xyz/user'>Normal User Dashboard</a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$_SESSION['login_user'];?>
                    </div> 
                </nav> 
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Add New Task</h1>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>View A Submission</div>
                            <div class="card-body">
                                <?php
                                $error = "";
                                if (isset($_POST['submit'])) {
                                    $day = $_POST['day'];
                                    $track = $_POST['track'];
                                    $level = $_POST['level'];
                                    $task = mysqli_real_escape_string($conn, $_POST['task']);
                                    
                                    $sql = "INSERT INTO task(task_day, track, task, level) VALUES('$day', '$track', '$task', '$level')";
                                    $result = mysqli_query($conn, $sql);
                                    // var_dump($sql); die;
                                    if ($conn->query($sql)) {
                                        $error = "Task uploaded successfully";
                                    }else{
                                        echo "string";
                                    }
                                }
                                ?>
                                <?php if($error !== ''){ ?>
                                    <div class="alert alert-primary alert-dismissable">
                                        <?= $error; ?>
                                    </div>
                                <?php }?>
                                <form method="POST">
                                    <div class="form-group">
                                    <label for="point">Day</label> <br>
                                    <input class="form-control" type="text" name="day" readonly="" value="<?=$days; ?>">
                                    <br><label for="point">Track</label> <br>
                                    <select class="form-control" name="track">
                                        <option value="frontend">Frontend</option>
                                        <option value="backend">Backend</option>
                                        <option value="mobile">Mobile</option>
                                        <option value="python">Python</option>
                                        <option value="ui">UIUX</option>
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">Choose level</small>

                                    <br><label for="point">Level</label> <br>
                                    <select class="form-control" name="level">
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                    </select>
                                    <small id="emailHelp" class="form-text text-muted">Choose the track</small>

                                    <br><label for="point">Task</label> <br>
                                    <textarea name="task" class="form-control" id="feedback" placeholder="Enter the task" rows="7"></textarea>
                                    <small id="emailHelp" class="form-text text-muted">Enter the task</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
        <script src="../../error/scripts.js"></script>
    </body>
</html>
<?php
}else{
    header("location:../../login.php"); 
}
?>
