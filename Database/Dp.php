<?php

//$con=mysqli_connect("192.168.137.218","root","","inventorymanagment");
//$con=mysqli_connect("06.mysql.servage.net","1005138_ap72875","GolfTango@5432","1005138-sahyog");
$con=mysqli_connect("06.mysql.servage.net","1005138_ap72875","GolfTango@5432","1005138-sahyog");

// Check connection
if ($con->connect_errno) {
  die("Connection failed: " . $con->connect_error);
}else{
//echo "Connected successfully";
}
?>

