<?php
include 'Dp.php';
$id = $_GET['v'];
//echo  $id;
$sql="DELETE FROM ClientDb WHERE Full_Name = '$id'";
if(mysqli_query($con, $sql)){
    //echo $sql;
    
  //header("Location:" .$location);
   echo " Delete Succesfully";
   
   $path = "../ClientData/$id";
if(!rmdir($path)) {
  echo ("Could not remove $path");
}
   
    header("Location:http://apajuris.in/work/Clients.php");
    die();
}
else{
    echo "<h3> can't Delect user </h3>";
}
mysqli_close($con);
?>

?>