<?php
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
function FunctionName()
{
    global $arr;
    echo $arr['a'];
}
// echo json_encode($arr);
?>