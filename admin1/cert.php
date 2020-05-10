<?php
require('../config/connect.php');
require('../config/session.php');
if(isset( $_SESSION['login_user'])){
$id = $_GET['id'];
$sql = "SELECT * FROM submissions WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
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
<link href="../error/styles.css" rel="stylesheet" />
<link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
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
                    <a class='nav-link' href='waiting_room.php'>Waiting Room</a> 
                    <a class='nav-link' href='superadmin.php'>Super Admin</a>
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
                <h1 class="mt-4">Dashboard</h1>
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Certificate</div>
                    <div class="card-body">
                    <?php  
            if (isset($_POST['submit'])){
              $type = $_POST['type'];
              $first = $_POST['first'];
              $last = $_POST['last'];
              $track = $_POST['track'];
              $certify = 1;
              $response = file_get_contents("http://30days.autocaps.xyz/generate/?type={$type}&first_name={$first}&last_name={$last}&track={$track}");
            }
          ?>
          <?php if($certify == 1){ ?>
            <a href="<?php echo $response; ?>"><button class="btn btn-primary mb-2">Download Certificate</button></a>
          <?php } ?>
        <form method="POST">
            <div class="form-group">
            <input type="name" name="first" class="form-control" id="first" placeholder="First Name" required>
            <br>
            <input type="name" name="last" class="form-control" id="last" placeholder="Last Name" required>
            <br>
            <select name="type" id="type" value="" class="form-control">
              <option value="1">Certificate of Participation</option>
              <option value="2">Certificate of Mentor</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Receive Certificate</button>
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
<script src="../error/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
}else{
header("location:../../sign_in.php"); 
}
?>
