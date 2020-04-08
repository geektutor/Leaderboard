<?php
 include("../config/connect.php");
 $sql = "SELECT * FROM `user`";
 $result = $conn->query($sql);
 $count = mysqli_num_rows($result);
 $sql='';
 if($count > 0){
   for($i = 0; $i < 10; $i++){
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $hash_password =  $hashed_password = password_hash($row['password'],PASSWORD_DEFAULT,array('cost'=>12));
   $sql .="UPDATE user SET password ='$hash_password'  WHERE user.id=".$row['id'].";";
   // $stmt = $conn->prepare("UPDATE `user` SET `password` =?  WHERE `user`.`id` = ? ");
   // $stmt->bind_param("ss",$hash_password,$rows[$i]['id']);
    //$status = $stmt->execute(); 
    }
    $conn->multi_query($sql);
    echo  $conn->error;
}

?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="stylesheet" href="../dashboard/user/assets/css/submissions.css">
    <title>Document</title>
    <style>
    body{
        background:#272727;
    }
    .table-responsive{
        width:70%;
        margin:50px auto;
    }
    th{
        background:#000;
    }
    .table tr:nth-child(even){
        background:#000;
        color:#fff;
    }
    .table tr:nth-child(odd){
        background:rgba(245,121,0,0.7);
        color:#fff;
    }
    </style>
</head>
<body>
<div class="table-responsive" style="text-align: right;">
    <table class="table" >
    <thead>
          <tr>
            <th scope="col">Action</th>
            <th scope="col">nickname</th>
            <th scope="col">password hashed</th>
            
          </tr>
        </thead>
    <tbody>
    <?php 
        //   if($count > 0){
        //       $j =1;
        //       while($row = $result->fetch_assoc()) {
          ?>
    <tr>
  <td><input type="checkbox" name="hashit"></td>
  <td></td>
  <td></td>
  </tr>
  <?php 
            //   $j++;
            //   }}else{
            //       echo `<p>no unhashed password</p>`;
            //   }
          ?>
    </tbody>
    </table>
    </div>
</body>
</html> -->