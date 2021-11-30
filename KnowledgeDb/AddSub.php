<?php

include 'Dp.php';

$Cid = json_decode($_POST['id']);
$subC= json_decode($_POST['Subc']);



$check=mysqli_num_rows(mysqli_query($con,"SELECT * from knowledge_subcateg where Sub_Category='$subC'"));
if($check>0){
   $msgs="<br> This Sub Category is already present";
  echo $msgs;
   
// }
}
else{

  $sql ="INSERT into knowledge_subcateg (Cid,Sub_Category) 
  VALUES('$Cid','$subC')";
     
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
  
 

  //echo $_SESSION["mail"];
  header("Location: http://apajuris.in/work/knowledge.php");
  echo "Saved Sucessfully Bro";
  
} else {
  $msgs =  "Error: ----->" . $sql . "<br>" . $con->error;
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
}

?>


?>