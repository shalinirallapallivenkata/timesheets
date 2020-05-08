<?php
include_once __DIR__ . "/../app/config.php";
$recordid=$_POST['recordid'];
$query_res=$conn->query("delete from timeentry where id ="."\"".$recordid."\"");
?>

