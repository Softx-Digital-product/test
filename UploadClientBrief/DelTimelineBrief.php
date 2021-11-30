<?php
include 'Dp.php';

$id = $_GET['v'];
$cid= $_GET['c'];
echo $id;
echo $cid;

$sql="DELETE FROM BreifTimeline_data WHERE Sr_no = $id";
echo $sql;
if(mysqli_query($con, $sql)){
    
    
  //header("Location:" .$location);
   echo " Delete Succesfully";
    header("Location:http://apajuris.in/work/viewbriefs.php?v=$cid");
       die();
}
else{
    echo "<h3> can't Delect user </h3>";
}
mysqli_close($con);
?>
