<?php

include('Dp.php');

$Date = $_POST['Date'];
$cc = $_POST['CC_text'];
$ct =$_POST['CT_text'];
$cs= $_POST['SC_text'];
$Ckeditor = $_POST['editor'];
$Title= $_POST['title'];

//echo $Date,"<br>";
//echo $cc,"<br>";
//echo $ct,"<br>";
//echo $cs,"<br>";
//echo $Ckeditor,"<br>";
//echo $Title,"<br>";


$check=mysqli_num_rows(mysqli_query($con,"SELECT * from knowledge_data Where K_Title='$Title'"));
if($check>0){
   $msgs="<br> This DATA is already present";
  echo $msgs;
   
// }
}
else{

  $sql ="INSERT into knowledge_data (K_Category,K_Sub_Category,K_Date,K_Type,K_Title,K_Content) 
  VALUE('$cc','$cs','$Date','$ct','$Title','$Ckeditor')";
     
if ($con->query($sql) === TRUE) {
  $msgs="Add Sucessfully";
 
  //echo $_SESSION["mail"];
 
  echo "Saved Sucessfully Bro";
   header("Location:http://apajuris.in/work/TestingDS.php");
  
} else {
  
  echo "Error: ----->" . $sql . "<br>" . $con->error;
}

$con->close();
}





?>