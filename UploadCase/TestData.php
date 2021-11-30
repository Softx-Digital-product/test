<?php
include 'Dp.php';
//$id = $_GET['n'];

$id="ClientCaseData/Aditya Pratap/SecondCase/OTTsynopsis.pdf";

echo  $id;

   
   $path = "../$id";
// Use unlink() function to delete a file 
if (!unlink($path)) { 
    echo ("$path cannot be deleted due to an error"); 
} 
else { 
    echo ("$path has been deleted"); 
} 
 
mysqli_close($con);
?>
