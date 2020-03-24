<?php
ob_start();
session_start();

function logged_in()
{
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        return true;
    }else{
        return false;
    }
}
 ?>