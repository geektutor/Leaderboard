<?php
<<<<<<< HEAD
	$day = strtotime("2020-06-07");
=======
    $day = strtotime("2020-06-08");
>>>>>>> 227d9c9e99c7f655dca196beb17c01f7cad4db34
    $currdates = date("Y-m-d");
    $currdate = strtotime($currdates);
    $diff = abs($currdate - $day);
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
    $days +=1;
    $cohort = 2;
