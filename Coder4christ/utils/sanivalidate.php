<?php 
function validateEmail($email,$error){
      $email = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
      if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
         $error .= 'email input is wrong, please check\n';
        }
      return $email;
}
function validateString($str,$description,$error){
     $str = filter_var(trim($str),FILTER_SANITIZE_STRING);
     if(empty($str)){
        $error .= " $description  is wrong, please check\n";
     }
   return $str;
}



?>
