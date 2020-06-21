<?php
$user ='root';
$pass ='';
$db ='IOCL';

$conn = new mysqli('localhost',$user,$pass,$db) or die("ERROR:" . mysqli_connect_error());
?>