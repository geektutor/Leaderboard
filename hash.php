<?php
 include("config/connect.php");
 function password_is_hash($password){
     //this function is used to validate if a password has been hashed before 
    $nfo = password_get_info($password);
    return $nfo['algo'] != 0 &&  (($password === $password) && !password_verify($password,$password));
}
 if(isset($_POST["submit"]) && $_POST["submit"]!=""){
     //check if ids were sent
     if(isset($_POST['id'])){
        $count = count($_POST['id']);
        for($i=0; $i<$count; $i++){
            $sql = "SELECT * FROM user WHERE `id` ='" . $_POST['id'][$i] . "'";
            $result = $conn->query($sql);
            $rows = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //if the user actually exist, and his paasword has not been hashed then hash it
        if($rows > 0 && !password_is_hash($row['password'])){
           $hash_password =  $hashed_password = password_hash($row['password'],PASSWORD_DEFAULT,array('cost'=>12));
           $sql ="UPDATE user SET password ='$hash_password'  WHERE user.id=".$row['id'].";";
           $result = $conn->query($sql);
           if(!$result){
               echo "hashing not successfull".$conn->error;
           }
        }

     }
  }
}
 $sql = "SELECT * FROM `user`";
 $result = $conn->query($sql);
 $count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="stylesheet" href="../dashboard/user/assets/css/submissions.css">
    <title>Hashed</title>
<style>
body{
    background:linear-gradient(to bottom, #8350CE,#5613BB);
    background-size:100% 100%;
}
.table-responsive{
    width:70%;
    margin:50px auto;
}
th{
    background:navy;
    color:#fff;
}
.table tr:nth-child(even){
    background:#E2EDF9;
    color:#000;
}
.table tr:nth-child(odd){
    background:#B3E8FF;
    color:#000;
}
input[type="checkbox"]{
    content: '\a0'; /* non-break space */
    display: inline-block;
    vertical-align: .2em;
    width: 1.9em;
    height: 1.5em;
    margin-right: .2em;
    border-radius: .2em;
    text-indent: .15em;
    line-height: .65;
}

input[type="checkbox"]:checked{
content: '\2713';
}
.select-css {
    display: block;
    font-size: 16px;
    font-family: sans-serif;
    font-weight: 700;
    color: #444;
    line-height: 1.3;
    padding: .6em 1.4em .5em .8em;
    width: 25%;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0;
    border: 1px solid #aaa;
    box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
    border-radius: .5em;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    background-color: #fff;
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
        linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    background-repeat: no-repeat, repeat;
    background-position: right .7em top 50%, 0 0;
    background-size: .65em auto, 100%;
}
.select-css::-ms-expand {
    display: none;
}
.select-css:hover {
    border-color: #888;
}
.select-css:focus {
    outline: none;
}
.select-css option {
    font-weight:normal;
}
.group{
    display:flex;
    margin-bottom:10px;
}
.submit{
    background:linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    margin-left:10px;
    padding: .6em 2em .5em 2em;
    border:none;
    border-radius:50px;
}
        </style>
</head>
<body>
<div class="table-responsive" style="text-align: left;">
<form method = "POST" name="hashform" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> '>
<div class="group">
<select class="select-css" name="action">
                <option value="bulk">Bulk Actions</option>
                <option value="hash">Hash</option>
    </select>
    <button class="submit" name="submit" value="submit">Apply</button>
    </div>
    <table class="table" >
    <thead>
          <tr>
            <th scope="col"><input type="checkbox" class="selectAll">select All</th>
            <th scope="col">nickname</th>
            <th scope="col">email</th>
            <th scope="col">password hashed</th>

          </tr>
        </thead>
    <tbody>
    <?php 
          if($count > 0){
              $j =1;
              while($row = $result->fetch_assoc()) {
                  if(password_is_hash($row['password'])) continue;
          ?>
    <tr>
            <td><input type="checkbox" name='id[]' value='<?php echo $row['id']?>'></td>
            <td><?php echo $row['nickname']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo password_is_hash($row['password'])? 'True'  :'false';?></td>
  </tr>
  <?php  $j++;}}else{echo `<p>no unhashed password</p>`;}?>
    </tbody>
    </table>
 </form>
    </div>
    <script>
    const [ selectAll,...allCheckbox] = document.querySelectorAll("input[type='checkbox'");
    const button = document.querySelector('.submit')
    const action = document.querySelector('.select-css')
    let checked =0;
    function isChecked(){
        if(this.checked){
             checked = checked + 1;
        }else{
            checked = checked - 1;
        }

    }
    allCheckbox.forEach(checkbox =>{
         checkbox.addEventListener("change",isChecked)  
    })
    selectAll.addEventListener("change",function(){
        checked = 0;
        if(this.checked){
        allCheckbox.forEach(checkbox=>{
        checkbox.checked = true;
        checked = checked + 1;
        })
        }else{
         allCheckbox.forEach(checkbox=>{
        checkbox.checked = false;
        })
    }

    })
   button.addEventListener('click',function(e){
       if(checked > 0 ){
          if(action.value == "bulk"){
              alert("please choose the action you want to carry")
              e.preventDefault();
          }

    }else{
        alert("please select at least 1 item to Hash")
              e.preventDefault();
    }
})
    </script>
</body>
</html>