<?php
include 'Dp.php';
$Cid = json_decode($_POST['id']);

$sql="DELETE FROM knowledge_subcateg WHERE Sr_no = '$Cid'";
if(mysqli_query($con, $sql)){
    
    
  //header("Location:" .$location);
   echo " Delete Succesfully";
}
else{
    echo "<h3> can't Delect user </h3>";
}
mysqli_close($con);
?>

?>