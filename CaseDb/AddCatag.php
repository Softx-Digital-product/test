

<?php

include 'Dp.php';

$Cname= json_decode($_POST['name']);
 //$Cname="Tax Law";

//echo $Cname;



$check=mysqli_num_rows(mysqli_query($con,"SELECT * from knowledge_categ Where Category='$Cname'"));
if($check>0){
   $msgs="<br> This Category is already present";
  echo $msgs;
   
// }
}
else{

  $sql ="INSERT into knowledge_categ (Category) 
  VALUE('$Cname')";
     
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
  
 

  //echo $_SESSION["mail"];
 
  echo "Saved Sucessfully Bro";
  
} else {
  $msgs =  "Error: ----->" . $sql . "<br>" . $con->error;
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
}

?>