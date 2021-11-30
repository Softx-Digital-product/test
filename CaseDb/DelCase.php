<?php
include 'Dp.php';
$id = $_GET['n'];

echo  $id;
$sql="DELETE FROM Client_CaseDb WHERE Case_Path = '$id'";
if(mysqli_query($con, $sql)){
    //echo $sql;
    
  //header("Location:" .$location);
   echo " Delete Succesfully";
   
   $path = "../$id";
if(!rmdir($path)) {
  echo ("Could not remove $path");
}
   echo $path;
    header("Location:http://apajuris.in/work/ClientCase.php");
    die();
}
else{
    echo "<h3> can't Delect user </h3>";
}
mysqli_close($con);
?>

?>