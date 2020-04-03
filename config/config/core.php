<?php
ob_start();
session_start();

function logged_in()
{
    if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
        return true;
    }else{
        return false;
    }
}
 ?>