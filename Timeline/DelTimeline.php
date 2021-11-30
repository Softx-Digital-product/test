<?php
include 'Dp.php';

$id = $_GET['v'];

echo $id;

$sql="DELETE FROM Timeline_data WHERE Sr_no = $id";
echo $sql;
if(mysqli_query($con, $sql)){
    
    
  //header("Location:" .$location);
   echo " Delete Succesfully";
    header("Location:http://apajuris.in/work/viewtimeline.php");
    die();
}
else{
    echo "<h3> can't Delect user </h3>";
}
mysqli_close($con);
?>
