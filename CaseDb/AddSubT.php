<?php

include 'Dp.php';

$Cid = json_decode($_POST['id']);
$subC= json_decode($_POST['Subc']);



$check=mysqli_num_rows(mysqli_query($con,"SELECT * from Case_SubType where Case_SubType='$subC'"));
if($check>0){
   $msgs="<br> This Sub Category is already present";
  echo $msgs;
   
// }
}
else{

  $sql ="INSERT into Case_SubType (Cid,Case_SubType) 
  VALUES('$Cid','$subC')";
     
if ($con->query($sql) === TRUE) {

} else {

  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
}

?>


?>