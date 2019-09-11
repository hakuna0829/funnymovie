<?php

$db_host    = "localhost";
$db_user    = "root";
$db_pwd     = "";
$db_name    = "funnyvideo";

$conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);
   
if(! $conn ){
   die('Could not connect: ' . mysqli_error($conn));
}
// mysqli_close($conn);
