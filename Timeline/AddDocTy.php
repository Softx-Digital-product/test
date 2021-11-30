

<?php

include 'Dp.php';

$Tname= json_decode($_POST['name']);
 //$Cname="Tax Law";

//echo $Cname;



$check=mysqli_num_rows(mysqli_query($con,"SELECT * from Document_type Where Document_name ='$Tname'"));
if($check>0){
   $msgs="<br> This Type is already present";
  echo $msgs;
   
// }
}
else{

  $sql ="INSERT into Document_type (Document_name) 
  VALUE('$Tname')";
     
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